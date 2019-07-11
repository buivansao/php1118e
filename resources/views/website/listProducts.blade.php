@extends('website.master')
@section('title', "Danh sách sản phẩm")
@section('main')
    <div id="wrap-inner" style="margin-top: 50px">
        <div class="products">
            <h3>{{$name}}</h3>
            <div class="product-list row">
                @foreach($products as $product)
                    <div class="product-item col-md-3 col-sm-6 col-xs-12">
                        <a href="{{asset('detail/'.$product->slug)}}"><img
                                    src="{{asset('storage/app/products/'.$product->image)}}" class="img-thumbnail"></a>
                        <p><a href="{{asset('detail/'.$product->slug)}}">{{$product->name}}</a></p>
                        <p class="price sale" style="color: #5e5e5e">
                            @if ($product->price != 0) <span style="color: red">{{number_format($product->price)}} đ</span>@endif
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
            <div style="margin-top: 10px; margin-left: 50px;" class="pagination">
                {{ $products->render() }}
            </div>
        </div>
    </div>
@stop