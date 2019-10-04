<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => [
                // 地址必须填写
                'required',

                // 判断地址id是否在数据库中
                Rule::exists('user_addresses', 'id')->where('user_id', $this->user()->id),
            ],

            'items' => [
                'required',
                'array',
            ],

            'items.*.sku_id' => [ // 检查items下面的每一个子数组 sku_id参数
                'required',
                function ($attribute, $value, $fail){
                    if (!$sku = ProductSku::find($value)){
                        return $fail('商品不存在');
                    }

                    if (!$sku->product->on_sale){
                        return $fail('商品已下架');
                    }

                    if (!$sku->stock > 0){
                        return $fail('商品已卖完');
                    }

                    // 获取item数组的索引下标值
                    preg_match('/items\.(\d+)\.sku_id/', $attribute, $m);
                    $index = $m[1];

                    // 通过索引找到用户的购买数量
                    $amount = $this->input('items')[$index]['amount'];
                    if ($amount > 0 && $amount > $sku->stock){
                        return $fail('商品库存不足');
                    }
                },
            ],

            'items.*.amount' => ['required', 'integer', 'min:1'],
        ];
    }
}
