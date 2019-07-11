@extends('backend.layout.index')
@section('title','Sửa sản phẩm')
@section('main')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Sửa sản phẩm</div>
                    <div class="panel-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="tab">
                            <button class="tablinks active" onclick="openTab(event, 'product')">Thông tin chung</button>
                            <button class="tablinks" onclick="openTab(event, 'option')">Thông số kỹ thuật</button>
                            <button class="tablinks" onclick="openTab(event, 'category')">Danh mục</button>
                            <button class="tablinks" onclick="openTab(event, 'image')">Ảnh</button>
                            <button class="tablinks" onclick="openTab(event, 'relate')">Sản phẩm liên quan</button>
                        </div>

                        <form method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div id="product" style="display: block" class="tabcontent">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required type="text" name="name" class="form-control"
                                           value="{{$product->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" name="img" class="form-control">
                                    <img src="{{asset('storage/app/products/' . $product->image)}}" height="100px">
                                </div>
                                <div class="form-group">
                                    <label>Hãng</label>
                                    <select name="brand_id">
                                        @foreach($brands as $brand)
                                            <option
                                                    @if($product->brand_id == $brand->id)
                                                    {{"selected"}}
                                                    @endif
                                                    value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn</label>
                                    <input type="text" name="description" class="form-control"
                                           value="{{$product->description}}">
                                </div>
                                <div class="form-group">
                                    <label>Giá nhập</label>
                                    <input style="width: 200px" type="text" name="stock_price" class="form-control"
                                           value="{{$product->stock_price}}">
                                </div>
                                <div class="form-group">
                                    <label>Giá bán</label>
                                    <input style="width: 200px" type="text" name="price" class="form-control"
                                           value="{{$product->price}}">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea name="content" class="ckeditor">{{$product->content}}</textarea>
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
                                <div class="form-group" style="width: 200px">
                                    <label>Kho hàng</label>
                                    <select class="form-control" required name="stock">
                                        <option value="1" <?php if ($product->stock == 1) echo 'selected' ?>>Còn hàng
                                        </option>
                                        <option value="0" <?php if ($product->stock == 0) echo 'selected' ?>>Hết hàng
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group" style="width: 200px">
                                    <label>Trạng thái</label>
                                    <select class="form-control" required name="status">
                                        <option value="1" <?php if ($product->status == 1) echo 'selected' ?>>Hiện
                                        </option>
                                        <option value="0" <?php if ($product->status == 0) echo 'selected' ?>>Ẩn
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
                                    @if(count($options) == 0) {{"Chưa có thông tin"}}
                                    @else
                                        @foreach($options as $option)
                                            <tr>
                                                <td class="col-sm-4">
                                                    <input type="text" name="option_name[]"
                                                           value="{{$option->option_name}}"
                                                           class="form-control"/>
                                                </td>
                                                <td class="col-sm-4">
                                                    <input type="text" name="option_value[]"
                                                           value="{{$option->option_value}}"
                                                           class="form-control"/>
                                                </td>
                                                <td class="col-sm-2">
                                                    <a class="deleteRow"></a>
                                                    <a href="{{asset('admin/product/'.$option->id.'/deleteop/')}}"
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                       class="btn btn-danger"><span
                                                                class="glyphicon glyphicon-trash"></span>
                                                        Xóa</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: left;">
                                            <input type="button" class="btn btn-success"
                                                   style="width: 50px; float: right"
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
                                    <select name="category[]" multiple class="form-control"
                                            style="width: 500px; height: 200px">
                                        <?php
                                        foreach ($listCategories as $item) {
                                            echo "<option value='" . $item->id . "'";
                                            if (isset($category))
                                                foreach ($category as $cate)
                                                    if ($cate->cateid == $item->id) echo "selected";
                                            echo ">" . $item->id . " _ " . $item->name . "</option>";

                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($category)){
                                        foreach($category as $item){?>
                                        <tr>
                                            <td>{{$item->cid}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->cName}}</td>
                                            <td>
                                                <a href="{{asset('admin/product/'.$item->cid.'/deletecate')}}"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                   class="btn btn-danger"><span
                                                            class="glyphicon glyphicon-trash"></span>
                                                    Xóa</a>
                                            </td>

                                        </tr>
                                        <?php }
                                        }
                                        else echo "Chưa có sản phẩm liên quan";?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="image" class="tabcontent">
                                {{csrf_field()}}
                                <?php if(count($image) == 0) {?>
                                <div class="input-group control-group increment">
                                    <input type="file" name="filename[]">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php }
                                else{
                                foreach ($image as $img){ ?>
                                <div class="input-group control-group increment">
                                    <input type="file" name="filename[]">
                                    <img src="{{asset('storage/app/products/' . $img->image)}}" height="200px">
                                    {{$img->image}}
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>
                                        </button>
                                        <a href="{{asset('admin/product/'.$img->id.'/delete')}}"
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                           class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </div>
                                </div>
                                <?php }
                                }?>
                                <div class="clone hide">
                                    <div class="control-group input-group" style="margin-top:10px">
                                        <input type="file" name="filename[]" class="form-control">
                                        <div class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="relate" class="tabcontent">
                                <div class="form-group">
                                    <label>Chọn sản phẩm liên quan</label>
                                    <select name="relate[]" multiple class="form-control"
                                            style="width: 500px; height: 200px">
                                        <?php
                                        foreach ($listProducts as $item) {
                                            echo "<option value='" . $item->id . "'";
                                            if (isset($relate))
                                                foreach ($relate as $re)
                                                    if ($re->sid == $item->id) echo "selected";
                                            echo ">" . $item->id . " _ " . $item->name . "</option>";

                                        }
                                        ?>?>
                                    </select>
                                </div>
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Sản phẩm liên quan</th>
                                            <th>Chức năng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($relate)){
                                        foreach($relate as $item){?>
                                        <tr>
                                            <td>{{$item->rid}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->rName}}</td>
                                            <td>
                                                <a href="{{asset('admin/product/'.$item->rid.'/deleterl')}}"
                                                   onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                   class="btn btn-danger"><span
                                                            class="glyphicon glyphicon-trash"></span>
                                                    Xóa</a>
                                            </td>

                                        </tr>
                                        <?php }
                                        }
                                        else echo "Chưa có sản phẩm liên quan";?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>    <!--/.main-->
@stop