@extends('layouts.dashboard')

@section('content')

<!-- Cartimatic Header html-->
<div class="top-bg">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>An ecommerce platform made for you</h2>
            <p>Whether you sell online, in store, or out of the trunk of your car,<br/>Cartimatic has you covered.</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Get Started</span>
            </div>
            <div class="free-trail">Try Cartimatic free for 14 days. No risk, and no credit card required.</div>
        </div>
    </div>
    
	<div class="container nopadding header-features">
        <div class="col-md-12 nopadding">
            <div class="col-md-4 nopadding">
                <div class="feature-box one">
                	<div class="f-icons"></div>
                    <div class="title">Ercu. In enim justo, rhoncus ut, imperdiet a, venen</div>
                    <p>Nullam lacinia dolor eu magna aliquet placerat. Aliquam semper</p>
                </div>
            </div>
            <div class="col-md-4 nopadding">
                <div class="feature-box two">
                	<div class="f-icons"></div>
                    <div class="title">Ercu. In enim justo, rhoncus ut, imperdiet a, venen</div>
                    <p>Nullam lacinia dolor eu magna aliquet placerat. Aliquam semper</p>
                </div>
            </div>
            <div class="col-md-4 nopadding">
            	<div class="feature-box three">
                	<div class="f-icons"></div>
                    <div class="title">Ercu. In enim justo, rhoncus ut, imperdiet a, venen</div>
                    <p>Nullam lacinia dolor eu magna aliquet placerat. Aliquam semper</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container nopadding">
	<div class="img-wrapper">
    	<img src="{!! asset('local/public/assets/bootstrap/images/laptop-mobile.png') !!}" />
   	</div>
	<div class="feature-text-wrapper">
    	<h2>We help you to Increase your Revenue</h2>
        <p>You have complete control over the look and feel of your online store and instant access to hundreds
of the best looking themes the industry has to offer. Finally, a gorgeous store of your own that reflects the personality of your business.</p>
		<span class="sep-line"></span>
    </div>
</div>

<div class="container nopadding">
	<div class="more-revenue">
    	<div class="col-md-12 nopadding">
    		<div class="col-md-6 nopadding">
            	<p>Selling your products in many places should be every bit as simple as selling in one. With Shopify, you get one unified platform to run your business with ease.</p>
                <ul>
                	<li>Fully customize your online store </li>
                    <li>Add new sales channels in seconds</li>
                    <li>Manage unlimited products and inventory</li>
                    <li>Fulfill orders in a single step</li>
                </ul>
            </div>
        	<div class="col-md-6 nopadding">
            	<div class="graph-img">
                	<img src="{!! asset('local/public/assets/bootstrap/images/graph.png') !!}" />
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container nopadding">
	<div class="feature-text-wrapper">
    	<h2>All the features you need</h2>
        <p>Cartimatic handles all the hassles of ecommerce, perfect for beginners and experts alike</p>
		<span class="sep-line"></span>
    </div>
    
    <div class="row features-box">
    	<div class="col-md-4 f-single">
        	<div class="icon unlimited"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon payment"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon e-integrate"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon secure"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon trends"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon global"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
    </div>
</div>

<div class="stay-wrapper">
	<div class="container nopadding">
        <div class="col-md-5 nopadding">
            <div class="stay-on-top">
                <h2>Stay on top of your sales</h2>
                <h4>Accept orders in seconds</h4>
                <p>Get notified by email or mobile when a new sale comes in. Fulfill one or multiple orders with just one click, making your order management a breeze.</p>
                <h4>Shipping made easy</h4>
                <p>Easily integrate shipping with every major carrier and provide your customers with tracking info for their orders.</p>
            </div>
        </div>
        <div class="col-md-7 nopadding">
            <div class="f-img">
            	<img src="{!! asset('local/public/assets/bootstrap/images/image-2.jpg') !!}" />
            </div>
        </div>
    </div>
</div>

<div class="container nopadding">
	<div class="feature-text-wrapper">
    	<h2>Ecommerce cartimatic app</h2>
        <p>Impress your customers with a beautiful and secure online store through our mobile application</p>
		<span class="sep-line"></span>
    </div>
    <div class="img-wrapper mt0">
    	<img src="{!! asset('local/public/assets/bootstrap/images/iphones.png') !!}" />
   	</div>
</div>

<div class="customer-reviews">
	<div class="container nopadding">
    	<div class="dt">
        	<div class="left">
            	<h1>What our Customers are Saying</h1>
            </div>
            <div class="right">
            	<div class="c-review">
                	<h2>They’ve helped us achieve our marketing goals about my store</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                    <div class="c-writers">
                    	<h4>Harvey Dent</h4>
                        <div class="user-images">
                        	<a href="#" class="active"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                            <a href="#"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                            <a href="#"><img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" width="50" height="50" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>

<div class="cart-powers">
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
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/asus-logo.png') !!}" />
            </div>
            <div class="col-md-2 nopadding">
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/rockport-logo.png') !!}" />
            </div>
            <div class="col-md-2 nopadding">
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/nike-logo.png') !!}" />
            </div>
            <div class="col-md-2 nopadding">
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/Virgin.png') !!}" />
            </div>
            <div class="col-md-2 nopadding">
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/cnn-hd-logo-png-sk.png') !!}" />
            </div>
            <div class="col-md-2 nopadding">
                <img src="{!! asset('local/public/assets/bootstrap/images/logos_assets/Cadburys-logo.png') !!}" />
            </div>
        </div>
    </div>
</div>
@endsection