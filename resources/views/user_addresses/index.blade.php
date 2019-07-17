@extends('layouts.app')
@section('title','收货地址')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card panel-default">
                <div class="card-header">
                    收货地址列表
                    <a href="{{ route('user_addresses.create') }}" class="float-right">新增收货地址</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>收货人</th>
                                <th>地址</th>
                                <th>邮编</th>
                                <th>电话</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td>{{ $address->contact_name }}</td>
                                    <td>{{ $address->full_address }}</td>
                                    <td>{{ $address->zip }}</td>
                                    <td>{{ $address->contact_phone }}</td>
                                    <td>
                                        <a href="{{ route('user_addresses.edit', ['user_address' => $address->id]) }}" class="btn btn-success">修改</a>
                                        <button class="btn btn-danger btn-del-address" type="button" data-id="{{ $address->id }}">删除</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptsAfterJs')
    <script>
        $(document).ready(function () {
            // 删除按钮电竞事件
            $('.btn-del-address').click(function () {
                // 获取按钮上的data-id值，也就是地址的id值
                var id = $(this).data('id');
                // 调用sweetalert弹窗组件
                swal({
                    title:'确认是否要删除这条地址',
                    icon: "warning",
                    buttons: ["取消","确定"],
                    dangerMode: true,
                }).then(function (willDelete){ // 用户点击按钮触发的这个回调函数
                    // 点击确定 willDelete 返回true, 否则反正
                    // 用户点了取消
                    if (!willDelete){
                        // return 终止程序
                        return;
                    }

                    // 用户点了确定
                    // 调用删除接口
                    axios.delete('/user_addresses/'+id).then(function (){
                        // 请求成功后刷新页面
                        location.reload();
                    })
                });

            });
        });
    </script>
@endsection