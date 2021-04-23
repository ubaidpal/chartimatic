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
                            <li><a href="#">All Orders</a></li>
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
                            <li><a href="#" class="active">Dispute</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
        	<div class="row">
            	<div class="dispute-main-title">Dispute Details</div>
                <div class="dispute-wrapper">
                	<div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Order ID :</label></div>
                        <div class="col-md-10"><div class="col-right">64125090856047</div></div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Status :</label></div>
                        <div class="col-md-10"><div class="col-right">he seller has shipped your order</div></div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Track Info :</label></div>
                        <div class="col-md-10">
                        	<div class="col-right">
                            	<div class="col-md-6">
                                	<div class="row">Tracking Number: &nbsp; RL046408913CN</div>
                                </div>
                                <div class="col-md-6">
                                	<div class="row">Shipping Time: &nbsp; 2015-10-15 01:04</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Reminder :</label></div>
                        <div class="col-md-10">
                        	<div class="col-right">Please wait for the supllier to respond to your dispute. You can modify the details of your dispute or cancel
your dispute by clicking the button below
								</div>
                        	<div class="col-right">
                            	<p>If you cannot reach an agreement with the seller, you can file a claim for the order</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Details :</label></div>
                        <div class="col-md-10"><div class="col-right">Mobile phone just delivered to me is broken in box</div></div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2"><label class="col-left">Attachments :</label></div>
                        <div class="col-md-10">
                        	<div class="col-right">
                            	<div class="product-image">
                                	<div class="col-md-2">
                                    	<img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}">
                                    </div>
                                </div>
                                <div class="product-image">
                                	<div class="col-md-2">
                                    	<img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-22.jpg') !!}">
                                    </div>
                                </div>
                                <div class="product-image">
                                	<div class="col-md-2">
                                    	<img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-24.jpg') !!}">
                                    </div>
                                </div>
                            </div>
                       	</div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-2">&nbsp;</div>
                        <div class="col-md-10">
                        	<div class="col-right">
                            	<div aria-label="Basic example" role="group" class="btn-group">
                                  <button class="btn btn-default" type="button">Confirm order</button>
                                  <button class="btn btn-grey" type="button">Open Dispute</button>
                                  <a href="#">File a claim</a>
                                </div>
                            </div>
                        	<div class="col-right">
                            	<p>Please check your order when it's delivered by the shipping company. Only confirm receipt of delivery when
you are satisfied with the condition of your order. You can open a dispute for the order if your are not satisfied
with the items you receive.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="dispute-wrapper">
                	<div class="messages-title">Leave a Message</div>
                    <div class="write-msg">
                    	<textarea class="form-control" rows="5" id="comment" placeholder="Type you message here . . ."></textarea>
                    </div>
                    <div class="btn-box">
                    	<button class="btn btn-default" type="button">Send message</button>
                    </div>
                </div>
                
                <div class="dispute-wrapper">
                	<div class="messages-title bdrB">Messages</div>
                    <div class="msgs-box">
                    	<div class="msg-list">
                    	<div class="col-md-2">
                        	<div class="name">Roman Nemdus</div>
							<div class="td">Apr 19 | 05:54 pm</div>
                        </div>	
                        <div class="col-md-10">
                        	<div class="msg">
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ad haec, nisi molestum est, habeo quae
velim. Quamquam ab iis philoso phiam et omnes ingenuas disciplinas habem us; Quid, si non sens
usmodo ei sit datus
                            </div>
                        </div>	
                    </div>
                    
                    	<div class="msg-list">
                    	<div class="col-md-2">
                        	<div class="name">Me</div>
							<div class="td">Apr 19 | 05:54 pm</div>
                        </div>	
                        <div class="col-md-10">
                        	<div class="msg me">
                            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ad haec, nisi molestum est, habeo quae
velim. Quamquam ab iis philoso phiam et omnes ingenuas disciplinas habem us; Quid, si non sens
usmodo ei sit datus
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
