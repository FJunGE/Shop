<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\ProductSku;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title','description','image','on_sale',
        'rating','sold_count','review_count','price'
    ];

    protected $casts = [
        'on_sale' => 'boolean',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function getImageUrlAttribute()
    {
        // 判如果字段image已经包含http 或 https完整路径，url直接返回
        if (Str::startsWith($this->attributes['image'],['https://','http://']))
        {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }
}
