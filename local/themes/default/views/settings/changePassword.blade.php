@extends('layouts.main')
@section('content')
<div class="col-md-12">
    <div class="row">
    	<div class="shipping-form">
                <div class="title-box bdrB">
                    <h1>Change Password</h1>
                </div>
                <div class="col-md-6">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <span style="color: #ff0000;">
                        <li>{{ $error }}</li>
                        </span>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5>Type your password</h5>
                    <form role="form" method="POST" action="password_change">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-box">
                            <input type="password" id="old_password" name="old_password" placeholder="Old Password"
                                   required class="form-control" value="">
                        </div>

                        <div class="form-box">
                            <input type="password" id="password" name="password"
                                   placeholder="New Password" required class="form-control"
                                   value="">
                        </div>

                        <div class="form-box">
                            <input type="password" id="conformed_password" name="conformed_password" required
                                   placeholder="Retype password" class="form-control" value="">

                        </div>

                        <div class="form-box">
                            <input type="submit"  class="btn btn-primary" name="submit" value="Reset Password">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>

                    </form>
                </div>
                <div class="col-md-6">
                	<h4>Create a strong password</h4>
                    <p>-    Make sure your password is at least eight characters in length.<br/>
-    Combine numbers and letters, and don't include commonly used words.<br/>
-    Select a word or acronym and insert numbers between some of the letters.<br/>
-    Include punctuation marks.<br/>
-    Mix capital and lowercase letters.</p>
                </div>
            </div>
    </div>
</div>
@endsection
