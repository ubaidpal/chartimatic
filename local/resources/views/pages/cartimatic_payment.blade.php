@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
        	<h1>Payment</h1>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="col-md-8">
        	<div class="row">
        		<div class="cart-box mr15">
					<div class="title-box bdrB">
                        <h1>Pay with card</h1>
                    </div>   
          			<div class="col-md-8">
                <div class="shipping-form">
                    <form class = "form-horizontal" role = "form">
                        <div class = "form-box">
                          <label for = "name">Card number <span>(Required)</span></label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Country holder’s name <span>(Required)</span></label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "">
                        </div>
                        
                        <div class = "form-box">
                          	<label for = "name">Expiration date <span>(Required)</span></label>
                            <div class="clrfix"></div>
                          	<select class="form-control date" id="">
                              <option>Month</option>
                              <option>January</option>
                              <option>February</option>
                              <option>March</option>
                              <option>April</option>
                            </select>
                            
                            <select class="form-control date" id="">
                              <option>Year</option>
                              <option>2001</option>
                              <option>2002</option>
                              <option>2003</option>
                              <option>2004</option>
                            </select>
                            <div class="clrfix"></div>
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Card verification code <span>(Required)</span></label>
                          <input type = "text" class = "form-control vcode" id = "name" placeholder = "">
                        </div>


                        <a href="{{url('pages/manage_orders')}}"><button type="button" class="btn btn-default">Pay now</button></a>
                    </form>
                </div>
          	</div>
        		</div>
        	</div>
        </div>
        <div class="col-md-4">
        	<div class="row">
                <div class="cart-box">
                    <div class="title-box bdrB">
                        <h1>ORDER SUMMARY</h1>
                    </div>
                    <div class="pro-list-wraper">
                        <div class="col-md-8">
                        	<div class="product-information">
                            	<div class="os">Order NO. <span>75116634156047</span></div>
                                <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                                <div class="os">Seller: <span>Samsung</span></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="pr">Price: 299.00</div>
                        </div>
                    </div>
                    
                    <div class="pro-list-wraper">
                        <div class="col-md-8">
                        	<div class="product-information">
                            	<div class="os">Order NO. <span>75116634156047</span></div>
                                <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                                <div class="os">Seller: <span>Samsung</span></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="pr">Price: 299.00</div>
                        </div>
                    </div>
                    
                    <div class="pro-list-wraper">
                        <div class="col-md-8">
                        	<div class="product-information">
                            	<div class="os">Order NO. <span>75116634156047</span></div>
                                <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                                <div class="os">Seller: <span>Samsung</span></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        	<div class="pr">Price: 299.00</div>
                        </div>
                    </div>
                    
                    <div class="subT">
                    	<div>Total: $7955.99</div>
                        <div>+ Shipping: $5.00</div>
                    </div>
                    
                    <div class="gt">
                    	<div>Grand Total: <span>$7960.99</span></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection











