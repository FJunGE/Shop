<?php

namespace App\Services;

use Auth;

class CartService {

    public function __construct()
    {
        // 获取当前用户的关联的sku 和 产品
        return Auth::user()->cartItems()->with(['productSku.product'])->get();
    }
}