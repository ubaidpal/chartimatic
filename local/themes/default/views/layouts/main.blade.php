<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>{{ucfirst(get_theme_option($theme_id,'website_title','Website title'))}}</title>
	<link href="{{getAssetPath()}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{getAssetPath()}}/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{getAssetPath()}}/css/prettyPhoto.css" rel="stylesheet">
	<link href="{{getAssetPath()}}/css/price-range.css" rel="stylesheet">
	<link href="{{getAssetPath()}}/css/animate.css" rel="stylesheet">
	<link href="{{url('main.css')}}" rel="stylesheet">
	@yield('styles')
	<link href="{{getAssetPath()}}/css/responsive.css" rel="stylesheet">
	<script src="{{getAssetPath()}}/js/jquery.js"></script>
	<!--[if lt IE 9]>
	<script src="{{getAssetPath()}}/js/html5shiv.js"></script>
	<script src="{{getAssetPath()}}/js/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="<?php get_theme_option($theme_id,'favicon',getAssetPath().'/images/ico/favicon.ico')?>">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{getAssetPath()}}/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{getAssetPath()}}/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{getAssetPath()}}/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="{{getAssetPath()}}/images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>

	<header id="header">
		<!--header-->
		<div class="header_top">
			<!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<?php $phone_number = get_theme_option($theme_id,'phone-number','Phone number',true); ?>

								<li><a href="#"><i class="fa fa-phone"></i>{{$phone_number}}&nbsp;</a></li>

								<?php $email_address = get_theme_option($theme_id,'email-address','Email Adress',true); ?>

								<li><a href="#"><i class="fa fa-envelope"></i>&nbsp;{{$email_address}}</a></li>

							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<?php
								$array = [
										'social-media-facebook' => 'fa-facebook',
										'social-media-twitter' => 'fa-twitter',
										'social-media-linkedin' => 'fa-linkedin',
										'social-media-dribble' => 'fa-dribbble',
										'social-media-google-plus' => 'fa-google-plus'
								];
								?>
								@foreach($array as $key => $class)
									<?php $social_media = get_theme_option($theme_id,(STRING)$key,'',true); ?>

									<li><a target="_blank" href="{{$social_media}}"><i class="fa {{$class}}"></i></a></li>

								@endforeach

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header_top-->

		<div class="header-middle">
			<!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{url('/')}}">
								<img width="<?php get_theme_option($theme_id,'header-logo-width','150') ?>" src="<?php get_theme_option($theme_id,'header-logo',getAssetPath().'/images/home/logo-placeholder.jpg') ?>" alt="" />
							</a>
						</div>

					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php $totalProducts = countCartProducts() ?>
								<li><a href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i> Cart <span id="the_cart">@if($totalProducts > 0) {{$totalProducts}} @endif</span></a></li>
								@if(Auth::check())
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Account</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
										@if(Auth::user()->user_type == \Config::get("constants.BRAND_USER"))
											<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('/store/'.Auth::user()->username
.'/admin/orders')}}">Store Dashboard</a></li>
											<li role="presentation"><a role="menuitem" tabindex="1" href="{{url('settings/change-password')}}">Change Password</a></li>
										@else
											<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('my-profile')}}">My Profile</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="{{url('messages')}}">Messages</a></li>
											<li role="presentation"><a role="menuitem" tabindex="1" href="{{url('my-orders')}}">My Orders</a></li>
											<li role="presentation"><a role="menuitem" tabindex="2" href="{{url('wishlist')}}">My Wish List</a></li>
											<li role="presentation"><a role="menuitem" tabindex="3" href="{{url('settings/change-password')}}">Change Password</a></li>
										@endif
										<li role="presentation"><a role="menuitem" tabindex="4" href="{{url('logout')}}">Signout</a></li>
									</ul>
								</li>
									@if(Auth::user()->user_type == 1)
									<?php $counterWishList = wishListCounter(); ?>
								<li><a href="{{url('wishlist')}}"><i class="fa fa-star"></i> Wishlist ({{$counterWishList}})</a></li>
									@endif
								@endif
								@if(!Auth::check())
								<li><a href="#"  data-toggle="modal" data-target="#myModalSignin"><i class="fa fa-lock"></i> Login</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/header-middle-->

		<div class="header-bottom">
			<!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{url('/')}}" class="active">Home</a></li>
								<?php $menus = get_theme_menu($theme_id); ?>

								@if(!empty($menus) && !$menus->isEmpty())
								@foreach($menus as $menu)
								<?php $type = get_menu_type($theme_id,$store_id,$menu->id,'menu-type'); ?>
								@if(@$type->value == 'category')
								<li class="dropdown"><a href="#">{{$menu->value}}<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<?php $menu_items = get_theme_menu_items($theme_id,$store_id,$menu->id,'category-id') ?>
										@if(!empty($menu_items))
											@foreach($menu_items as $menu_item)
											<?php $category = getCategory($menu_item->value); ?>
											<li><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
											@endforeach
										@endif
									</ul>
								</li>
								@elseif(@$type->value == 'page')
								<?php $menu_items = get_theme_menu_items($theme_id,$store_id,$menu->id,'page-id'); ?>
								@if(!empty($menu_items))
								@foreach($menu_items as $menu_item)
                                    @if($menu_item->value == -1)
                                <li>
                                    <a href="{{url('contact-us')}}">Contact Us</a>
                                </li>
                                    @else
								<li>
									<?php $the_page = getPage($menu_item->value); ?>

									<a href="{{url('pages/'.$the_page->id)}}">{{$menu->value}}</a>
								</li>
                                    @endif
								@endforeach
								@endif
								@endif
								@endforeach
								@else
								<li class="dropdown"><a href="#">Drop Down Menu<i class="fa fa-angle-down"></i></a>
									<ul role="menu" class="sub-menu">
										<li><a href="#">Item 1</a></li>
										<li><a href="#">Item 2</a></li>
										<li><a href="#">Item 3</a></li>
										<li><a href="#">Item 4</a></li>
									</ul>
								</li>
								<li><a href="#">Page Link</a></li>
								@endif
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						{!! Form::open(['url' => url("search-products"), "id" => "search_form"]) !!}
						<input type="hidden" name="search_param" value="all" id="search_param">
						<div class="search_box pull-right">
							<span>
								<input type="text" autocomplete="off" class="form-control filter_product" name="search" id="filter_product" placeholder="Search"/>
								<div id="suggesstion-box" style="display:none"></div>
								<div id="hot-search" class="hot-search" style="display:none"></div>
							</span>
						</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
		<!--/header-bottom-->

		<!--start of sigin modal-->
		<div class="modal fade" id="myModalSignin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="signup-wrapper w-650" role="document">
				<div class="modal-content">
					<div class="modal-body clearfix">
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
					<div class="modal-body clearfix">
						<div class="col-md-12 ">

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
										<input type="hidden" name="user_type" id="user_type" value="1">
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
											<input type="text" placeholder="" title="Please enter your First Name" required="" value="" name="first_name" id="first_name" class="form-control">
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

	</header>
	<div class="container">
	@yield('content')
	</div>
	<div class="clearfix"></div>
	@include('includes.theme-footer')
	<script src="{{getAssetPath()}}/js/bootstrap.min.js"></script>
	<script src="{{getAssetPath()}}/js/jquery.scrollUp.min.js"></script>
	<script src="{{getAssetPath()}}/js/price-range.js"></script>
	<script src="{{getAssetPath()}}/js/jquery.prettyPhoto.js"></script>
	<script src="{{getAssetPath()}}/js/main.js"></script>
	<script src="{{getAssetPath()}}/js/smartWizard.js"></script>
	@yield('footer-scripts');
	<script type="text/javascript">
		$('.filter_product').keyup(function(evt){
			evt.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});//for token purpose in laravel

			var searchRecord = $('#filter_product').val();
			var categories =  $('#categories').val();
			var inParentCategory = '';

			//var data = "searchRecord:"+searchRecord+ "categories:"+categories;

			jQuery.ajax({
				url: '{{ url("filter/products") }}',
				type: "Post",
				data: {searchRecord: searchRecord, categories: categories},
				success: function (data) {
					var maArrayData = jQuery.parseJSON(data);

					var maArray  = maArrayData.searchedProducts;
					var catInfo  = maArrayData.catInfo;
					if(data !=0 ) {
						var html = '<ul>';
						$.each(maArray, function (key, val) {

							var search_result = '';
							if(typeof val.count != 'undefined'){
								search_result = '<span id="search_results">'+val.count+'</span>';
							}

							if(typeof(catInfo[val.category_id]) != "undefined" && catInfo[val.category_id] !== null) {
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
										+ substringTitle + " <span style='color:#FE980F ; font-size: 12px ; font-weight:bold ;'>" + inParentCategory;
								html += '</span><span style="margin-left:10px;">Totals items  ' + search_result + '</span>';
								html += '</a>' +
										'</li>';
								inParentCategory = '';
							}
						});

					}
					html += '</ul>';

					if(data !=0 ){
						$("#suggesstion-box").show();
						$("#hot-search").hide();
						$("#suggesstion-box").html(html);
						return false;
					}else{
						$("#suggesstion-box").show();
						$("#hot-search").hide();
						$("#suggesstion-box").html('<ul><li class="no-suggestion">No Suggestion</li></ul>');
					}
				}});
		});
	</script>

	<script type="text/javascript">
		$('#wizard_verticle').smartWizard();
		function validDataStep1(errorCheckType){
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
				}
			});//for token purpose in laravel

			var email                   = $('#email').val();
			var user_type               = $('#user_type').val();
			var password                = $('#password').val();
			var password_confirmation   = $('#password_confirmation').val();
			if(user_type == 2){
				var store_name = $('input[name="store_name"]').val();
			}

			$('.actionBar').find('.buttonDisabled').hide();

			$("#confirm-password-help").html('Please wait..');
			var dataString = 'email='+email+'&user_type='+user_type+'&password='+password+'&password_confirmation='+password_confirmation;
			if (user_type == 2){
				dataString += '&store_name='+store_name;
			}
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

					email    = response.email;
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

					if(response == ''){
						$('.actionBar').find('.btn-success').show();
					}
				}
			});
		}


		$(document).on("blur", "#email", function(){
			validDataStep1('email');
		});

		$(document).on("blur", "#username", function(){
			validDataStep1('username');
		});

		$(document).on("blur", "#password", function(){
			validDataStep1('password');
		});

		$(document).on("blur", "#password_confirmation", function(){
			validDataStep1('password');
		});

		$(document).on("blur", "#store_name", function(){
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
				$('.actionBar').find('.btn-success').hide();
			}else{
				$("#first_name-help").html('');
				$('.actionBar').find('.btn-success').show();
			}

			if(last_name == ''){
				$("#last_name-help").html('Please enter Last Name.');
			}else{
				$("#last_name-help").html('');
				$('.actionBar').find('.btn-success').show();
			}
		}
		$(document).on("click", ".sm",  function (e)
		{
			var suggesstion = $("#suggesstion-box");
			var hotSearch = $(".hot-search");

			if (!suggesstion.is(e.target ) // if the target of the click isn't the container...
					&& suggesstion.has(e.target).length === 0 || !hotSearch.is(e.target ) // if the target of the click isn't the container..
					&& hotSearch.has(e.target).length === 0)
			{
				suggesstion.hide();
				hotSearch.hide();
			}
		});


		function showHideFinishBtnNextBtn(){
			var step1IsDone = $(".step_no_1").attr("isDone");
			var step2IsDone = $(".step_no_2").attr("isDone");
			var step3IsDone = $(".step_no_3").attr("isDone");

			if(step1IsDone == 1 && step2IsDone == 1 && step3IsDone == 1){
				$('.actionBar').find('.btn-success').hide();
				$('.actionBar').find('.btn-default').show();
			}
		}

		window.setInterval(function(){showHideFinishBtnNextBtn()}, 500);

		$('.filter_product').keyup(function(evt){
			evt.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});//for token purpose in laravel

			var searchRecord = $('#filter_product').val();
			var categories =  $('#categories').val();
			var inParentCategory = '';

			//var data = "searchRecord:"+searchRecord+ "categories:"+categories;

			jQuery.ajax({
				url: '{{ url("filter/products") }}',
				type: "Post",
				data: {searchRecord: searchRecord, categories: categories},
				success: function (data) {
					var maArrayData = jQuery.parseJSON(data);

					var maArray  = maArrayData.searchedProducts;
					var catInfo  = maArrayData.catInfo;
					if(data !=0 ) {
						var html = '<ul>';
						$.each(maArray, function (key, val) {

							var search_result = '';
							if(typeof val.count != 'undefined'){
								search_result = '<span id="search_results">'+val.count+'</span>';
							}

							if(typeof(catInfo[val.category_id]) != "undefined" && catInfo[val.category_id] !== null) {
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
										+ substringTitle + " <span style='color:#FE980F ; font-size: 12px ; font-weight:bold ;'>" + inParentCategory;
								html += '</span><span style="margin-left:10px;">Totals items  ' + search_result + '</span>';
								html += '</a>' +
										'</li>';
								inParentCategory = '';
							}
						});

					}
					html += '</ul>';

					if(data !=0 ){
						$("#suggesstion-box").show();
						$("#hot-search").hide();
						$("#suggesstion-box").html(html);
						return false;
					}else{
						$("#suggesstion-box").show();
						$("#hot-search").hide();
						$("#suggesstion-box").html('<ul><li class="no-suggestion">No Suggestion</li></ul>');
					}
				}});
		});

		/* $('.filter_product').click(function(evt){
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
		 });*/

		$(".cart-wrapper").click(function(e){
			window.location.href= '{{url('store/cart')}}';
		});

		$(".btn-register").click(function(){
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

			if(lengthOfItems > 9){
				widthToBeSet = 189;
			}

			if(lengthOfItems > 18){
				widthToBeSet = 284;
			}

			$(subMenuItems[i]).css('width', widthToBeSet+"%");
		});
		jQuery(document).on('change','#user_type',function (e) {
			var user_type = $(this).val();
			if(user_type == 2){
				$('.store-name-container').removeClass('hide').find('input').attr('disabled',false);
			}else {
				$('.store-name-container').addClass('hide').find('input').attr('disabled',true);
			}
		});
	</script>
</body>
</html>