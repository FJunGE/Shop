<?php

namespace App\Models;

use App\Exceptions\InternalException;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    protected $fillable = [
        'product_code', 'description', 'price', 'stock', 'cost'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * 自减库存，返回受影响行数
     * @param $amount
     * @return mixed
     * @throws InternalException
     */
    public function decrementStock($amount)
    {
        if ($amount < 0){
            throw new InternalException('库存不足');
        }

        // 判断当前这个sku的库存是否大于操作的库存，并实现自减
        // sql: update ls_product_sku set stock = stock - $amount where id = $id and stock >= $amount
        return $this->where('id', $this->id)->where('stock','>=',$amount)->decrement('stock', $amount);
    }

    public function addStock($amount){
        // 直接库存自增
        return $this->where('id', $this->id)->increment('stock', $amount);
    }
}
