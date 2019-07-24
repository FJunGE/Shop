<?php

namespace App\Models;

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
}
