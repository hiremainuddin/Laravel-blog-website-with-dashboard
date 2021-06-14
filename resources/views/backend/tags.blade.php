@extends('backend.layout.master')

@section('title')
Blog -Tags
@endsection()

@section('content')

<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Tags</h5>
        <a href="" class="btn btn-success float-right" data-toggle="modal" data-target="#addtagModal">Add Tag</a>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive table-sm w-100" id="tags">
        	<thead>
        		<th scope="col">#</th>
        		<th scope="col">Name</th>
        		<th scope="col">Created At</th>
        		<th scope="col">Updated At</th>
        		<th scope="col">Edit</th>
        		<th scope="col">Delete</th>
        	</thead>
        </table>
    </div>
</div>

@include('backend.layout.partials.tagsModal')

@endsection()

@section('scripts')
<script type="text/javascript" src="{{asset('/backend/partials/tag.js')}}"></script>
@endsection()
