<?php
session_start();
?>
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <base href="{{asset('public/asset/fontend')}}/">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: rgb(239, 239, 239)">
<!-- header -->
<header id="header">
    <div class="container">
        <div class="row" style="border-bottom: 1px solid #BDBDBD;padding-top: 10px; padding-bottom: 7px">
            <div class="col-md-4 col-sm-3 col-xs-3">Chào mừng bạn đến với Thế Giới Di Động !</div>
            <div class="col-md-5 col-sm-3 col-xs-3" style="opacity: 0.9">
                <a class="new" style="opacity: 0.9; color: #000;" href="{{asset('/new')}}"><i
                            class="far fa-newspaper"></i><span
                            style="position: relative; top: -3px; font-size: 15px"> Tin công nghệ</span></a>
                <a class="new" href="/" style="opacity: 0.9; margin-left: 15px;   color: #000;"><span
                            style="position: relative; top: -3px; font-size: 15px"><i
                                style="font-size: 17px; opacity: 0.9"
                                class="fas fa-check-circle"></i> Bảo hành</span></a>
                <a class="new" href="/" style="opacity: 0.9; margin-left: 15px; color: #000;"><span
                            style="position: relative; top: -3px; font-size: 15px"><i
                                style="font-size: 17px; opacity: 0.9" class="fas fa-tags"></i> Khuyến mãi</span></a>
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12">
                <div class="user">
                    @if(Auth::guard('customers')->check())
                        <ul>
                            <li>
                                <i class="far fa-user"></i> <span> {{Auth::guard('customers')->user()->name}}</span>
                                <ul class="child">
                                    <li><a class="a" href="{{asset('order/history')}}">Lịch sử đặt hàng</a></li>
                                    <li><a class="a" href="{{asset('account')}}">Tài khoản của tôi</a></li>
                                    <li>
                                        <a class="a" href="{{asset('customer/logout')}}"
                                           onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Đăng
                                            xuất</a>
                                        <form id="frm-logout" action="{{ route('logout') }}"
                                              method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @else                 <i class="far fa-user"></i>
                    <span><a href="{{asset('customer/login')}}">Đăng nhập </a><span
                                style="color: #000; opacity: 0.8">|</span><a
                                href="{{asset('customer/register')}}"> Đăng ký</a></span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row" style="height: 70px;">
            <div id="logo" class="col-md-3 col-sm-3 col-xs-3" style="z-index: 2; margin-top: -9px">
                <h1>
                    <a style="margin-left: 15px" href="{{asset('')}}"><img src="img/home/thegioididong.png"
                                                                           width="130px"></a>
                </h1>
            </div>
            <div id="search" class="col-md-6 col-sm-5 col-xs-3">
                <form role="search" method="GET">
                    <input style="text-align: left" type="text" name="name"
                           placeholder="Bạn muốn tìm gì ?"
                           value="@if (isset($_GET['name'])) {{$_GET['name']}} @endif"/>
                    <button type="submit" class="iconsearch btn btn-danger">
                        <i style="color: #fff;" class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div id="cart" class="col-md-2 col-sm-12 col-xs-12">
                <a class="display" href="{{route('cart.index')}}"><i class="fas fa-cart-plus"></i> <span
                            style="position: relative; top: -3px;">Giỏ hàng</span></a>
            </div>
        </div>
        <div style="background-color: #cd1818; width: 1519px; position: relative; left: -205px; height: 50px">
            <center>
                <div class="col-md-12">
                    <nav style="margin-left: 15px" class="menu col-md-12">
                        <?php
                        function showCategories($categories, $parent_id = 0, $char = '', $stt = 0)
                        {
                        $cate_child = array();
                        foreach ($categories as $key => $item) {
                            if ($item['parent_id'] == $parent_id) {
                                $cate_child[] = $item;
                                unset($categories[$key]);
                            }
                        }
                        if ($cate_child) {
                        if ($stt == 0) {
                        echo '<ul>';
                        foreach ($cate_child as $key => $item) {
                        ?>
                        <li><a class="a" href="{{asset($item->slug)}}">{{$item['name']}}</a>
                        <?php showCategories($categories, $item['id'], $char . '|---', ++$stt);
                        echo '</li>';
                        }
                        echo '</ul>';
                        }

                        else {
                        echo '<ul class="sub-menu">';
                        foreach ($cate_child as $key => $item) { ?>
                        <li><a class="a" href="{{asset($item->slug)}}">{{$item['name']}}</a>
                        <?php showCategories($categories, $item['id'], $char . '|---', ++$stt);
                        echo '</li>';
                        }
                        echo '</ul>';
                        }
                        }
                        }
                        showCategories($categories);
                        ?>
                    </nav>
                </div>
            </center>
        </div>
    </div>

