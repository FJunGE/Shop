<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Monolog\Logger;
use Yansongda\Pay\Pay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // 支付依赖注入容器中，后期可直接app('支付方式')从容器中获取依赖的配置
        // $this->app->singleton 往服务容器里注入单例对象，可以后期在用
        $this->app->singleton('alipay', function (){
            // 读取阿里支付配置
            $config = config('pay.alipay');

            // 判断当前环境是否是live环境 app
            // app()->environment()获取当前运行环境
            if (app()->environment() !== 'production'){
                // 当前为开发环境
                $config['mode'] = 'dev';
                $config['log']['level'] = Logger::DEBUG;
            }else{
                $config['log']['level'] = Logger::WARNING;
            }
            // 调用 Yansongda\Pay 来创建一个支付宝支付对象
            return Pay::alipay($config);
        });

        $this->app->singleton('wechat_pay', function (){
            $config = config('pay.wechat');

            // 判断当前环境是否是live环境
            if (app()->environment() != 'production'){
                // 如果在开发环境下，log等级必须是debug级别，方便翻查日志
                $config['log']['level'] = Logger::DEBUG;
            }else{
                $config['log']['level'] = Logger::WARNING;
            }
            return Pay::wechat($config);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
