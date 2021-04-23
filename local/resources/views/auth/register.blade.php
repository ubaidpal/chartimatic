@extends('layouts.default')

@section('content')
	<!-- Cropper test start -->
	<link rel="stylesheet" href="{{asset('local/public/assets/plugins/jquery-cropper/css/cropper.min.css')}}">
	<link rel="stylesheet" href="{{asset('local/public/assets/plugins/jquery-cropper/css/main.css')}}">
	<div class="container" id="crop-avatar">

		<!-- Current avatar -->
		<div class="avatar-view" title="Change the avatar">
			<img src="{{asset('local/public/assets/plugins/jquery-cropper/img/picture.jpg')}}" alt="Avatar">
		</div>

		<!-- Cropping modal -->
		<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
						</div>
						<div class="modal-body">
							<div class="avatar-body">

								<!-- Upload image and data -->
								<div class="avatar-upload">
									<input type="hidden" class="avatar-src" name="avatar_src">
									<input type="hidden" class="avatar-data" name="avatar_data">
									<label for="avatarInput">Local upload</label>
									<input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
								</div>

								<!-- Crop and preview -->
								<div class="row">
									<div class="col-md-9">
										<div class="avatar-wrapper"></div>
									</div>
									<div class="col-md-3">
										<div class="avatar-preview preview-lg"></div>
										<div class="avatar-preview preview-md"></div>
										<div class="avatar-preview preview-sm"></div>
									</div>
								</div>

								<div class="row avatar-btns">
									<div class="col-md-9">
										<div class="btn-group">
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="-15">-15deg</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="-30">-30deg</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="-45">-45deg</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="15">15deg</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="30">30deg</button>
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="45">45deg</button>
										</div>
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div> -->
					</form>
				</div>
			</div>
		</div><!-- /.modal -->

		<!-- Loading state -->
		<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	</div>

<!-- end of cropper -->

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('titles.register') }}</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>{{ Lang::get('auth.whoops') }}</strong> {{ Lang::get('auth.someProblems') }}<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.name') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ Lang::get('auth.confirmPassword') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ Lang::get('auth.register') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer-scripts')
	<script src="{{asset('local/public/assets/plugins/jquery-cropper/js/cropper.min.js')}}"></script>
	<script src="{{asset('local/public/assets/plugins/jquery-cropper/js/main.js')}}"></script>
@endsection
