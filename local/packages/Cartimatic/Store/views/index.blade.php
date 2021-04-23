@extends('layouts.brand-default')

@section('content')
    <div class="brand-banner">
        <img src="{!! url($storeOwner->cover_photo_url) !!}" onError="this.onerror=null;this.src='<?php echo url('local/public/images/defaults/store_cover.jpg')?>';"  class="img-responsive" alt="cover_photo">
        <div class="bread-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-logo">
                        <div class="brand-image">
                            <img src="{!! url($storeOwner->profile_photo_url) !!}" onError="this.onerror=null;this.src='<?php echo url('local/public/images/defaults/small_category.jpg')?>';" class="img-responsive" alt="profile_photo">
                        </div>
                        <h1>{{getStoreName($storeOwner->id)}}</h1>
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
                        <a href="#" class="bl"><img src="{!! url($storeOwner->profile_photo_url) !!}" class="img-responsive" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" alt="profile_photo"></a>

                        <ul class="nav navbar-nav">
                            @if(is_array($allProducts))
                                @foreach($allProducts as $key => $categoryProducts)
                                    <?php if(empty($categoryProducts)){continue;}?>
                                    <li id="{{str_replace([" ", "&", '/[^A-Za-z0-9\-]/', '&amp;' , 'amp;'], "_", $key)}}" class="nav_item"><a href="#{{str_replace([" ", "&", '/[^A-Za-z0-9\-]/', '&amp;', 'amp;'], "_", $key)}}"><?php $catName = explode('_', $key); echo $catName[1]; ?></a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if(is_array($allProducts))
                        @foreach($allProducts as $key => $categoryProducts)
                            <?php if(empty($categoryProducts)){continue;}?>
                    <div class="container-fluid" id="{{$key}}">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="title-box bb">
                                    <h1><?php $catName = explode('_', $key); echo $catName[1]; ?></h1>
                                    <a href="{{url('category/'.getCategorySlug($catName[0]))}}">See more</a>
                                </div>
                            </div>
                        </div>

                        <div class="product-wrapper">
                            <?php $countForClrFx = 0; ?>
                            @foreach($categoryProducts as $p)

                            <?php
                                    //PriceInfo
                                    $priceInfo = product_price_info($p->id);
                                    if(!isset($priceInfo->price)){
                                        continue;
                                    }

                                    $productPrice = 1;
                                    $discountAmount = 0;
                                    $discountInPercent = 0;

                                    if(isset($priceInfo->price)){
                                        $productPrice = $priceInfo->price;
                                    }

                                    if(isset($priceInfo->discount)){
                                        $discountAmount  = $productPrice / 100 * $priceInfo->discount;
                                        $discountInPercent  = $priceInfo->discount;
                                    }
                                    $afterDiscountedAmount  = $productPrice - $discountAmount;
                                    //end of priceInfo
                                    $countForClrFx++; ?>
                            <div class="col-md-3 col-sm-3">
                                <div class="row pro-contain">
                                    <a href="{{url('product/'.$p->id)}}">
                                        <div class="col-item">
                                            @if($discountAmount > 0)
                                            <div class="shape discount">
                                                <div class="shape-text">
                                                    {{$discountInPercent}}% off
                                                </div>
                                            </div>
                                            @endif
                                            <div class="photo">
                                                <img alt="image" title="{{$p->title}}" class="img-responsive" src="{!! getRandomImageOfProduct($p->id) !!}" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';">
                                            </div>
                                            <div class="info">
                                                <div class="col-md-12">
                                                    <p>{{substr($p->title, 0, 65)}}...</p>
                                                    <div class="price-wrapper">
                                                        <div class="price">
                                                            <h3>{{format_currency($afterDiscountedAmount)}}</h3>
                                                            @if($discountAmount > 0)
                                                                <sub>{{format_currency($productPrice)}}</sub>
                                                            @endif
                                                        </div>

                                                        @if($discountAmount > 0)
                                                            <div class="disc-badge">
                                                                {{$discountInPercent}}% off
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="reviews-wrapper">
                                                        <fieldset class="rating" style="padding-left:5px;padding-top:5px">
                                                            <?php
                                                            $reviewInfo = getProductReviewInfo($p->id);
                                                            ?>
                                                            @if(isset($reviewInfo->rating))
                                                                <?php $count_review = $reviewInfo->count_review; ?>
                                                                @if($reviewInfo->rating == 0)
                                                                    <img class="rated_stars"
                                                                         src="{!! asset('local/public/assets/images/star.png') !!}"
                                                                         alt="Rating"/>
                                                                @endif

                                                                @for($i=1;$i<=$reviewInfo->rating;$i++)
                                                                    <img class="rated_stars"
                                                                         src="{!! asset('local/public/assets/images/rattingstar.png') !!}"
                                                                         alt="Rating"/>
                                                                @endfor

                                                                @for($i=1; $i <= 5 - $reviewInfo->rating; $i++)
                                                                    <img class="rating_stars"
                                                                         src="http://localhost/kinnect2/local/public/assets/images/star.png"
                                                                         alt="Rating">
                                                                @endfor
                                                            @else
                                                                @for($i=1;$i<= 5;$i++)
                                                                    <img class="rated_stars"
                                                                         src="{!! asset('local/public/assets/images/star.png') !!}"
                                                                         alt="Rating"/>
                                                                @endfor
                                                                <?php $count_review = 0;?>
                                                            @endif
                                                        </fieldset>
                                                        <span>({{$count_review}}  Reviews )</span>
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
                                @if($countForClrFx == 4)<div class="clrfix"></div><?php $countForClrFx; ?>@endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section("footer-scripts")
    <script>
        $(".nav_item").click(function(evt) {
            $(".nav_item").removeClass('active');
            $(this).addClass("active");
        });
    </script>
@endsection
@endsection
