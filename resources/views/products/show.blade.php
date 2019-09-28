@extends('layouts.app')
@section('titile', $product->title)
@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-body product-info">
                    <div class="row">
                        <div class="col-5">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="cover">
                        </div>
                        <div class="col-7">
                            <div class="title">{{ $product->title }} <span class="small_title"></span></div>
                            <div class="price"><label>价格</label><em>￥</em><span>{{ $product->price }}</span></div>
                            <div class="sales_and_reviews">
                                <div class="sold_count">
                                    累计销量 <span class="count">{{ $product->sold_count }}</span>
                                </div>
                                <div class="review_count">
                                    累计评价 <span class="count">{{ $product->review_count }}</span>
                                </div>
                                <div class="rating" title="评分 {{ $product->rating }}">
                                    <span class="count">{{ str_repeat('💖', $product->rating) }}</span><span class="count">{{ str_repeat('💔', 5 - floor($product->rating)) }}</span>
                                </div>
                            </div>
                            <div class="skus">
                                <label>选择</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    @foreach($product->skus as $sku)
                                        <label class="btn sku-btn" title="{{ $sku->product_code }}" data-sku="{{ $sku->product_code }}" data-placement="bottom" data-toggle="tooltip" data-price="{{ $sku->price }}" data-stock="{{ $sku->stock }}">
                                            <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"> {{ $sku->product_code }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="cart_amount"><label>数量</label><input type="text" class="form-control form-control-sm" value="1"><span>件</span><span class="stock"></span></div>
                            <div class="buttons">
                                @if($favored)
                                    <button class="btn btn-danger btn-disfavor">取消收藏</button>
                                    @else
                                    <button class="btn btn-success btn-favor">❤ 收藏</button>
                                @endif

                                <button class="btn btn-primary btn-add-to-cart">加入购物车</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab" aria-selected="true">商品详情</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab" aria-selected="false">用户评价</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
                                {!! $product->description !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="product-reviews-tab">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
            $('.sku-btn').click(function () {
                $('.small_title').text($(this).data("sku"));
                $('.product-info .price span').text($(this).data('price'));
                $('.product-info .stock').text('库存：'+ $(this).data('stock') + '件');
            });

            // 监听点击收藏产品按钮事件
            $('.btn-favor').click(function () {
                // 进行一个ajax请求
                axios.post('{{ route('products.favor', [ 'product' => $product->id ]) }}')
                    .then(function (){
                        // 请求成功返回响应
                        swal('收藏成功', '', 'success').then(function() {
                            location.reload();
                        });
                    }, function (error) {
                        if (error.response && error.response.status === 401){
                            // 加入状态码是401说明session失效
                            swal('请先登录 傻妹', '', 'error').then(function () {
                                location.href('{{ route('login') }}');
                            });
                            location('{{ route('login') }}');
                        }else if (error.response && (error.response.data.msg || error.response.data.message)){
                            // 其次所有的信息都返回
                            swal(error.response.data.msg ? error.response.data.msg : error.response.data.message, '', 'error');
                        }else{
                            // 最后可能服务器挂了
                            swal('系统挂了，拜拜', '', 'error');
                        }
                    });
            });
            
            $('.btn-disfavor').click(function () {
                axios.delete('{{ route('products.disfavor', ['product' => $product->id]) }}').then(function () {
                    swal('取消收藏成功', '', 'success').then(function () {
                        location.reload();
                    });
                });
            });

            // 点击加入购物车事件
            $('.btn-add-to-cart').click(function () {

                // 请求购物车接口
                axios.post('{{ route('cart.add') }}',{
                    sku_id: $('label.active input[name=skus]').val(),
                    amount: $('.cart_amount input').val()
                }).then(function () {
                    swal('添加购物车成功！', '', 'success').then(function () {
                        location.href ='{{ route('cart.index') }}';
                    });
                },function (error) {
                    if (error.response.status === 401){

                        // 状态401说明用户未登录
                        swal('请登录，跳转至登录界面中...', '', 'error').then(function () {
                            location.href('{{ route('login') }}');
                        });
                    }else if(error.response.status === 422){

                        // 状态422说明validate表单验证不通过
                        var html = '<div>';
                        _.each(error.response.data.errors, function (errors) {
                            _.each(errors, function(error){
                               html += error + '<br>';// 循环把错误写入div中并每条错误加上br换行
                            });
                        });
                        html += '</div>';// 最后在把底补上
                        swal({content:$(html)[0], icon:'error'});
                    }else{

                        //还有一种情况 系统崩溃
                        swal('系统崩溃，稍后再试...');
                    }
                })
            });
        });
    </script>
@endsection