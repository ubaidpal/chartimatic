@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Manage Feedback</h1>
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
                	<div class="col-md-7">Product</div>
                    
                    <div class="col-md-3">
                    	<div class="row">
                        	Feedback State
                       	</div>
                    </div>
                    <div class="col-md-2">
                    	<div class="row">Rating</div>
                    </div>
                </div>
                
                <div class="order-wrapper">
                	<div class="order-list-wrapper">
                		<div class="col-md-7">
                            <div class="col-md-3">
                                <div class="row"><img src="http://localhost/shalmi/local/public/assets/bootstrap/images/products-images/product-images-1.jpg" class="img-responsive" alt="a"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                            </div>
                        </div>
                    	<div class="col-md-3">
                        <div class="row finance">Active Feedback</div>
                    </div>
                    	<div class="col-md-2">
                    	<div class="row unit-price">
                        	<div class="reviews-wrapper">
                                <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                            </div>
                    	</div>
                    </div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-7">
                                <div class="col-md-3">
                                    <div class="row"><img src="http://localhost/shalmi/local/public/assets/bootstrap/images/products-images/product-images-8.jpg" class="img-responsive" alt="a"></div>
                                </div>
                                <div class="col-md-9">
                                    <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                </div>
                            </div>
                        <div class="col-md-3">
                            <div class="row finance">
                            	Awaiting Feedback
                                <button type="button" class="btn btn-default mt10">send reminder</button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row unit-price">
                                <div class="reviews-wrapper">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                	
                    <div class="order-detail-wrapper">
                    	<div class="col-md-4">
                        	<div class="row">
                    			<div class="left-col">
                        	<div class="status">Order Status <a href="#">View Detail</a></div>
                            <div>Date: 09:04 | Oct. 13 2014  </div>
                        </div>
                        	</div>
                        </div>
                        <div class="col-md-8">
                        	<div class="row">
                        		<div class="right-col pull-left">
                                    <div class="sc">Buyer Name: <span>Nikki Reed</span></div>
                                    <div><a href="#">View Profile</a></div>
                                </div>
                        	</div>
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
