@extends('layouts.app')

@section('content')
<div class="container">
  @if (Auth::check())
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
              <a class="btn btn-primary btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#newPost" aria-expanded="true" aria-controls="newPost">
                New Post
              </a>
            </div>

            <div id="newPost" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">

                @include('LaravelPosts::forms.create')

              </div>
            </div>
        </div>
      </div>
    </div>
  @endif

  <div class="row">

    @if (count($posts))
      @foreach ($posts as $post)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><a href="/post/{{$post->slug}}">{{ucwords($post->title)}}</a></h4></div>

                <div class="panel-body">
                    {{ucfirst($post->body)}}
                </div>
            </div>
        </div>
      @endforeach
    @endif
  </div>
</div>
@endsection
