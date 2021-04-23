@extends('pages.layouts.default')

@section('content')

    @include('pages.includes.category-sidebar')
    @include('pages.includes.main-slider')

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-5 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                 class="img-responsive" alt="promotion banner">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>Men’s Clothing <a href="#" class="edit-item">Edit</a></h1>
                                    <a href="javascript:void(0)">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
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
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
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

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-5 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <a href="#" class="edit-item">Edit</a>
                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                 class="img-responsive" alt="promotion banner">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>women’s Clothing<a href="#" class="edit-item">Edit</a></h1>
                                    <a href="javascript:void(0)">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
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
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
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

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-5 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <a href="#" class="edit-item">Edit</a>
                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                 class="img-responsive" alt="promotion banner">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>consumer electronics<a href="#" class="edit-item">Edit</a></h1>
                                    <a href="javascript:void(0)">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
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
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
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

    <div class="col-md-12">
        <div class="row">
            <div class="specific-category">
                <div class="col-md-5 hidden-sm">
                    <div class="row">
                        <div class="category-left-col">
                            <a href="#" class="edit-item">Edit</a>
                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                 class="img-responsive" alt="promotion banner">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box">
                                    <h1>jewelry &amp; watches<a href="#">Edit</a></h1>
                                    <a href="javascript:void(0)">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <div class="row">
                                <div class="products-category">
                                    <div class="singal-category">
                                        <h6>Top</h6>
                                        <ul>
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
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
                                            <li><a href="javascript:void(0)">Women's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Men's Clothing</a></li>
                                            <li><a href="javascript:void(0)">Computer &amp; Offices</a></li>
                                            <li><a href="javascript:void(0)">Phones &amp; Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Simple, Casual, Smart</h3>

                                                <p>Urban sole</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="row">
                                        <div class="thumbnail">
                                            <a href="#" class="edit-item">Edit</a>
                                            <img src="{!! asset('local/public/assets/images/cartimatic/product-large-image.jpg') !!}"
                                                 alt="promotion banner">

                                            <div class="caption">
                                                <h3>Thumbnail label</h3>

                                                <p>...</p>
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
    @include('pages.includes.best-products-carosell')
@endsection
