@extends('layouts.default')

@section('content')
<div class="col-md-12 hidden-xs">
	<div class="row">
    	<div class="pro-header">
			<h1>Top Sellers</h1>
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
                          <li><a @if(isset($active_top_link_number)) @if($active_top_link_number == 1) class="active" @endif @endif href="{{url('new-arrivals')}}">New Arrivals</a></li>
                          <li><a @if(isset($active_top_link_number)) @if($active_top_link_number == 2) class="active" @endif @endif href="{{url('top-sellers')}}">Top Sellers</a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">

                <div class="order-title-box">
                    <div class="select-category">
                        <div class="input-group">
                            <label style="margin-bottom: 5px;" for="top_sellers_categories">Filter By Category</label>
                            {!!  \Form::select('top_sellers_categories', $topSellersProductsCategories, 0, ['class' => 'form-control' ,'id' => 'top_sellers_categories'])!!}
                            <label style="margin-top: 5px;float:right; display: none;" id="show_all"><a href=""> Show All</a></label>
                        </div>
                    </div>
                </div>

                <div class="order-wrapper">
                    @foreach($topSellersProducts as $favoriteProduct)
                        <?php $brandInfo = getBrandInfo($favoriteProduct->owner_id);
                        if(!isset($brandInfo->id)){
                            continue;
                        }?>

                        <div class="order-list-wrapper" data-filter="{{$favoriteProduct->category_id}}" id="delete_wishList_{{$favoriteProduct->id}}">
                            <div class="col-md-6 col-xs-12">
                                <a title="Click to view detail." href="{{url('product/'.$favoriteProduct->id)}}" id="{{$favoriteProduct->id}}">
                                    <div class="col-md-3 col-xs-4">
                                        <div class="row">
                                            @if(isset($favoriteProduct->id))
                                                <img alt="{{$favoriteProduct->title}}" class="img-responsive"
                                                     onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"  src="{!! getRandomImageOfProduct($favoriteProduct->id) !!}">
                                            @else
                                                <img onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" alt="{{$favoriteProduct->title}}" class="img-responsive"
                                                     src="{!! getImage(null) !!}">
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-9 col-xs-8">
                                        <p class="product-det-txt">{{$favoriteProduct->title}}</p>

                                        <div class="per-piece">US ${!! wishListPrice($favoriteProduct->id) !!} <sub>/ piece</sub></div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-4 col-xs-12 top-xs-margin">
                                <div class="row">
                                    <div class="store-name">Store Name: {{$brandInfo->displayname}}</div>
                                    <div class="view-profile"><a href="{{url('store/'.$brandInfo->username)}}">View Profile</a></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="time"></div>
                                    <a class="left-xs-margin" href="{{url('product/'.$favoriteProduct->id)}}" id="{{$favoriteProduct->id}}">View Product Detail</a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Record</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product in your wishList.</p>
            </div>
            <div class="modal-footer">
                <input class="delWishList" type="hidden" name="delParent" value="">
                <a href="#" class="btn btn-danger delP" data-dismiss="modal">Delete</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>
@endsection

@section('footer-scripts')
    @include('includes.searchQueryScript.searchScript')
    <script>
        $("#show_all").hide();
        $("#top_sellers_categories").change(function(){
            var products = $(".order-list-wrapper");
            products.hide();
            $("#show_all").show();

            products.each(function(){
                if($(this).data('filter') == $("#top_sellers_categories").val()){
                    $(this).fadeIn( "slow", function() {
                        // Animation complete.
                    });
                }
            });
        });

        $("#show_all").click(function (evt) {
            var products = $(".order-list-wrapper");
            $('#top_sellers_categories').val("0");
            products.each(function(){
                products.get(0);
                $(this).fadeIn( "slow", function() {
                    // Animation complete.
                });
            });
        });
    </script>
@endsection
