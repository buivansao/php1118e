@extends('website.master')
@section('title', "$item->name")
@section('main')
    <link rel="stylesheet" href="css/details.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        .noidung {
            float: left;
            width: 800px;
        }

        .tintuclienquan {
            margin-top: 150px;
            margin-left: 30px;
            float: left;
            width: 250px;
        }

        .noidung p {
            text-align: justify;
            width: 800px;
        }

        .buynow {
            margin-left: -200px;
        }

        .modal {
            display: none; /* mặc định được ẩn đi */
            position: fixed; /* vị trí cố định */
            z-index: 1; /* Ưu tiên hiển thị trên cùng */
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;

        .slideshow-container {
            max-width: 500px;
            position: relative;
            margin: auto;
        }

        #box-cmt {
            width: 500px;
            height: 50px;
            border-radius: 20px;
        }
    </style>
    <div style="background-color: #fff;" id="wrap-inner">
        <div id="product-info" style="margin-top: 30px; padding-top: 15px">
            <div class="clearfix"></div>
            <div>
                <h2 style="color: black; margin-left: 15px;">Điện thoại {{$item->name}}</h2>
                <div class="row">
                    <div id="product-img" class="col-xs-2 col-sm-3 col-md-4 text-center">
                        <img width="380px" src="{{asset('storage/app/products/'. $item['image'])}}">
                    </div>
                    <div style="margin-left: -20px" id="product-details" class="col-xs-3 col-sm-3 col-md-3">
                        <p class="price sale" style="color: #5e5e5e">
                            <strike>
                                @if ($item->stock_price != 0) {{number_format($item->stock_price) . " đ"}} @endif
                            </strike>
                        </p>
                        <p class="price sale">
                            {{number_format($item->price) . " đ"}}
                        </p>
                        <p style="text-align: justify">
                            <i class="fas fa-box-open"></i> Trong hộp có: sạc, tai nghe, sách hướng dẫn, cáp, cây lấy
                            sim
                            <br/><i class="fas fa-spinner"></i> Bảo hành: 12 tháng
                            <br/><i class="fas fa-history"></i> 1 đổi 1 trong tháng đầu
                            <br/><i class="fas fa-shipping-fast"></i> Giao hàng miễn phí toàn quốc, thanh toán sau khi
                            nhận hàng
                        <p style="color: #FF0000">Kho
                            hàng: <?php if ($item->stock == 1) echo "Còn hàng"; else echo "Hết hàng"?></p>
                        @if ($item->stock >= 1)
                            <p class="buynow"
                               style="margin-bottom: 20px; margin-top: 70px; background-color: orange; width: 250px">
                                <a href="{{route('cart.add',$item->id)}}">Đặt hàng
                                    online</a>

                            </p>
                        @endif
                    </div>
                    <div style="margin-left: 15px; margin-top: 0px" class="col-md-5">
                        <h3>Thông số kỹ thuật</h3>
                        <div class="">
                            <table class="table table-striped table-bordered">
                                @foreach($options as $option)
                                    <tr style="font-size: 12px">
                                        <td>{{$option->option_name}}</td>
                                        <td>{{$option->option_value}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div id="product-detail" class="col-md-12">
                    <div>
                        <div style="margin-left: 0px" class="slideshow-container">
                            @foreach($imgs as $img)
                                <div class="mySlides fade">
                                    <img width="700px" src="{{asset('storage/app/products/'. $img['image'])}}">
                                </div>
                            @endforeach
                            <div style="margin-left: 250px">
                                @foreach($imgs as $img)
                                    <span class="dot" onclick="currentSlide({{$img->position}})"></span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="noidung">
                        <b><p>{{$item->description}} </p></b>
                        <br/>
                        {!! $item->content  !!}
                    </div>
                    <div class="tintuclienquan">
                        <h4>Tin tức liên quan</h4>
                        @foreach($news as $key => $item)
                            @if ($key <= 9)
                                <div class="tintuc" style="margin-top: 20px">
                                    <a style="text-decoration: none; color: black" href="{{asset('new/'.$item->slug)}}">
                                        <div class="anh">
                                            <img height="70px"
                                                 src="{{asset('storage/app/news/'.$item->image)}}">
                                        </div>
                                        <div class="ten">{{$item->name}}</div>
                                    </a>
                                </div>
                                <div style="clear: both"></div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div style="clear: both"></div>
                <h3>Sản phẩm liên quan</h3>
                <div style="background-color: #fff" class="product-list row">
                    @if(count($relates) > 0)
                        @foreach($relates as $product)
                            <div class="product-item col-md-3 col-sm-6 col-xs-12">
                                <a href="{{asset('detail/'.$product->slug)}}"><img
                                        src="{{asset('storage/app/products/'.$product->image)}}" height="30%"
                                        class="img-thumbnail"></a>
                                <p><a href="{{asset('detail/'.$product->slug)}}">{{$product->name}}</a></p>
                                <p class="price sale" style="color: #5e5e5e">
                                    @if ($product->price != 0) <span
                                        style="color: red">{{number_format($product->price)}} đ</span>@endif
                                    @if ($product->stock_price != 0)
                                        <strike>{{number_format($product->stock_price)}} đ</strike>
                                    @endif
                                </p>
                                @if ($product->stock == 1)
                                    <a style="margin-left: 30px" class="buynow"
                                       href="{{route('cart.add',$product->id)}}">Mua ngay</a>
                                @else {{"Hết hàng"}}
                                @endif
                            </div>
                        @endforeach
                    @else {{"Không có sản phẩm nào liên quan"}}
                    @endif
                </div>

                <div style="margin-top: 50px;" id="comment">
                    <button id="review-product" class="btn btn-success">Để lại bình luận</button>
                    <div style="display: none;" class="col-md-12 comment">
                        <form action="" method="post" id="form-cmt"
                              style="border: 1px solid red; border-radius: 5px; width: 520px; padding: 10px;">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Tên:</label>
                                <input required
                                       value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->name}} @endif"
                                       id="customer-name" type="text" placeholder="Họ tên (bắt buộc)"
                                       class="form-control"
                                       name="name">
                            </div>
                            <div class="form-group">
                                <label>Điện thoại:</label>
                                <input
                                    value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->phone}} @endif"
                                    id="customer-phone" placeholder="Số điện thoại (để nhận phản hồi qua Zalo)"
                                    required
                                    type="text" class="form-control" name="phone">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input id="customer-email" placeholder="Email (để nhập phản hồi qua Email)" required
                                       type="email"
                                       class="form-control" name="email"
                                       value="@if(Auth::guard('customers')->check()) {{Auth::guard('customers')->user()->email}} @endif">
                            </div>
                            <div class="form-group">
                                <label>Nội dung:</label>
                                <textarea name="comment" required type="text"
                                          class="form-control"> </textarea>
                            </div>
                            <div class="form-group text-center">
                                <input class="btn btn-warning" type="submit" value="Gửi">
                            </div>
                        </form>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12" id="comment-list">

                    @foreach($comments as $item)
                        @if ($item->parent_id == '')
                            @if ($item->status == 1)
                                <ul>
                                    <li class="">
                                        <b>{{$item->customer_name}}</b>
                                        @if (Auth::check())
                                            <span><br/>{{$item->customer_phone}} - {{$item->customer_email}}</span>
                                        @endif
                                        <br/><span>{{date('d-m-Y H:m:s', strtotime($item->created_at))}}</span>
                                    </li>
                                    <li class="com-details">
                                        <span style="color: #333">{{$item->comment}}</span>
                                        <br/>

                                    </li>
                                    @if (Auth::check())
                                        <a href="{{asset('detail/'.$item->id .'/hidden')}}">Ẩn</a>
                                    @endif
                                    <div class="reply" id="row-{{$item->id}}" data-id="{{$item->id}}">
                                        <a href="" class="commit">
                                            <small>Trả lời</small>
                                        </a>

                                        <div id="reply-box-{{$item->id}}" style="display: none;">

                                            <form action="{{route('customers.comment',$slug)}}" method="post">
                                                {{csrf_field()}}
                                                <div class="form-group">

                                                    <input type="hidden" name="parent_id" value="{{$item->id}}">
                                                    <input name="name" type="hidden" class="form-control name">
                                                    <input name="email" type="hidden" class="form-control">
                                                    <input name="phone" type="hidden" class="form-control">
                                                </div>
                                                <div class="form-group">

                                    <textarea style="height: 50px;width: 1000px;border-radius: 7px" required
                                              cols="0" rows="2" class="form-control " id="box-cmt"
                                              name="comment"></textarea>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input type="submit" class="btn btn-defautl submit-cmt" value="Gửi">
                                                </div>
                                            </form>
                                            <div>
                                                <small class="reply-user-name">
                                                </small>
                                            </div>
                                        </div>

                                    </div>

                                </ul>
                            @endif
                        @endif
                        <div style="background-color:#dfdfdf;border-radius: 5px; margin-left: 10px ">
                            @foreach($comments as $itemChild)

                                @if($itemChild->parent_id == $item->id)

                                    <ul>
                                        <li class="">
                                            <b>{{$itemChild->customer_name}}</b>
                                            @if (Auth::check())
                                                <span><br/>{{$itemChild->customer_phone}} - {{$itemChild->customer_email}}</span>
                                            @endif
                                            <br/><span>{{date('d-m-Y H:m:s', strtotime($itemChild->created_at))}}</span>
                                        </li>
                                        <li class="com-details">
                                            <span style="color: red">{{$itemChild->comment}}</span>

                                        </li>
                                        @if (Auth::check())
                                            <a href="{{asset('detail/'.$itemChild->id .'/hidden')}}">Ẩn</a>
                                        @endif
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if(Auth::guard('customers')->check())

        <span style="display:none" id="user-id"> {{Auth::guard('customers')->user()->id}}</span>
    @endif
    @if(!Auth::guard('customers')->check())
        <div id="myModal" class="modal">
            <!-- Nội dung form đăng nhập -->
            <div class="modal-content">
                <h2 style="text-align: center;">Nhập thông tin</h2>

                <span class="close">&times;</span>
                <div class="form-group">
                    <label>Tên:</label>
                    <input required id="customer-name" type="text" placeholder="Họ tên (bắt buộc)" class="form-control"
                           name="name">
                </div>
                <div class="form-group">
                    <label>Điện thoại:</label>
                    <input id="customer-phone" placeholder="Số điện thoại (để nhận phản hồi qua Zalo)" required
                           type="text" class="form-control" name="phone">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input id="customer-email" placeholder="Email (để nhập phản hồi qua Email)" required type="email"
                           class="form-control" name="email">
                </div>
                <div class="form-group text-center">
                    <input type="button" class="btn btn-success " id="submit-info" value="Gửi">
                </div>

            </div>
        </div>
    @endif
    <script>
        var slideIndex;

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }

            slides[slideIndex].style.display = "block";
            dots[slideIndex].className += " active";
            slideIndex++;
            if (slideIndex > slides.length - 1) {
                slideIndex = 0
            }
            setTimeout(showSlides, 3000);
        }

        showSlides(slideIndex = 0);


        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        $(document).ready(function () {
            $('#review-product').on('click', function () {
                $('.comment').show();
            });

            $('.commit').on('click', function (e) {
                e.preventDefault();
                // localStorage.removeItem('user-info');
                var cmtId = $(this).parent().data('id');
                $('#reply-box-' + cmtId).show();
                if (localStorage.getItem('user-info')) {
                    var data = JSON.parse(localStorage.getItem('user-info'));
                    $('#reply-box-' + cmtId + ' .reply-user-name').text(data.name);
                    $('#row-' + cmtId + ' input[name="name"]').val(data.name);
                    $('#row-' + cmtId + ' input[name="phone"]').val(data.phone);
                    $('#row-' + cmtId + ' input[name="email"]').val(data.email);
                } else {
                    $('#reply-box-' + cmtId + '.reply-user-name').empty();
                }
            });
            $('.submit-cmt').on('click', function (e) {

                if (localStorage.getItem('user-info')) {
                    $('#myModal').hide();

                } else {

                    $('#myModal').show();
                }
            });
            $('.close').on('click', function () {
                $('#myModal').hide();
            });
            $('#submit-info').on('click', function (e) {

                var userName = $('#customer-name').val();
                if (!userName) {
                    alert("Bạn phải nhập tên");
                    e.preventDefault();
                }
                console.log("JDK");
                var userId = $('#user-id').text();

                var userEmail = $('#customer-email').val();
                var userPhone = $('#customer-phone').val();
                var data = {
                    'name': userName,
                    'email': userEmail,
                    'phone': userPhone,
                };
                localStorage.setItem('user-info', JSON.stringify(data));

                $('#myModal').hide();
            });
        });
        $('#form-cmt').validate({
            rules: {
                comment: "required",
                name: "required",
            },
            messages: {
                comment: "Nhập nội dung binh luận",
                name: "Nhập họ tên",
            }
        });
    </script>
@stop
