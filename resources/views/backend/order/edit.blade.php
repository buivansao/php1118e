@extends('backend.layout.index')
@section('title','Cập nhật đơn hàng')
@section('main')
    <div class="col-xs-12 col-md-10 col-lg-10 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Cập nhật đơn hàng
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
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Tên khách hàng</label>
                        <input style="width: 300px" type="text" name="name" class="form-control"
                               value="{{$order->customer_name}}">
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Số điện thoại</label>
                        <input style="width: 300px" type="text" name="phone" class="form-control"
                               value="{{$order->customer_phone}}">
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Email</label>
                        <input style="width: 300px" type="text" name="email" class="form-control"
                               value="{{$order->customer_email}}">
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Địa chỉ giao hàng</label>
                        <input style="width: 600px" type="text" name="address" class="form-control"
                               value="{{$order->customer_address}}">
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Ghi chú</label>
                        <input style="width: 600px" type="text" name="note" class="form-control"
                               value="{{$order->note}}">
                    </div>
                    <div class="form-group">
                        <label>Trạng thái đơn hàng</label><br/>
                        <input @if($order['status'] == 0) {{'checked'}} @endif name="status" value="0" type="radio"> Chờ
                        xác nhận <br/>
                        <input @if($order['status'] == 1) {{'checked'}} @endif name="status" type="radio" value="1"> Đã
                        xác nhận<br/>
                        <input @if($order['status'] == 2) {{'checked'}} @endif name="status" type="radio" value="2">
                        Đang giao hàng<br/>
                        <input @if($order['status'] == 3) {{'checked'}} @endif name="status" type="radio" value="3"> Đã
                        giao hàng <br/>
                        <input @if($order['status'] == 4) {{'checked'}} @endif name="status" type="radio" value="4"> Hủy
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Lưu" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop