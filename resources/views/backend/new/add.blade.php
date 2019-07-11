@extends('backend.layout.index')
@section('title','Thêm tin tức')
@section('main')
    <div class="col-xs-12 col-md-10 col-lg-10 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Thêm tin tức
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Tên tin tức</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-xs-12 col-lg-12">
                        <label for="">Ảnh</label>
                        <input type="file" onchange="preview_ava()" name="image" class="form-control">
                        <div id="preview"></div>
                    </div>
                    <div>
                        <label>Tóm tắt nội dung</label>
                        <textarea type="text" name="description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12">
                        <label>Nội dung</label>
                        <textarea name="content" class="ckeditor" rows="15"></textarea>
                        <script type="text/javascript">
                            var editor = CKEDITOR.replace('content', {
                                language: 'vi',
                                filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
                                filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
                                filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                filebrowserFlashUploadUrl: '../..editor//public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                            });
                        </script>
                    </div>

                    <div class="form-group col-md-3 col-lg-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-control">
                            <option value="1">Hiển thị</option>
                            <option value="0">Không hiển thị</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit" name="submit" value="Thêm mới" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
