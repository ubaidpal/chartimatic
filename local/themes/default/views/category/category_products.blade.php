@extends('layouts.main')

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="pro-header">
                <h1>{{$category->name}}</h1>
                @include('includes.breadcrumbs', array('category'=> $category->id))
            </div>
        </div>
    </div>
    @include('includes.product-filter-sidebar')
    <div class="col-md-9 padding-right">
        <div class="features_items">

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

            <div class="col-md-4 col-xs-6">
                <p>{!! 'Showing '. $from .' to '. $to . ' of '.$allProductRecords->total() !!}</p>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="form-group row">
                    <label>Sort By:</label>
                    {!!  \Form::select('sortingByName', ["title"=> "title", "price" =>"price", "created_at" => "created_at"], (isset($sorting)) ? $sorting : "", ['class' => 'form-control sorting' ,'id' => 'sortingByName'])!!}

                </div>
            </div>
            <div class="col-md-3 col-xs-8">
                <div class="form-group sortSelect">
                    <label>Show:</label>
                    {!!  \Form::select('sortingRecordsNumber', ["25"=>25, "50" =>50, "100" => 100], (isset($perPage)?$perPage:''), ['class' => 'form-control pageSort' ,'id' => 'sortingRecordsNumber'])!!}
                    <label>per page</label>
                </div>
            </div>
            <div class="col-md-2 col-xs-4"></div>
        </div>
            @if($allProductRecords->isEmpty())
            <div class="col-md-12 col-sm-10 col-xs-10">
                <div class="col-item">
                    <span>No item found in this category.</span>
                </div>
            </div>
            @else
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
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{url('product/'.$allProductRecord->id)}}"
                                   title="{!! $allProductRecord->title !!}"><img alt="a"
                                                                                 class="img-responsive"
                                                                                 onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                                                                 src="{{getRandomImageOfProduct($allProductRecord->id)}}"></a>
                                <h2>{{format_currency($afterDiscountedAmount)}}</h2>
                                @if($discountAmount > 0)
                                <p>{{format_currency($productPrice)}}</p>
                                @endif
                                @if($discountAmount > 0)
                                 <p>{{$discountInPercent}}% off</p>
                                @endif
                                <p>{{$allProductRecord->title}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>

                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{format_currency($afterDiscountedAmount)}}</h2>
                                    @if($discountAmount > 0)
                                        <p>{{format_currency($productPrice)}}</p>
                                    @endif
                                    @if($discountAmount > 0)
                                        <p>{{$discountInPercent}}% off</p>
                                    @endif
                                    <p>{!! str_limit(trim($allProductRecord->title), $limit=130, $end="...") !!}</p>
                                    <a href="{{url('view-product/'.$allProductRecord->id)}}" class="btn btn-default">Buy Now</a>
                                </div>
                            </div>

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

            @endif


        </div>
    </div>
    <!--featured categories-->
    <div class="col-md-12">
      <div class="row">
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
                if($childProductsCount == 0){continue;}
              }else{
                $parentProductCount = parentHasProducts($subCategoryItem->id);
                if($parentProductCount == 0){continue;}
              }
              $count++;
              ?>
              <div class="specific-category">
                <div class="col-md-12 col-sm-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="title-box">
                          <h1>{{$subCategoryItem->name}}</h1>
                          <a href="{{url('category/'.$subCategoryItem->slug)}}">See more</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                      <div class="row">
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
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <div class="row">
                                <div class="thumbnail">

                                  <img alt="promotion banner" onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" src="{{getRandomImageOfProductBycatId($subCategory->id)}}">

                                  <div class="caption">
                                    <h3>{{$subCategory->name}}</h3>

                                    <p>@if($childProductsCount != null){{$childProductsCount}}@else {{$childProductsCount}} @endif items</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @endif
        @endif
      </div>
    </div>
@section('footer-scripts')

@endsection
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
