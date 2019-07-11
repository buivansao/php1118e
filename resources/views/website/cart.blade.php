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
    <section id="cart_items" style="margin-top: 30px; background-color: #fff; padding: 15px;">
        <div class="container">
            <h3>
                Thông tin giỏ hàng của bạn
            </h3>
            <div class="table-responsive cart_info" id="result">
                @if(count($cart))
                    <form action="{{route('order.place')}}" method="POST">
                        @csrf
                        <table class="table table-condensed">
                            <thead>
                            <tr class="cart_menu">
                                <th>Mặt hàng</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $item)
                                <tr id="row-{{$item->rowId}}">

                                    <td class="cart_description">
                                        <h5><a href="{{asset('detail/'.$item->slug)}}">{{$item->name}}</a></h5>
                                    </td>
                                    <td class="cart_price">
                                        <p>  {{number_format($item->price)}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">

                                            <input data-row="{{$item->rowId}}" class="product-qty" type="number" max=100
                                                   min="1"
                                                   data-id="{{$item->id}}" data-price="{{$item->price}}" name="quantity"
                                                   value="{{$item->qty}}" autocomplete="off" size="2">

                                        </div>
                                    </td>
                                    <td class="cart_total">

                                        <p class="cart_total_price">{{number_format($item->subtotal)}}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a data-row="{{$item->rowId}}" class="cart_quantity_delete" href="#"><i
                                                    class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th id="total">Tổng tiền: {{Cart::total()}}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <div style=" padding: 10px; border: 1px solid red; border-radius: 10px">
                            <div id="comment">
                                <h3>Thông tin khách hàng</h3>
                                <div class="form-group">
                                    <input name="customer_id" type="hidden" value="@if(Auth::guard('customers')->check()) {{Auth::guard('customer')->user()->id}} @endif">
                                    <input placeholder="Họ và tên"
                                           value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->name}} @endif"
                                           required type="text" class="form-control" name="name">
                                    <input placeholder="Số điện thoại"
                                           value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->phone}} @endif"
                                           required type="text" class="form-control" name="phone">
                                    <input placeholder="email"
                                           value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->email}} @endif"
                                           type="email" class="form-control" name="email">
                                </div>
                                <div style="margin-top: 65px; width: 500px" class="form-group">
                                    <textarea placeholder="Địa chỉ giao hàng" required rows="2" id="cm"
                                              class="form-control"
                                              name="address">@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->address}} @endif</textarea>
                                </div>
                                <div style="width: 500px" class="form-group">
                                    <textarea placeholder="Ghi chú" rows="2" id="cm" class="form-control"
                                              name="note"></textarea>
                                </div>
                            </div>
                            <h4 style="margin-left: 30px; font-weight: bold">Hình thức thanh toán</h4>
                            <p style="margin-left: 50px; font-weight: bold"><input disabled="disabled" type="checkbox"
                                                                                   checked
                                                                                   class="form-check-input">
                                COD - Thanh toán sau khi nhận hàng</p>
                            <center>
                                <button type="submit" style="margin-top: 20px" class="btn btn-success">Xác nhận đặt
                                    hàng
                                </button>
                            </center>
                            @else
                                <p>Chưa có sản phẩm nào trong giỏ hàng</p>
                            @endif
                        </div>
                    </form>
            </div>
        </div>
    </section>

    <script type="text/javascript">

        $(document).ready(function () {


            $(document).on('change', '.product-qty', function () {
                var qty = parseFloat($(this).val());
                var rowId = $(this).data('row');
                var productId = $(this).data('id');
                var price = parseFloat($(this).data('price'));
                var subtotal = qty * price;
                console.log(qty);
                $.ajax({
                    url: '/cart/update',
                    method: 'POST',
                    data: {
                        row_id: rowId,
                        product_id: productId,
                        price: price,
                        qty: qty,
                        subtotal: subtotal,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            toastr.success('Successfully');
                            $('#row-' + rowId + ' .cart_total_price').text(addCommas(subtotal));
                            $('#total').text('Tổng tiền: ' + res.total);
                        } else {
                            toastr.error('Error');
                        }
                    }
                })
            });
            var total =
                $('#total').text()
            $(document).on('click', '.cart_quantity_delete', function (e) {
                e.preventDefault();
                var rowId = $(this).data('row');
                $.ajax({
                    url: '/cart/delete',
                    method: 'POST',
                    data: {row_id: rowId, _token: '{{ csrf_token() }}'},
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            console.log(res.status);
                            $('#row-' + rowId).remove();
                            $('#total').text('Tổng tiền: ' + res.total);
                        }

                    }
                })

            })
        });

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script><!--/#cart_items-->
@endsection
