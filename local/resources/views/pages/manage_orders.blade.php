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
            	<div class="order-link-wrapper">
                	<a href="#">All</a>
                    <a href="#">Awaiting payment (0)</a>
                    <a href="#">Awaiting shipment (0)</a>
                    <a href="#">Awaiting delivery (0)</a>
                    <a href="#">Disputes (0)</a>
                </div>
                
                <div class="order-title-box">
                	<div class="col-md-6">Product</div>
                    
                    <div class="col-md-4">
                    	<div class="row">
                        	<span>Unit Price</span>
                            
                            <span>Discount</span>
                            
                            <span>Quantity</span>
                       	</div>
                    </div>
                    
                    <div class="col-md-2">
                    	<div class="row">Order Amount</div>
                    </div>
                </div>
                
                <div class="order-wrapper">
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row finance">
                                <span>$54.00</span>
                                
                                <span>$4.22</span>
                                
                                <span>2</span>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    	<div class="row unit-price">$33.99</div>
                    </div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-8.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row finance">
                                <span>$54.00</span>
                                
                                <span>$4.22</span>
                                
                                <span>2</span>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    	<div class="row unit-price">$33.99</div>
                    </div>
                    </div>
                    
                    <div class="order-detail-wrapper">
                    	<div class="left-col">
                        	<div class="status">Order Status <a href="#">View Detail</a></div>
                            <div>Date: 09:04 | Oct. 13 2014  </div>
                        </div>
                        <div class="right-col">
                        	<div class="sc">Shipment Cost: <span>$10.40</span></div>
                            <div>Order Amount: <span>$10.40</span></div>
                        </div>
                    </div>
                    
                    <div class="order-status-wrapper">
                    	<div class="col-md-5">
                        	<div class="status-title">Order Status</div>
                            <div class="order-status">Awaiting Shipment</div>
                        </div>
                        <div class="col-md-5">
                        	<div class="seller-name">Seller name: Samsung</div>
                            <div><a href="#">View Profile</a></div>
                        </div>
                        <div class="col-md-2">
                        	<button class="btn btn-default" type="button">Cancel</button>
                        </div>
                    </div>
                </div>
                
                <div class="order-wrapper">
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row finance">
                                <span>$54.00</span>
                                
                                <span>$4.22</span>
                                
                                <span>2</span>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    	<div class="row unit-price">$33.99</div>
                    </div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-8.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row finance">
                                <span>$54.00</span>
                                
                                <span>$4.22</span>
                                
                                <span>2</span>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    	<div class="row unit-price">$33.99</div>
                    </div>
                    </div>
                    
                    <div class="order-detail-wrapper">
                    	<div class="left-col">
                        	<div class="status">Order Status <a href="#">View Detail</a></div>
                            <div>Date: 09:04 | Oct. 13 2014  </div>
                        </div>
                        <div class="right-col">
                        	<div class="sc">Shipment Cost: <span>$10.40</span></div>
                            <div>Order Amount: <span>$10.40</span></div>
                        </div>
                    </div>
                    
                    <div class="order-status-wrapper">
                    	<div class="col-md-5">
                        	<div class="status-title">Order Status</div>
                            <div class="order-status">Awaiting Shipment</div>
                        </div>
                        <div class="col-md-5">
                        	<div class="seller-name">Seller name: Samsung</div>
                            <div><a href="#">View Profile</a></div>
                        </div>
                        <div class="col-md-2">
                        	<button class="btn btn-default" type="button">Cancel</button>
                        </div>
                    </div>
                </div>
                
                <div class="pagination-wrapper">
                	<div class="pages-limit">
                    	<div class="input-group">
                        	<label>Show</label>
                            <select class="form-control">
                              <option>25</option>
                              <option>50</option>
                              <option>100</option>
                            </select>
                            <label>per page</label>
                        </div>
                    </div>
                    
                    <div class="pagination-box">
                    	<ul class="pagination"> <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul>
                    </div>
                </div>
            </div>	
        </div>
    </div>
</div>
@endsection
