<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku_id' => [
                'required',
                function ($attribute, $value, $fail){
                    if (!$sku = ProductSku::find($value))
                    {
                        return $fail('商品不存在');
                    }

                    if(!$sku->product->on_sale)
                    {
                        return $fail('该商品未上架');
                    }
                    
                }
            ]
        ];
    }
}
