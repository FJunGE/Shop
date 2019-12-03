<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Models\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

// ShouldQueue 这个接口代表异步监听
class UpdateProductSouldCount implements ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  OrderPaid  $event
     * @return void
     */
    public function handle(OrderPaid $event)
    {
        $order = $event->getOrder();
        // 预加载订单下的产品
        $order->load('items.product');

        // 便利订单的产品
        foreach($order->items as $item){
            $product = $item->product;

            // 计算产品的销量
            $soldCount = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query){
                    $query->whereNotNull('paid_at'); //关联的订单必须是为已支付
                })->sum('amount');

            // 更新产品的销量
            $product->update([
                'sold_count' => $soldCount,
            ]);
        }
    }
}
