<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // 将注册必要路由颁发访问令牌 撤销访问令牌 客户端 个人令牌
        Passport::routes();

        // 使用Gate::guessPolicyNameUsing 方法来自定义策略文件的寻找逻辑
        Gate::guessPolicyNamesUsing(function ($class){
            // class_basename 辅助函数，获取类的简短名称 如： App\Models\User 则获取 User
            return '\\App\\Policies\\'.class_basename($class).'Policy';
        });
    }
}
