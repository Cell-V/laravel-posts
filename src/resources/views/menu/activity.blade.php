@php
setlocale(LC_TIME, 'it_IT');
@endphp

<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Activity <span class="caret"></span></a>
  <ul class="dropdown-menu">

  	@if (isset($activities) && count($activities))
  		@foreach ($activities->sortByDesc('updated_at') as $activity)
	  		{{-- {{dump($activity->properties)}} --}}
  		  <li class="text-overflow"><a href="{{ route('user.activity', $activity->id) }}">Updated {{ $activity->subject->title }} on {{$activity->updated_at->formatLocalized('%A %d %B %Y %R')}} by {{ $activity->causer->name }}</a></li>
  		@endforeach
		@endif

    <li role="separator" class="divider"></li>
    <li><a href="#">Show all activities for this post</a></li>

		{{-- <li>{{ dump($activities) }}</li> --}}
  </ul>
</li>