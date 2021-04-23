@extends('layouts.default')
@section('content')
        <!--Create Album-->
<div class="col-md-12">
    <div class="row">
        <div class="cart-box mr15">
            <div class="shipping-form">
                <div class="title-box bdrB">
                    <h1>Profile</h1>
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
                    <form role="form" method="POST" action="saveProfileChanges">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-box">
                            <label for="">First Name</label>
                            <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                   required class="form-control" value="{{$user_record->first_name}}">
                        </div>

                        <div class="form-box">
                            <label for="">Last Name</label>

                            <input type="text" id="last_name" name="last_name"
                                   placeholder="Last Name" required class="form-control"
                                   value="{{$user_record->last_name}}">
                        </div>

                        <div class="form-box">
                            <label for="">Gender</label>
                            {!!  \Form::select('gender', ["1"=>"Male", "2" =>"Female"], $user_record->gender, ['class' => 'form-control' ,'id' => 'form-control'])!!}
                        </div>

                        <div class="form-box">
                            <input type="submit"  class="btn btn-primary" name="submit" value="Save">
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
