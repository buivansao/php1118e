@extends('backend.layout.index')
@section('title','Thêm sản phẩm')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Sửa danh mục
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
                                    <input required type="text" name="name" value="{{$category->name}}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <textarea name="description" class="ckeditor">{{$category->description}}</textarea>
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
                                    function showCategories($categories, $parent_id = 0, $char = '')
                                    {
                                        $pId = $_GET['pId'];
                                        foreach ($categories as $item) {
                                            if ($item['parent_id'] == $parent_id) {
                                                echo '<option value="' . $item['id'] . '"';
                                                if ($item['id'] == $pId && $item['parent_id'] != '')
                                                    echo "selected>";
                                                else echo '>';
                                                echo $char . $item['id'] . ". " . $item['name'] . "</option>";
                                                unset($categories['name']);
                                                showCategories($categories, $item['id'], $char . '|---');
                                            }
                                        }
                                    }

                                    ?>
                                    <select name="parent_id">
                                        <option value="">Chọn</option>
                                        <?php
                                        showCategories($categories);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea name="content" class="ckeditor">{{$category->content}}</textarea>
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
                                    <label>Vị trí</label>
                                    <input type="number" style="width: 100px" name="position"
                                           value="{{$category->position}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="status">
                                        <option value="1" <?php if ($category->status == 1) echo 'selected' ?>>Hiện
                                        </option>
                                        <option value="0" <?php if ($category->status == 0) echo 'selected' ?>>Ẩn
                                        </option>
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