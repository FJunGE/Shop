<?php

namespace App\Providers;

use App\Events\OrderPaid;
use App\Listeners\SendOrderPaidMail;
use App\Listeners\UpdateProductSouldCount;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // 订单支付成功 走这个事件
        OrderPaid::class => [
            UpdateProductSouldCount::class, // 监听：修改产品销量
            SendOrderPaidMail::class, // 监听：发送邮件
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
