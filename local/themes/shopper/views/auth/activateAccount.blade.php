@extends('layouts.shopper-main')

@section('content')
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="panel panel-default">
				<div class="panel-heading"><a href="{{url('/')}}">{{ Lang::get('titles.home') }}</a></div>

				<div class="panel-body">
					<p>{{ Lang::get('auth.sentEmail',
						['email' => $email] ) }}</p>

					<p>{{ Lang::get('auth.clickInEmail') }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection