@extends('backend.layout.index')
@section('title','Sửa thương hiệu')
@section('main')
<div class="col-xs-12 col-md-10 col-lg-10 pull-right">
	<div class="panel panel-primary">
		<div class="panel-heading">
			Sửa thương hiệu
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
					<label>Tên thương hiệu:</label>
					<input type="text" name="name" class="form-control" placeholder="Tên danh mục..." value="{{$brands->name}}">
				</div>
				<div class="form-group col-xs-12 col-lg-12">
					<label for="">Logo</label>
					<input type="file" name="logo" class="form-control">
					<img src="{{asset('storage/app/brands/' . $brands->logo)}}" height="50px">
				</div>
				
				<div class="form-group col-xs-12 col-lg-12">
					<label>Description:</label>
					<textarea name="description" class="ckeditor">{{$brands->description}}</textarea>
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
					<label>Status:</label>
					<select name="status" class="form-control">
						<option 
						@if($brands->status == 1)
						{{"selected"}}
						@endif
						value="1">Hiển thị</option>
						<option 
						@if($brands->status == 0)
						{{"selected"}}
						@endif
						value="0">Không hiển thị</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Update" class="btn btn-primary " >
				</div>
			</div>
		</form>
	</div>
</div>
@stop