@extends('layouts.default')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="page404"></div>
      <div class="page404-txt">
        <h1 class="p404">404</h1>

        <p class="pnf">Page not found</p>

        <p class="pnf-txt">
          The link you followed probably broken, or page
          might have been removed, had its name changed,
          or is temporarily unavailable
        </p>

        <div class="link404">
          <a class="l404" href="{{url('/')}}">Take me out of here</a>
        </div>
      </div>
    </div>
  </div>
@endsection
