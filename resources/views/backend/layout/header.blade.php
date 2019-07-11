<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('public/asset/admin/login')}}/">
    <title>@yield('title')</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script type="text/javascript" src="{{asset('public/asset/editor/ckeditor/ckeditor.js')}}"></script>
    <script src="js/lumino.glyphs.js"></script>
    <style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{asset('')}}">WEBSITE</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg> {{Auth::user()->user_name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{asset('logout')}}"
                               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <svg class="glyph stroked cancel">
                                    <use xlink:href="#stroked-cancel"></use>
                                </svg>
                                Logout</a>
                            <form id="frm-logout" action="{{ route('logout') }}"
                                  method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li role="presentation" class="divider"></li>
        <li class="{{ Request::is('admin/home') ? 'active' : '' }}"><a href="{{asset('admin/home')}}">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                Trang chủ</a></li>
        <li class="{{ Request::is('admin/product') ? 'active' : '' }}"><a href="{{asset('admin/product')}}">
                <svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-calendar"></use>
                </svg>
                Sản phẩm</a></li>
        <li class="{{ Request::is('admin/brand') ? 'active' : '' }}"><a href="{{asset('admin/brand')}}">
                <svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-calendar"></use>
                </svg>
                Thương hiệu</a></li>
        <li class="{{ Request::is('admin/category') ? 'active' : '' }}"><a href="{{asset('admin/category')}}">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Danh mục</a></li>
        <li class="{{ Request::is('admin/order') ? 'active' : '' }}"><a href="{{asset('admin/order')}}">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Đơn hàng</a></li>
        <li class="{{ Request::is('admin/new') ? 'active' : '' }}"><a href="{{asset('admin/new')}}">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Tin tức</a></li>
        @if (Auth::user()->level == 1)
            <li class="{{ Request::is('admin/account') ? 'active' : '' }}">
                <a href="{{asset('admin/account')}}">
                    <svg class="glyph stroked line-graph">
                        <use xlink:href="#stroked-line-graph"></use>
                    </svg>
                    Nhân viên
                </a>
            </li>
        @endif
        <li class="{{ Request::is('admin/customer') ? 'active' : '' }}">
            <a href="{{asset('admin/customer')}}">
                <svg class="glyph stroked line-graph">
                    <use xlink:href="#stroked-line-graph"></use>
                </svg>
                Khách hàng
            </a>
        </li>
        <li role="presentation" class="divider"></li>
    </ul>

</div><!--/.sidebar-->
