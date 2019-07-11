@extends('backend.index')
@section('title','Danh sách khách hàng')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách khách hàng
                    <form style="width: 300px; position: relative; left: 600px; top: -38px" method="get"
                          action="{{ url('admin/customer') }}">
                        <input class="form-control" type="text"
                               value="<?php if (isset($params['name'])) echo $params['name']; ?>" name="name"
                               placeholder="Tìm kiếm">
                    </form>
                </div>
                <div class="panel-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="bootstrap-table">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-primary">
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listCustomers as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>@if ($item->status == 1) {{ "Hoạt động" }} @else {{ "Không hoạt động" }} @endif</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <form action="{{ url('admin/customer/' . $item->id . '/disable') }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn muốn hủy kích hoạt?')"
                                                        class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    Hủy kích hoạt</a>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ url('admin/customer/' . $item->id . '/enable') }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn muốn kích hoạt lại?')"
                                                        class="btn btn-success">
                                                    <span class="glyphicon glyphicon-paperclip"></span>
                                                    Kích hoạt</a>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pagination">
                        {!! $listCustomers->appends($params)->render() !!}
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@stop
