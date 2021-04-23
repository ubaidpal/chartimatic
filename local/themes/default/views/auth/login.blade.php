@extends('layouts.main')
@section('content')
    <div class="container">
    	<div class="">
                <div class="">
                    <div class="bread-wrapper"><h1>{{ Lang::get('titles.login') }}</h1></div>
                    <div class="panel-body col-md-6 col-md-offset-3">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>{{ Lang::get('auth.whoops') }}</strong>{{ Lang::get('auth.someProblems') }}<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                            	<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ Lang::get('auth.email') }}">
                            </div>

                            <div class="form-group">
                            	<input type="password" class="form-control" name="password" placeholder="{{ Lang::get('auth.password') }}">
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ Lang::get('auth.rememberMe') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ Lang::get('auth.login') }}</button>

                                <a class="btn-link" href="{{ url('/password/email') }}">{{ Lang::get('auth.forgot') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
