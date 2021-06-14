<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="@yield('meta')">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="{{asset('frontend/css/clean-blog.min.css')}}" rel="stylesheet">
@yield('styles')
</head>

<body>

<!-- Navigation -->
@include('frontend/layout/navbar')

<!-- header -->
@yield('header')

  <!-- Main Content -->
  <div class="container">
@yield('content')
  </div>

  <hr>

@include('frontend/layout/footer')

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('frontend/js/clean-blog.min.js')}}"></script>
@yield('scripts')
</body>

</html>
