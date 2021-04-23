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
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">store front</a></li>
            <li><a data-toggle="tab" href="#menu1">products</a></li>
            <li><a data-toggle="tab" href="#menu2">checkout</a></li>
        </ul>
        
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
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
                                <p>Experience total control of your website on your fingertips, including the domain name, colors, content layout and much more.</p>
                                <h4>No design skills needed</h4>
                                <p>Avail the facility of choosing out of hundreds of professional looking templates to give your website the perfect look that is most representative of your business. The best part is that you don’t any design skills to get this done.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
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
                            <h4>Showcase your products</h4>
                            <p>To make it easier for you customer to browse through your products, you can categorize and display them in an online catalog.</p>
                            <h4>Sell one product or millions</h4>
                            <p>Cartimatic allows you to sell an unlimited number of products whether you have a single store or a big brand name.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div id="menu2" class="tab-pane fade">
              <div class="stay-wrapper blank-box">
                <div class="container nopadding">
                    <div class="col-md-7 nopadding">
                        <div class="f-img">
                            <img src="http://localhost/shalmi/local/public/assets/bootstrap/images/template-front-tab.png" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-5 nopadding">
                        <div class="stay-on-top">
                            <h2>Accept payment instantly</h2>
                            <h4>Your data is safe and secure</h4>
                            <p>Cartimatic deploys the same level of security to safeguard pages, content, credit card and transaction information as used by banks.</p>
                        </div>
                    </div>
                </div>
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
        	<div class="icon customiseyouronlinestore"></div>
            <div class="f-head">Customize your online store</div>
            <p class="f-text">Customize your online store by selecting and applying colors, banner, and images of your choice.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon webbuilder"></div>
            <div class="f-head">Website builder</div>
            <p class="f-text">Choose from 3 of our themes to build your own website with a purpose that serves you the best.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon inventorymange"></div>
            <div class="f-head">Inventory management</div>
            <p class="f-text">Maintain your inventory with Cartimatic. Track quantities, and automatically stop selling products depending on availability</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon productvariation"></div>
            <div class="f-head">Product variation</div>
            <p class="f-text">Offer product variations, such as sizes, colors, materials, and more. Couple each variation with its own price, weight and inventory status.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon color-options"></div>
            <div class="f-head">Unlimited bandwidth</div>
            <p class="f-text">Enjoy unlimited bandwidth and upload unlimited products to ensure complete showcase of your service without the fear of paying extra or crashing.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon analytics"></div>
            <div class="f-head">Analytics</div>
            <p class="f-text">Stay updated about your business progression and sales analytics throughout the year, every day.</p>
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
