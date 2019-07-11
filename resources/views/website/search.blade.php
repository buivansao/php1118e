@extends('website.master')
@section('title', "Danh sách tìm kiếm")
@section('main')
    <div id="wrap-inner" style="margin-top: 50px">
        <h3>Kết quả tìm kiếm</h3>
        <div class="products">
            <div class="product-list row">
                @if(count($products) > 0)
                    @foreach($products as $item)
                        <div class="product-item col-md-3 col-sm-6 col-xs-12">
                            <a href="{{asset('detail/'.$item->slug)}}"><img
                                        src="{{asset('storage/app/products/'.$item->image)}}" class="img-thumbnail"></a>
                            <p><a href="{{asset('detail/'.$item->slug)}}">{{$item->name}}</a></p>
                            <p class="price sale" style="color: #5e5e5e">
                                <strike>
                                    <?php
                                    if ($item->stock_price != 0) ;
                                    echo "Giá cũ: " . number_format($item->stock_price) . " đ";
                                    ?>
                                </strike>
                            </p>
                            <p class="price sale">
                                <?php
                                if ($item->price != 0) echo "Giảm còn: " . number_format($item->price) . " đ";
                                ?>
                            </p>
                            @if ($item->stock == 1)
                                <a class="buynow"
                                   href="{{route('cart.add',$item->id)}}">Mua ngay</a>
                            @else {{"Hết hàng"}}
                            @endif
                        </div>
                    @endforeach
                @else {{"Không có kết quả tìm kiếm"}}
                @endif
            </div>
        </div>
    </div>
@stop