@extends('userpanel.layout.master')

@section('title')
Blog - Awaiting Approval
@endsection()

@section('content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Awaiting Blogs</h5>
    </div>

    <div class="card-body">
        <table class="table table-responsive table-striped table-bordered table-sm w-100" id="userAwaitingBlogs">
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
<script type="text/javascript" src="{{asset('/backend/partials/userAwaiting.js')}}"></script>
@endsection()
