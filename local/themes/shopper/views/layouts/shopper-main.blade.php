<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>{{ucfirst(get_theme_option($theme_id,'website_title','Shopper'))}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
	<!-- bootstrap -->
	<link href="{{getAssetPath($theme)}}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{getAssetPath($theme)}}/css/bootstrap-responsive.min.css" rel="stylesheet">

	<link href="{{getAssetPath($theme)}}/css/bootstrappage.css" rel="stylesheet"/>
	<link rel="shortcut icon" href="<?php get_theme_option($theme_id,'favicon',null)?>">
	<!-- global styles -->
	<link href="{{getAssetPath($theme)}}/css/flexslider.css" rel="stylesheet"/>
	<link href="{{url('main.css')}}" rel="stylesheet"/>

	<!-- scripts -->
	<script src="{{getAssetPath($theme)}}/js/jquery-1.7.2.min.js"></script>
	<script src="{{getAssetPath($theme)}}/js/bootstrap.min.js"></script>
	<script src="{{getAssetPath($theme)}}/js/superfish.js"></script>
	<script src="{{getAssetPath($theme)}}/js/jquery.scrolltotop.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<script src="{{getAssetPath($theme)}}/js/respond.min.js"></script>
	<![endif]-->
</head>
	<body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<form method="POST" class="search_form">
						<input type="text" class="input-block-level search-query" Placeholder="eg. T-sirt">
					</form>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							@if(Auth::check())
							<li class="dropdown-submenu">
								<a href="#">My Account</a>
								@if(Auth::user()->user_type == \Config::get("constants.BRAND_USER"))
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
								@endif
							</li>
							@endif
							<li>
								<a href="{{url('cart')}}">Your Cart</a>
								<?php $totalProducts = countCartProducts() ?>
								<span id="the_cart">@if($totalProducts > 0) {{$totalProducts}} @endif</span>
							</li>
							<li><a href="#">Checkout</a></li>
							@if(!Auth::check())
							<li><a href="{{url('/store/login')}}">Login</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div id="wrapper" class="container">
		@include('includes.shopper-nav')
		@yield('content')
		<div class="clearfix"></div>
		@include('includes.shopper-footer')
		</div>
	</body>
	<script src="{{getAssetPath($theme)}}/js/common.js"></script>
	@yield('footer-scripts')
</html>