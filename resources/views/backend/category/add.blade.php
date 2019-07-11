@extends('backend.layout.index')
@section('title','Thêm danh mục')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Thêm danh mục
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
                        <form method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input required type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mô tả ngắn</label>
                                <textarea name="description" class="ckeditor"></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('description', {
                                        language: 'vi',
                                        filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                <?php
                                function showCategories($parents, $parent_id = 0, $char = '')
                                {
                                    foreach ($parents as $item) {
                                        if ($item['parent_id'] == $parent_id) {
                                            echo '<option value="' . $item['id'] . '">';
                                            echo $char . $item['id'] . ". " . $item['name'];
                                            echo '</option>';
                                            unset($parents['name']);
                                            showCategories($parents, $item['id'], $char . '|---');
                                        }
                                    }
                                }
                                ?>
                                <select name="parent_id">
                                    <option value="">Chọn</option>
                                    <?php
                                    showCategories($parents);
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label>Vị trí</label>
                                <input class="form-control" type="number" name="position" style="width: 200px">
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="content" class="ckeditor"></textarea>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('content', {
                                        language: 'vi',
                                        filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?Type=Images',
                                        filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?Type=Flash',
                                        filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                        filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option value="1" selected>Hiện</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--/.row-->
        </div>    <!--/.main-->
    </div>
@stop