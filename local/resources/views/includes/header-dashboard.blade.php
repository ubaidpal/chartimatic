<!-- Cartimatic Header html-->
<div class="header-wrap">
    <div class="container">
        <div class="col-md-12 nopadding">
            <div class="col-md-2 nopadding">
                <div class="index-logo"><a href="{{url('/')}}">Cartimatic</a></div>
            </div>
            <div class="col-md-9">
                <div class="navigation">
                    <a href="{{url('pricing')}}">Pricing</a>
                    <a href="#.">About</a>
                    <a href="{{url('help-center')}}">Help Center</a>
                    <a href="{{url('pos')}}">POS</a>
                    <a href="{{url('online-store')}}">Online Store</a>
                    <a href="#contact-pop" data-toggle="modal" data-target="#contact-request">Contact Us</a>
                </div>
            </div>
            <div class="col-md-1">
                <div class="login-btn">
                    @if(!Auth::check())
                        <a href="#." data-toggle="modal" data-target="#myModalSignin">Login</a>
                    @elseif(Auth::user()->user_type == 2)
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true">
                                Account
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="{{url('admin/dashboard')}}" style="color: #333333;">Dashboard</a></li>
                                <li><a href="{{url('logout')}}" style="color: #333333;">Sign Out</a></li>
                            </ul>
                        </div>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(!Auth::check())
    <!--start of sigin modal-->
    <div class="modal fade" id="myModalSignin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="signup-wrapper" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="col-md-6 new-user">
                            <?php /*
                            <h1>New Customer</h1>
                            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of
                                the orders you have previously made.</p>
                            <button class="btn btn-register" data-toggle="modal" data-target="#myModalSignUp">register</button> */ ?>
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
                                <form novalidate class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}"
                                      id="loginForm">
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
                                        <a href="#step-1" class="selected step_no_1" isdone="1" rel="1">
                                            <span class="step_no">1</span>
                                            <label>Get Started</label>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-2" class="disabled step_no_2" isdone="0" rel="2">
                                            <span class="step_no">2</span>
                                            <label>Personal Information</label>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-3" class="disabled step_no_3" isdone="0" rel="3">
                                            <span class="step_no">3</span>
                                            <label>Complete</label>
                                        </a>
                                    </li>
                                </ul>
                                <div id="step-1" class="wizard_content" style=" display: block;">
                                    <div class="form-group joinAs">
                                        <input type="hidden" name="user_type" value="2" id="user_type">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="email">Email *</label>
                                        <input type="text" placeholder="example@gmail.com" title="Please enter you email" required=""
                                               value="" name="email" id="email" class="form-control">
                                        <span class="help-block" id="email-help"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password">Password</label>
                                        <button type="button" class="tp" data-toggle="tooltip" data-placement="left" title="Use 6 to 64 characters.

