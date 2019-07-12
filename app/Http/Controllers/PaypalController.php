<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    const $product =
    private $Paypla;
    public function __construct()
    {
        $this->Paypla = new ApiContext(new OAuthTokenCredential(
            config('client_id'), config('secret')
        ));
    }

    public function index(){
        return view('paypal');
    }

    public function payment(Request $request){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('')
    }
}
