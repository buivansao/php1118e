<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('public/asset/admin/login')}}/">
    <title>Đặt lại mật khẩu</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">Đặt lại mật khẩu</div>
            <div class="panel-body">
                <form role="form" action="{{ url('customer/password/reset') }}" method="POST">
                    <fieldset>
                        {{csrf_field()}}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                        </div>
                        <div class="form-group">
                            <input id="password" placeholder="Nhập mật khẩu mới" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" placeholder="Nhập lại mật khẩu" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <input type="submit" name="submit" value="Đặt lại mật khẩu">
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
</body>
</html>
