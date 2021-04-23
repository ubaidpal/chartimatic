<?php $options = get_theme_options($theme_id,'custom-section-product-id',null,true); ?>

<section>
    <div class="row">
        <div class="features_items">
            <!--features_items-->
            <?php
            $section_name = get_theme_option($theme_id,'custom-section-name',null,true);
            ?>
            <h2 class="title text-center">{{$section_name}}</h2>
            @if(!empty($options))
            @foreach($options as $option)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <?php
                            $product = getProductDetailsByID($option->value);
                            ?>
                            <img src="{{getRandomImageOfProduct($option->value)}}" alt="" />
                            <?php $price = product_price_info($option->value); ?>
                            <h2>${{wishListPrice($option->value)}}</h2>
                            <p>{{$product->title}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                        </div>
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{format_currency($option->value)}}</h2>
                                <p>
                                </p>
                                <a href="{{url('view-product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            @if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) != -1 AND Auth::user()->user_type != 2)
                            @if(isProductFavorite($product->id))
                                <li><a href="#" id="{{$product->id}}" class="product-un-favorite-btn"><i class="fa fa-minus-square"></i>Remove from wishlist</a></li>
                            @else
                            <li><a href="#" id="{{$product->id}}" class="product-favorite-btn"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

@section('footer-scripts')
    <script type="text/javascript">
        $(document).on("click", ".product-favorite-btn", function (evt) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //for token purpose in laravel
            evt.preventDefault();
            var product_id = evt.target.id;
            var imgSrc = "{!! asset('local/public/assets/images/cartimatic/loading.svg') !!}";
            $(".product-favorite-wrap").append('<img src="' + imgSrc + '" title="loading" alt="loading..."/>');
            if (product_id > 0) {
                jQuery.ajax({
                    url: '{{url('store/add-product-favorites')}}',
                    type: "Post",
                    data: {product_id: product_id},
                    success: function (data) {
                        var image = $(".product-favorite-wrap").html(data);
                        window.location.reload(image);
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        alert("ERROR:" + xhr.responseText + " - " + thrownError);
                    }
                });
            }
        });
        $(document).on("click", ".product-un-favorite-btn", function (evt) {
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            evt.preventDefault();
            var product_id = evt.target.id;
            var imgSrc = "{!! asset('local/public/assets/images/cartimatic/loading.svg') !!}";
            $(".product-favorite-wrap").append('<img src="' + imgSrc + '" title="loading" alt="loading..."/>');
            if (product_id > 0) {
                jQuery.ajax({
                    url: '{{url('store/remove-product-favorites')}}',
                    type: "Post",
                    data: {product_id: product_id},
                    success: function (data) {
                        var image = $(".product-un-favorite-btn").html(data);
                        window.location.reload(image);
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        alert("ERROR:" + xhr.responseText + " - " + thrownError);
                    }
                });
            }
        });
    </script>
@endsection