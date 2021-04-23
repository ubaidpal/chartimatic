@extends('layouts.dashboard')

@section('content')

<!-- Cartimatic Header html-->
<div class="marketplace_bg">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>Marketplace</h2>
            <p>Sell online with us. A one-one marketplace for all.</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Search</span>
            </div>
            <div class="free-trail">Try Cartimatic free (Limited time offer). No risk, and no credit card required. </div>
        </div>
    </div>
</div>

<div class="container nopadding">
    <div class="getmore-sales">
    	<div class="col-md-6 col-sm-6 col-xs-12">
        	<h1>You should not wait any longer. Get more sales with <span>Cartimatic!</span><em class="sepline">&nbsp;</em></h1>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
        	<p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus</p>
        </div>
    </div>
</div>

<div class="marketplace-features row">
	<div class="col-md-3 col-sm-3 col-xs-12">
    	<div class="left-img">
        	<img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/left-img.png') !!}">
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
    	<div class="col-md-12 nopadding featured-wrapper mt0">
            <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                <div class="featured-box introduction">
                    <h4>Cartimatic ecommerce</h4>
                    <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                <div class="featured-box youraccount">
                    <h4>Manage Products</h4>
                    <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                <div class="featured-box migrate">
                    <h4>Payments</h4>
                    <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 nopadding">
                <div class="featured-box community">
                    <h4>Category</h4>
                    <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
    	<div class="right-img">
        	<img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/right-img.png') !!}">
        </div>
    </div>
</div>
<div class="container nopadding">
	<div class="feature-text-wrapper">
    <h2>Get straight to growing your business</h2>
    <p>When we say it’s never been easier to start a business, we mean it. Cartimatic handles 
everything from marketing and payments, to secure checkout and shipping. Now you can
focus on the things you love. </p>
    <span class="sep-line"></span>
</div>
</div>

<div class="stay-wrapper">
    <div class="container nopadding">
        <div class="col-md-5 nopadding">
            <div class="stay-on-top">
                <h2>Cartimatic Mobile App</h2>
                <h4>Accept orders in seconds</h4>
                <p>Get notified by email or mobile when a new sale comes in. Fulfill one or multiple orders with just one click, making your order management a breeze.</p>
                <h4>Shipping made easy</h4>
                <p>Easily integrate shipping with every major carrier and provide your customers with tracking info for their orders.</p>
            </div>
        </div>
        <div class="col-md-7 nopadding">
            <div class="f-img">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/app-img.png" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<div class="b-email">
	<div class="container nopadding">
    	<div class="feature-text-wrapper">
            <h2>The perfect solution for you store</h2>
            <p>Easily manage and grow your business with Vend, no matter how complex your operations are.</p>
            <span class="sep-line"></span>
        </div>
    </div>
    <div class="">
		<div class="input-group get-started">
          <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
          <span class="input-group-addon" id="">Get Started</span>
        </div>
	</div>
</div>

<div class="cart-powers brands">
	<div class="container nopadding">
    	<div class="feature-text-wrapper">
            <h2>Cartimatic powers over 50+ businesses and counting</h2>
            <p>We've helped our customers sell their products</p>
            <span class="sep-line"></span>
        </div>
    </div>
    <div class="brand-logos">
        <div class="container nopadding">
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/asus-logo.png">
            </div>
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/rockport-logo.png">
            </div>
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/nike-logo.png">
            </div>
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/Virgin.png">
            </div>
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/cnn-hd-logo-png-sk.png">
            </div>
            <div class="col-md-2 nopadding">
                <img src="http://store.example.com/shalmi/local/public/assets/bootstrap/images/logos_assets/Cadburys-logo.png">
            </div>
        </div>
    </div>
</div>

<div class="clrfix"></div>
@endsection
