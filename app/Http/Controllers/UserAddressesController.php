<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;
use Auth;

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

    public function store(UserAddressRequest $userAddressRequest)
    {
        $userAddressRequest->user()->addresses()->create($userAddressRequest->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }
    
    public function edit(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        return view('user_addresses.create_and_edit', ['address'=> $userAddress]);
    }

    public function update(UserAddress $userAddress, UserAddressRequest $request)
    {
        $this->authorize('own', $userAddress);
        $userAddress->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    public function destroy(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        $userAddress->delete();
        return [];
    }
}