<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CloserOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $delay)
    {
        // 依赖注入
        $this->order = $order;

        // 设置延迟时间 也就是说delay参数即代表多少秒后执行
        $this->delay = $delay;
    }

    /**
     * 定义当前任务具体的操作逻辑
     * 当队列在任务中取出任务是执行这个handle方法
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 数据表中有产生支付时间 则直接return掉
        // 如果已经支付则不需要关闭订单，直接退出
        if ($this->order->paid_at){
            return ;
        }

        // 开启数据库事务
        DB::transaction(function (){
            //  关闭订单
            $this->order->update(['closed' => true]);

            // 循环将订单item购买数量退回给产品库存
            foreach ($this->order->items as $item) {
                $item->productSku->addStock($item->amount);
            }
        });
    }
}
