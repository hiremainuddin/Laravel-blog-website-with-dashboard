@extends('userpanel.layout.master')

@section('title')
Blog - Create Blog
@endsection()

@section('styles')
<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
<style type="text/css">
	.ck-editor__editable{
		height: 15em;
	}
</style>
@endsection()

@section('content')

@if(count($errors) != 0)
@if(count($errors) == 1)
<div class="alert alert-danger">There is 1 error in the form please correct the errors to procced </div>
@else
<div class="alert alert-danger">There is {{count($errors)}} errors in the form please correct the errors to procced </div>
@endif
@endif
<!-- row-->
<div class="row">
	<div class="col-xl-12 col-lg-8">
		<div class="card shadow mb-4">
			<div class="card-body">
				<form action="{{url('/user/create')}}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-row">
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="title" class="ml-1">Blog Title</label>
							<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" placeholder="My Frist Blog" >
							@if($errors->has('title'))
							<small class="text-danger ml-1">{{$errors->first('title')}}</small>
							@endif
						</div>
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="url" class="ml-1">Blog Url</label>
							<input type="text" name="url" id="url" class="form-control" value="{{old('url')}}" placeholder="My-Frist-Blog">
							@if($errors->has('url'))
							<small class="text-danger ml-1">{{$errors->first('url')}}</small>
							@endif
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="category" class="ml-1">Select Category</label>
							<select name="category" id="category" class="form-control">
								<option value="">Select Category</option>
								@foreach($categories as $category)	
								<option {{old('category') == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
								@endforeach				
							</select>
							@if($errors->has('category'))
							<small class="text-danger ml-1">{{$errors->first('category')}}</small>
							@endif
						</div>
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="tags" class="ml-1">Select Tags</label>
							<select name="tags[]" id="tags[]" multiple="multiple" class="form-control tags">
								@foreach($tags as $tag)
								<option @if(old('tags')) {{in_array($tag->id, old('tags')) ? 'selected' : ''}} @endif value="{{$tag->id}}">{{$tag->name}}</option>
								@endforeach
							</select>
							@if($errors->has('tags'))
							<small class="text-danger ml-1">{{$errors->first('tags')}}</small>
							@endif
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="image" class="ml-1">Upload Image</label>
							<input type="file" name="image" id="image" class="form-control-file">
							@if($errors->has('image'))
							<small class="text-danger ml-1">{{$errors->first('image')}}</small>
							@endif
						</div>
						<div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
							<label for="Image_Alt" class="ml-1">Image Alt Text</label>
							<input type="text" name="image_alt" id="image_alt" class="form-control" value="{{old('image_alt')}}" placeholder="My Home Picture">
							@if($errors->has('image_alt'))
							<small class="text-danger ml-1">{{$errors->first('image_alt')}}</small>
							@endif
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<label for="meta" class="ml-1">Meta</label>
							<input type="text" name="meta" id="meta" value="{{old('meta')}}" class="form-control" placeholder="For ex: This was my first blog">
							@if($errors->has('meta'))
							<small class="text-danger ml-1">{{$errors->first('meta')}}</small>
							@endif
						</div>
						<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<label for="short_description" class="ml-1">Short Description</label>
							<textarea type="text" name="short_description" id="short_description"  class="form-control" placeholder="Write Short Description">
							 {{old('short_description')}}
							</textarea>
							@if($errors->has('short_description'))
							<small class="text-danger ml-1">{{$errors->first('short_description')}}</small>
							@endif
						</div>
						<div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<label for="sdescription" class="ml-1">Description</label>
							<textarea type="text" rows="5" name="description" id="description" class="form-control" placeholder="Write Description">{{old('description')}}
							</textarea>
							@if($errors->has('description'))
							<small class="text-danger ml-1">{{$errors->first('description')}}</small>
							@endif
						</div>
					</div>

					<button type="submit" class="btn btn-success">Create</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection()

@section('scripts')
<script type="text/javascript" src="{{asset('/backend/partials/category.js')}}"></script>
<script src="{{asset('backend/js/select2.min.js')}}"></script>
<script src="{{asset('backend/js/ckeditor.js')}}"></script>
<script type="text/javascript">
	$(".tags").select2({
		placeholder: "Select a Tag",
		allowClear: true
	});
	ClassicEditor
	.create( document.querySelector( '#description' ) )
	.then( editor => {
		console.log( editor );
	} )
	.catch( error => {
		console.error( error );
	} );

	var success = "{{session('success') ?? ''}}";
	setTimeout(function(){

		if (success !== '') 
		{
			Swal.fire({
				icon: 'success',
				title: 'Success',
				text: 'Blog Succesfully Added',
			});
		}
	}, 300);
		
	
</script>
@endsection()
