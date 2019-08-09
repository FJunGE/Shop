<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $builder = Product::query()->where('on_sale',true);

        // 模糊查询产品标题，商品描述，sku标题，sku描述
        if ($search = $request->input('search', '')){
            $like = '%' . $search . '%';
            $builder->where(function ($query) use ($like){
                $query->where('title', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like){
                       $query->where('product_code', 'like', $like);
                    });
            });
        }
        // 排序方式，根据传入排序方式对数据，进行排序
        if ($order = $request->input('order', '')){
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)){
                if (in_array($m[1], ['price', 'sold_count', 'rating'])){
                    // 通过正则表达式对数据进行拆分
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products  = $builder->paginate(16);
        return view('products.index', [
            'products'=>$products,
            'filters' => [
                'search' => $search,
                'order' => $order,
            ],
        ]);
    }

    public function show(Product $product, Request $request)
    {
        if (!$product->on_sale){
            throw new \Exception('当前产品未上架');
        }

        return view('products.show', compact('product'));
    }
}
