<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        // 取出的地址是一对多的，一个用户的多个地址
        return view('user_addresses.index',[
            'addresses'=>$request->user()->addresses,
        ]);
    }
}
