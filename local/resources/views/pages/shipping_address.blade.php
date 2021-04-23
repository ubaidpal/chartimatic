@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Manage Orders</h1>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="col-md-3">
        	<div class="row">
            	<div class="cart-left-nav">
                	<nav>
                        <ul class="nav">
                            <li><a href="#" class="active">All Orders</a></li>
                            <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Shipping Address (toggle)</a>
                                <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                                    <li><a href="#">Link 2.1</a></li>
                                    <li><a href="#">Link 2.2</a></li>
                                    <li><a href="#">Link 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Manage Feedbacks</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Invoices</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
        	<div class="row">
                <div class="order-title-box">
                	<div class="col-md-12">Shipping Address</div>
                </div>
                
                <div class="shipping-wrapper">
                	<div class="shipping-list">
                		<div class="col-md-10">
                    	<div class="shiping-address">
                            <div class="buyer-name">John Doe</div>
                            <address>
                              <strong>Twitter, Inc.</strong><br>
                              1355 Market Street, Suite 900<br>
                              San Francisco, CA 94103<br>
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            
                            
                        </div>
                    </div>
                    	<div class="col-md-2">
                    	<div class="shiping-address pull-right">
                        	<div class="btn-group m0" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-edit mr10">Edit</button>
                              <button type="button" class="btn btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="shipping-list">
                		<div class="col-md-10">
                    	<div class="shiping-address">
                            <div class="buyer-name">John Doe</div>
                            <address>
                              <strong>Twitter, Inc.</strong><br>
                              1355 Market Street, Suite 900<br>
                              San Francisco, CA 94103<br>
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            
                            
                        </div>
                    </div>
                    	<div class="col-md-2">
                    	<div class="shiping-address pull-right">
                        	<div class="btn-group m0" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-edit mr10">Edit</button>
                              <button type="button" class="btn btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="shipping-list">
                		<div class="col-md-10">
                    	<div class="shiping-address">
                            <div class="buyer-name">John Doe</div>
                            <address>
                              <strong>Twitter, Inc.</strong><br>
                              1355 Market Street, Suite 900<br>
                              San Francisco, CA 94103<br>
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            
                            
                        </div>
                    </div>
                    	<div class="col-md-2">
                    	<div class="shiping-address pull-right">
                        	<div class="btn-group m0" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-edit mr10">Edit</button>
                              <button type="button" class="btn btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="shipping-list">
                		<div class="col-md-10">
                    	<div class="shiping-address">
                            <div class="buyer-name">John Doe</div>
                            <address>
                              <strong>Twitter, Inc.</strong><br>
                              1355 Market Street, Suite 900<br>
                              San Francisco, CA 94103<br>
                              <abbr title="Phone">P:</abbr> (123) 456-7890
                            </address>
                            
                            
                        </div>
                    </div>
                    	<div class="col-md-2">
                    	<div class="shiping-address pull-right">
                        	<div class="btn-group m0" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-edit mr10">Edit</button>
                              <button type="button" class="btn btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
</div>
@endsection
