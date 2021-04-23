@extends('layouts.default')
@section('content')
        <!--Create Album-->
<div class="col-md-12">
    <div class="row">
        <div class="cart-box mr15">
            <div class="shipping-form">
                <div class="title-box bdrB">
                    <h1>Change Password</h1>
                </div>
                <div class="col-md-12">
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
                    <form role="form" method="POST" action="password_change">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-box">
                            <label for="">Old Password</label>
                            <input type="password" id="old_password" name="old_password" placeholder="current password"
                                   required class="form-control" value="">
                        </div>

                        <div class="form-box">
                            <label for="">New Password</label>

                            <p class="col-dark mb10">
                                Passwords must be at least 7 characters in length.
                            </p>
                            <input type="password" id="password" name="password"
                                   placeholder="new Password format e.g.Cartimatic#" required class="form-control"
                                   value="">
                        </div>

                        <div class="form-box">
                            <label for="">Re-Enter New Password</label>

                            <p class="col-dark mb10">
                                Enter your password again for confirmation.
                            </p>
                            <input type="password" id="conformed_password" name="conformed_password" required
                                   placeholder="Re-enter password" class="form-control" value="">

                        </div>

                        <div class="form-box">
                            <input type="submit"  class="btn btn-primary" name="submit" value="Reset Password">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
