@extends('website.main')
@section('title', "Trang chủ")
@section('main')

    <style>
        .quangcao img {
           width: 102.5%;
            margin-left: -15px;
        }
    </style>
{{--    @include('website.banner')--}}
    <div id="wrap-inner" style="margin-top: 20px">
        <div class="products">
            <div>
                <h2><a class="danhmuc" href="{{asset('dien-thoai-noi-bat')}}"><span style="color: red">Sản phẩm nổi bật</span></a></h2>
            </div>
            <div style="background-color: #fff" class="product-list row">
                @foreach($hotProducts as $product)
                    <div class="product-item col-md-3 col-sm-6 col-xs-12">
                        <a href="{{asset('detail/'.$product->slug)}}"><img
                                    src="{{asset('storage/app/products/'.$product->image)}}" class="img-thumbnail"></a>
                        <p><a href="{{asset('detail/'.$product->slug)}}">{{$product->name}}</a></p>
                        <p class="price sale" style="color: #5e5e5e">
                            @if ($product->price != 0) <span
                                    style="color: red">{{number_format($product->price)}} đ</span>@endif
                            @if ($product->stock_price != 0)
                                <strike>{{number_format($product->stock_price)}} đ</strike>
                            @endif
                        </p>
                        @if ($product->stock == 1)
                            <a class="buynow"
                               href="{{route('cart.add',$product->id)}}">Mua ngay</a>
                        @else {{"Hết hàng"}}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="quangcao">
        <img src="img/home/636951817101622147_Banner-Vivo-C1-2x.png" alt="">
    </div>
    <div style="clear: both"></div>

    <div class="products" style="margin-top: 30px">
        <h2><a class="danhmuc" href="{{asset('dien-thoai-gia-re')}}" ><span style="color: red">Sản phẩm giá rẻ</span></a></h2>
        <div style="background-color: #fff" class="product-list row">
            @foreach($cheapProducts as $product)
                <div class="product-item col-md-3 col-sm-6 col-xs-12">
                    <a href="{{asset('detail/'.$product->slug)}}"><img
                                src="{{asset('storage/app/products/'.$product->image)}}" class="img-thumbnail"></a>
                    <p><a href="{{asset('detail/'.$product->slug)}}">{{$product->name}}</a></p>
                    <p class="price sale" style="color: #5e5e5e">
                        @if ($product->price != 0) <span
                                style="color: red">{{number_format($product->price)}} đ</span>@endif
                        @if ($product->stock_price != 0)
                            <strike>{{number_format($product->stock_price)}} đ</strike>
                        @endif
                    </p>
                    <p><a class="buynow"
                          href="{{route('cart.add',$product->id)}}">Mua ngay</a></p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="quangcao">
        <img src="img/home/636949755987009116_Banner-C1__mi9@2x.png">
    </div>
    <div style="clear: both"></div>
    <div class="products" style="margin-top: 30px">
        <h2><a class="danhmuc" href="{{asset('phu-kien-dien-thoai')}}"><span style="color: red">Phụ kiện điện thoại</span></a></h2>
        <div style="background-color: #fff" class="product-list row">
            @foreach($sockProducts as $product)
                <div class="product-item col-md-3 col-sm-6 col-xs-12">
                    <a href="{{asset('detail/'.$product->slug)}}"><img
                                src="{{asset('storage/app/products/'.$product->image)}}" class="img-thumbnail"></a>
                    <p><a href="{{asset('detail/'.$product->slug)}}">{{$product->name}}</a></p>
                    <p class="price sale" style="color: #5e5e5e">
                        @if ($product->price != 0) <span
                                style="color: red">{{number_format($product->price)}} đ</span>@endif
                        @if ($product->stock_price != 0)
                            <strike>{{number_format($product->stock_price)}} đ</strike>
                        @endif
                    </p>
                    <p style="position: relative; bottom: 0px"><a class="buynow"
                                                                  href="{{route('cart.add',$product->id)}}">Mua ngay</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@stop