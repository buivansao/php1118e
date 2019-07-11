<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('public/asset/admin/login')}}/">
    <title>Đăng ký</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Đăng ký</div>
            <div class="panel-body">
                {{--					@include('errors.note')--}}
                @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif
                <form role="form" action="{{url('customer/register')}}" method="POST">
                    <fieldset>
                        {{csrf_field()}}
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" placeholder="Họ tên" name="name" type="text"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <input required class="form-control" autocomplete="off" placeholder="Điện thoại"
                                   name="phone" type="text">

                        </div>
                        <div class="form-group">
                            <textarea rows="2" required class="form-control" autocomplete="off" placeholder="Địa chỉ"
                                      name="address" type="text"></textarea>
                        </div>
                        <div class="form-group">
                            <input required autocomplete="off" class="form-control" placeholder="E-mail" name="email"
                                   type="email">

                        </div>
                        <div class="form-group">
                            <input class="form-control" autocomplete="off" placeholder="Mật khẩu" name="password"
                                   type="password" value="">
                            <span id="psw-error"></span>
                        </div>

                        <div class="form-group">
                            <input class="form-control" autocomplete="off" placeholder="Nhập lại mật khẩu"
                                   name="password" type="password">
                            <span id="psw1-error"></span>
                        </div>
                        <input type="submit" name="submit" onclick="return validate()" value="Đăng ký">
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>
</html>
