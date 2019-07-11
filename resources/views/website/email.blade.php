<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>PHP1118e - Hoàn thành</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/email.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
        $(function () {
            var pull = $('#pull');
            menu = $('nav ul');
            menuHeight = menu.height();

            $(pull).on('click', function (e) {
                e.preventDefault();
                menu.slideToggle();
            });
        });

        $(window).resize(function () {
            var w = $(window).width();
            if (w > 320 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
    </script>
</head>
<body>
<!-- main -->
<section id="body">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-9">
                <!-- main -->
                <h1>ĐẶT HÀNG THÀNH CÔNG!</h1>
                <div id="wrap-inner">
                    <div id="khach-hang">
                        <h3>Thông tin khách hàng</h3>
                        <p>
                            <span class="info">Khách hàng: {{ $customerName }}</span>
                        </p>
                        <p>
                            <span class="info">Điện thoại: {{ $customerPhone }}</span>
                        </p>
                        <p>
                            <span class="info">Địa chỉ: {{ $customerAddress }}</span>
                        </p>
                        <p>Ghi chú: {{ $note }}</p>
                    </div>
                    <div id="hoa-don">
                        <h3>Tổng thanh toán đơn hàng: {{ number_format($totalPrice) }} nghìn đồng </h3>
                    </div>
                    <div id="xac-nhan">
                        <p align="justify">
                            <b>Quý khách đã đặt hàng thành công!</b><br/>
                            • Sản phẩm của Quý khách sẽ được chuyển đến Địa chỉ có trong phần Thông tin Khách hàng của
                            chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.<br/>
                            • Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24
                            tiếng.<br/>
                            <b><br/>Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
                        </p>
                    </div>
                </div>
                <!-- end main -->
            </div>
        </div>
    </div>
</section>
<!-- endmain -->
</body>
</html>
