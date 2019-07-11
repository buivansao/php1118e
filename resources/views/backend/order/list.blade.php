@extends('backend.layout.index')
@section('title','Danh sách hóa đơn')
@section('main')
    <style>
        form {
            padding: 10px;
            border: 2px solid #3498db;
            background: #F0F8FF;
            border-radius: 15px;
            display: none;
        }
    </style>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách hóa đơn
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
                    <div class="bootstrap-table">

                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-primary">
                                <th>Số hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>Điện thoại</th>
                                <th>Email</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listOrders as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->customer_name}}</td>
                                    <td>{{$item->customer_phone}}</td>
                                    <td>{{$item->customer_email}}</td>
                                    <td>{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                    <td>{{number_format($item->total_price)}} đ</td>
                                    <td>
                                        @if ($item->status == 0) {{"Chờ xác nhận"}}
                                        @elseif ($item->status == 1) {{"Đã xác nhận"}}
                                        @elseif ($item->status == 2) {{"Đang giao hàng"}}
                                        @elseif ($item->stauts == 3) {{"Đã giao hàng"}}
                                        @elseif ($item->status == 4) {{"Đã hủy"}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{asset('admin/order/' .$item->id . '/update')}}"
                                           class="btn btn-success"><span class="glyphicon glyphicon-certificate"></span>
                                            Cập nhật
                                        </a>
                                        <a href="{{asset('admin/order/' .$item->id . '/detail')}}"
                                           class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Chi
                                            tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pagination">
                        {!! $listOrders->appends($params)->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
@stop