<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(\App\Models\Product::class, 30)->create();
        foreach ($products as $product){
            // 创建三个sku, 每个sku的product id字段设为当前循环商品的id
            $skus = factory(\App\Models\ProductSku::class, 3)->create(['product_id'=>$product->id]);
            $product->update(['price' => $skus->min('price')]);
        }
    }
}
