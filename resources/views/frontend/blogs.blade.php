@extends('frontend.layout.master')

@section('title')
Blog
@endsection()


@section('styles')
@endsection()

@section('header')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('frontend/img/home-bg.jpg')}}')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Clean Blog</h1>
          <span class="subheading">A Blog Theme by Start Bootstrap</span>
        </div>
      </div>
    </div>
  </div>
</header>

@endsection()

@section('content')
<div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        @foreach($blogs as $blog)
        <div class="post-preview">
          <a href="{{ url('/blog/'.$blog->url) }}">
            <h2 class="post-title">
              {{ Str::words($blog->title, 10, ' ...') }}
            </h2>
            <h3 class="post-subtitle">
              {{ Str::limit($blog->short_description, 100) }}
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#">{{ $blog->user->name }}</a>
            {{ Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</p>
        </div>
        @if(!$loop->last)
        <hr>
        @endif
        @endforeach
        <!-- Pager -->
        <div class="col-12">
          <nav aria-label="pagination">
            <ul class="pagination justify-content-center">
              {{ $blogs->links("pagination::bootstrap-4") }}
            </ul>
          </nav>
        </div>
      </div>
    </div>
@endsection()

@section('scripts')
@endsection()