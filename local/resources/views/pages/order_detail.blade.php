@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Wishlist</h1>
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
                            <li><a href="#">All Orders</a></li>
                            <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Shipping Address (toggle)</a>
                                <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                                    <li><a href="#">Link 2.1</a></li>
                                    <li><a href="#">Link 2.2</a></li>
                                    <li><a href="#">Link 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Manage Feedbacks</a></li>
                            <li><a href="#" class="active">Wishlist</a></li>
                            <li><a href="#">Invoices</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
        	<div class="row">
            	<div class="od-wrapper">
                	<div class="od-inner-wrapper">
                    	<div class="od-form-box">
                        	<div class="col-md-2">
                            	<label>Order Number:</label>
                            </div>
                            <div class="col-md-10">
                            	<div class="values">
                                	64125090856047
                                </div>
                            </div>
                        </div>
                        <div class="od-form-box">
                        	<div class="col-md-2">
                            	<label>Status:</label>
                            </div>
                            <div class="col-md-10">
                            	<div class="values">
                                	Finished
                                </div>
                            </div>
                        </div>
                        <div class="od-form-box">
                        	<div class="col-md-2">
                            	<label>Reminder:</label>
                            </div>
                            <div class="col-md-10">
                            	<div class="values">
                                	You have confirmed order received. 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="heading-bar">Shipping information</div>
                    
                    <div class="od-inner-wrapper">
                    	<div class="col-md-3">
                          <div class="sp-box">
                          	<div class="title">Courier Company</div>
                            <div class="text">International Post Air Mail</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="sp-box">
                                <div class="title">Tracking Number</div>
                                <div class="text">RL046408913CN</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="sp-box">
                                <div class="title">Estimated Delivery Time</div>
                                <div class="text">15-23 Days</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<div class="sp-box">
                                <div class="title">Processing Time</div>
                                <div class="text">20 Days</div>
                            </div>
                        </div>
                        <div class="clrfix"></div>
                        <div class="shipTo">
                        	<div class="col-md-8">
                            	<div class="heading">Ship to:</div>
                                <div class="od-form-box">
                                    <div class="col-md-3">
                                        <label>Contact Name:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="values">
                                            John Doe
                                        </div>
                                    </div>
                                </div>
                        		<div class="od-form-box">
                                    <div class="col-md-3">
                                        <label>Address:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="values">
                                            23/24 Leinster Gardens, Paddington, London.
                                        </div>
                                    </div>
                                </div>
                        		<div class="od-form-box">
                                    <div class="col-md-3">
                                        <label>Zip Code:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="values">
                                            W254770
                                        </div>
                                    </div>
                                </div>
                                <div class="od-form-box">
                                    <div class="col-md-3">
                                        <label>Mobile:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="values">
                                            00447204721305
                                        </div>
                                    </div>
                                </div>
                                <div class="od-form-box">
                                    <div class="col-md-3">
                                        <label>Tel:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="values">
                                            00447204721305
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            	<div class="store-name">Store Name: Samsung</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="heading-bar">Financial information</div>
                        
                        <div class="od-inner-wrapper">
                            <div class="financial-box">
                            	<div class="head">Total Amount:</div>
                                <div class="col-md-6">
                                  <div class="sp-box">
                                    <div class="title">Price</div>
                                    <div class="text">GBP £ 18.80</div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sp-box">
                                        <div class="title">Shipping Cost</div>
                                        <div class="text">GBP £ 0.00</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sp-box">
                                        <div class="title">Total Amount</div>
                                        <div class="text">GBP £ 18.80</div>
                                    </div>
                                </div>	
                            </div>
                            
                            <div class="financial-box">
                            	<div class="head">Payment Received:</div>
                                <div class="col-md-3">
                                  <div class="sp-box">
                                    <div class="title">Total</div>
                                    <div class="text">GBP £ 18.80</div>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sp-box">
                                        <div class="title">Received</div>
                                        <div class="text">GBP £ 18.80</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sp-box">
                                        <div class="title">Payment Method</div>
                                        <div class="text">Credit Card</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="sp-box">
                                        <div class="title">Date</div>
                                        <div class="text">2015-10-15 01:04</div>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        
                        
                        <div class="heading-bar">Order details</div>
                        
                        <div class="od-inner-wrapper">
                        	<div class="product-list">
                            	<div class="col-md-5">
                              <div class="sp-box row">
                                <div class="title">Product Details</div>
                                <div class="text">
                                	<div class="col-md-4">
                                    	<img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}">
                                    </div>
                                    <div class="col-md-8">
                                    	55" JU6800 6 Series Flat UHD 4K Nano Crystal Smart TV
                                    </div>
                                </div>
                              </div>
                            </div>
                        		<div class="col-md-2">
                        		<div class="sp-box">
                                    <div class="title">Price Per Unit</div>
                                    <div class="text">GBP £ 18.80</div>
                                </div>
                            </div>
                       	 		<div class="col-md-1">
                                <div class="sp-box row">
                                    <div class="title">Quantity</div>
                                    <div class="text">1 Piece</div>
                                </div>
                            </div>
                        		<div class="col-md-2">
                                <div class="sp-box">
                                    <div class="title">Order Total</div>
                                    <div class="text">GBP £ 18.80</div>
                                </div>
                            </div>
                            	<div class="col-md-2">
                                <div class="sp-box">
                                    <div class="title">Status</div>
                                    <div class="text">Confirmation Received</div>
                                </div>
                            </div>
                            </div>
                    	</div>
                        
                        <div class="total-amount">
                        	<div class="col-md-3 col-md-offset-5">
                            	<div class="txt">
                                	Product Amount
                                </div>
                                <div class="amount">
                                	GBP £ 18.80
                                </div>
                            </div>
                            <div class="col-md-2">
                            	<div class="row">
                                    <div class="txt">
                                        Shipping Cost
                                    </div>
                                    <div class="amount">
                                        GBP £ 0.00
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                            	<div class="txt">
                                	Total Amount
                                </div>
                                <div class="amount">
                                	GBP £ 18.80
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
