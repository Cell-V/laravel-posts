  {{-- <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading"><h3>{{$post->title}}</h3></div>

              <div class="panel-body">
                {{ucfirst($post->body)}}
                {{ucfirst($post->tags)}}
              </div>
          </div>
      </div>
  </div> --}}



<div class="panel panel-info">
    <div class="panel-heading clearfix">
      <div class="" style="display:inline-block;">
        <h4><a href="{{route('post.showBySlug', $post->slug)}}">{{ucwords($post->title)}}</a> ({{ $post->getKey() }})</h4>
      </div>

      @can('update-post', $post)
      <div class="pull-right"style="line-height: 41px;">
        <a href="{{route('post.edit', $post->id)}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
      </div>
      @endcan
    </div>

    <div class="panel-body">
        {{ucfirst($post->body)}}
        <br>
        @foreach ($post->tags as $tag)
          <span class="tag label label-info">{{$tag->name}}</span>
        @endforeach
    </div>

    <div class="panel-footer">
      @if ($post->user)
        Posted by <strong><a href="{{route('user.profile', $post->user)}}">{{$post->user->name}}</a></strong>, created on {{$post->created_at->formatLocalized('%A %d %B %Y %R')}}
      @endif
    </div>

</div>
