@extends('backend.layout.index')
@section('title','Danh sách hóa đơn')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div style="border: 1px">
                        <h2>HOÁ ĐƠN SỐ {{$order['id']}}</h2>
                        <h6>Ngày đặt: {{$order['created_at']}}</h6>
                        <h5>Khách hàng: {{$order['customer_name']}}</h5>
                        <h5>Số điện thoại: {{$order['customer_phone']}}</h5>
                        <h5>Email: {{$order['customer_email']}}</h5>
                        <h5>Địa chỉ: {{$order['customer_address']}}</h5>
                        <h5>Ghi chú: {{$order['note']}}</h5>
                    </div>
                    <div class="bootstrap-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-primary">
                                <th>Mặt hàng</th>
                                <th>Số lượng</th>
                                <th>Tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($detail as $item)
                                <tr>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{number_format($item->subtotal)}} đ</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="2">Tổng tiền</th>
                                <th>{{number_format($order['total_price'])}} đ</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
@stop