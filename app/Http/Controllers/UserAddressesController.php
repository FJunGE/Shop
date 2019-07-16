<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        // 取出的地址是一对多的，一个用户的多个地址
        return view('user_addresses.index',[
            'addresses'=>$request->user()->addresses,
        ]);
    }
    
    public function create(UserAddress $userAddress)
    {
        return view('user_addresses.create_and_edit', ['address' => $userAddress]);
    }
}
