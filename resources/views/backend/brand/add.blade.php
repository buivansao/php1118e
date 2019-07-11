@extends('backend.layout.index')
@section('title','Thêm thương hiệu')
@section('main')
<div class="col-xs-12 col-md-10 col-lg-10 pull-right">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Thêm thương hiệu
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
			<form  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group col-xs-12 col-lg-12">
					<label>Tên thương hiệu</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="form-group col-xs-12 col-lg-12">
					<label for="">Logo</label>
					<input type="file" onchange="preview_ava()" name="logo" class="form-control">
					<div id="preview"></div>
				</div>
				
				<div class="form-group col-xs-12 col-lg-12">
					<label>Giới thiệu</label>
					<textarea name="description" class="ckeditor"></textarea>
					<script type="text/javascript">
						var editor = CKEDITOR.replace('description',{
							language:'vi',
							filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
							filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl: '../..editor//public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
						});
					</script>

				</div>
				
				<div class="form-group col-xs-12 col-lg-12">
					<label>Trạng thái</label>
					<select name="status" class="form-control">
						<option value="1">Hiển thị</option>
						<option value="0">Không hiển thị</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Thêm mới" class="btn btn-primary " >
				</div>
			</div>
		</form>
	</div>
</div>
@stop