@extends('layouts.shopper-main')
@section('content')
	<section class="header_text sub">
	<h4><span>Login or Regsiter</span></h4>
	</section>
	<section class="main-content">
		<div class="row">
			<div class="span5">
				<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
				<form action="{{url('auth/login')}}" method="post">
					<input type="hidden" name="next" value="/">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Username</label>
							<div class="controls">
								<input type="text" name="email" placeholder="Enter your username" id="username" class="input-xlarge">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Username</label>
							<div class="controls">
								<input type="password" name="password" placeholder="Enter your password" id="password" class="input-xlarge">
							</div>
						</div>
						<div class="control-group">
							<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
							<hr>
							<p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span7">
				<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
				<form action="{{url('auth/register')}}" id="registration_form" method="post" class="form-stacked">
					<input type="hidden" name="user_type" value="2">
					<fieldset>
						<div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="email" placeholder="Enter your username" class="input-xlarge">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Password:</label>
							<div class="controls">
								<input type="password" id="register_password" name="password" placeholder="Enter your password" class="input-xlarge">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Confirm Password:</label>
							<div class="controls">
								<input type="password" name="password_confirmation" placeholder="Enter your password" class="input-xlarge">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">First Name</label>
							<div class="controls">
								<input type="text" name="first_name" placeholder="Enter your first name" class="input-xlarge">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Last Name</label>
							<div class="controls">
								<input type="text" name="last_name" placeholder="Enter your last name" class="input-xlarge">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Gender</label>
							<div class="controls">
								<select name="gender" class="input-xlarge">
									<option value="1">Male</option>
									<option value="2">Female</option>
								</select>
							</div>
						</div>

						<hr>
						<div class="actions">
							<input tabindex="9" class="btn btn-inverse large" type="submit" value="Create your account">
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</section>
@endsection
@section('footer-scripts')
	<script type="text/javascript" src="{{getAssetPath($theme)}}/js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$('#registration_form').validate({
			rules : {
				'email' : {
					required:true,
					email:true,
					remote : {
						url : '{{url('auth/isValidEmail')}}',
						type : 'post',
					}
				},
				'password' : {required:true,minlength:6},
				'password_confirmation' : {required:true,equalTo:"#register_password"},
				'first_name' : {required:true},
				'last_name' : {required:true},
				'gender'	: {required:true}
			}
		});
	</script>
@endsection