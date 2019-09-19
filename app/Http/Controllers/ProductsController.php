<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
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


    /**
     * 收藏产品
     * @param Request $request
     * @param Product $product
     * @return array
     */
    public function favor(Request $request, Product $product)
    {
        $user = $request->user();
        // 判断是否已经加入了收藏列表
        if ($user->favoriteProducts()->find($product->id))
        {
            // 是的话 返回空
            return [];
        }
        // 添加相应的关联关系
        $user->favoriteProducts()->attach($product);

        return [];
    }

    /**
     * 取消收藏产品
     * @param Request $request
     * @param Product $product
     * @return array
     */
    public function disfavor(Request $request, Product $product)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);
        return [];
    }

    public function show(Product $product, Request $request)
    {
        if (!$product->on_sale) {
            throw new InvalidRequestException('商品未上架');
        }

        $favored = false;
        // 用户未登录是返回null，以登陆则返回用户信息
        if ($user = $request->user()){
            // 当用户从已收藏的商品中能找到这个产品 则表示已经收藏了
            // boolval直接返回true
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }

        return view('products.show', ['product' => $product, 'favored' => $favored]);
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);
        return view('products.favorites', ['products' => $products]);
    }
}
