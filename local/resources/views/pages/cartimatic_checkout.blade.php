@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
    	<div class="col-md-9">
        	<div class="row">
                <h1>Checkout</h1>    	
            </div>
        </div>
        <div class="col-md-3">
        	<div class="row">
            	<a href="http://localhost/shalmi/pages/category_products" class="continue-link">Return to Shopping Cart &nbsp; &gt;</a>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="cart-box">
			<div class="title-box bdrB">
                <h1>Select shipping address</h1>
            </div>   
          	<div class="col-md-12">
          	<div class="row">
            	<div class="col-md-4">
                	<div class="shiping-address">
                        <div class="buyer-name">John Doe</div>
                        <address>
                          <strong>Twitter, Inc.</strong><br>
                          1355 Market Street, Suite 900<br>
                          San Francisco, CA 94103<br>
                          <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{url('pages/cartimatic_payment')}}"><button type="button" class="btn btn-default">Ship to this address</button></a>
                          <button type="button" class="btn btn-edit">Edit</button>
                          <button type="button" class="btn btn-delete">Delete</button>
                        </div>
                	</div>
                </div>
                <div class="col-md-4">
                	<div class="shiping-address">
                        <div class="buyer-name">John Doe</div>
                        <address>
                          <strong>Twitter, Inc.</strong><br>
                          1355 Market Street, Suite 900<br>
                          San Francisco, CA 94103<br>
                          <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{url('pages/cartimatic_payment')}}"><button type="button" class="btn btn-default">Ship to this address</button></a>
                          <button type="button" class="btn btn-edit">Edit</button>
                          <button type="button" class="btn btn-delete">Delete</button>
                        </div>
                	</div>
                </div>
                <div class="col-md-4">
                	<div class="shiping-address">
                        <div class="buyer-name">John Doe</div>
                        <address>
                          <strong>Twitter, Inc.</strong><br>
                          1355 Market Street, Suite 900<br>
                          San Francisco, CA 94103<br>
                          <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
                        
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="{{url('pages/cartimatic_payment')}}"><button type="button" class="btn btn-default">Ship to this address</button></a>
                          <button type="button" class="btn btn-edit">Edit</button>
                          <button type="button" class="btn btn-delete">Delete</button>
                        </div>
                	</div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="col-md-7">
    <div class="row">
    	<div class="cart-box mr15">
			<div class="title-box bdrB">
                <h1>Add New Address</h1>
            </div>   
          	<div class="col-md-7">
                <div class="shipping-form">
                    <form class = "form-horizontal" role = "form">
                        <div class = "form-box">
                          <label for = "name">Full name <span>(Required)</span></label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Country <span>(Required)</span></label>
                          <select class="form-control" id="exampleSelect1">
                              <option>Pakistan</option>
                              <option>Australia</option>
                              <option>UAE</option>
                              <option>Turkey</option>
                              <option>Iran</option>
                            </select>
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Address line 1</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Address line 2</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">City</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">State</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">State/Province/Region</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Postal code</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        
                        <div class = "form-box">
                          <label for = "name">Phone number</label>
                          <input type = "text" class = "form-control" id = "name" placeholder = "Enter Name">
                        </div>
                        <a href="http://localhost/shalmi/pages/cartimatic_payment"><button type="button" class="btn btn-default">Ship to this address</button></a>
                    </form>
                </div>
          	</div>
        </div>
    </div>
</div>

<div class="col-md-5">
    <div class="row">
        <div class="cart-box">
            <div class="title-box bdrB">
                <h1>ORDER SUMMARY</h1>
            </div>
            <div class="pro-list-wraper">
                <div class="col-md-6">
                    <div class="product-information">
                        <div class="os">Order NO. <span>75116634156047</span></div>
                        <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                        <div class="os">Seller: <span>Samsung</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pr">Price: 299.00</div>
                </div>
                <div class="col-md-3">
                    <div class="pr">Price: 299.00</div>
                </div>
            </div>
            
            <div class="pro-list-wraper">
                <div class="col-md-6">
                    <div class="product-information">
                        <div class="os">Order NO. <span>75116634156047</span></div>
                        <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                        <div class="os">Seller: <span>Samsung</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pr">Price: 299.00</div>
                </div>
                <div class="col-md-3">
                    <div class="pr">Price: 299.00</div>
                </div>
            </div>
            
            <div class="pro-list-wraper">
                <div class="col-md-6">
                    <div class="product-information">
                        <div class="os">Order NO. <span>75116634156047</span></div>
                        <p>Striped T Shirts Men Designer Clothes Cross Flag...</p>
                        <div class="os">Seller: <span>Samsung</span></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pr">Price: 299.00</div>
                </div>
                <div class="col-md-3">
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
@endsection











