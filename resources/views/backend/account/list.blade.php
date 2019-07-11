@extends('backend.index')
@section('title','Danh sách nhân viên')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Danh sách nhân viên
                    <form style="width: 300px; position: relative; left: 600px; top: -38px" method="get" action="">
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
                    <a href="{{asset('admin/account/add')}}" class="btn btn-success"><span
                            class="glyphicon glyphicon-save"></span>Thêm mới </a>
                    <div class="bootstrap-table">

                        <table class="table table-bordered">
                            <thead>
                            <tr class="bg-primary">
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listAccounts as $item)
                                <tr>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->user_email }}</td>
                                    <td>@if ($item->status == 1) {{ "Hoạt động" }} @else {{ "Không hoạt động" }} @endif</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <form action="{{ url('admin/account/' . $item->user_id . '/disable') }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->user_id }}">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit"
                                                        onclick="return confirm('Bạn có chắc chắn muốn hủy kích hoạt?')"
                                                        class="btn btn-danger">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    Hủy kích hoạt</a>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ url('admin/account/' . $item->user_id . '/enable') }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->user_id }}">
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
                        {!! $listAccounts->appends($params)->render() !!}
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@stop
