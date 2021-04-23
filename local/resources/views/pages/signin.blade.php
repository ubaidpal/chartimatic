@extends('layouts.default')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalSignin">
  Sign In 
</button>

<!-- Modal -->
<div class="modal fade" id="myModalSignin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="signup-wrapper" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="col-md-12">
        	<div class="col-md-6 new-user">
            	<h1>New Customer</h1>
                <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                <button class="btn btn-register" type="submit">register</button>
            </div>
            <div class="col-md-6 social-user">
            	<div class="omb_login">
                    <hr class="omb_hr">
                    <span class="omb_span">sign in with social media</span>
				</div>
                
                <div class="omb_socialButtons">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-block omb_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>	
                    <div class="col-md-6">
                        <a href="#" class="btn btn-block omb_btn-google">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">Google+</span>
                        </a>
                    </div>	
                </div>
                
                <div class="omb_loginOr">
                    <hr class="omb_hrOr">
                    <span class="omb_spanOr">or</span>
				</div>
                
                <div class="login-container">
                	<form novalidate action="/login/" method="POST" id="loginForm">
                      <div class="form-group">
                          <label class="control-label" for="username">Username</label>
                          <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                          <span class="help-block"></span>
                      </div>
                      <div class="form-group">
                          <label class="control-label" for="password">Password</label>
                          <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">
                          <span class="help-block"></span>
                      </div>
                      <div class="alert alert-error hide" id="loginErrorMsg">Wrong username og password</div>
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" id="remember" name="remember"> Remember login
                          </label>
                          <a class="forgot-pass" href="#">Forgot password</a>
                      </div>
                      <button class="btn btn-login" type="submit">Sign In</button>
                  </form>
                </div>
                
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
<script>

    (function() {
        setTimeout(function(){
            $(".btn.btn-primary.btn-lg").trigger("click");
        }, 1000)
    })();
</script>

