@extends('layouts.brand-default')

@section('content')
<div class="brand-banner">
    <img src="{!! asset('local/public/assets/bootstrap/images/b-img.jpg') !!}" class="img-responsive" alt="a">
    <div class="bread-wrapper">
    	<div class="row">
        	<div class="col-md-12">
            	<div class="brand-logo">
                	<div class="brand-image">
                    	<img src="{!! asset('local/public/assets/bootstrap/images/apple_416x416.jpg') !!}" class="img-responsive" alt="a">
                    </div>
                	<h1>samsung</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container category">
	<div class="brand-navbar">
    	<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="488">
                <div>
                  <div class="collapse navbar-collapse" id="myNavbar">
                  	<a href="#" class="bl"><img src="{!! asset('local/public/assets/bootstrap/images/samsung-logo.jpg') !!}" class="img-responsive" alt="a"></a>
                    <ul class="nav navbar-nav">
                      <li><a href="#section1">Mobile phones</a></li>
                      <li><a href="#section2">Laptops</a></li>
                    </ul>
                  </div>
                </div>
            </nav>   	
    </div>
	<div class="row">
		<div class="col-md-12">
    		<div class="row">
        		<div class="container-fluid" id="section1">
        	<div class="col-md-12">
            <div class="row">
                <div class="title-box bb">
                    <h1>Mobile Phones </h1>
                    <a href="javascript:void(0)">See more</a>
                </div>
            </div>
        </div>    
        	<div class="product-wrapper">    
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape discount">
                        <div class="shape-text">
                            20% off								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-20.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape new">
                        <div class="shape-text">
                            Sale							
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-21.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape hot">
                        <div class="shape-text">
                            Hot							
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-22.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape discount">
                        <div class="shape-text">
                            20% off								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-23.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape hot">
                        <div class="shape-text">
                            Hot								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-24.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape discount">
                        <div class="shape-text">
                            20% off								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-25.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape new">
                        <div class="shape-text">
                            New								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-26.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row pro-contain">
                    <a href="{{url('pages/product_detail')}}">
                        <div class="col-item">
                    <div class="shape discount">
                        <div class="shape-text">
                            20% off								
                        </div>
                    </div>
                    <div class="photo">
                        <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-27.jpg') !!}">
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
                </div>
                    </a>
                </div>
            </div>
            <div class="clrfix"></div>
        </div>
        </div>
        		<div class="container-fluid" id="section2">
                    <div class="col-md-12">
                    <div class="row">
                        <div class="title-box bb">
                            <h1>Laptops</h1>
                            <a href="javascript:void(0)">See more</a>
                        </div>
                    </div>
                </div>    
                    <div class="product-wrapper">    
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape discount">
                                <div class="shape-text">
                                    20% off								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-29.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape new">
                                <div class="shape-text">
                                    Sale							
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-30.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape hot">
                                <div class="shape-text">
                                    Hot							
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-31.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape discount">
                                <div class="shape-text">
                                    20% off								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-32.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape hot">
                                <div class="shape-text">
                                    Hot								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-33.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape discount">
                                <div class="shape-text">
                                    20% off								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-34.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape new">
                                <div class="shape-text">
                                    New								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-35.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <div class="row pro-contain">
                        <div class="col-item">
                            <div class="shape discount">
                                <div class="shape-text">
                                    20% off								
                                </div>
                            </div>
                            <div class="photo">
                                <img alt="a" class="img-responsive" src="{!! asset('local/public/assets/bootstrap/images/products-images/product-images-36.jpg') !!}">
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
                        </div>
                        </div>
                    </div>
                    <div class="clrfix"></div>
                </div>
                </div>
    		</div>
		</div>
	</div>
</div>
@endsection
