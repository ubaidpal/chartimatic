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
                    	<div class="col-md-4"><label class="col-left">Did you receive your order :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<label class="radio-inline">
                                	<input checked="checked" data-val="true" data-val-required="" id="" name="" type="radio" value="False">
                    				Yes
                				</label>
                                <label class="radio-inline">
                                	<input data-val="true" data-val-required="" id="" name="" type="radio" value="False">
                    				No
                				</label>
                			</div>
                		</div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4"><label class="col-left">Payment Received :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<div class="col-md-6">
                                	<div class="row">GBP £ 18.80</div>
                                </div>
                                <div class="col-md-6">
                                	<div class="row">Shipping Time: &nbsp; 2015-10-15 01:04</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4"><label class="col-left">Refund Requested :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<label class="radio-inline">
                                	<input data-val="true" data-val-required="" id="" name="" type="radio" value="False">
                    				Full Refund
                				</label>
                            </div>
                            <div class="col-right">
                            	<label class="radio-inline">
                                	<input checked="checked" data-val="true" data-val-required="" id="" name="" type="radio" value="False">
                    				Partial Refund - Amount Requested: GBP &pound; 
                				</label>
                                
                                <input class="form-control partial-field" data-val="true"  id="" name="" type="text" value="">
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4"><label class="col-left mt10">Reason :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<select class="form-control">
                                  <option>All Categories</option>
                                  <option></option>
                                  <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4"><label class="col-left mt10">Detail :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<textarea placeholder="Type you message here . . ." id="comment" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4"><label class="col-left mt10">Attachment :</label></div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<label class="file">
                                  <input type="file" id="file">
                                  <span class="file-custom"></span>
                                </label>
                            </div>
                            <div class="col-right mt10"><a href="#">Add another attachment</a></div>
                        </div>
                    </div>
                    
                    <div class="dp-box">
                    	<div class="col-md-4">&nbsp;</div>
                        <div class="col-md-8">
                        	<div class="col-right">
                            	<div aria-label="Basic example" role="group" class="btn-group">
                                  <button class="btn btn-default" type="button">Submit</button>
                                  <button class="btn btn-grey" type="button">Cancel</button>
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
