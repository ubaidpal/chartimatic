<!-- Cartimatic Header html-->
<div class="header-wrapper">
	<div class="container sm">
    	<div class="row">
        	<div class="col-md-3">
            	<div class="row">
                    <div class="logo-box">
                        <a href="{{url('/')}}" title="Cartimatic"><h1>Cartimatic</h1>
                        <h4>Smarter Shopping. better living.</h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            	<div class="row">
              		<nav class="navbar navbar-default">
                  		<div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                      </div>
                  		<div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#">New Arivals</a></li>
                      <li><a href="#">top sellers</a></li>
                      <li><a href="#">deals</a></li>
                      <li><a href="#">Clearance</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">more <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pakistan <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USD <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li class="dropdown-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div><!--/.nav-collapse -->
              		</nav>
                    <div class="col-md-8">
                    	<div class="row">
                    	<div class="search-area">
                            {!! Form::open(['url' => url("search-products"), "id" => "search_form"]) !!}
                            <div class="input-group">

                                <div class="input-group-btn search-panel">

                                    <?php $categories = allCategory();?>
                                    {!!  Form::select('category_id', $categories, 0, ['class' => 'btn btn-default dropdown-toggle' ,'id' => 'categories'])!!}

                                </div>
                                <input type="hidden" name="search_param" value="all" id="search_param">
                                <span>
                                <input type="text" autocomplete="off" class="form-control searchRecord" name="search" id="searchRecord"  placeholder="I want___">
                                    <div id="suggesstion-box" style="display:none"></div>
                                    <div id="hot-search" class="hot-search" style="display:none"></div>
                                    </span>
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-search" type="submit"></button>
                                </span>

                            </div>
                            {!! Form::close() !!}
                        	</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="cart-wrapper">
                                <!-- <div class="total-amount">$1000</div>
                                 <a href="javascript:void(0)">0 items</a>-->
                                <?php $all_products = Session::get( 'cart.products' );?>
                                 <a href="#" class="items-total">{{count($all_products)}}</a>
                        </div>
                        	<div class="loign-wishlist">
                            @if(Auth::check())
                                <a href="{{url('logout')}}" title="Logout">Logout</a>
                            @else
                                <a href="javascript:void(0);" title="Login" data-toggle="modal" data-target="#myModalSignin">Login</a>
                                <!--start of sigin modal-->
                                <div class="modal fade" id="myModalSignin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="signup-wrapper" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="col-md-6 new-user">
                                                        <h1>New Customer</h1>
                                                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                                        <button class="btn btn-register" data-toggle="modal" data-target="#myModalSignUp" >register</button>
                                                    </div>
                                                    <div class="col-md-6 social-user">
                                                        <div class="omb_login">
                                                            <hr class="omb_hr">
                                                            <span class="omb_span">sign in with social media</span>
                                                        </div>

                                                        <div class="omb_socialButtons">
                                                            <div class="col-md-6">
                                                                <a href="{{url('social/facebook')}}" class="btn btn-block omb_btn-facebook">
                                                                    <i class="fa fa-facebook visible-xs"></i>
                                                                    <span class="hidden-xs">Facebook</span>
                                                                </a>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="{{url('social/google')}}" class="btn btn-block omb_btn-google">
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
                                                            <form novalidate class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}" id="loginForm">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">Username</label>
                                                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="password">Password</label>
                                                                    <input type="password" class="form-control" name="password">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                                <div class="alert alert-error hide" id="loginErrorMsg">Wrong username og password</div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" id="remember" name="remember"> Remember login
                                                                    </label>
                                                                    <a class="forgot-pass" href="{{ url('/password/email') }}">Forgot password</a>
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
                                <!--end of sigin modal-->

                                <!-- start of sign up Modal -->
                                <div class="modal fade" id="myModalSignUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="signup-wrapper w-650" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="col-md-12">

                                                    <form novalidate action="{{url('/auth/register')}}" method="POST" id="signupForm">
                                                        <?php echo Form::token(); ?>
                                                    <h1 class="mt20">Register a new account</h1>
                                                    <div class="form_wizard wizard_verticle login-container" id="wizard_verticle">
                                                        <ul class="list-unstyled wizard_steps anchor">
                                                            <li>
                                                                <a href="#step-1" class="selected" isdone="1" rel="1">
                                                                    <span class="step_no">1</span>
                                                                    <label>Get Started</label>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#step-2" class="disabled" isdone="0" rel="2">
                                                                    <span class="step_no">2</span>
                                                                    <label>Personal Information</label>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#step-3" class="disabled" isdone="0" rel="3">
                                                                    <span class="step_no">3</span>
                                                                    <label>Complete</label>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div id="step-1" class="wizard_content" style="display: block;">
                                                                <div class="form-group joinAs">
                                                                    <select class="form-control pull-right" id="user_type" name="user_type">
                                                                        <option value="1">Buyer</option>
                                                                        <option value="2">Seller</option>
                                                                    </select>
                                                                    <label class="pull-right">You want to join as a</label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="email">Email *</label>
                                                                    <input type="text" placeholder="example@gmail.com" title="Please enter you email" required="" value="" name="email" id="email" class="form-control">
                                                                    <span class="help-block" id="email-help"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="password">Password</label>
                                                                    <button type="button" class="tp" data-toggle="tooltip" data-placement="left" title="Use 6 to 64 characters.

