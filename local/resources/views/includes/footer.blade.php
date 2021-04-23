<!-- Footer Html-->
<div class="tags-wrapper">
	<div class="container nopadding">
		<div class="col-md-12">
    	<div class="row">
        	<div class="col-md-4">
            	<div class="inst-box">
                	<div class="title">great value</div>
                    <p>We offer competitive prices on our 100 million plus product range.</p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="inst-box">
                	<div class="title">worldwide delivery</div>
                    <p>With sites in 5 languages, we ship to over 200 countries & regions.</p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="inst-box">
                	<div class="title">24/7 support</div>
                    <p>Round-the-clock assistance for a smooth shopping experience.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="subscribe-wrapper">
	<div class="container nopadding">
		<div class="col-md-12">
    	<div class="row">
        	<div class="sub-box">
            	<div class="col-md-12 nopadding">
                	<div class="col-md-2 col-md-offset-4">
                    	<div class="sub-title">SUBSCRIPTION</div>
                    </div>
                    <div class="col-md-6">
                    	<div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter your email address">
                            <span class="input-group-btn">
                            	<button class="btn btn-default" type="button">signup</button></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="carti-footer">
	<div class="container">
    	<div class="row">
            <div class="col-md-12">
                <div class="row">
                	<div class="col-md-3 col-sm-4 col-xs-12">
                        <ul class="unstyled">
                            <li class="title">ABout cartimatic</li>
                            <li>
                            	<p>Nisl. Dolor mus. Commodo felis eget risus. Dis ullamcorper. Cras commodo aliquet molestie sodales dolor orci tortorvitae venenatis At dapibus ut. </p>
                               <div class="application">
                               		<a href="#" class="app-store"></a>
                                    <a href="#" class="google-store"></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6 col-md-offset-1">
                        <ul class="unstyled">
                            <li class="title">How to buy</li>
                            <li><a href="{{url('help/create-an-account')}}">Create an Account</a></li>
                            <li><a href="{{url('help/making-payments')}}">Making Payments</a></li>
                            <li><a href="{{url('help/delivery-options')}}">Delivery Options</a></li>
                            <li><a href="{{url('help/buyer-protection')}}">Buyer Protection</a></li>
                            <li><a href="{{url('help/new-user-guide')}}">New User Guide</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-6">
                        <ul class="unstyled">
                            <li class="title">Customer Service</li>
                            <li><a href="{{url('wishlist')}}">My Wishlist</a></li>
                            <li><a href="<?php if(Auth::check()){ if(Auth::user()->user_type == 2){echo url('store/'.Auth::user()->username.'admin/orders');}else{ echo url('my-orders'); } }else{ echo url('login');}?>">My Order</a></li>
                            <li><a href="<?php if(Auth::check()){ if(Auth::user()->user_type == 2){echo url('store/'.Auth::user()->username.'admin/orders');}else{ echo url('my-orders'); } }else{ echo url('login');}?>">Orders And Returns</a></li>
                            <li><a href="{{url('contact-us')}}">Contacts</a></li>
                            <li><a href="{{url('site-map')}}">Site Map</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-2 col-xs-6 col-md-offset-1">
                        <ul class="unstyled"><li class="title">Partner Promotion</li>
                            <li><a href="{{url('partnership')}}">Partnerships</a></li>
                            <li><a href="{{url('affiliate-program')}}">Affiliate Program</a></li>
                        </ul>
                        
                        <ul class="unstyled mt20">
                        	<li class="title">Payment Method</li>
                            <li>
                            	<div class="payment-methods"></div>
                            </li>
                        </ul>
                    </div
                </div>
            </div>
    	</div>
    </div>
    </div>
</div>
<div class="copyright">
    	<div class="container">
          	<p class="muted">© 2016 Blue Orca Studios. All rights reserved</p>
        </div>
    </div>