@extends('layouts.app')

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
            <a class="navbar-brand" href="#">Show Posts</a>
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
              @include('LaravelPosts::menu.activity', ['activities'=>$post->activity])
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>

  <div class="row">
      <div class="col-md-8 col-md-offset-2">

          <div class="panel panel-info">
              <div class="panel-heading clearfix">
                <div class="" style="display:inline-block;">
                  <h4>{{$post->title}}</h4>
                </div>

                @if ($post->activity->count())
                  <div class="btn-group">
                    <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      @foreach ($post->activity->sortByDesc('updated_at') as $activity)
                        <li><a href="#"><strong>{{array_get($activity->getChangesAttribute()->get('attributes'), 'title')}}</strong> <small>on {{$activity->updated_at}}</small></a></li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                {{-- <div class="btn-group">
                  <button type="button" class="btn btn-default">{{$post->title}}</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu">
                    @foreach ($post->activity->sortByDesc('updated_at') as $activity)
                      <li><a href="#"><strong>{{array_get($activity->getChangesAttribute()->get('attributes'), 'title')}}</strong> <small>on {{$activity->updated_at}}</small></a></li>
                    @endforeach
                  </ul>
                </div> --}}

                @can('update-post', $post)
                <div class="pull-right"style="line-height: 41px;">
                  <a href="{{route('post.edit', $post->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                </div>
                @endcan
              </div>

              <div class="panel-body">
                <ul class="list-unstyled">
                  @foreach ($post->activity->sortByDesc('updated_at') as $activity)
                    {{-- <li>{{dump($activity->properties)}}</li> --}}
                    {{-- <li>{{dump($activity->properties->pluck('title'))}}</li> --}}
                    {{-- <li>{{array_pluck($activity->properties, 'title')}}</li> --}}
                    {{-- <li>{{dump($activity->getChangesAttribute())}}</li> --}}
                    {{-- <li>{{array_dot($activity->getChangesAttribute(), 'old.title')}}</li> --}}
                    {{-- <li>{{array_get($activity->getChangesAttribute()->get('attributes'), 'title')}}</li> --}}
                    {{-- <li>{{dump($activity->getChangesAttribute()->get('old'))}}</li> --}}
                    {{-- <li>{{dump($activity->getChangesAttribute()->pluck('title'))}}</li> --}}
                    {{-- <li>{{dump($activity->getExtraProperty('title'))}}</li> --}}
                  @endforeach
                </ul>

                {!! Linkify::process(ucfirst($post->body), ['attr'=>['target'=>'_blank']]) !!}
                <br>
                @if ($post->activity->count())
                  <div class="btn-group">
                    <button class="btn btn-default btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                      @foreach ($post->activity->sortByDesc('updated_at') as $activity)
                        <li><a href="#"><strong>{{array_get($activity->getChangesAttribute()->get('attributes'), 'body')}}</strong> <small>on {{$activity->updated_at}}</small></a></li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                  <br>
                {{-- {{dump($post->tags)}} --}}
                @foreach ($post->tags as $tag)
                  {{-- {{dump($tag->name)}} --}}
                  <span class="tag label label-info">{{$tag->name}}</span>
                @endforeach
                {{-- {{ucfirst($post->tags->pluck('name')->implode(','))}} --}}

                {{-- <input type="text" class="form-control" id="tags" data-role="tagsinput" data-live-search="true" name="tags[]" value="{{ $post->tags->pluck('name')->implode(',') }}" placeholder="Tags" class="hidden" disabled> --}}

              </div>
              <div class="panel-footer">
                @if ($post->user)
                  Posted by <strong><a href="{{route('user.profile', $post->user)}}">{{$post->user->name}}</a></strong>, created on {{$post->created_at->formatLocalized('%A %d %B %Y %R')}}
                @endif

                {{-- {{dump($post)}} --}}
                {{-- {{dump($post->comments->first())}} --}}
                {{-- {{dump('hasComments', $post->hasComments)}} --}}
                {{-- {{dump('hasComments', $post->comments_count)}} --}}
                {{-- {{dump('hasComments', $post->has('comments')->get())}} --}}
                {{-- {{dump('comments count', $post->comments->count())}} --}}
                  @can('view', $post->comments->first())
                    @includeIf('post.partials._comments')
                  @elseif(Auth::guest())
                    <em><a href="{{ route('login-ajax') }}" class="btn ajax show-btn" data-method="post" data-modal="#bsModal" data-replace="#bsModal .view-content">Sign In</a> to read comments</em>
                  @endcan
              </div>
          </div>
      </div>
  </div>

</div>
@endsection

@push('morescripts')
  {{-- // <script src="/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script> --}}
  {{--
  // <script>
  // $(function() {
  //   console.log("tagsinput");
  //   $('input[data-role=tagsinput]').tagsinput({
  //     tagClass: 'big'
  //   });
  // });
  // </script>
   --}}
@endpush
