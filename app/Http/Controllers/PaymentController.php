<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Exceptions\InvalidRequestException;
use Illuminate\Http\Request;
use Monolog\Logger;

class PaymentController extends Controller
{
    /**
     * 根据订单的情况调用支付宝支付接口，yansongda/pay库
     * 回调：订单支付成功后一般会返回服务器回调（支付宝服务器与项目服务器进行匹配） && 前端回调（依赖浏览器）
     * @param Order $order
     * @param Request $request
     * @return mixed
     * @throws InvalidRequestException
     */
    public function payByAlipay(Order $order)
    {
        // 判断订单是否属于当前这个用户, 如果不属于这个用着报419错误
        // $this->authorize('own', $order);

        if ($order->paid_at || $order->closed)
        {
            throw new InvalidRequestException('订单状态不正确');
        }

        return app('alipay')->web([
            'out_trade_no' => $order->no, // 订单编号
            'total_amount' => $order->total_amount, // 订单金额
            'subject'      => '支付'.env('APP_NAME').'订单：'.$order->no, // 订单标题
        ]);
    }

    /**
     * 前端支付回调。用户通过浏览器返回参数传送至服务器
     */
    public function alipayReturn(){
        $data = app('alipay')->verify(); // 校验前端返回值是否符合要求。不确定是否有被用户恶意篡改
        dd($data);
    }

    /**
     * 后端支付回调。支付成功后ali服务器会用订单相关数据请求项目的接口，不用依赖用户访问浏览器
     */
    public function alipayNotify(){
        $data = app('alipay')->verify();
        \Log::debug('Alipay notify', $data->all());
    }
}
