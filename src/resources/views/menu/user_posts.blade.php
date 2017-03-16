@php
$posts = Auth::user()->posts;
@endphp

<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User posts <span class="caret"></span></a>
  <ul class="dropdown-menu">

  	@if (isset($posts) && count($posts))
  		@foreach ($posts->sortByDesc('updated_at') as $post)
  		  <li><a href="{{ route('post.show', $post->id) }}"><span class="glyphicon glyphicon-sound-dolby" aria-hidden="true"></span> {{$post->title}}</a></li>
        {{-- <li role="separator" class="divider"></li> --}}
  		@endforeach
		@endif

    <li role="separator" class="divider"></li>
    <li><a href="#">Show all posts</a></li>
		{{-- <li>{{ dump($posts) }}</li> --}}
  </ul>
</li>