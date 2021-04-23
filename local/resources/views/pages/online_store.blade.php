@extends('layouts.dashboard')

@section('content')

<div class="online-store">
<!-- Cartimatic Header html-->
<div class="top-bg">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>Online store</h2>
            <p>It's never been easier to won and operate a beautiful, full-featured online store</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Enter your email address" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Get Started</span>
            </div>
            <div class="free-trail">Get your store online in just a few minutes</div>
        </div>
    </div>
</div>

<div class="container nopadding">
	<div class="pos-img-wrapper">
    	<img src="{!! asset('local/public/assets/bootstrap/images/theme-template.png') !!}" />
   	</div>
	<div class="feature-text-wrapper">
    	<h2>Your ecommerce website.</h2>
        <p>Impress your customers with a beautiful and secure online store</p>
		<span class="sep-line"></span>
    </div>
    <div class="sub-navigaion">
    	<a href="#." class="active">store front</a>
        <a href="#.">products</a>
        <a href="#.">checkout</a>
   	</div>
    <div class="stay-wrapper blank-box">
        <div class="container nopadding">
            <div class="col-md-7 nopadding">
                <div class="f-img">
                    <img src="http://localhost/shalmi/local/public/assets/bootstrap/images/template-front-tab.png" class="img-responsive">
                </div>
            </div>
            <div class="col-md-5 nopadding">
                <div class="stay-on-top">
                    <h2>A home for your brand</h2>
                    <h4>Customize your store</h4>
                    <p>You have complete control over the look and feel of your website, from its domain name to its layout, colors and content.</p>
                    <h4>No design skills needed</h4>
                    <p>Choose from over 100 professional store templates, or build your own design using HTML and CSS.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="stay-wrapper">
        <div class="container nopadding">
            <div class="col-md-7 nopadding">
                <div class="f-img">
                    <img src="http://localhost/shalmi/local/public/assets/bootstrap/images/theme-options.png">
                </div>
            </div>
            <div class="col-md-5 nopadding">
                <div class="stay-on-top">
                    <h2>Your mission control</h2>
                    <p>Selling your products in many places should be every bit as simple as selling in one. With Shopify’s ecommerce software, you get one unified platform to run your business with ease. </p>
                    <ul>
                        <li>Fully customize your online store </li>
                        <li>Add new sales channels in seconds</li>
                        <li>Manage unlimited products and inventory</li>
                        <li>Fulfill orders in a single step</li>
                    </ul>
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
        	<div class="icon web-builder"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon bandwidth"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon cards"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon seo"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon color-options"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon featured-products"></div>
            <div class="f-head">Unlimited products</div>
            <p class="f-text">Lorem ipsum dolor sit amet, consecteturing theadipiscing elit. Pellentesque nec metusesvel ligula placerat pellentesque.</p>
        </div>
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
                        	<a href="#" class="active"><img src="http://localhost/shalmi/local/public/assets/bootstrap/images/apple_416x416.jpg" width="50" height="50"></a>
                            <a href="#"><img src="http://localhost/shalmi/local/public/assets/bootstrap/images/apple_416x416.jpg" width="50" height="50"></a>
                            <a href="#"><img src="http://localhost/shalmi/local/public/assets/bootstrap/images/apple_416x416.jpg" width="50" height="50"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</div>

<div class="b-email">
	<div class="container nopadding">
    	<div class="feature-text-wrapper">
            <h2>Start building your online store</h2>
            <p>Easily manage and grow your business with Cartimatic, no matter how complex your operations are.</p>
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
<div class="clrfix"></div>
</div>
@endsection
