@extends('Admin::layout.store-admin')
@section('content')
        <!-- Post Div-->
@include('Admin::layout.arbitrator-leftnav')
@include('Admin::alert.alert')
<div class="ad_main_wrapper" id="ad_main_wrapper">
    <div class="task_inner_wrapper">
        <div class="main_heading">
            <h1>Create User</h1>
        </div>
        <div style="text-align: center;">

        </div>
        @include('includes.alerts')
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['url' => 'admin/contact/save-user']) !!}
                {!! Form::hidden('contact_id',$id) !!}
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    {!! Form::text('first_name', NULL,['placeholder'=>"first-name", 'id'=>"first-name", 'class'=>"form-control",'required']) !!}
                </div>

                <div class="form-group">
                    <label for="last-name">Last Name</label>

                    {!! Form::text('last_name',NULL,['placeholder'=>"last-name",'id'=>"last-name",'class'=>"form-control",'required']) !!}

                </div>

                <div class="form-group">
                    <label for="email">Email address</label>

                    {!! Form::email('email',NULL,['placeholder'=>"Email Address",'id'=>"email",'class'=>"form-control",'required']) !!}
                </div>

                <div class="form-group">
                    <label for="address">Street address</label>

                    {!! Form::text('address',NULL,['placeholder'=>"Street Address",'id'=>"address",'class'=>"form-control",'required']) !!}

                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>

                    {!! Form::text('phone',Null,['placeholder'=>"Phone",'id'=>"phone",'class'=>"form-control",'required']) !!}

                </div>

                <div class="form-group">
                    <label for="city">City</label>

                    {!! Form::text('city',Null,['placeholder'=>"City",'id'=>"city",'class'=>"form-control",'required']) !!}

                </div>


                <div class="form-group">
                    <label for="post_code">Postal Code/ ZIP Code</label>

                    {!! Form::text('post_code',NULL,['placeholder'=>"Postal Code/ ZIP Code",'id'=>"post_code",'class'=>"form-control",'required']) !!}

                </div>
                <?php
                $countries = getCountries();
                ?>


                <div class="form-group">
                    <label for="package">Country:</label>
                    {!! Form::select('country', $countries, NULL, ['class'=>'form-control','required', 'placeholder'=> 'Select Country']) !!}
                </div>
                <div class="form-group">
                    <label for="state">State / Province</label>

                    {!! Form::text('state',Null,['placeholder'=>"State / Province",'id'=>"state",'class'=>"form-control",'required']) !!}


                </div>

                <p>Gender:</p>
                <label for="gender">Male

                    {!! Form::radio('gender','1',['class' =>"form-control"]) !!}
                </label>

                <label for="gender">Female
                    {!! Form::radio('gender','2',['class' =>"form-control"]) !!}
                </label>

            </div>

            <button type="submit" class="btn btn-default">Submit</button>
            {!! Form::close() !!}
        </div>

    </div>
</div>

@endsection

@section('footer-scripts')
    <script>

    </script>
@endsection
