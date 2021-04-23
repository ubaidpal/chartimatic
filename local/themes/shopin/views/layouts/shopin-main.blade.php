<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>{{ucfirst(get_theme_option($theme_id,'website_title','Shopin'))}}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->

	<link href="{{getAssetPath($theme)}}/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- Custom Theme files -->

	<!-- slider css-->
	<link href="{{getAssetPath($theme)}}/css/flexslider.css" rel="stylesheet"/>

	<!--theme-style-->
	<link href="{{getAssetPath($theme)}}/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--//theme-style-->
	<meta name="keywords" content="Shopin Responsive web template, Bootstrap Web Templates, Flat Web Templates, AndroId Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!--theme-style-->
	<link href="{{getAssetPath($theme)}}/css/style4.css" rel="stylesheet" type="text/css" media="all" />
	<!--//theme-style-->
	<script src="{{getAssetPath($theme)}}/js/jquery.min.js"></script>
	<!--- start-rate---->
	<script src="{{getAssetPath($theme)}}/js/jstarbox.js"></script>
	<link rel="stylesheet" href="{{getAssetPath($theme)}}/css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
	<script type="text/javascript">
    jQuery(function() {
      jQuery('.starbox').each(function() {
        var starbox = jQuery(this);
        starbox.starbox({
          average: starbox.attr('data-start-value'),
          changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
          ghosting: starbox.hasClass('ghosting'),
          autoUpdateAverage: starbox.hasClass('autoupdate'),
          buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
          stars: starbox.attr('data-star-count') || 5
        }).bind('starbox-value-changed', function(event, value) {
          if(starbox.hasClass('random')) {
            var val = Math.random();
            starbox.next().text(' '+val);
            return val;
          }
        })
      });
    });
	</script>
	<!---//End-rate---->
	<link href="{{getAssetPath($theme)}}/css/form.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<!--header-->
