@extends('layouts.default')

@section('content')

    @include('pages.includes.category-sidebar-demo')
    @include('pages.includes.main-slider-demo')

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-4 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-big.jpg') !!}"
                                 class="img-responsive" alt="promotion banner" width="400" height="600">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>Men’s Clothing</h1>
                                    <a href="{{url("pages/category")}}">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="{{url("pages/category")}}">Women's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}}">Men's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}})">Computer &amp; Offices</a></li>
                                            <li><a href="{{url("pages/category")}}">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>

                                    <div class="singal-category">
                                        <h6>Men Shoes</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                    <div class="singal-category">
                                        <h6>Men Assesories</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-1.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-2.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-3.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-4.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-5.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-6.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
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

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category align-right">
                <div class="col-md-4 hidden-sm right">
                    <div class="row">
                        <div class="category-left-col">
                            <img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-big-2.jpg') !!}"
                                 class="img-responsive" alt="promotion banner" width="400" height="600">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>Women’s Clothing</h1>
                                    <a href="http://localhost/shalmi/pages/category">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 right">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="{{url("pages/category")}}">Women's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}}">Men's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}})">Computer &amp; Offices</a></li>
                                            <li><a href="{{url("pages/category")}}">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>

                                    <div class="singal-category">
                                        <h6>Men Shoes</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                    <div class="singal-category">
                                        <h6>Men Assesories</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-7.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-8.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-9.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-10.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-11.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-12.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
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

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-4 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-big-3.jpg') !!}"
                                 class="img-responsive" alt="promotion banner" width="400" height="600">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>Consumer Electronics</h1>
                                    <a href="http://localhost/shalmi/pages/category">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="{{url("pages/category")}}">Women's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}}">Men's Clothing</a></li>
                                            <li><a href="{{url("pages/category")}})">Computer &amp; Offices</a></li>
                                            <li><a href="{{url("pages/category")}}">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>

                                    <div class="singal-category">
                                        <h6>Men Shoes</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                    <div class="singal-category">
                                        <h6>Men Assesories</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-sm-9">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-13.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-14.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-15.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-16.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-17.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a class="" href="http://localhost/shalmi/pages/category_products">
                                            	<img src="{!! asset('local/public/assets/bootstrap/images/products-images/Image-small-18.jpg') !!}"
                                                 alt="promotion banner">

                                            	<div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                            </a>
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
    @include('pages.includes.best-products-carosell')
@endsection
