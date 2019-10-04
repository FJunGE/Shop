<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\ProductSku;
use Illuminate\Http\Request;
use App\Http\Requests\AddCartRequest;

class CartController extends Controller
{

    public function add(AddCartRequest $request)
    {
        $user = $request->user();
        $amount = $request->input('amount');
        $skuId = $request->input('sku_id');


        // 判断这个sku是否在购物车中
        // $user->cartItems()->get() 返回的是这个用户所关联的cartItems数组
        if ($cart = $user->cartItems()->where('sku_id', $skuId)->first()) {

            // 存在则给当前sku数量加1
            $cart->update([
                'amount' => $cart->amount + $amount
            ]);

        }else{

            // 不存在则添加新的产品
            $cart = new CartItem(['amount'=>$amount]);
            $cart->user()->associate($user); // associate可以理解为把$user 赋值给$cart->user_id
            $cart->productSku()->associate($skuId);
            $cart->save();

        }

        return [];
    }

    public function index(Request $request)
    {
        $cartItems = $request->user()->cartItems()->with(['productSku.product'])->get();
        $addresses = $request->user()->addresses()->orderBy('last_used_at', 'desc')->get();
        return view('cart.index',['cartItems' => $cartItems, 'addresses' => $addresses]);
    }

    public function remove(Request $request,ProductSku $sku)
    {
        $request->user()->cartItems()->where('sku_id', $sku->id)->delete();
        return [];
    }
}
