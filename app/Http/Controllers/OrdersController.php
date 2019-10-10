<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Http\Requests\OrderRequest;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ProductSku;
use App\Jobs\CloserOrder;
use App\Services\CartService;
use Carbon\Carbon;
use App\Services\OrderService;
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
        //$this->authorize('own', $order);
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }


    public function store(OrderRequest $request, OrderService $orderService){
        // 获取当前登录的用户
        $user = $request->user();
        $userAddress = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $userAddress, $request->input('remark'), $request->input('items'));
    }
}
