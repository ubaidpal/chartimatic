@extends('layouts.shopper-main')

@section('content')
<section class="main-content">
    <div class="row">
        <div class="span12">
            <div class="pro-header">
                <div class="span9">
                    <h1>{{$category->name}}</h1>
                    @include('includes.breadcrumbs', array('category'=> $category->id))
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="span12">
            <div class="row">
                @include('includes.product-filter-sidebar')
                <div class="span9">
                    <div class="row">
                        <div class="pro-info-header" id="divId">
                            <?php
                            $to = $allProductRecords->currentPage() * $allProductRecords->perPage();
                                if($to > $allProductRecords->total()){
                                    $to = $allProductRecords->total();
                                }
                            if($allProductRecords->currentPage() > 1){
                                $from = ($allProductRecords->currentPage() * $allProductRecords->perPage()) - $allProductRecords->perPage();
                            }else{
                                $from = 1;
                            }

                            ?>

                        <div class="span2">
                            <p>{!! 'Showing '. $from .' to '. $to . ' of '.$allProductRecords->total() !!}</p>
                        </div>
                        <div class="span3">
                            <div class="form-group row">
                                <label>Sort By:</label>
                                {!!  \Form::select('sortingByName', ["title"=> "title", "price" =>"price", "created_at" => "created_at"], (isset($sorting)) ? $sorting : "", ['class' => 'form-control sorting' ,'id' => 'sortingByName'])!!}

                            </div>
                        </div>
                        <div class="span4">
                            <div class="form-group sortSelect">
                                <label>Show:</label>
                                {!!  \Form::select('sortingRecordsNumber', ["25"=>25, "50" =>50, "100" => 100], (isset($perPage)?$perPage:''), ['class' => 'form-control pageSort' ,'id' => 'sortingRecordsNumber'])!!}
                                <label>per page</label>
                            </div>
                        </div>
                    </div>
                        @if($allProductRecords->isEmpty())
                        <style type="text/css">#divId{display:none;}</style>

                        <div>
                                <div class="col-item">
                                    <span style="font-size: 21px;">No item found in this category.</span>
                                </div>
                        </div>
                        @else

                        <div class="product-wrapper">
                        @foreach($allProductRecords as $allProductRecord)
                        <?php
                            //PriceInfo
                            $priceInfo = product_price_info( $allProductRecord->id );
                            if ( ! isset( $priceInfo->price ) ) {
                                continue;
                            }

                            $brandInfo = getBrandInfo( $allProductRecord->owner_id );
                            if(!isset( $brandInfo->username )){
                              continue;
                            }
                            $productPrice = 1;
                            $discountAmount = 0;
                            $discountInPercent = 0;

                            if ( isset( $priceInfo->price ) ) {
                                $productPrice = $priceInfo->price;
                            }

                            if ( isset( $priceInfo->discount ) ) {
                                $discountAmount    = $productPrice / 100 * $priceInfo->discount;
                                $discountInPercent = $priceInfo->discount;
                            }
                            $afterDiscountedAmount = $productPrice - $discountAmount;
                            //end of priceInfo
                            ?>
                            <div class="span3">
                                <div class="row pro-contain">
                                    <div class="product-box">
                                        <p>
                                            <a href="{{url('view-product/'.$allProductRecord->id)}}"
                                               title="{!! $allProductRecord->title !!}"><img alt="a"
                                                                                             class="img-responsive"
                                                                                             onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                                                                             src="{{getRandomImageOfProduct($allProductRecord->id)}}"></a>
                                        </p>
                                        <a href="{{url('view-product/'.$allProductRecord->id)}}" class="title">{{$allProductRecord->title}}</a><br/>
                                        <p class="price">{{format_currency($afterDiscountedAmount)}}</p>
                                        @if($discountAmount > 0)
                                        <p>{{format_currency($productPrice)}}</p>
                                        @endif
                                        @if($discountAmount > 0)
                                            <div class="disc-badge">
                                                {{$discountInPercent}}% off
                                            </div>
                                        @endif
                                        <div class="info">
                                            <div class="col-md-12">
                                                <div class="reviews-wrapper">
                                                    <fieldset class="rating" style="padding-left:5px;padding-top:5px">
                                                        <?php
                                                        $reviewInfo = getProductReviewInfo( $allProductRecord->id );
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
                                                    <span>({{$count_review}} Reviews )</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-more animated fadeInUp">
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-1">
                                                    <a href="{{url('view-product/'.$allProductRecord->id)}}"
                                                       class="btn btn-default">Buy Now</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Social Acitons -->
                                                <div class="action share_on_social_media">
                                                    <div>  <a href="{{url('http://www.facebook.com/sharer/sharer.php?u='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}" target="_blank" class="fb">
                                                        </a> </div>
                                                    <div>  <a href="{{url('http://twitter.com/share?url='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}" target="_blank" class="tw">
                                                        </a></div>
        <div> <a href="{{url('https://plus.google.com/share?url='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}" target="_blank" class="gp">
                                                        </a></div>
                                                </div>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="clrfix"></div>
                        {!! $allProductRecords->render() !!}
                    </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="span12">

            @if(isset($featuredCategories))
              @if(is_object($featuredCategories))
                <?php $count = 0; ?>
                @foreach($featuredCategories as $subCategoryItem)
                  <?php
                  $childProductsCount = null;
                  $parentProductCount = null;
                  if($count > 0){
                    continue;
                  }
                  if(isLeafCategory($subCategoryItem->id) == 0){
                    $childProductsCount = hasProducts($subCategoryItem->id);
                    if($childProductsCount == 0){
                        continue;
                    }
                  }else{
                    $parentProductCount = parentHasProducts($subCategoryItem->id);
                    if($parentProductCount == 0){
                        continue;
                    }
                  }
                  $count++;
                  ?>
                  <div class="specific-category">
                    <div class="">

                        <div class="">
                            <div class="title-box">
                              <h1>{{$subCategoryItem->name}}</h1>
                              <a href="{{url('category/'.$subCategoryItem->slug)}}">See more</a>
                            </div>
                        </div>
                        <div class="">

                            <?php $allSubCategories = getSubCategories($subCategoryItem->id);?>
                            @foreach($allSubCategories as $subCategory)
                              <?php

                              if(isLeafCategory($subCategory->id) == 0){
                                if(hasProducts($subCategory->id) == 0){continue;}
                              }else{
                                if(parentHasProducts($subCategory->id) == 0){continue;}
                              } ?>
                              <?php
                              $childProductsCount = null;
                              $childProductsCount = hasProducts($subCategory->id);
                              if($childProductsCount == 0){continue;}
                              ?>
                              <a href="{{url("category/".strtolower($subCategory->slug ))}}" title="{{ucwords($subCategory->slug)}}">
                                <div class="span3">

                                    <div class="thumbnail">

                                      <img alt="promotion banner" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" src="{{getRandomImageOfProductBycatId($subCategory->id)}}">

                                      <div class="caption">
                                        <h3>{{$subCategory->name}}</h3>

                                        <p>@if($childProductsCount != null){{$childProductsCount}}@else {{$childProductsCount}} @endif items</p>
                                      </div>
                                    </div>
                                </div>
                              </a>
                            @endforeach

                        </div>

                    </div>
                  </div>
                @endforeach
              @endif
            @endif
          </div>
        <div class="clearfix"></div>
    </div>
