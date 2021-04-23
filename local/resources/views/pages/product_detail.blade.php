@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
    	<div class="col-md-9">
        	<div class="row">
                <h1>Computer &amp; Office</h1>
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">All Categories</a></li>
                  <li><a href="#">Computer &amp; Office</a></li>
                  <li class="active">Laptops</li>
                </ol>    	
            </div>
        </div>
        <div class="col-md-3">
        	<div class="row">
            	<form class="navbar-form p0" role="search">
                    <div class="input-group add-on">
                      <input type="text" class="form-control" placeholder="Search in laptops" name="srch-term" id="srch-term">
                      <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="product-detial-box">
            <div class="col-md-5">
            	<div class="row">
                	<img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}">
                </div>
            </div>
            <div class="col-md-4">
            	<div class="row">
                    <div class="product-info">
                        <h1>14 Inch Laptop Computer 4GB RAM & 64GB SSD & 320GB HDD with Celeron J1900 WIFI Mini HDMI 1.3Webcam Windows 10 Pro</h1>
                        <div class="ref">
                        	view all products by <a href="{{url('pages/brand_index')}}"> Marchesa</a>
                        </div>
                        
                        <div class="social-share">
                                <div class="col-md-3 col-xs-3">
                                    <div class="row">
                                        <label>Share</label>
                                    </div>
                                </div>
                                <div class="col-md-9 col-xs-9">
                                	<a href="#" class="fb"></a>
                                    <a href="#" class="tw"></a>
                                    <a href="#" class="yt"></a>
                                    <a href="#" class="vi"></a>
                                    <a href="#" class="gp"></a>
                                    
                                </div>
                        </div>
                        
                        <div class="shipping-wrap">
                        	<div class="col-md-3">
                            	<div class="row">
                            		<span class="title">Shipping:</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                            	<div class="row">
                            		<div class="courier-price">$21.84 to Pakistan via DHL</div>
                                	<p>Estimated Delivery Time: 4-8 days (ships out within 7 business days)</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-common-box">
                        	<div class="col-md-3">
                            	<div class="row">
                            		<span class="title">Size:</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                            	<div class="row">
                                	<div class="size-wraper">
                                        <a href="#">35</a>
                                        <a href="#">36</a>
                                        <a href="#">37</a>
                                        <a href="#" class="active">38</a>
                                        <a href="#">39</a>
                                        <a href="#">40</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-common-box">
                        	<div class="col-md-3">
                            	<div class="row">
                            		<span class="title">Color:</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                            	<div class="row">
                                	<div class="color-wraper">
                                        <a href="#">Red</a>
                                        <a href="#" class="active">Blue</a>
                                        <a href="#">Green</a>
                                        <a href="#">Black</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-common-box">
                        	<div class="col-md-3">
                            	<div class="row">
                            		<span class="title">Total Price:</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                            	<div class="row">
                                	<div class="actual-price">$12,521.87</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
            	<div class="cart-detail-wrapper">
                	<div class="returnTo"><span>&gt;</span>&nbsp; Return to the <a href="#">Product List</a></div>
                    
                    <div class="add-cart-box">
                    	<div class="price-range">
                        	<div class="off">$ 18,510</div>
                            <div class="range">$1200.00 - 1900.00 <sub>/piece</sub></div>
                            <div class="stock"><span class="available">In stock</span></div>
                        </div>
                        <div class="cartBtn">
                        	<a href="{{url('pages/cartimatic_cart')}}"><button class="btn btn-default" type="submit">Add to Cart</button></a>
                        </div>
                    </div>
                    
                    <div class="refund-wrapper">
                    	<div class="bpro">Buyer Protection</div>
                    	<div class="refund full">
                        	<strong>Full Refund</strong>
                            <span>If you don't receive your order</span>
                        </div>
                        <div class="refund partial">
                        	<strong>Full or Partial Refund</strong>
                            <span>If the item is not as described</span>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
        
        <div class="product-desc-wrapper">
        	<div class="container">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_a" data-toggle="tab">Product Description </a></li>
                  <li><a href="#tab_b" data-toggle="tab">Reviews</a></li>
                  <li><a href="#tab_c" data-toggle="tab">SHIPPMENT AND PAYMENT</a></li>
                  <li><a href="#tab_d" data-toggle="tab">SELLER GUARANTEES</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_a">
                        <div class="col-md-6">
                        	<div class="row">
                        		<p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                                <ul>
                                	<li>^ Length: 74cm</li>
                                    <li>^ Regular fit</li>
                                    <li>^ Notched lapels</li>
                                    <li>^ Twin button front fastening</li>
                                    <li>^ Front patch pockets; chest pocket</li>
                                    <li>^ Internal pockets</li>
                                    <li>^ Centre-back vent</li>
                                    <li>^ Please refer to the garment for care instructions.</li>
                                    <li>^ Length: 74cm</li>
                                    <li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_b">
                        <div class="col-md-6">
                        	<div class="row">
                        		<p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt.</p>
                                <ul>
                                	<li>^ Length: 74cm</li>
                                    <li>^ Regular fit</li>
                                    <li>^ Notched lapels</li>
                                    <li>^ Twin button front fastening</li>
                                    <li>^ Front patch pockets; chest pocket</li>
                                    <li>^ Please refer to the garment for care instructions.</li>
                                    <li>^ Length: 74cm</li>
                                    <li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_c">
                        <div class="col-md-6">
                        	<div class="row">
                        		<p>The River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                                <ul>
                                	<li>^ Length: 74cm</li>
                                    <li>^ Regular fit</li>
                                    <li>^ Notched lapels</li>
                                    <li>^ Twin button front fastening</li>
                                    <li>^ Front patch pockets; chest pocket</li>
                                    <li>^ Centre-back vent</li>
                                    <li>^ Please refer to the garment for care instructions.</li>
                                    <li>^ Length: 74cm</li>
                                    <li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_d">
                         <div class="col-md-6">
                        	<div class="row">
                        		<p>The River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                                <ul>
                                	<li>^ Length: 74cm</li>
                                    <li>^ Regular fit</li>
                                    <li>^ Notched lapels</li>
                                    <li>^ Twin button front fastening</li>
                                    <li>^ Front patch pockets; chest pocket</li>
                                    <li>^ Centre-back vent</li>
                                    <li>^ Please refer to the garment for care instructions.</li>
                                    <li>^ Length: 74cm</li>
                                    <li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
                        </div>
                    </div>
                </div><!-- tab content -->
            </div><!-- end of container -->
        </div>
    </div>
</div>
@endsection
