@extends('backend.layout.index')
@section('title','Thêm sản phẩm')
@section('main')
    <div class="col-xs-12 col-md-10 col-lg-10 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Thêm Sản phẩm
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
                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'product')">Thông tin chung</button>
                    <button class="tablinks" onclick="openTab(event, 'option')">Thông số kỹ thuật</button>
                    <button class="tablinks" onclick="openTab(event, 'category')">Danh mục</button>
                    <button class="tablinks" onclick="openTab(event, 'image')">Ảnh</button>
                    <button class="tablinks" onclick="openTab(event, 'relate')">Sản phẩm liên quan</button>
                </div>
                <form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                    <div id="product" style="display: block" class="active tabcontent">
                        {{csrf_field()}}
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Tên sản phẩm</label>
                            <input required type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Mô tả</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label for="">Hình</label>
                            <input id="avatar" onchange="preview_ava()" type="file" name="image" class="form-control">
                            <div id="preview"></div>
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Thương hiệu</label>
                            <select name="brand_id" class="form-control">
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Giá nhập</label>
                            <input type="text" name="stock_price" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Giá bán</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                        <div class="form-group col-xs-12 col-lg-12">
                            <label>Nội dung</label>
                            <textarea name="content" class="ckeditor"></textarea>
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
                        <div class="form-group" style="width: 200px">
                            <label>Kho hàng</label>
                            <select class="form-control" name="stock">
                                <option value="1" selected>Còn hàng
                                </option>
                                <option value="0">Hết hàng
                                </option>
                            </select>
                        </div>
                        <div class="form-group" style="width: 200px">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="1" selected>Hiện
                                </option>
                                <option value="0">Ẩn
                                </option>
                            </select>
                        </div>
                    </div>
                    <div id="option" class="tabcontent">
                        <table id="myTable" class=" table order-list">
                            <thead>
                            <tr>
                                <td>Thuộc tính</td>
                                <td>Giá trị</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="col-sm-4">
                                    <input type="text" name="option_name[]" class="form-control"/>
                                </td>
                                <td class="col-sm-4">
                                    <input type="text" name="option_value[]" class="form-control"/>
                                </td>
                                <td class="col-sm-2"><a class="deleteRow"></a></td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: left;">
                                    <input type="button" class="btn btn-lg btn-block" style="width: 50px; float: right"
                                           id="addrow"
                                           value="+"/>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="category" class="tabcontent">
                        <div class="form-group">
                            <label>Chọn danh mục</label>
                            <select name="category[]" multiple class="form-control" style="width: 500px; height: 200px">
                                <?php
                                foreach ($categories as $item) {
                                    echo "<option value='" . $item->id . "''>" . $item->id . " _ " . $item->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="image" class="tabcontent">
                        <div class="input-group control-group increment">
                            <input multiple id="img" onchange="preview_image()" type="file" name="filename[]"
                                   class="form-control">
                            <div id="gallery"></div>
                        </div>
                    </div>
                    <div id="relate" class="tabcontent">
                        <div class="form-group">
                            <label>Chọn sản phẩm liên quan</label>
                            <select name="relate[]" multiple class="form-control" style="width: 500px; height: 200px">
                                <?php
                                foreach ($products as $item) {
                                    echo "<option value='" . $item->id . "''>" . $item->id . " _ " . $item->name . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" name="submit" value="Lưu" class="btn btn-primary ">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

