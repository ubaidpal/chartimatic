@extends('layouts.default')
@section('content')
	<!--  Login Container  -->
	
	<div class="panel panel-default">
		<div class="panel-heading">Forgot Password</div>

		<div class="panel-body">
			<p class="description">If you cannot login because you have forgotten your password, please enter your email address in the field below.</p>
			@if (session('status'))
				<p class="description">
					{{ session('status') }}
				</p>
			@endif

			<form class="form-horizontal mb10 mt10" role="form" method="POST" action="{{ url('/password/email') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="email-label col-md-2 control-label">{{ Lang::get('auth.email') }}</label>
					<div class="col-md-5">
						<input type="email" class="form-control m0" name="email" value="{{ old('email') }}" placeholder="Please enter valid email address...">
					</div>
				</div>
				@if (count($errors) > 0)
				<div class="alert alert-danger emailError">
					<!--<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br><br>-->
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="form-group">
					<div class="col-md-7">
						<button type="submit" class="btn btn-default btn-sm pull-right">
							{{ Lang::get('auth.sendResetLink') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--  Login Container - Ends -->
@endsection
