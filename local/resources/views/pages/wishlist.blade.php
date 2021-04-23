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
                <div class="order-title-box">
                	<div class="select-category">
                    	<select class="form-control">
                          <option>All Categories</option>
                          <option></option>
                          <option></option>
                        </select>
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
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
                            </div>
                    	</div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-3.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
                            </div>
                    	</div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-5.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
                            </div>
                    	</div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-18.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
                            </div>
                    	</div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-5.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
                            </div>
                    	</div>
                    </div>
                    
                    <div class="order-list-wrapper">
                        <div class="col-md-6">
                            <div class="col-md-3">
                                <div class="row"><img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-18.jpg') !!}"></div>
                            </div>
                            <div class="col-md-9">
                                <p class="product-det-txt">Striped T Shirts Men Designer Clothes Cross Flag Print Vintage</p>
                                <div class="per-piece">US $19.90 <sub>/ piece</sub></div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="store-name">Store Name: Nikki Reed</div>
                                <div><a href="#">View Profile</a></div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                    		<div class="row">
                            	<div class="time">Added 10 May 2016</div>
                                <div class="delete-list"><a href="#">Delete from wishlist</a></div>
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
