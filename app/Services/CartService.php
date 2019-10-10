<?php

namespace App\Services;

use App\Models\CartItem;
use Auth;

class CartService {

    public function findCart(){
        return Auth::user()->cartItems()->with(['productSku.product'])->get();
    }

    public function add($skuID, $amount)
    {
        $user = Auth::user();

        // 查询下这个产品是否在购物车中，有着在原有基础上添加数据
        if ($item = $user->cartItems()->where('sku_id', $skuID)->first()){

            // 存在添加商品数量
            $item->update([
                'amount' => $item->amount + $amount
            ]);
        }else{

            // 购物车中没有出现这个商品
            $item = new CartItem(['amount' => $amount]);
            $item->user()->associate($user); // associate可以理解为把$user 赋值给$cart->user_id
            $item->productSku()->associate($skuID);
            $item->save();

        }
        return $item;
    }

    public function remove($skuIDs)
    {
        if (!is_array($skuIDs)){

            // 如果不是数组的话，就把sku id 转成数组
            $skuIDs = [$skuIDs];
        }

        Auth::user()->cartItems()->whereIn('sku_id', $skuIDs)->delete();
    }
}