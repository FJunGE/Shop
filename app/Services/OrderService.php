<?php
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\ProductSku;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use Carbon\Carbon;

class OrderService{

    /**
     * @param User $user
     * @param UserAddress $address
     * @param $remark
     * @param $items
     * @return mixed
     * @throws \Throwable
     * @deprecated 未保证服务的单一原则，不能引入$request参数
     */
    public function store(User $user, UserAddress $address, $remark, $items)
    {
        // 开启数据库事务
        // 在事务执行中，当有发现数据异常则会终止操作
        $order = \DB::transaction(function () use ($user, $address, $remark, $items){

            $address->update(['last_used_at' => Carbon::now()]);

            // 新建订单
            $order = new Order([
                'address' => [
                    'address' => $address->full_address,
                    'zip' => $address->zip,
                    'contact_name' => $address->contact_name,
                    'contact_phone' => $address->contact_phone
                ],
                'remark' => $remark,
                'total_amount' => 0 // 价格现在是0后面再做一个update
            ]);

            // 插入对应关联关系
            $order->user()->associate($user);

            // 订单保存
            $order->save();
            $total_amount = 0;

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
                    throw new InvalidRequestException('库存不足');
                }
            }

            // 更新总订单金额
            $order->update([
                'total_amount' => $total_amount
            ]);

            // 移除购物车数据
            $skuIds = collect($items)->pluck('sku_id')->all(); // collect提前items数组里面的sku_id值作为一个数组
            app(CartService::class)->remove($skuIds);

            return $order;
        });

        // 将订单逻辑操作事务写入脚本中自动运行
        dispatch(new CloserOrder($order, config('app.order_ttl')));
        return $order;

    }
}