Besides letters, include at least a number or symbol (!@#$%^*-_+=).

Password is case sensitive.

Avoid using the same password for multiple sites." aria-describedby="tooltip">?
                                        </button>
                                        <input type="password" title="Please enter your password" required="" value="" name="password"
                                               id="password" class="form-control">
                                        <span class="help-block" id="password-help"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password">Password (again) *</label>
                                        <input type="password" title="Please enter your password" required="" value=""
                                               name="password_confirmation" id="password_confirmation" class="form-control">
                                        <span class="help-block" id="confirm-password-help"></span>
                                    </div>
                                    <div class="form-group store-name-container">
                                        <label class="control-label" for="password">Store Name</label>
                                        <input type="text" title="Store name" placeholder="Store name" name="store_name" id="store_name"
                                               class="form-control">
                                        <span class="help-block" id="store_name_help"></span>
                                    </div>
                                </div>

                                <div id="step-2" class="wizard_content" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label" for="username">First name *</label>
                                        <input type="text" placeholder="" title="Please enter you First Name" required="" value=""
                                               name="first_name" id="first_name" class="form-control">
                                        <span class="help-block" id="first_name-help"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="password">Last Name *</label>
                                        <input type="text" title="Please enter your Last Name" required="" value="" name="last_name"
                                               id="last_name" class="form-control">
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
                                    <p>You are almost done click finish to send activation email, so that you can activate your account.</p>
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

@section('footer-scripts')
    <script type="text/javascript">
        $('#wizard_verticle').smartWizard({});

        jQuery(document).ready(function (e) {
            $('#signupForm').ajaxForm({
                beforeSubmit: function showRequest(formData, jqForm, options) {
                    $('.fadeMe').removeClass('hide');
                    return true;
                },
                success: function showResponse(responseText, statusText, xhr, $form) {
                    $('.fadeMe').addClass('hide');
                    if (typeof responseText == 'object') {
                        $.each(responseText, function (index, val) {
                            if (index == 'email') {
                                $('#email-help').text(val[0]);
                            } else if (index == 'password') {
                                $('#password-help').text(val[0]);
                            } else if (index == 'store_name') {
                                $('#store_name_help').text(val[0]);
                            }
                        });

                        $('#wizard_verticle').smartWizard('goToStep', 1);

                    } else {
                        $('#myModalSignUp').modal('hide');
                        $('.signup-message').html($(responseText).find('.signup-message').html());
                    }
                }
            });
        });

        function validDataStep1(errorCheckType) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            });//for token purpose in laravel

            var email = $('#email').val();
            var user_type = $('#user_type').val();
            var password = $('#password').val();
            var password_confirmation = $('#password_confirmation').val();

            var store_name = $('input[name="store_name"]').val();


            $('.actionBar').find('.buttonDisabled').hide();

            $("#confirm-password-help").html('Please wait..');
            var dataString = 'email=' + email + '&user_type=' + user_type + '&password=' + password + '&password_confirmation=' + password_confirmation + '&store_name=' + store_name;
            $.ajax({
                type: 'POST',
                url: "<?php echo url('auth/stepOne'); ?>",
                data: dataString,
                success: function (response) {
                    var email = password = password_confirmation = '';

                    $("#email-help").html('');
                    $("#password-help").html('');
                    $("#confirm-password-help").html('');
                    $('#store_name_help').html('');
                    $('#store_name_help').html(response.store_name);

                    email = response.email;
                    password = response.password;
                    password_confirmation = response.password_confirmation;

                    //if(errorCheckType == 'email') {
                    $("#email-help").html(email);
                    //}

                    //if(errorCheckType == 'password'){
                    $("#password-help").html(password);
                    $("#confirm-password-help").html(password_confirmation);
                    $('.actionBar').find('.btn-success').hide();
                    //}

                    if (response == '') {
                        $('.actionBar').find('.btn-success').show();
                    }
                }
            });
        }


        $(document).on("blur", "#email", function () {
            validDataStep1('email');
        });

        $(document).on("blur", "#username", function () {
            validDataStep1('username');
        });

        $(document).on("blur", "#password", function () {
            validDataStep1('password');
        });

        $(document).on("blur", "#password_confirmation", function () {
            validDataStep1('password');
        });

        $(document).on("blur", "#store_name", function () {
            validDataStep1('password');
        });

        $(document).on("blur", "#first_name", function () {
            validDataStep2();
        });

        $(document).on("blur", "#last_name", function () {
            validDataStep2();
        });

        function validDataStep2() {

            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();

            if (first_name == '') {
                $("#first_name-help").html('Please enter First Name.');
                $('.actionBar').find('.btn-success').hide();
            } else {
                $("#first_name-help").html('');
                $('.actionBar').find('.btn-success').show();
            }

            if (last_name == '') {
                $("#last_name-help").html('Please enter Last Name.');
            } else {
                $("#last_name-help").html('');
                $('.actionBar').find('.btn-success').show();
            }
        }
        $(document).on("click", ".sm", function (e) {
            var suggesstion = $("#suggesstion-box");
            var hotSearch = $(".hot-search");

            if (!suggesstion.is(e.target) // if the target of the click isn't the container...
                && suggesstion.has(e.target).length === 0 || !hotSearch.is(e.target) // if the target of the click isn't the container..
                && hotSearch.has(e.target).length === 0) {
                suggesstion.hide();
                hotSearch.hide();
            }
        });


        function showHideFinishBtnNextBtn() {
            var step1IsDone = $(".step_no_1").attr("isDone");
            var step2IsDone = $(".step_no_2").attr("isDone");
            var step3IsDone = $(".step_no_3").attr("isDone");

            if (step1IsDone == 1 && step2IsDone == 1 && step3IsDone == 1) {
                $('.actionBar').find('.btn-success').hide();
                $('.actionBar').find('.btn-default').show();
            }
        }

        window.setInterval(function () {
            showHideFinishBtnNextBtn()
        }, 500);

        $('.filter_product').keyup(function (evt) {
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel

            var searchRecord = $('#filter_product').val();
            var categories = $('#categories').val();
            var inParentCategory = '';

            //var data = "searchRecord:"+searchRecord+ "categories:"+categories;

            jQuery.ajax({
                url: '{{ url("filter/products") }}',
                type: "Post",
                data: {searchRecord: searchRecord, categories: categories},
                success: function (data) {
                    var maArrayData = jQuery.parseJSON(data);

                    var maArray = maArrayData.searchedProducts;
                    var catInfo = maArrayData.catInfo;
                    if (data != 0) {
                        var html = '<ul>';
                        $.each(maArray, function (key, val) {

                            var search_result = '';
                            if (typeof val.count != 'undefined') {
                                search_result = '<span id="search_results">' + val.count + '</span>';
                            }

                            if (typeof(catInfo[val.category_id]) != "undefined" && catInfo[val.category_id] !== null) {
                                var urlToGo = '{{url('category/')}}/' + catInfo[val.category_id].product_cat_slug + '?srch-term=' + searchRecord + '&cat=' + val.category_id;

                                another_cat = 0;
                                if ($.inArray(val.category_id, catInfo)) {
                                    if (categories != catInfo[val.category_id].id) {
                                        inParentCategory = "in " + catInfo[val.category_id].name;
                                        urlToGo = '{{url('category/')}}/' + catInfo[val.category_id].product_cat_slug + '?srch-term=' + searchRecord + '&cat=' + val.category_id;
                                    }
                                }
                                substringTitle = val.title;
                                if (val.title.length > 45) {
                                    substringTitle = val.title.substring(0, 45) + '...';
                                }
                                html += '<li class="suggest ' + another_cat + '">' +
                                    '<a title="' + val.title + '"  href="' + urlToGo + '">'
                                    + substringTitle + " <span style='color: #00aeef; font-size: 12px'>" + inParentCategory;
                                html += '</span><span style="float: right">Totals items  ' + search_result + '</span>';
                                html += '</a>' +
                                    '</li>';
                                inParentCategory = '';
                            }
                        });

                    }
                    html += '</ul>';

                    if (data != 0) {
                        $("#suggesstion-box").show();
                        $("#hot-search").hide();
                        $("#suggesstion-box").html(html);
                        return false;
                    } else {
                        $("#suggesstion-box").show();
                        $("#hot-search").hide();
                        $("#suggesstion-box").html('<ul><li class="no-suggestion">No Suggestion</li></ul>');
                    }
                }
            });
        });

        $(".cart-wrapper").click(function (e) {
            window.location.href = '{{url('store/cart')}}';
        });

        $(".btn-register").click(function () {
            $('.actionBar').find('.buttonDisabled').hide();
        });

        $(document).click(function (evt) {
            $("#suggesstion-box").hide();
        });

        var subMenu = $(".sub-menu");
        var subMenuItems = $(".sub-menu-box");

        subMenu.each(function (i, val) {
            var lengthOfItems = $(subMenuItems[i]).find("li").length;

            var widthToBeSet = 100;

            if (lengthOfItems > 9) {
                widthToBeSet = 189;
            }

            if (lengthOfItems > 18) {
                widthToBeSet = 284;
            }

            $(subMenuItems[i]).css('width', widthToBeSet + "%");
        });
        jQuery(document).on('change', '#user_type', function (e) {
            var user_type = $(this).val();
            if (user_type == 2) {
                $('.store-name-container').removeClass('hide').find('input').attr('disabled', false);
            } else {
                $('.store-name-container').addClass('hide').find('input').attr('disabled', true);
            }
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="contact-request" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Contact Us</h4>
                </div>

                {!! Form::open(['url' => 'send-request', 'class'=>'']) !!}
                <div class="modal-body">
                    @if (count($errors->all()) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="first-name">First Name</label>
                        <div class="col-sm-9">
                            {!! Form::text('first_name', NULL, ["placeholder"=>"Enter First Name", "class"=>"form-control", "required"]) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="last-name">Last Name</label>
                        <div class="col-sm-9">
                            {!! Form::text('last_name', NULL, ["placeholder"=>"Enter Last Name", "class"=>"form-control", "required"]) !!}
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="exampleInputEmail1">Email address</label>
                        <div class="col-sm-9">
                            {!! Form::email('email', NULL, ["placeholder"=>"Enter Email", "class"=>"form-control", "required"]) !!}
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.
                            </small>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="work-phone">Work Phone</label>
                        <div class="col-sm-9">
                            {!! Form::text('phone', NULL, ["placeholder"=>"Enter Work Phone", "class"=>"form-control", "required"]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="company">Company</label>
                        <div class="col-sm-9">
                            {!! Form::text('company', NULL, ["placeholder"=>"Enter Company", "class"=>"form-control", "required"]) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="title">Company Title</label>
                        <div class="col-sm-9">
                            {!! Form::text('company_title', NULL, ["placeholder"=>"Enter Company Title", "class"=>"form-control", "required"]) !!}
                        </div>
                    </div>
                    <?php
                    $countries = getCountries();
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="country">Country/Region</label>
                        <div class="col-sm-9">
                            {!! Form::select('country', $countries, NULL, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="title">Comments</label>
                        <div class="col-sm-9">

                            {!! Form::textarea('detail', NULL, ['class'=>'form-control','required', 'rows' => 2]) !!}
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>


    </div>
@endsection
