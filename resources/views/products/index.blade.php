@extends('layouts.app')
@section('title','产品列表')
@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-2">
            <div class="card">
                <div class="card-body">
                    {{-- 筛选开始 --}}
                    <form action="{{ route('products.index') }}" class="search-from">
                        <div class="form-row">
                            <div class="col-md-9">
                                <div class="form-row">
                                    <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
                                    <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="order" class="form-control form-control-sm float-right">
                                    <option value="">排序方式</option>
                                    <option value="price_desc">价格从高到低</option>
                                    <option value="price_asc">价格从低到高</option>
                                    <option value="sold_count_desc">销量最高</option>
                                    <option value="sold_count_asc">销量最低</option>
                                    <option value="rating_desc">评论最多</option>
                                    <option value="rating_asc">评论最低</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="row products-list">
                        @foreach($products as $product)
                            <div class="col-3 product-item">
                                <div class="product-content">
                                    <div class="top">
                                        <div class="img"><img src="{{ $product->image_url }}" alt=""></div>
                                        <div class="price"><b>￥</b>{{ $product->price }}</div>
                                        <div class="title">{{ $product->title }}</div>
                                    </div>
                                    <div class="bottom">
                                        <div class="sold_count">销量 <span>{{ $product->sold_count }}</span></div>
                                        <div class="review_count">评价 <span>{{ $product->review_count }}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="float-right">{{ $products->appends($filters)->render() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    <script>
        var filters = {!! json_encode($filters) !!};
        $(document).ready(function () {
            $('.search-from input[name=search]').val(filters.search);
            $('.search-from select[name=order]').val(filters.order);
            $('.search-from select[name=order]').on('change',function () {
                $('.search-from').submit();
            });
        })
    </script>
@endsection