</section>
@endsection
@section('footer-scripts')
{!! HTML::script('local/public/assets/js/jquery.min.js') !!}
@include('includes.searchQueryScript.searchScript')
<script type="text/javascript">

    $(document).on("change", ".sorting,.pageSort", function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//for token purpose in laravel

        var sorting =   $('.sorting option:selected').text();

        var perPage =  $('.pageSort option:selected').text();
        var url = '{{url('category/'.$category->slug)}}'+ '/' +sorting +'/'+perPage;
        document.location.reload(true);
        window.location = url;

    });

    $(".search-category-products-btn").click(function(evt){
      evt.preventDefault();
      var search_term = $("#srch-term").val();
      var category_id = $("#srch-term").data("categoryId");
      var urlToSubmit = '{{url('category').'/'.$category->slug}}?srch-term='+search_term+'&cat='+category_id;

      window.location.href = urlToSubmit;
    });

    $(document).ready(function(){
        $('.gp').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var href = $(this).attr('href');
            window.open(href, '_blank');
            $("#download-link").show();
        });
    });
    $(document).ready(function(){
        $('.fb').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var href = $(this).attr('href');
            window.open(href, '_blank');
            $("#download-link").show();
        });
    });
    $(document).ready(function(){
        $('.tw').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            var href = $(this).attr('href');
            window.open(href, '_blank');
            $("#download-link").show();
        });
    });


</script>
@endsection
