@extends('backend.layout.index')
@section('title','Danh sách thương hiệu')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Danh sách thương hiệu
                        <form style="width: 300px; position: relative; left: 600px; top: -38px" method="get" action="">
                            <input class="form-control" type="text"
                                   value="<?php if (isset($params['name'])) echo $params['name']; ?>" name="name"
                                   placeholder="Tìm kiếm">
                        </form>
                    </div>
                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <a href="{{asset('admin/brand/add')}}" class="btn btn-success"><span
                                    class="glyphicon glyphicon-save"></span>Thêm mới </a>
                        <div class="bootstrap-table">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-primary">
                                    <th>ID</th>
                                    <th>Tên thương hiệu</th>
                                    <th>Logo</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <td>{{$brand->id}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>
                                            <img src="{{asset('storage/app/brands/' . $brand->logo)}}" height="50px">
                                        </td>
                                        <td>
                                            @if($brand->status == 1)
                                                {{"Hiển thị"}}
                                            @else
                                                {{"không hiển thị"}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{asset('admin/brand/' . $brand->id.'/edit/')}}"
                                               class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>
                                                Sửa</a>
                                            <a href="{{asset('admin/brand/' . $brand->id.'/delete/')}}"
                                               onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                               class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                                Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            {!! $brands->appends($params)->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@stop