Besides letters, include at least a number or symbol (!@#$%^*-_+=).

Password is case sensitive.

Avoid using the same password for multiple sites." aria-describedby="tooltip">?</button>
                                                                    <input type="password" title="Please enter your password" required="" value="" name="password" id="password" class="form-control">
                                                                    <span class="help-block" id="password-help"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="password">Password (again) *</label>
                                                                    <input type="password" title="Please enter your password" required="" value="" name="password_confirmation" id="password_confirmation" class="form-control">
                                                                    <span class="help-block" id="confirm-password-help"></span>
                                                                </div>

                                                        </div>

                                                        <div id="step-2" class="wizard_content" style="display: none;">
                                                                <div class="form-group">
                                                                    <label class="control-label" for="username">First name *</label>
                                                                    <input type="text" placeholder="" title="Please enter you First Name" required="" value="" name="first_name" id="first_name" class="form-control">
                                                                    <span class="help-block" id="first_name-help"></span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="password">Last Name *</label>
                                                                    <input type="text" title="Please enter your Last Name" required="" value="" name="last_name" id="last_name" class="form-control">
                                                                    <span class="help-block" id="last_name-help"></span>
                                                                </div>
                                                                <div class="form-group gender">
                                                                    <label class="control-label" for="password">Gender *</label>
                                                                    <select class="form-control" id="gender" name="gender">
                                                                        <option value="1">Male</option>
                                                                        <option value="2">Female</option>
                                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div id="step-3" class="wizard_content" style="display: none;">
                                                            <p>Welcome to online marketplace! For security reasons, please verify your email to complete your registration</p>
                                                        </div>
                                                        <div class="clrfix"></div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end of sign up Modal -->
                            @endif
                            <?php $counterWishList = wishListCounter(); ?>

                                <a href="{{url('wishlist')}}">Wish list({{$counterWishList}})</a>
                            </div>

                    	<!--<div class="cart-wrapper">
                            <div class="total-amount">$1000</div>
                            <a href="javascript:void(0)">0 items</a>
                        </div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footer-scripts')
<script>
    function validDataStep1(errorCheckType){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        });//for token purpose in laravel

        var email                   = $('#email').val();
        var user_type                   = $('#user_type').val();
        var password                = $('#password').val();
        var password_confirmation   = $('#password_confirmation').val();

        $("#confirm-password-help").html('Please wait..');
        var dataString = 'email='+email+'&user_type='+user_type+'&password='+password+'&password_confirmation='+password_confirmation;
        $.ajax({
            type: 'POST',
            url: "<?php echo url('auth/stepOne'); ?>",
            data: dataString,
            success: function (response) {
                var email = password = password_confirmation = '';

                $("#email-help").html('');
                $("#password-help").html('');
                $("#confirm-password-help").html('');

                email    = response.email;
                password = response.password;
                password_confirmation = response.password_confirmation;

                if(errorCheckType == 'email') {
                    $("#email-help").html(email);
                }

                if(errorCheckType == 'password'){
                    $("#password-help").html(password);
                    $("#confirm-password-help").html(password_confirmation);
                }

            }
        });
    }

    $(document).on("blur", "#username", function(){
        validDataStep1('email');
    });

    $(document).on("blur", "#password", function(){
        validDataStep1('password');
    });

    $(document).on("blur", "#password_confirmation", function(){
        validDataStep1('password');
    });

    $(document).on("blur", "#first_name", function(){
        validDataStep2();
    });

    $(document).on("blur", "#last_name", function(){
        validDataStep2();
    });

    function validDataStep2(){
        var first_name               = $('#first_name').val();
        var last_name                = $('#last_name').val();

        if(first_name == ''){
            $("#first_name-help").html('Please enter First Name.');
        }else{
            $("#first_name-help").html('');
        }

        if(last_name == ''){
            $("#last_name-help").html('Please enter Last Name.');
        }else{
            $("#last_name-help").html('');
        }
    }

    $('.searchRecord').keyup(function(evt){
        evt.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//for token purpose in laravel

        var searchRecord = $('#searchRecord').val();
        var categories =  $('#categories').val();
        //var data = "searchRecord:"+searchRecord+ "categories:"+categories;
        jQuery.ajax({
            url: '{{ url("search") }}',
            type: "Post",
            data: {searchRecord: searchRecord, categories: categories},
            success: function (data) {
            var maArray = jQuery.parseJSON(data);
            var html = '<ul>';
            $.each(maArray, function (key, val) {

                var search_result = '';
                if(val.count != 'undefined'){
                     search_result = '<span id="search_results">'+val.count+'</span>';
                }
                html += '<li style="suggest">' +
                        '<a  href="{{url('search-product-name')}}/' + val.category_id + '/' +val.title +'" id="">'
                        + val.title ;
                html +='<span style="float: right">Totals items  '+ search_result+'</span>';
                html += '</a>' +
                        '</li>';
            });

            html += '</ul>';

            if(data !=0 ){
            $("#suggesstion-box").show();
            $("#hot-search").hide();
            $("#suggesstion-box").html(html);
            return false;
            }else{
                $("#suggesstion-box").show();
                $("#hot-search").hide();
                $("#suggesstion-box").html('<ul><li class="">No Suggestion</li></ul>');
            }
            }});
    });

    $('.searchRecord').click(function(evt){
        evt.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//for token purpose in laravel

        $.getJSON('{{url('hot-search')}}', function (data) {
            var html = '<ul>';
			var html = '<span>Hot Search</span>';
            $.each(data, function (key, val) {

                html += '<li>' +
                        '<a href="{{url('search-product-click')}}/' + val.product_id +'" id="">'
                        + val.title ;
                html += '</a>' +
                        '</li>';
            });

            html += '</ul>';
            if(data !=0 ) {
                $("#hot-search").show();
                $("#suggesstion-box").hide();
                $("#hot-search").html(html);
                return false;
            }else{
                $("#hot-search").show();
                $("#suggesstion-box").hide();
                $("#hot-search").html('<ul><li class="">No hot search found</li><ul>');
                return false;
            }
        });
    });
</script>
@endsection
