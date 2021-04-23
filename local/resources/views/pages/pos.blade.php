@extends('layouts.dashboard')

@section('content')

<!-- Cartimatic Header html-->
<div class="top-bg">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>Easily sell in store</h2>
            <p>Cartimatic’s POS system will help you grow your retail business.</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Get Started</span>
            </div>
            <div class="free-trail">Try Cartimatic free for 14 days. No risk, and no credit card required.</div>
        </div>
    </div>
</div>

<div class="container nopadding">
	<div class="pos-img-wrapper">
    	<img src="{!! asset('local/public/assets/bootstrap/images/pos-hardware.png') !!}" />
   	</div>
	<div class="feature-text-wrapper">
    	<h2>Sell more to your customers, in-store and online.</h2>
        <p>Here are some points to consider when choosing the right POS system:</p>
		<span class="sep-line"></span>
    </div>
</div>



<div class="container nopadding">
	<div class="row features-box">
    	<div class="col-md-4 f-single">
        	<div class="icon unlimited"></div>
            <div class="f-head">Staff management</div>
            <p class="f-text">With individual PINs, it's never been easier to track your staff's sales and register usage.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon payment"></div>
            <div class="f-head">Hardware integration</div>
            <p class="f-text">Support for everything you need at the checkout - barcode scanner, cash register, and receipt printer</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon e-integrate"></div>
            <div class="f-head">Accept payments</div>
            <p class="f-text">Safely and securely accept tap, chip, and swipe payments or accept cash, and gift cards.</p>
        </div>
    </div>
</div>

<div class="pos-software">
	<div class="text-wrap">
    	<h1>Run the world’s best retail with Cartimatic POS software.</h1>
        <p> Cartimatic is retail POS software, inventory management, ecommerce & customer loyalty for iPad, Mac and PC.<br/>
Easily manage & grow your business in the cloud.</p>
    </div>
</div>

<div class="container nopadding">
	<div class="feature-text-wrapper">
    	<h2>Everything you need to run your retail business.</h2>
        <p>Here are some points to consider when choosing the right POS system:</p>
		<span class="sep-line"></span>
    </div>
    <div class="sub-navigaion">
    	<a href="#." class="active">sell</a>
        <a href="#.">manage</a>
        <a href="#.">report</a>
        <a href="#.">grow</a>
   	</div>
    
    <div class="col-md-12 nopadding featured-wrapper">
    	<div class="col-md-4 nopadding">
        	<div class="featured-box point">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box ecommerce">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box soperation">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box gift">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box hardware">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box works">
            	<h4>Point of sale</h4>
                <p>Vend makes it easy to sell to your customers, whether you use our responsive web-based POS on Mac or PC, or our Cartimatic Register iPad app.</p>
            </div>
        </div>
    </div>
</div>

<div class="three-images-wrapper">
	<div class="col-md-12 nopadding">
    	<div class="row">
        	<div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-1.png') !!}" /></div>
            <div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-2.png') !!}" /></div>
            <div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-3.png') !!}" /></div>
        </div>
    	
    </div>
</div>


<div class="b-email">
	<div class="container nopadding">
    	<div class="feature-text-wrapper">
            <h2>The perfect POS software solution for multi-store retailers.</h2>
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
<div class="clrfix"></div>
@endsection
