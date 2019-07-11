@extends('website.master')
@section('title', "$detail->name")
@section('main')
    <style>
        .tintucp {
            width: 800px;
            float: left;
            background-color: #fff;
            padding: 20px;
        }

        .tintucp p {
            text-align: left;
            float: left;
        }

        .tintuclienquan {
            margin-left: 30px;
            margin-top: 60px;
            width: 250px;
            float: left;
            background-color: #fff;
            padding: 10px;
        }
        .anh{
            float: left;
            width: 20px;
        }
        .ten{
            text-align: justify;
            margin-top: -4px;
            margin-left: 93px;
            float: left;
            width: 115px;
        }
        .anh:hover{
            padding: 2px;
        }
        .ten:hover{
            font-weight: bold;
        }
        #nd img{
            width: 100%;
        }
    </style>
    <div style="background-color: #fff">
        <div class="tintucp" style="margin-top: 60px">
            <h2>{{$detail['name']}}</h2>
            <img width="98%" src="{{asset('storage/app/news/'.$detail->image)}}">
            <br/>
            <p>{{$detail->description}}</p>
            <br/>
            <div id="nd">{!! $detail->content !!}</div>
        </div>
        <div class="tintuclienquan">
            <h4>Tin tức liên quan</h4>
            @foreach($news as $key => $item)
                @if ($key <= 7)
                    <div class="tintucrl" style="margin-top: 30px">
                        <a class="aa" style="text-decoration: none; color: black" href="{{asset('new/'.$item->slug)}}">
                            <div class="anh"><img height="60px"
                                                  src="{{asset('storage/app/news/'.$item->image)}}"></div>
                            <div class="ten">{{$item->name}}</div>
                        </a>
                    </div>
                    <div style="clear: both"></div>
                @endif
            @endforeach
        </div>
    </div>
@stop