<div class="header">
	<div class="container">
		<div class="head">
			<div class=" logo">
				<a href="{{url('/')}}"><img src="{{getAssetPath($theme)}}/images/logo.png" alt=""></a>
			</div>
		</div>
	</div>
	<div class="header-top">
		<div class="container">
			<div class="col-sm-5 col-md-offset-2  header-login">
				<ul >
					@if(Auth::check())
				<li>
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">My Account
							<span class="caret"></span></button>
						<ul class="dropdown-menu">
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
					</div>
				</li>

					@else
						<li><a href="login.html">Login</a></li>
						<li><a href="register.html">Register</a></li>
					@endif

					<li><a  href="{{url('cart')}}">Checkout</a></li>
				</ul>
			</div>

			<div class="col-sm-5 header-social">
				<ul >
					<li><a href="#"><i></i></a></li>
					<li><a href="#"><i class="ic1"></i></a></li>
					<li><a href="#"><i class="ic2"></i></a></li>
					<li><a href="#"><i class="ic3"></i></a></li>
					<li><a href="#"><i class="ic4"></i></a></li>
				</ul>

			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="container">

		<div class="head-top">

			<div class="col-sm-8 col-md-offset-2 h_menu4">
				<nav class="navbar nav_bottom" role="navigation">

					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header nav_2">
						<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
						<ul class="nav navbar-nav nav_1">
							<li><a class="color" href="index.html">Home</a></li>

							<li class="dropdown mega-dropdown active">
								<a class="color1" href="#" class="dropdown-toggle" data-toggle="dropdown">Women<span class="caret"></span></a>
								<div class="dropdown-menu ">
									<div class="menu-top">
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu1</h4>
												<ul>
													<li><a href="product.html">Accessories</a></li>
													<li><a href="product.html">Bags</a></li>
													<li><a href="product.html">Caps & Hats</a></li>
													<li><a href="product.html">Hoodies & Sweatshirts</a></li>

												</ul>
											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu2</h4>
												<ul>
													<li><a href="product.html">Jackets & Coats</a></li>
													<li><a href="product.html">Jeans</a></li>
													<li><a href="product.html">Jewellery</a></li>
													<li><a href="product.html">Jumpers & Cardigans</a></li>
													<li><a href="product.html">Leather Jackets</a></li>
													<li><a href="product.html">Long Sleeve T-Shirts</a></li>
												</ul>
											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu3</h4>
												<ul>
													<li><a href="product.html">Shirts</a></li>
													<li><a href="product.html">Shoes, Boots & Trainers</a></li>
													<li><a href="product.html">Sunglasses</a></li>
													<li><a href="product.html">Sweatpants</a></li>
													<li><a href="product.html">Swimwear</a></li>
													<li><a href="product.html">Trousers & Chinos</a></li>

												</ul>

											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu4</h4>
												<ul>
													<li><a href="product.html">T-Shirts</a></li>
													<li><a href="product.html">Underwear & Socks</a></li>
													<li><a href="product.html">Vests</a></li>
													<li><a href="product.html">Jackets & Coats</a></li>
													<li><a href="product.html">Jeans</a></li>
													<li><a href="product.html">Jewellery</a></li>
												</ul>
											</div>
										</div>
										<div class="col1 col5">
											<img src="{{getAssetPath($theme)}}/images/me.png" class="img-responsive" alt="">
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</li>
							<li class="dropdown mega-dropdown active">
								<a class="color2" href="#" class="dropdown-toggle" data-toggle="dropdown">Men<span class="caret"></span></a>
								<div class="dropdown-menu mega-dropdown-menu">
									<div class="menu-top">
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu1</h4>
												<ul>
													<li><a href="product.html">Accessories</a></li>
													<li><a href="product.html">Bags</a></li>
													<li><a href="product.html">Caps & Hats</a></li>
													<li><a href="product.html">Hoodies & Sweatshirts</a></li>

												</ul>
											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu2</h4>
												<ul>
													<li><a href="product.html">Jackets & Coats</a></li>
													<li><a href="product.html">Jeans</a></li>
													<li><a href="product.html">Jewellery</a></li>
													<li><a href="product.html">Jumpers & Cardigans</a></li>
													<li><a href="product.html">Leather Jackets</a></li>
													<li><a href="product.html">Long Sleeve T-Shirts</a></li>
												</ul>
											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu3</h4>

												<ul>
													<li><a href="product.html">Shirts</a></li>
													<li><a href="product.html">Shoes, Boots & Trainers</a></li>
													<li><a href="product.html">Sunglasses</a></li>
													<li><a href="product.html">Sweatpants</a></li>
													<li><a href="product.html">Swimwear</a></li>
													<li><a href="product.html">Trousers & Chinos</a></li>

												</ul>

											</div>
										</div>
										<div class="col1">
											<div class="h_nav">
												<h4>Submenu4</h4>
												<ul>
													<li><a href="product.html">T-Shirts</a></li>
													<li><a href="product.html">Underwear & Socks</a></li>
													<li><a href="product.html">Vests</a></li>
													<li><a href="product.html">Jackets & Coats</a></li>
													<li><a href="product.html">Jeans</a></li>
													<li><a href="product.html">Jewellery</a></li>
												</ul>
											</div>
										</div>
										<div class="col1 col5">
											<img src="{{getAssetPath($theme)}}/images/me1.png" class="img-responsive" alt="">
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							</li>
							<li><a class="color3" href="product.html">Sale</a></li>
							<li><a class="color4" href="404.html">About</a></li>
							<li><a class="color5" href="typo.html">Short Codes</a></li>
							<li><a class="color6" href="contact.html">Contact</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->

				</nav>
			</div>
			<div class="col-sm-2 search-right">
				<ul class="heart">
					<li>
						<a href="wishlist.html" >
							<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
						</a></li>
					<li><a class="play-icon popup-with-zoom-anim" href="#small-dialog"><i class="glyphicon glyphicon-search"> </i></a></li>
				</ul>
				<div class="cart box_1">
					<a href="checkout.html">
						<h3> <div class="total">
								<span class="simpleCart_total"></span></div>
							<img src="{{getAssetPath($theme)}}/images/cart.png" alt=""/></h3>
					</a>
					<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>

				</div>
				<div class="clearfix"> </div>

				<!----->

				<!---pop-up-box---->
				<link href="{{getAssetPath($theme)}}/css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
				<script src="{{getAssetPath($theme)}}/js/jquery.magnific-popup.js" type="text/javascript"></script>
				<!---//pop-up-box---->
				<div id="small-dialog" class="mfp-hide">
					<div class="search-top">
						<div class="login-search">
							<input type="submit" value="">
							<input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}">
						</div>
						<p>Shopin</p>
					</div>
				</div>
				<script>
          $(document).ready(function() {
            $('.popup-with-zoom-anim').magnificPopup({
              type: 'inline',
              fixedContentPos: false,
              fixedBgPos: true,
              overflowY: 'auto',
              closeBtnInside: true,
              preloader: false,
              midClick: true,
              removalDelay: 300,
              mainClass: 'my-mfp-zoom-in'
            });

          });
				</script>
				<!----->
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--content-->
<div class="content">
	@yield("content")
</div>
<!--//content-->
@include('includes.shopin-footer')
@yield('footer-scripts')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{getAssetPath($theme)}}/js/simpleCart.min.js"> </script>
<!-- slide -->
<script src="{{getAssetPath($theme)}}/js/bootstrap.min.js"></script>
<!--light-box-files -->
<script src="{{getAssetPath($theme)}}/js/jquery.chocolat.js"></script>
<link rel="stylesheet" href="{{getAssetPath($theme)}}/css/chocolat.css" type="text/css" media="screen" charset="utf-8">
<!--light-box-files -->
<script type="text/javascript" charset="utf-8">
  $(function() {
    $('a.picture').Chocolat();
  });
</script>


</body>
</html>