</header><!-- /header -->
<!-- endheader -->

<!-- main -->
<section id="body">
    <div class="container">
        <div class="row">
{{--            @include('website.banner')--}}
            <div id="main" class="col-md-12">
                @yield('main')
            </div>
        </div>
    </div>
</section>
<!-- endmain -->

<!-- footer -->
<footer id="footer">
    <div id="footer-t">
        <div class="container">
            <div class="row">
                <div id="logo-f" class="col-md-3 col-sm-12 col-xs-12 text-center">
                    <a href="{{asset('')}}"><img src="img/home/thegioididong.png" width="200px"></a>
                </div>
                <div id="about" class="col-md-3 col-sm-12 col-xs-12">
                    <h3><b>Chính sách</b></h3>
                    <div class="text-justify">
                        <p>Tìm hiểu về mua trả góp</p>
                        <p>Chính sách bảo hành</p>
                        <p>Chính sách đổi trả</p>
                        <p>Giao hàng & Thanh toán</p>
                    </div>
                </div>
                <div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
                    <h3><b>Liên hệ</b></h3>
                    <p>Gọi mua hàng <b>1800.1060</b> (7:30 - 22:00)</p>
                    <p>Gọi khiếu nại <b>1800.1062</b> (8:00 - 21:30)</p>
                    <p>Gọi bảo hành <b>1800.1064</b> (8:00 - 21:00)</p>
                    <p>Hỗ trợ kỹ thuật <b>1800.1763 (7:30 - 22:00)</b></p>
                </div>
                <div id="contact" class="col-md-3 col-sm-12 col-xs-12">
                    <h3><b>Địa chỉ</b></h3>
                    Văn phòng điều hành: <br/>
                    Công ty TNHH Một Thành Viên Công Nghệ Thông Tin Thế Giới Di Động Lô T2-1.2 đường D1, Khu Công Nghệ
                    Cao, Phường Tân Phú, Quận 9, TP.HCM
                    <br/>Số điện thoại: 028 38125960
                    <br/>E-mail: investor@thegioididong.com
                </div>
            </div>
        </div>
        <div style="background-color: #999; margin-top: 10px; padding: 5px">
            <div style="height: 25px; margin: 0px auto" class="col-md-6 col-sm-12 col-xs-12 text-center">
                <p style="color: black">Copyright © 2011 All Rights Reserved. Phát triển bởi ITPlus Academy</p>
            </div>
        </div>
    </div>
</footer>
<a id="on_top" href="{{url()->full()}}" style="display: block;"><i class="fa-arrow-circle-up fa"></i></a>
<!-- endfooter -->
</body>

<script src="http://code.jquery.com/jquery-latest.js">
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) $(".lentop").fadeIn();
            else $(".lentop").fadeOut();
        });
        $(".lentop").click(function () {
            $("body,html").animate({scrollTop: 0}, "slow");
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#on_top').fadeIn();
            } else {
                $('#on_top').fadeOut();
            }
        });
        $('#on_top').click(function () {
            $("html, body").animate({scrollTop: 0}, 600);
            return false;
        });
    });

    // window.onscroll = function() {scrollFunction()};
    //
    // function scrollFunction() {
    //     if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    //         document.getElementsByClassName("menu")[0].style.padding = "30px 10px";
    //         document.getElementsByClassName("logo").style.fontSize = "25px";
    //     } else {
    //         document.getElementById("navbar").style.padding = "80px 10px";
    //         document.getElementById("logo").style.fontSize = "35px";
    //     }
    // }
</script>
</html>
