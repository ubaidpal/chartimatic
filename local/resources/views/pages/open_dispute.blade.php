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
            	<div class="dispute-main-title">Open Dispute</div>
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
                        	<div class="col-right">Your order is in transit</div>
                        	<div class="col-right">
                            	<p>Please click &quot;Confirm&quot; if you have received your order. And if you do not receive your order, please open adespute by clicking &quot;Open Dispute&quot;</p>
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
            </div>	
        </div>
    </div>
</div>
@endsection
