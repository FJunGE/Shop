<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Http\Requests\OrderRequest;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ProductSku;
use App\Jobs\CloserOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders =  Order::query()
            ->with(['items.product','items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders'=>$orders]);
    }

    public function show(Request $request, Order $order)
    {
        $this->authorize('own', $order);
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }


    public function store(OrderRequest $request){
        // 获取当前登录的用户
        $user = $request->user();

        // 开启数据库事务
        // 在事务执行中，当有发现数据异常则会终止操作
        $order = Db::transaction(function () use ($user, $request){

            $address = UserAddress::find($request->input('address_id'));
            // 更新地址最后一次使用时间
            $address->update(['last_used_at' => Carbon::now()]);

            // 新建订单
            $order = new Order([
                'address' => [
                    'address' => $address->full_address,
                    'zip' => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone
                ],
                'remark' => $request->input('remark'),
                'total_amount' => 0 // 价格现在是0后面再做一个update
            ]);

            // 插入对应关联关系
            $order->user()->associate($user);

            // 订单保存
            $order->save();
            $total_amount = 0;
            $items = $request->input('items');

            // 循环遍历购物车items
            foreach($items as $data){
                $sku = ProductSku::find($data['sku_id']);
                // 新建一个关联关系的对象，OrderItem的对象，但是不会保存到数据库中
                // 类似下面associate一样
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                    'price' => $sku->price,
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();

                $total_amount += $data['amount'] * $sku->price;
                // 如果库存不足抛出异常
                if($sku->decrementStock($data['amount']) <= 0){
                    throw new InternalException('库存不足');
                }
            }

            // 更新总订单金额
            $order->update([
                'total_amount' => $total_amount
            ]);

            // 移除购物车数据
            $skuIds = collect($items)->pluck('sku_id'); // collect提前items数组里面的sku_id值作为一个数组
            $user->cartItems()->whereIn('sku_id', $skuIds)->delete();

            // 将订单逻辑操作事务写入脚本中自动运行
            $this->dispatch(new CloserOrder($order, config('app.order_ttl')));
            return $order;
        });

        return $order;
    }
}
