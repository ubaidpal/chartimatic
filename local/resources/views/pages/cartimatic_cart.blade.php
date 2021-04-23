@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
    	<div class="col-md-9">
        	<div class="row">
                <h1>Computer &amp; Office</h1>    	
            </div>
        </div>
        <div class="col-md-3">
        	<div class="row">
            	<a href="http://localhost/shalmi/pages/category_products" class="continue-link">Continue Shopping &nbsp; &gt;</a>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="cart-box">
        	<div class="cart-title-box">
            	<div class="seller">Seller: <a href="">Marchesa</a></div>
                <div class="product-head">
                    <div class="col-md-6">
                        <div class="row">Product Name &amp; Details</div>
                    </div>
                    <div class="col-md-3">Quantity</div>
                    <div class="col-md-3">Price</div>
                </div>
            </div>
            <div class="product-added-box">
                <div class="col-md-2">	
                    <div class="thumb"><img alt="promotion banner" src="http://localhost/shalmi/local/public/assets/bootstrap/images/added_cart_img.jpg"></div>
                </div>
                <div class="col-md-4">
                    <div class="product-name">
                        <h1>2L GORE-TEX® Murdoc Snowboard Jacket</h1>
                        <div class="cs">Color: <span>Black</span></div>
                        <div class="cs">Size: <span>30</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group select-qty">
                      <span class="input-group-btn">
                          <button type="button" class="btn" data-type="minus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-minus"></span>
                          </button>
                      </span>
                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style="
                text-align: center;
            ">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL" data-type="plus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-plus"></span>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="price row">$44.99 <sub>/ piece</sub></div>
                </div>
                <div class="col-md-1">
                    <a href="#" class="delete-product">Delete</a>
                </div>
            </div>
                
            <div class="product-added-box">
                <div class="col-md-2">	
                    <div class="thumb"><img alt="promotion banner" src="http://localhost/shalmi/local/public/assets/bootstrap/images/added_cart_img.jpg"></div>
                </div>
                <div class="col-md-4">
                    <div class="product-name">
                        <h1>2L GORE-TEX® Murdoc Snowboard Jacket</h1>
                        <div class="cs">Color: <span>Black</span></div>
                        <div class="cs">Size: <span>30</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group select-qty">
                      <span class="input-group-btn">
                          <button type="button" class="btn" data-type="minus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-minus"></span>
                          </button>
                      </span>
                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style="
                text-align: center;
            ">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL" data-type="plus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-plus"></span>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="price row">$44.99 <sub>/ piece</sub></div>
                </div>
                <div class="col-md-1">
                    <a href="#" class="delete-product">Delete</a>
                </div>
            </div>
            
            <div class="col-md-4 col-md-offset-8 t-amount">
            	<div class="col-md-12 sep">
                	<div class="row">
                        <div class="col-md-7">
                            <div class="subTotal">
                                Subtotal <span>(2 items)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-price">$599.87</div>
                        </div>
                        <div class="clrfix"></div>
                        <div class="total-wraper">
                        <div class="col-md-7">
                            <div class="total">
                                Total
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="total-price">$599.87</div>
                        </div>
                    </div>
                    </div>
               </div>
               
               <div class="buy-this">
               		<a href="{{url('pages/cartimatic_checkout')}}"><button type="submit" class="btn btn-default">Buy from this seller</button></a>
               </div>
            </div>
        </div>
        
        <div class="cart-box">
        	<div class="cart-title-box">
            	<div class="seller">Seller: <a href="">Marchesa</a></div>
                <div class="product-head">
                    <div class="col-md-6">
                        <div class="row">Product Name &amp; Details</div>
                    </div>
                    <div class="col-md-3">Quantity</div>
                    <div class="col-md-3">Price</div>
                </div>
            </div>
            <div class="product-added-box">
                <div class="col-md-2">	
                    <div class="thumb"><img alt="promotion banner" src="http://localhost/shalmi/local/public/assets/bootstrap/images/added_cart_img.jpg"></div>
                </div>
                <div class="col-md-4">
                    <div class="product-name">
                        <h1>2L GORE-TEX® Murdoc Snowboard Jacket</h1>
                        <div class="cs">Color: <span>Black</span></div>
                        <div class="cs">Size: <span>30</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group select-qty">
                      <span class="input-group-btn">
                          <button type="button" class="btn" data-type="minus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-minus"></span>
                          </button>
                      </span>
                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style="
                text-align: center;
            ">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL" data-type="plus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-plus"></span>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="price row">$44.99 <sub>/ piece</sub></div>
                </div>
                <div class="col-md-1">
                    <a href="#" class="delete-product">Delete</a>
                </div>
            </div>
                
            <div class="product-added-box">
                <div class="col-md-2">	
                    <div class="thumb"><img alt="promotion banner" src="http://localhost/shalmi/local/public/assets/bootstrap/images/added_cart_img.jpg"></div>
                </div>
                <div class="col-md-4">
                    <div class="product-name">
                        <h1>2L GORE-TEX® Murdoc Snowboard Jacket</h1>
                        <div class="cs">Color: <span>Black</span></div>
                        <div class="cs">Size: <span>30</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group select-qty">
                      <span class="input-group-btn">
                          <button type="button" class="btn" data-type="minus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-minus"></span>
                          </button>
                      </span>
                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style="
                text-align: center;
            ">
                      <span class="input-group-btn">
                          <button type="button" class="btn bdrL" data-type="plus" data-field="quant[1]">
                              <span class="glyphicon glyphicon-plus"></span>
                          </button>
                      </span>
                  </div>
                </div>
                <div class="col-md-2">
                    <div class="price row">$44.99 <sub>/ piece</sub></div>
                </div>
                <div class="col-md-1">
                    <a href="#" class="delete-product">Delete</a>
                </div>
            </div>
            
            <div class="col-md-4 col-md-offset-8 t-amount">
            	<div class="col-md-12 sep">
                	<div class="row">
                        <div class="col-md-7">
                            <div class="subTotal">
                                Subtotal <span>(2 items)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-price">$599.87</div>
                        </div>
                        <div class="clrfix"></div>
                        <div class="total-wraper">
                        <div class="col-md-7">
                            <div class="total">
                                Total
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="total-price">$599.87</div>
                        </div>
                    </div>
                    </div>
               </div>
               
               <div class="buy-this">
               		<a href="{{url('pages/cartimatic_checkout')}}"><button type="submit" class="btn btn-default">Buy from this seller</button></a>
               </div>
            </div>
        </div>
        
        <div class="cart-box">
        	<div class="col-md-8">
            	<div class="features">
                    <span>Buyer Protection:</span>
                    <ul>
                        <li>Full Refund if you don't received your order</li>
                        <li>Refund or Keep items not described</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 t-amount">
            	<div class="col-md-12 sep">
                	<div class="row">
                        <div class="col-md-7">
                            <div class="subTotal">
                                Subtotal <span>(2 items)</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-price">$599.87</div>
                        </div>
                        <div class="clrfix"></div>
                        <div class="total-wraper">
                        <div class="col-md-7">
                            <div class="total">
                                Total
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="total-price">$599.87</div>
                        </div>
                    </div>
                    </div>
               </div>	
               <div class="buy-this">
               		<a href="{{url('pages/cartimatic_checkout')}}"><button class="btn btn-default" type="submit">Buy All</button></a>
               </div>
            </div>	
        </div>
    </div>
</div>
@endsection











