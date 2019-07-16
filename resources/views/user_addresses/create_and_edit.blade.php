@extends('layouts.app')
@section('titile','新增收货地址')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">
                        新增收货地址
                    </h2>
                </div>
                <div class="card-body">
                    {{-- 后端处理异常显示开始 --}}
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <h4>有错误发生</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li><i class="glyphicon glyphicon-remove"></i> {{ error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- 后端异常显示结束 --}}

                    <user-addresses-create-and-edit inline-template>
                    <form class="form-horizontal" role="form">
                        {{-- csrf token --}}
                        {{ csrf_field() }}
                        <select-district @change="onDistrictChanged" inline-template>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-md-right">省市区</label>
                                <div class="col-sm-3">
                                    <select class="form-control" v-model="provinceId">
                                        <option value="">选择省</option>
                                        <option v-for="(name, id) in provinces" :value="id">@{{ name }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" v-model="cityId">
                                        <option value="">选择市</option>
                                        <option v-for="(name, id) in cities" :value="id">@{{ name }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select class="form-control" v-model="districtId">
                                        <option value="">选择区</option>
                                        <option v-for="(name, id) in districts" :value="id">@{{ name }}</option>
                                    </select>
                                </div>
                            </div>
                        </select-district>
                        {{-- 插入3个隐藏字段 --}}
                        {{-- 通过v-model 与 user-address-create-and-edit 组件关联起来 --}}
                        <input type="hidden" name="province" v-model="province">
                        <input type="hidden" name="city" v-model="city">
                        <input type="hidden" name="district" v-model="district">
                        
                        <div class="form-group row">
                            <label for="col-form-label text-md-right col-md-2">详细地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="address" value="{{ old('address', $address->address) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="col-form-label text-md-right col-md-2">邮编</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="zip" value="{{ old('address', $address->zip) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="col-form-label text-md-right col-md-2">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_name" value="{{ old('address', $address->contact_name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="col-form-label text-md-right col-md-2">电话</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_phone" value="{{ old('address', $address->contact_phone) }}">
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </div>
                    </form>
                    </user-addresses-create-and-edit>
                </div>
            </div>
        </div>
    </div>
@endsection