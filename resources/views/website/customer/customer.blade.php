@extends('website.master')
@section('title','Cập nhật thông tin tài khoản')
@section('main')
    <div style="background-color: #fff" class="col-xs-12 col-md-12">
        <div style="margin-top: 20px; padding: 10px" class="panel panel-primary">
            <div style="text-align: center" class="panel-heading">
                <h2>Cập nhật thông tin tài khoản</h2>
            </div>
            <div style="margin-left: 260px; margin-top: 30px" class="panel-body col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ url('account') }}">
                    {{csrf_field()}}
                    @if(Auth::guard('customers')->check())
                        <div style="float: left" class="form-group col-md-3">
                            <label>Họ tên</label>
                            <input value="{{Auth::guard('customers')->user()->name}}" type="text"
                                   name="name" class="form-control">
                        </div>
                        <div style="float: left" class="form-group col-md-3">
                            <label>Số điện thoại</label>
                            <input value="{{Auth::guard('customers')->user()->phone}}" type="text"
                                   name="phone" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Email</label>
                            <input readonly value="{{Auth::guard('customers')->user()->email}}"
                                   type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <label>Địa chỉ</label>
                            <textarea rows="5" type="text" name="address"
                                      class="form-control">{{Auth::guard('customers')->user()->address}}</textarea>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Mật khẩu mới</label>
                            <input autocomplete="new-password" type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input autocomplete="new-password" class="form-control" placeholder="Xác nhận mật khẩu"
                                       name="password_confirmation" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Cập nhật" class="btn btn-primary ">
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@stop
