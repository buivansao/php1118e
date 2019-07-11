<div style="margin-left: -15px" class="col-md-9">
    <div id="slider">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                <li data-target="#demo" data-slide-to="3"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img height="350px" width="825px" src="img/home/quangcao1.png" alt="">
                </div>
                <div class="carousel-item">
                    <img height="350px" width="825px" src="img/home/quangcao2.png" alt="">
                </div>
                <div class="carousel-item">
                    <img height="350px" width="825px" src="img/home/quangcao3.gif" alt="">
                </div>
                <div class="carousel-item">
                    <img height="350px" width="825px" src="img/home/quangcao4.png" alt="">
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</div>
<div style="background-color: #fff; height: 350px; width: 300px">
    <div style="background: #cd1818; padding: 2px">
        <a class="new" style="opacity: 0.9; color: #fff; font-size: 27px; text-transform: uppercase"
           href="{{asset('/new')}}">
            &nbsp&nbsp<i class="far fa-newspaper" style="font-size: 30px"></i>
            <span> Tin công nghệ</span>
        </a>
    </div>
    <div style="margin-top: 10px; margin-left: 4px">
        <p><b style="color: red">&nbsp&nbspViettel tặng 100%</b> giá trị thẻ nạp 6/7</p>
    </div>
    @foreach($news as $key => $item)
        @if ($key <= 2 )
            <div class="tintuc1">
                <a style="text-decoration: none; color: black" href="{{asset('new/'.$item->slug)}}">
                    <div class="anh"><img height="70px" src="{{asset('storage/app/news/'.$item->image)}}">
                    </div>
                    <div class="ten">{{$item->name}}</div>
                </a>
            </div>
            <div style="clear: both"></div>
        @endif
    @endforeach
</div>
<div style="margin-top: 5px">
    <img src="img/home/quangcao5.jpg" width="100%">
</div>
<div style="margin-top: 15px" class="col-md-12">
    <center><p>Chọn mức giá:
            <a href="{{asset('duoi-2-trieu')}}">Dưới 2 triệu</a>
            ||
            <a href="{{asset('tu-2-4-trieu')}}">Từ 2-4 triệu</a>
            ||
            <a href="{{asset('tu-4-7-trieu')}}">Từ 4-7 triệu</a>
            ||
            <a href="{{asset('tu-7-13-trieu')}}">Từ 7-13 triệu</a>
            ||
            <a href="{{asset('tren-13-trieu')}}">Trên 13 triệu</a></p></center>
</div>
