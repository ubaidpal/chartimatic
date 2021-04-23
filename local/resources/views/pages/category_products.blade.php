@extends('pages.layouts.default')

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

@include('pages.includes.product-filter-sidebar')
<div class="col-md-9">
	<div class="row">
    	<div class="col-md-12">
        	<div class="row">
        		<div class="pro-info-header">
            	<div class="col-md-4">
                	<p>Showing 1 to 16 of 17 total</p>
                </div>
                <div class="col-md-3">
                	<div class="form-group row">
                    	<label>Sort By:</label>
                    	<select class="form-control">
                          <option>Name</option>
                          <option>samsung 11</option>
                          <option>Iphone 6</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                	<div class="form-group">
                    	<label>Show:</label>
                    	<select class="form-control">
                          <option>10</option>
                          <option>25</option>
                          <option>50</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        
				<div class="product-wrapper">    
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                        <div class="shape discount">
                            <div class="shape-text">
                                20% off								
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-14.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>Samsung</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                        <a href="{{url('pages/product_detail')}}">
                        <div class="shape new">
                            <div class="shape-text">
                                Sale							
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-15.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>apple</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                    	<a href="{{url('pages/product_detail')}}">
                        <div class="shape hot">
                            <div class="shape-text">
                                Hot							
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-16.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>Sony</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                    	<a href="{{url('pages/product_detail')}}">
                        <div class="shape hot">
                            <div class="shape-text">
                                Hot								
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-17.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>dell</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                    	<a href="{{url('pages/product_detail')}}">
                        <div class="shape discount">
                            <div class="shape-text">
                                20% off								
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-18.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>toshiba</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="row pro-contain">
                    <div class="col-item">
                    	<a href="{{url('pages/product_detail')}}">
                        <div class="shape new">
                            <div class="shape-text">
                                New								
                            </div>
                        </div>
                        <div class="photo">
                            <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-19.jpg') !!}">
                        </div>
                        <div class="b-name">
                        	<h1>Hp</h1>
                        </div>
                        <div class="info">
                            <div class="col-md-12">
                                <p>ACER Notebook - E5-571 - 15.6 inches - Intel Core i3 1.7 GHz</p>
                                <div class="price-wrapper">
                                    <div class="price">
                                        <h3>$45.05</h3>
                                        <sub>$20.05</sub>
                                    </div>
                                    <div class="disc-badge">
                                        30% off
                                    </div>
                                </div>
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
                                    <span>(10 Reviews )</span>
                                </div>
                            </div>
                        </div>
                        <div class="info-more">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <button type="button" class="btn btn-default">Buy Now</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Acitons -->
                        <div class="action">
                          <div><a href="#" class="fb"></a></div>  
                          <div><a href="#" class="tw"></a></div>
                          <div><a href="#" class="tw"></a></div>
                        </div>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="clrfix"></div>
			</div>
        	</div>
        </div>
	</div>
</div>

<div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>Tops &amp; Tees </h1>
                                    <a href="javascript:void(0)">See more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                          <a href="{{url('pages/product_detail')}}">  <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-1.jpg') !!}"></a>

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-2.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-3.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-4.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-5.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-6.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-7.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="row">
                                        <div class="thumbnail">
                                            
                                            <img alt="promotion banner" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-8.jpg') !!}">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>37489 items</p>
                                            </div>
                                        </div>
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
