@extends('layouts.app')

@section('styles')
  <link rel="stylesheet" href="/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css">
@endsection

@section('content')
<div class="container">
  @if (Auth::check())
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
              <h4>New Post</h4>
              {{-- <a class="btn btn-primary btn-block" role="button" data-toggle="collapse" data-parent="#accordion" href="#newPost" aria-expanded="true" aria-controls="newPost">
                New Post
              </a> --}}
            </div>

            <div id="newPost" class="{{-- panel-collapse collapse --}}" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">

                @include('LaravelPosts::_create')

              </div>
            </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection

@section('scripts')
  <script src="/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
@endsection
