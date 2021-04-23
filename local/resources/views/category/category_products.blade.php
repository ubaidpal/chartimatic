@extends('layouts.default')

@section('content')
  <div class="col-md-12">
    <div class="row">
      <div class="pro-header">
        <div class="col-md-9">
          <div class="row">
            <h1>{{$category->name}}</h1>
            @include('includes.breadcrumbs', array('category'=> $category->id))
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <form class="navbar-form p0 category-search" role="search">
              <div class="input-group add-on">
                <div class="input-group-btn">
                  <button class="btn btn-default search-category-products-btn" type="submit"></button>
                </div>
                <input type="text" class="form-control" data-category-id="{{$category->id}}" name="srch-term"
                       placeholder="Search in {{$category->name}}" value="{{(isset($search_term)?$search_term:'')}}"
                       id="srch-term">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.product-filter-sidebar')
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="pro-info-header" id="divId">
  <?php
  $to = $allProductRecords->currentPage() * $allProductRecords->perPage();
  ($to > $allProductRecords->total())? $to = $allProductRecords->total():'';
  ($allProductRecords->currentPage() > 1)? $from = ($allProductRecords->currentPage() * $allProductRecords->perPage()) - $allProductRecords->perPage():$from = 1;      ?>

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
            <style type="text/css"> #divId { display: none; }</style>
            <div class="col-md-12 col-sm-10 col-xs-10">
              <div class="col-item">
                <span style="font-size: 21px;">No item found in this category.</span>
              </div>
            </div>
          @else
            <?php $countProductsDisplayed = 1; ?>
            <div class="product-wrapper">
              @foreach($allProductRecords as $allProductRecord)

                <?php
                $priceInfo = product_price_info($allProductRecord->id);
                if(!isset($priceInfo->price)) {
                  continue;
                }

                $brandInfo = getBrandInfo($allProductRecord->owner_id);
                if (!isset($brandInfo->username)) {
                  continue;
                }
                $productPrice = 1;
                $discountAmount = 0;
                $discountInPercent = 0;

                if (isset($priceInfo->price)) {
                  $productPrice = $priceInfo->price;
                }

                if (isset($priceInfo->discount)) {
                  $discountAmount    = $productPrice / 100 * $priceInfo->discount;
                  $discountInPercent = $priceInfo->discount;
                }
                $afterDiscountedAmount = $productPrice - $discountAmount;
                //end of priceInfo
                ?>
                <?php    $i=0;
                if($i%3==0&&$i!=0)  ?>
                  <div class="col-md-4 col-sm-4 col-xs-6">
                  <div class="row pro-contain">
                    <div class="col-item">
                      @if($discountAmount > 0)
                        <div class="shape discount">
                          <div class="shape-text">
                            {{$discountInPercent}}% off
                          </div>
                        </div>
                      @endif
                      <div class="photo">
                        <a href="{{url('product/'.$allProductRecord->id)}}"
                           title="{!! $allProductRecord->title !!}"><img alt="a"
                                                                         class="img-responsive"
                                                                         onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                                                         src="{{getRandomImageOfProduct($allProductRecord->id)}}"></a>
                      </div>
                      <div class="b-name">
                        <?php $brandUserName = (isset($brandInfo->username)) ? $brandInfo->username : 'deleted'; ?>
                        <a href="{{url('store/'.$brandUserName)}}">
                          <h1>{{getStoreName($allProductRecord->owner_id)}}</h1>
                        </a>
                      </div>
                      <div class="info">
                        <div class="col-md-12">
                          <p class="collapse_description">{!! str_limit(trim($allProductRecord->title), $limit=75, $end="...") !!}</p>

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
                              $reviewInfo = getProductReviewInfo($allProductRecord->id);
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
                            <a href="{{url('product/'.$allProductRecord->id)}}"
                               class="btn btn-default">Buy Now</a>
                          </div>
                        </div>
                      </div>

                      <!-- Social Acitons -->
                      <div class="action share_on_social_media">
                        <div>
                        @if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) != -1 AND Auth::user()->user_type != 2)
                            {!! productFavoriteCategory($allProductRecord->id) !!}
                         @endif
                         {{-- <a href="#" target="_blank" class="fav"></a>--}}
                        </div>
                        <div>
                          <a href="{{url('http://www.facebook.com/sharer/sharer.php?u='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}"
                             target="_blank" class="fb">
                          </a>
                        </div>
                        <div>
                          <a href="{{url('http://twitter.com/share?url='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}"
                             target="_blank" class="tw">
                          </a>
                        </div>
                        <div>
                          <a href="{{url('https://plus.google.com/share?url='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}" target="_blank" class="pit"></a>
                        </div>

                        <div>
                          <a href="{{url('http://pinterest.com/pin/create/button/?url='.Config::get('constant_notifications.SHARE_URL.SHARE').$allProductRecord->id)}}" target="_blank" class="pit"></a>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
                  <?php    $i += 1;?>
                <?php $countProductsDisplayed++ ?>
                @if($countProductsDisplayed > 3)
                <div class="clrfix"></div>
                <?php $countProductsDisplayed=1; ?>
                @endif

              @endforeach
            </div>
            <div class="clrfix"></div>
            {!! $allProductRecords->render() !!}
        </div>
        @endif
      </div>
    </div>
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
            if ($count > 0) {
              continue;
            }
            if (isLeafCategory($subCategoryItem->id) == 0) {
              $childProductsCount = hasProducts($subCategoryItem->id);
              if ($childProductsCount == 0) {
                continue;
              }
            } else {
              $parentProductCount = parentHasProducts($subCategoryItem->id);
              if ($parentProductCount == 0) {
                continue;
              }
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

                        if (isLeafCategory($subCategory->id) == 0) {
                          if (hasProducts($subCategory->id) == 0) {
                            continue;
                          }
                        } else {
                          if (parentHasProducts($subCategory->id) == 0) {
                            continue;
                          }
                        } ?>
                        <?php
                        $childProductsCount = null;
                        $childProductsCount = hasProducts($subCategory->id);
                        if ($childProductsCount == 0) {
                          continue;
                        }
                        ?>
                        <a href="{{url("category/".strtolower($subCategory->slug ))}}"
                           title="{{ucwords($subCategory->slug)}}">
                          <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="row">
                              <div class="thumbnail">

                                <img alt="promotion banner"
                                     onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';"
                                     src="{{getRandomImageOfProductBycatId($subCategory->id)}}">

                                <div class="caption">
                                  <h3>{{$subCategory->name}}</h3>

                                  <p>@if($childProductsCount != null){{$childProductsCount}}@else {{$childProductsCount}} @endif
                                    items</p>
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
<script>

  $(document).on("change", ".sorting,.pageSort", function (e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });//for token purpose in laravel

    var sorting = $('.sorting option:selected').text();

    var perPage = $('.pageSort option:selected').text();
    var url = '{{url('category/'.$category->slug)}}' + '/' + sorting + '/' + perPage;
    document.location.reload(true);
    window.location = url;

  });

  $(".search-category-products-btn").click(function (evt) {
    evt.preventDefault();
    var search_term = $("#srch-term").val();
    var category_id = $("#srch-term").data("categoryId");
    var urlToSubmit = '{{url('category').'/'.$category->slug}}?srch-term=' + search_term + '&cat=' + category_id;

    window.location.href = urlToSubmit;
  });

  $(document).ready(function () {
    $('.gp').click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      var href = $(this).attr('href');
      window.open(href, '_blank');
      $("#download-link").show();
    });
  });
  $(document).ready(function () {
    $('.fb').click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      var href = $(this).attr('href');
      window.open(href, '_blank');
      $("#download-link").show();
    });
  });
  $(document).ready(function () {
    $('.tw').click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      var href = $(this).attr('href');
      window.open(href, '_blank');
      $("#download-link").show();
    });
  });




  $(document).on("click", ".product-favorite-btn", function (evt) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });//for token purpose in laravel
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
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });//for token purpose in laravel
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
