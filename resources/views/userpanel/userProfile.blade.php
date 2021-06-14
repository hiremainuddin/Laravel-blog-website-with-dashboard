@extends('userpanel.layout.master')

@section('title')
Blog -Dashboard
@endsection()

@section('content')

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

     <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <div class="border p-1">
                <label for="">Name :</label> {{ $user->name }}
            </div>
            <div class="border p-1">
                <label for="">Email :</label> {{ $user->email }}
            </div>
            <div class="border p-1">
                <label for="">Password :</label> 
            </div>
            
        </div>
    </div>

<!-- Content Row -->
@endsection()

@section('scripts')

<script src="{{asset('backend/vendor/bootstrap/js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/chart-pie-demo.js')}}"></script>
@endsection()
