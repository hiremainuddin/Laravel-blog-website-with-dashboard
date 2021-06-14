@extends('frontend.layout.master')
@section('meta')
{{ $blog->meta }}
@endsection()
@section('title')
Blog_detail
@endsection()


@section('styles')
@endsection()

@section('header')

<!-- Page Header -->
<header class="masthead" style="background-image: url('{{asset('frontend/img/post-bg.jpg')}}">
  <div class="overlay"></div>
  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{ $blog->title ?? ''}}</h1>
            <span class="meta">Category
              <a href="#" class="badge badge-success mb-3">{{$blog->category->name ?? ''}}</a>
            </span>
            <span class="meta">Tags
              @foreach($blog->tags as $tag)
              <a href="#" class="badge badge-success mb-3">{{$tag->name ?? ''}}</a>
              @endforeach
            </span>
            <span class="meta">Posted by
              <a href="#">{{$blog->user->name ?? ''}}</a>
              on {{Carbon\Carbon::parse($blog->created_at)->format('F d, Y') ?? ''}}
            </span>
          </div>
        </div>
      </div>
  </div>
</header>

@endsection()

@section('content')
<!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <blockquote class="blockquote">{{ $blog->short_description ?? ''}}</blockquote>
          <div class="text-center">
            <a href="#">
              <img src="{{asset('images/blogsImages/'.$blog->image ?? '')}}" class="img-fluid rounded" alt="{{ $blog->image_alt ?? ''}}">
            </a>
          </div>
          <p>{!! $blog->description ?? '' !!}</p>
      </div>
    </div>
  </article>

  <hr>
@endsection()

@section('scripts')
@endsection()