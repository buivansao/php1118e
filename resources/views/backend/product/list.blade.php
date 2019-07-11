@extends('backend.layout.index')
@section('title','Danh sách sản phẩm')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Danh sách sản phẩm
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
                        <a href="{{asset('admin/product/add')}}" class="btn btn-success"><span
                                    class="glyphicon glyphicon-save"></span>Thêm mới </a>
                        <div class="bootstrap-table">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-primary">
                                    <th>ID</th>
                                    <th>Hình</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thương hiệu</th>
                                    <th>Giá</th>
                                    <th>Kho hàng</th>
                                    <th>Trạng thái</th>
                                    <th>Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>
                                            <img src="{{asset('storage/app/products/' . $product->image)}}" height="100px">
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->brand->name}}</td>
                                        <td>{{number_format($product->price)}}</td>
                                        <td>
                                            @if($product->stock == 1)
                                                {{"Còn hàng"}}
                                            @else
                                                {{"Hết hàng"}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->status == 1)
                                                {{"Hiện"}}
                                            @else
                                                {{"Ẩn"}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{asset('admin/product/'.$product->id.'/edit/' )}}"
                                               class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>
                                                Sửa</a>
                                            <a href="{{asset('admin/product/'.$product->id.'/delete/')}}"
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
                        <div class="pagination">
                            {!! $products->appends($params)->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@stop