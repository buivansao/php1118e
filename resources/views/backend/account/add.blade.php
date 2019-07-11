@extends('backend.layout.index')
@section('title','Thêm tài khoản nhân viên')
@section('main')
    <div class="col-xs-12 col-md-10 col-lg-10 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Thêm tài khoản nhân viên
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Họ tên</label>
                        <input style="width: 300px" type="text" name="user_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input style="width: 300px" type="text" name="user_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" style="width: 300px" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input style="width: 300px" class="form-control" placeholder="Xác nhận mật khẩu"
                                   name="password_confirmation" type="password">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Quyền</label>
                        <select style="width: 200px" name="level">
                            <option selected value="2">Nhân viên</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Trạng thái</label>
                        <select style="width: 200px" name="status">
                            <option selected value="1">Hoạt động</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Lưu" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop