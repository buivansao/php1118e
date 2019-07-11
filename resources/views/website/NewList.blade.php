@extends('website.master')
@section('title', "Tin tức mới nhất")
@section('main')
    <style>
        .left {
            float: left;
            width: 500px;
        }

        .left img:hover {
            padding: 7px;
        }

        .right {
            float: left;
            margin-left: 50px;
            width: 450px;
            color: black;
            text-align: justify;
        }

        h2:hover {
            font-weight: bold;
        }

        .name {
            text-decoration: none;
            color: #000;
        }

        .name:hover {
            font-weight: bold;
            color: #000;
            text-decoration: none;
        }
    </style>
    <div style="background-color: #fff; padding: 10px" id="wrap-inner">
        <div id="product-info" style="margin-top: 20px">
            <h2 style="margin-left: 50px; margin-bottom: 30px; font-weight: bold">Tin công nghệ hot nhất</h2>
            <hr style="background-color: red"/>
            @foreach($listNews as $item)
                <div class="new" style="margin-top: 10px">
                    <div class="left"><a href="{{asset('new/'.$item->slug)}}"><img width="530px"
                                                                                   src="{{asset('storage/app/news/'.$item->image)}}"></a>
                    </div>
                    <div class="right">
                        <div class="tentt"><h2><a class="name" href="{{asset('new/'.$item->slug)}}">{{$item->name}}</a>
                            </h2></div>
                        <div class="mota">{!! $item->description !!}</div>
                        <br/>
                        <div>{{$item->created_at}}</div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            @endforeach
        </div>
        <div style="margin-top: 10px; margin-left: 50px;" class="pagination">
            {{ $listNews->render() }}
        </div>
    </div>
@stop
