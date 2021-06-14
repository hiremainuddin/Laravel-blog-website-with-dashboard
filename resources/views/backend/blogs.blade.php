@extends('backend.layout.master')

@section('title')
Blog - Blogs
@endsection()

@section('content')

<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Blogs</h5>
        <a href="/createblog" class="btn btn-success float-right">Create Blog</a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-responsive table-bordered table-sm w-100" id="blogs">
        	<thead>
                <th scope="col">Id</th>
                <th scope="col">Images</th>
                <th scope="col">User</th>
                <th scope="col">Category</th>
                <th scope="col">Title</th>
                <th scope="col">Short Desrciption</th>
                <th scope="col">Status</th>
        		<th scope="col">Edit</th>
        		<th scope="col">Delete</th>
        	</thead>
        </table>
    </div>
</div>

@endsection()

@section('scripts')
<script type="text/javascript" src="{{asset('/backend/partials/blogs.js')}}"></script>
@endsection()
