@extends('website.master')
@section('title', 'Giỏ hàng')
@section('main')
    <style>
        .form-group input {
            width: 300px;
            float: left;
            margin-top: 5px;
        }
    </style>
    <section id="cart_items" style="margin-top: 30px; padding-top: 20px; background-color: #fff;">
        <div class="container">
            <h3>
                Thông tin giỏ hàng của bạn
            </h3>
            <div>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="cart_menu">
                        <th>Số hóa đơn</th>
                        <th>Ngày mua</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái đơn hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrders as $item)
                        <tr>
                            <td><a href="{{asset('order/history/detail/'.$item->id)}}">{{$item->id}}</a></td>
                            <td> {{date('d-m-Y H:m:s', strtotime($item->created_at))}}</td>
                            <td>{{number_format($item->total_price)}} đ</td>
                            <td>
                                @if ($item->status == 0) {{"Chờ xác nhận"}}
                                @elseif ($item->status == 1) {{"Đã xác nhận"}}
                                @elseif ($item->status == 2) {{"Đang giao hàng"}}
                                @elseif ($item->stauts == 3) {{"Đã giao hàng"}}
                                @elseif ($item->status == 4) {{"Đã hủy"}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
