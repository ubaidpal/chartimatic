@extends('layouts.default')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Sign up
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="signup-wrapper w-650" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="col-md-12">
        	<h1 class="mt20">Register a new account</h1>
            <div class="form_wizard wizard_verticle login-container" id="wizard_verticle">
                <ul class="list-unstyled wizard_steps anchor">
                      <li>
                        <a href="#step-11" class="selected" isdone="1" rel="1">
                          <span class="step_no">1</span>
                          <label>Get Started</label>
                        </a>
                      </li>
                      <li>
                        <a href="#step-22" class="disabled" isdone="0" rel="2">
                          <span class="step_no">2</span>
                          <label>Personal Information</label>
                        </a>
                      </li>
                      <li>
                        <a href="#step-33" class="disabled" isdone="0" rel="3">
                          <span class="step_no">3</span>
                          <label>Complete</label>
                        </a>
                      </li>
                    </ul>
                	<div id="step-11" class="wizard_content" style="display: block;">
                    	<form novalidate action="/login/" method="POST" id="loginForm">
                            <div class="form-group joinAs">
                                <select class="form-control pull-right" id="user_type">
                                  <option>Buyer</option>
                                  <option>Seller</option>
                                </select>
                                <label class="pull-right">You want to join as a</label>
                            </div>
                          <div class="form-group">
                              <label class="control-label" for="email">Email *</label>
                              <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="" value="" name="email" id="email" class="form-control">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="password">Password</label>
                              <button type="button" class="tp" data-toggle="tooltip" data-placement="left" title="Use 6 to 64 characters.

Besides letters, include at least a number or symbol (!@#$%^*-_+=).

Password is case sensitive.

Avoid using the same password for multiple sites." aria-describedby="tooltip">?</button>
                              <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="password">Password (again) *</label>
                              <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">
                              <span class="help-block"></span>
                          </div>
                      </form>
                    </div>

                	<div id="step-22" class="wizard_content" style="display: none;">
                     <form novalidate action="/login/" method="POST" id="loginForm">
                          <div class="form-group">
                              <label class="control-label" for="first_name">First name *</label>
                              <input type="text" placeholder="" title="Please enter you First Name" required="" value="" name="first_name" id="first_name" class="form-control">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group">
                              <label class="control-label" for="password">Last Name *</label>
                              <input type="text" title="Please enter your Last Name" required="" value="" name="" id="" class="form-control">
                              <span class="help-block"></span>
                          </div>
                          <div class="form-group gender">
                            <label class="control-label" for="password">Gender *</label>
                            <select class="form-control" id="gender1">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                          </div>
                      </form>
                    </div>
                	<div id="step-33" class="wizard_content" style="display: none;">
                    	<p>Welcome to online marketplace! For security reasons, please verify your email to complete your registration</p>
                    </div>
                <div class="clrfix"></div>
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
