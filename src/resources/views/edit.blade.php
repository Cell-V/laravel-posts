@extends('layouts.app')


@section('styles')
  <link rel="stylesheet" href="/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endsection


@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <nav class="navbar navbar-info" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Posts</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navbar">
            {{-- <ul class="nav navbar-nav">
              <li class="active"><a href="{{route('post.index')}}" class="btn-primary">All Posts list</a></li>
              <li><a href="#"></a></li>
            </ul> --}}

            {{-- <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form> --}}

            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{route('post.index')}}">Back to list</a></li>

            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

      <div class="panel panel-info">
        <div class="panel-heading clearfix">
          <div class="" style="display:inline-block;">
            <h4><a href="{{route('post.showBySlug', $post->slug)}}">{{ucwords($post->title)}}</a></h4>
          </div>

          {{-- @if (Auth::check())
          <div class="pull-right"style="line-height: 41px;">
            <a href="{{route('post.edit', $post->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
          </div>
          @endif --}}
        </div>

        <div class="panel-body">
            @include('LaravelPosts::_edit', $post)
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')
  <script src="/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
@endsection
