@extends('layouts.shopin-main')

@section('content')

  @include('includes.breadcrumbs', array('category'=> $productDetail->category_id))

  <div class="single">
    <div class="container">
      <div class="col-md-12">
        <div class="col-md-5 grid">
          <div class="flexslider">
            <ul class="slides">
              <?php $images = getAllImagesOfProduct($productDetail->id);
              foreach($images as $image){ ?>
              <li data-thumb="{{$image}}">
                <div class="thumb-image"> <img src="{{$image}}" data-imagezoom="true" class="img-responsive"> </div>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <?php $category = getCategoryById($productDetail->category_id); ?>

        <div class="col-md-7 single-top-in">
          <div class="span_2_of_a1 simpleCart_shelfItem">
            <h3>{{$productDetail['title']}}</h3>
            <p class="in-para">{{$productDetail['overview']}}</p>

            <!-- variants combination html-->
            <?php $count = 0; ?>
            <div class="p-common-box clearfix">
              <?php $countAttribute = 0; $attributes1 = explode(",", $masterAttribute1)?>
              @foreach($attributes1 as $i)
                <?php $countAttribute++ ?>
                @if(isset($attributes1[0]) and $countAttribute == 1)
                  <?php $item = explode('_', $attributes1[0]) ?>
                  <div class="span1">
                    <div class="row">
                      <span class="title master_attribute1_label">{{(isset($item[1]))?$item[1]:''}}:</span>
                    </div>
                  </div>
                @endif
              @endforeach

              <div class="span3">
                <div class="row">
                  <div class="size-wraper">
                    <?php $countAttribute = 0; $alreadyIncludedAttribute = ''; ?>
                    @foreach($attributes1 as $i)
                      <?php
                      $item = explode('_', $i); $countAttribute++;
                      if(!isset($item[1])){continue;}
                      if (strpos($alreadyIncludedAttribute, $item[2].'_'.$item[3]) !== false) {continue;}
                      $alreadyIncludedAttribute .= $item[2].'_'.$item[3].',';
                      ?>
                      <a href="javascript:void(0);" id="atrr1_{{$item[2]}}"
                         class="cs-item cart_product_color_selection master_attribute_1 @if($countAttribute == 1) active @endif">{{$item[3]}}</a>
                    @endforeach
                  </div>
                </div>
              </div>

              <?php $countAttribute = 0; $attributes2 = explode(",", $masterAttribute2)?>
              @foreach($attributes2 as $i)
                <?php $countAttribute++ ?>
                @if(isset($attributes2[0]) and $countAttribute == 1)
                  <?php $item = explode('_', $attributes2[0]) ?>
                  <div class="span1">
                    <div class="row">
                      <span class="title master_attribute2_label">{{(isset($item[1]))?$item[1]:''}}:</span>
                    </div>
                  </div>
                @endif
              @endforeach

              <div class="span3">
                <div class="row">
                  <div class="size-wraper">
                    <?php $countAttribute = 0; $alreadyIncludedAttribute = ''; ?>
                    @foreach($attributes2 as $i)
                      <?php
                      $item = explode('_', $i); $countAttribute++;
                      if(!isset($item[1])){continue;}
                      if (strpos($alreadyIncludedAttribute, $item[2].'_'.$item[3]) !== false) {continue;}
                      $alreadyIncludedAttribute .= $item[2].'_'.$item[3].',';
                      ?>
                      <a href="javascript:void(0);" id="atrr2_{{$item[2]}}"
                         class="cs-item cart_product_color_selection master_attribute_2 @if($countAttribute == 1) active @endif">{{$item[3]}}</a>
                    @endforeach
                  </div>
                </div>
              </div>

            </div>
            <!-- /variants combination html-->
            <div class="product_stock add-cart-box" style="position: absolute; right: 999999999999999999999px;">

              <div class="price-range">
                <div class="off">$ 18,510</div>
                <div class="range"><sub>/piece</sub></div>
                <div class="stock">
                  <span class="isQtyAvailable"></span>
                </div>
              </div>
              <div class="cartBtn">
                @if($storeName == (isset(Auth::user()->username)?Auth::user()->username:-1))
                  <a class="btn btn-default"
                     href="{{url('/store/'.$storeName.'/admin/edit-product/'.$productDetail['id'])}}">Edit this
                    Product</a>
                @else
                  @if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) != 2 )
                    <button type="button" id="add_in_cart_{{$productDetail['id']}}" class="btn btn-inverse add_cart"
                            data-toggle="modal" data-target="#myModal">
                      Add to Cart
                    </button>
                    <button type="button" id="" class="btn btn-inverse mt10 btn-green">buy it now</button>
                    @if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) == 2))
                    <button type="button" id="" class="btn btn-default"> Buyer can buy this
                    </button>
                    @endif

                  @endif
                @endif
              </div>
            </div>

            <div class="price_single">
              <span class="reducedfrom item_price actual-price">$140.00</span>
              <a href="#">click for offer</a>
              <div class="clearfix"></div>
            </div>
            <h4 class="quick">Quick Overview:</h4>
            <p class="quick_desc">{!! str_limit($productDetail['description'], 250, '...') !!}</p>
            <div class="wish-list">
              <ul>
                <li class="wish"><a href="#"><span class="glyphicon glyphicon-check" aria-hidden="true"></span>Add to
                    Wishlist</a></li>
                <li class="compare"><a href="#"><span class="glyphicon glyphicon-resize-horizontal"
                                                      aria-hidden="true"></span>Add to Compare</a></li>
              </ul>
            </div>
            <div class="quantity">
              <div class="quantity-select">
                <div class="entry value-minus">&nbsp;</div>
                <div class="entry value"><span>1</span></div>
                <div class="entry value-plus active">&nbsp;</div>
              </div>
            </div>
            <!--quantity-->
            <script>
              $('.value-plus').on('click', function () {
                var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) + 1;
                divUpd.text(newVal);
              });

              $('.value-minus').on('click', function () {
                var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10) - 1;
                if (newVal >= 1) divUpd.text(newVal);
              });
            </script>
            <!--quantity-->

            <a href="#" class="add-to item_add hvr-skew-backward">Add to cart</a>
            <div class="clearfix"></div>
          </div>

        </div>
        <div class="clearfix"></div>
        <!---->
        <div class="tab-head">
          <nav class="nav-sidebar">
            <ul class="nav tabs">
              <li class="active"><a href="#tab1" data-toggle="tab">Product Description</a></li>
              <li class=""><a href="#tab2" data-toggle="tab">Features</a></li>
              <li class=""><a href="#tab3" data-toggle="tab">Reviews</a></li>
            </ul>
          </nav>
          <div class="tab-content one">
            <div class="tab-pane active text-style" id="tab1">
              <div class="facts">
                {!! $productDetail['description'] !!}
              </div>

            </div>
            <div class="tab-pane text-style" id="tab2">

              <div class="facts">@if($key_feature > 0)
                  <?php $featuresCount = 0; ?>
                  @foreach($key_feature as $key_features)
                    <ul>
                      <?php
                      $featuresCount++;

                      /*if ($featuresCount > 3) {
                        continue;
                      }*/
                      ?>
                      <li>{{ucwords(trim($key_features->title, ':')).': '}}<strong>{{ucwords($key_features->detail)}}</strong></li>
                    </ul>
                  @endforeach
                @else
                  <ul>No feature was added.</ul>
                @endif
              </div>

            </div>
            <div class="tab-pane text-style" id="tab3">

              <div class="facts"><!--Review Here-->
                @if(is_array($reviews))
                  @foreach($reviews as $review)
                    <?php if (!isset($review->description)) {
                      continue;
                    } ?>
                    <p>{{$review->description}}</p>
                    <span>{{$review->updated_at}}</span>
                    <?php $Owner = getUserDetail($review->owner_id); ?>
                    <span>{{$Owner->displayname}}</span>
                    <?php
                    $logged_in_user_id = -1;
                    if( isset(Auth::user()->id)){
                      $logged_in_user_id = Auth::user()->id;
                    } ;?>
                    @if($review->owner_id == $logged_in_user_id)
                      <img data-toggle="modal" data-target="#star" width="25" height="25"
                           src="{!! asset('local/public/assets/images/edit.png') !!}"
                           alt="Rating"/>
                      <div id="star" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                        {!! Form::open(array('method'=> 'post','url'=> "updateReview/".$review->id)) !!}
                        <!-- Modal content-->
                          <div class="modal-content">

                            <div class="modal-body">
                              <p>Description</p>
                              <span><input class="form-control" type="text" name="desc" value="{{$review->description}}"/></span>

                              <div>
                                <input type="text" style="display: none" id="stars_rating" name="stars_rating">
                                <img class="rating_stars"
                                     src="{!! asset('local/public/assets/images/star.png') !!}"
                                     alt="Rating"/>
                                <img class="rating_stars"
                                     src="{!! asset('local/public/assets/images/star.png') !!}"
                                     alt="Rating"/>
                                <img class="rating_stars"
                                     src="{!! asset('local/public/assets/images/star.png') !!}"
                                     alt="Rating"/>
                                <img class="rating_stars"
                                     src="{!! asset('local/public/assets/images/star.png') !!}"
                                     alt="Rating"/>
                                <img class="rating_stars"
                                     src="{!! asset('local/public/assets/images/star.png') !!}"
                                     alt="Rating"/>
                              </div>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Save Review</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    @endif
                    @if($review->rating == 0)
                      <img class="rated_stars"
                           src="{!! asset('local/public/assets/images/star.png') !!}" alt="Rating"/>
                    @endif
                    @for($i=1;$i<=$review->rating;$i++)
                      <img class="rated_stars"
                           src="{!! asset('local/public/assets/images/rattingstar.png') !!}"
                           alt="Rating"/>
                    @endfor
                    @for($i=1; $i <= 5 - $review->rating; $i++)
                      <img class="rated_stars"
                           src="{!! asset('local/public/assets/images/star.png') !!}"
                           alt="Rating">
                    @endfor
                  @endforeach
                @else
                  Not rated yet
                @endif
              </div>

            </div>

          </div>
          <div class="clearfix"></div>
        </div>
        <!---->
      </div>
      <!----->

      <div class="clearfix"></div>
    </div>
  </div>

  <div class="container">
    <div class="brand">
      <div class="col-md-3 brand-grid">
        <img src="{{getAssetPath($theme)}}/images/ic.png" class="img-responsive" alt="">
      </div>
      <div class="col-md-3 brand-grid">
        <img src="{{getAssetPath($theme)}}/images/ic1.png" class="img-responsive" alt="">
      </div>
      <div class="col-md-3 brand-grid">
        <img src="{{getAssetPath($theme)}}/images/ic2.png" class="img-responsive" alt="">
      </div>
      <div class="col-md-3 brand-grid">
        <img src="{{getAssetPath($theme)}}/images/ic3.png" class="img-responsive" alt="">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <script src="{{getAssetPath()}}/js/jquery.elevatezoom.js"></script>
  <script src="{{getAssetPath()}}/js/select2.full.js"></script>
  <script type="text/javascript">
    $("#zoom_09").elevateZoom({
      gallery : "gallery_09",
      galleryActiveClass: "active"
    });
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
    $(document).on("click", ".learn-more", function (e) {
      e.preventDefault();
      var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
      $("body").append(appendthis);
      jQuery('body').css('overflow', 'hidden');
      // $('body').css({'overflow-y': 'scroll', 'position': 'fixed', 'width': '100%'});

      $(".modal-overlay").fadeTo(500, 0.7);
      var product_id = e.target.id;
      $(".learn-more-btn").attr("id", 'popup2-' + product_id);
      $(".learn-more-btn").show();

      $('#no').click(function () {
        $('body').css({'overflow-y': 'auto', 'position': 'static', 'width': 'auto'});
        $(".modal-box, .modal-overlay").fadeOut(500, function () {
          $(".modal-overlay").remove();
        });
        $(".learn-more-btn").hide();
        return false;
      });

    });

    $('.rating_stars').hover(
        // Handles the mouseover
        function () {
          $(this).prevAll().andSelf().attr("src", "{!! asset('local/public/assets/images/rattingstar.png') !!}");
          $(this).nextAll().attr("src", "{!! asset('local/public/assets/images/star.png') !!}");
        },
        // Handles the mouseout
        function () {
          $(this).prevAll().andSelf().attr("src", "{!! asset('local/public/assets/images/rattingstar.png') !!}");
        },

        $('.rating_stars').click(function () {
          var count = $(this).prevAll().length;
          document.getElementById("stars_rating").value = count;
          var var1 = document.getElementById("stars_rating").value;

        })
    );

    jQuery(document).on('click', '.cart_del', function (e) {
      e.preventDefault();
      var url = jQuery(this).attr('href');
      jQuery.ajax({
        url: url,
      }).done(function (data) {
        jQuery('.add_cart_container').css('display', '');
        jQuery('.remove_cart_container').css('display', 'none');
        updateCartCounter(data.total_items);
      });
    });

    jQuery(document).on('click', '.add_cart', function (e) {
      e.preventDefault();
      var validationErr = false;
      var url      = window.location.href;
      var token = '';
      if (url.toLowerCase().indexOf("?token=") >= 0){
        token = url.split("?token=")[1];
      }

      var master_attribute_1 = $(".cs-item.active.master_attribute_1").attr("id");
      var master_attribute_1_label = $(".master_attribute1_label").html();
      var master_attribute_1_value = $(".cs-item.active.master_attribute_1").html();

      if (typeof master_attribute_1 === 'undefined') {
      } else {
        master_attribute_1 = master_attribute_1.split("_")[1];
      }

      var master_attribute_2       = $(".cs-item.active.master_attribute_2").attr("id");
      var master_attribute_2_label = $(".master_attribute2_label").html();
      var master_attribute_2_value = $(".cs-item.active.master_attribute_2").html();

      if (typeof master_attribute_2 === 'undefined') {
      } else {
        master_attribute_2 = master_attribute_2.split("_")[1];
      }

      var id = e.target.id;

      id = id.match(/\d+/)[0];
      //var quantity = $('#productQtyValueForCart').val();
      var quantity = 1;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $("#loading_icon").show();
      $("#continue_shopping_btn").hide();
      $("#view_shopping_cart_btn").hide();

      jQuery.ajax({
        url: '{{url('store/cart/add-product/')}}',
        type: "Post",
        data: {token:token, product_id: id, quantity: quantity, master_attribute_1: master_attribute_1, master_attribute_2: master_attribute_2, master_attribute_1_label: master_attribute_1_label, master_attribute_1_value: master_attribute_1_value, master_attribute_2_label: master_attribute_2_label, master_attribute_2_value: master_attribute_2_value},

        success: function (data) {
          $("#loading_icon").hide();
          $("#continue_shopping_btn").show();
          $("#view_shopping_cart_btn").show();

          if (data.message == 'quantity_overflow') {
            jQuery('#quantity_overflow').addClass('error').text(data.message_text);
          } else {
            jQuery('#quantity_overflow').removeClass('error').text('In Stock');
            jQuery('.add_cart_container').css('display', 'none');
            jQuery('.remove_cart_container').css('display', '');
            updateCartCounter(data.total_items)

            var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
            $("body").append(appendthis);
            //$('body').css({'overflow-y': 'scroll', 'position': 'fixed', 'width': '100%'});
            jQuery('body').css('overflow', 'hidden');
            $(".modal-overlay").fadeTo(500, 0.7);
            var brandStoreUrl = '{{url('store/')}}';

            $("#countCartItemText").html('<strong>' + data.total_items + '</strong>');
            $(".cart").show();
            return false;
          }


        }, error: function (xhr, ajaxOptions, thrownError) {
          alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
      });

    });
    jQuery(document).on('change', 'input[name="quantity_update"]', function (e) {
      quantityUpdate();
    });

    var timer = null;
    function quantityUpdate() {
      window.clearTimeout(timer);
      timer = window.setTimeout(function () {
        updateProductQuantity();
      }, 500);
    }
    ;

    updateProductQuantity = function () {
      var quantity = $('input[name="quantity_update"]').val();

      var dataString = {
        quantity: quantity,
        product_id: '{{$productDetail['id']}}'
      };

      $.ajax({
        type: 'POST',
        url: '{{url('store/cart/quantityUpdate')}}',
        data: dataString,
        success: function (response) {
          if (response.message == 'quantity_overflow') {
            jQuery('#quantity_overflow').addClass('error').text(response.message_text);
          } else {
            jQuery('#quantity_overflow').removeClass('error').text('In Stock');
            updateCartCounter(response.total_items);
          }
        }
      });
    };
    updateCartCounter = function (total) {
      if (total > 0) {
        $("#the_cart").html('<span class="skore">' + total + '</span>');
      } else {
        $("#the_cart").html('');
      }
    };


    //JS Related to feed options, like,dislike, share etc
    var ajaxPathPrefix = "{{url('')}}";

    function likePost(id) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/likeStatus/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_liked") {
            $(".").removeClass("")
          }
        },
        error: function (x, t, m) {

        }
      };
      $.ajax(params);
    }

    function dislikePost(id, $ele) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/dislikeStatus/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_disliked") {
            $('.feed-options .like-post').removeClass('active');
            $ele.addClass('active');
            $('.likes-count').text(response.likes.like_count + ' Likes');
            $('.dislikes-count').text(response.likes.dislike_count + ' Dislikes');
          }
        },
        error: function (x, t, m) {

        }
      };
      $.ajax(params);
    }

    function unlikePost(id, $ele) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/unlikeStatus/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_unliked") {
            $ele.removeClass('active');
            $('.likes-count').text(response.likes.like_count + ' Likes');
          }
        },
        error: function (x, t, m) {

        }
      };
      $.ajax(params);
    }


    function likePost(id, $ele) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/likeStatus/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_liked") {
            $('.feed-options .dislike-post').removeClass('active');
            $ele.addClass('active');
            $('.likes-count').text(response.likes.like_count + ' Likes');
            $('.dislikes-count').text(response.likes.dislike_count + ' Dislikes');
          }
        },
        error: function (x, t, m) {

        }
      };

      $.ajax(params);
    }
    function unDoDislikePost(id, $ele) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/undoDislike/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "undone_unlike") {

            $ele.removeClass('active');
            $('.dislikes-count').text(response.likes.dislike_count + ' Dislikes');
          }
        },
        error: function (x, t, m) {

        }
      };

      $.ajax(params);
    }


    function makeFavourite(id, el) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/makeActivityFavourite/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_fav") {
            el.addClass("active");
          }
        },
        error: function (x, t, m) {
          alert("Error in Unliking post");
        }

      };
      $.ajax(params);
    }

    function undoPostFavourite(id, el) {
      var requestData = {
        "id": id
      };
      var params = {
        url: ajaxPathPrefix + "/removeActivityFavourite/" + id,
        type: "GET",
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
        data: requestData,
        success: function (response) {
          if (response.message == "status_unfav") {
            el.removeClass("active");
          }
        },
        error: function (x, t, m) {
          alert("Error in Unliking post");
        }

      };
      $.ajax(params);
    }


    function reSharePost(options) {
      var requestData = {
        "text": options.text,
        "object_id": options.object_id,
        "object_type": options.object_type,
      };

      var params = {
        url: ajaxPathPrefix + "/shareActivity",
        type: "POST",
        //contentType: 'application/json; charset=utf-8',
        //dataType: 'json',
        data: requestData,
        beforeSend: function (xhr) {
          $(".modal-box, .modal-overlay").fadeOut(500, function () {
            jQuery('textarea.share-product-pp-txt').val('');
            $(".modal-overlay").remove();
          });
        },
        success: function (response) {
          if (response.message == "status_shared") {

          } else {
            alert((response.message).replace('_', ' '));
          }
        },
        error: function (x, t, m) {
        }

      };
      $.ajax(params);
    }

    $(document).ready(function () {
      var reference = $(".feed-options").data("action");
      $(".feed-options .like-post").click(function () {
        var $this = $(this);
        if ($this.hasClass('active')) {
          unlikePost(reference, $this)
        } else {
          likePost(reference, $this)
        }

      });

      $(".feed-options .dislike-post").click(function () {
        var $this = $(this);
        if ($this.hasClass('active')) {
          unDoDislikePost(reference, $this)
        } else {
          dislikePost(reference, $this)
        }

      });


      $(".feed-options .favourite-post").click(function () {
        var $this = $(this);
        if (!$this.hasClass('active')) {
          makeFavourite(reference, $this)
        } else {
          undoPostFavourite(reference, $this)
        }
      });


      //////////////////

      $(function () {
        var isoCountries = [
          {id: 'AF', text: 'Afghanistan'},
          {id: 'AX', text: 'Aland Islands'},
          {id: 'AL', text: 'Albania'},
          {id: 'DZ', text: 'Algeria'},
          {id: 'AS', text: 'American Samoa'},
          {id: 'AD', text: 'Andorra'},
          {id: 'AO', text: 'Angola'},
          {id: 'AI', text: 'Anguilla'},
          {id: 'AQ', text: 'Antarctica'},
          {id: 'AG', text: 'Antigua And Barbuda'},
          {id: 'AR', text: 'Argentina'},
          {id: 'AM', text: 'Armenia'},
          {id: 'AW', text: 'Aruba'},
          {id: 'AU', text: 'Australia'},
          {id: 'AT', text: 'Austria'},
          {id: 'AZ', text: 'Azerbaijan'},
          {id: 'BS', text: 'Bahamas'},
          {id: 'BH', text: 'Bahrain'},
          {id: 'BD', text: 'Bangladesh'},
          {id: 'BB', text: 'Barbados'},
          {id: 'BY', text: 'Belarus'},
          {id: 'BE', text: 'Belgium'},
          {id: 'BZ', text: 'Belize'},
          {id: 'BJ', text: 'Benin'},
          {id: 'BM', text: 'Bermuda'},
          {id: 'BT', text: 'Bhutan'},
          {id: 'BO', text: 'Bolivia'},
          {id: 'BA', text: 'Bosnia And Herzegovina'},
          {id: 'BW', text: 'Botswana'},
          {id: 'BV', text: 'Bouvet Island'},
          {id: 'BR', text: 'Brazil'},
          {id: 'IO', text: 'British Indian Ocean Territory'},
          {id: 'BN', text: 'Brunei Darussalam'},
          {id: 'BG', text: 'Bulgaria'},
          {id: 'BF', text: 'Burkina Faso'},
          {id: 'BI', text: 'Burundi'},
          {id: 'KH', text: 'Cambodia'},
          {id: 'CM', text: 'Cameroon'},
          {id: 'CA', text: 'Canada'},
          {id: 'CV', text: 'Cape Verde'},
          {id: 'KY', text: 'Cayman Islands'},
          {id: 'CF', text: 'Central African Republic'},
          {id: 'TD', text: 'Chad'},
          {id: 'CL', text: 'Chile'},
          {id: 'CN', text: 'China'},
          {id: 'CX', text: 'Christmas Island'},
          {id: 'CC', text: 'Cocos (Keeling) Islands'},
          {id: 'CO', text: 'Colombia'},
          {id: 'KM', text: 'Comoros'},
          {id: 'CG', text: 'Congo'},
          {id: 'CD', text: 'Congo}, Democratic Republic'},
          {id: 'CK', text: 'Cook Islands'},
          {id: 'CR', text: 'Costa Rica'},
          {id: 'CI', text: 'Cote D\'Ivoire'},
          {id: 'HR', text: 'Croatia'},
          {id: 'CU', text: 'Cuba'},
          {id: 'CY', text: 'Cyprus'},
          {id: 'CZ', text: 'Czech Republic'},
          {id: 'DK', text: 'Denmark'},
          {id: 'DJ', text: 'Djibouti'},
          {id: 'DM', text: 'Dominica'},
          {id: 'DO', text: 'Dominican Republic'},
          {id: 'EC', text: 'Ecuador'},
          {id: 'EG', text: 'Egypt'},
          {id: 'SV', text: 'El Salvador'},
          {id: 'GQ', text: 'Equatorial Guinea'},
          {id: 'ER', text: 'Eritrea'},
          {id: 'EE', text: 'Estonia'},
          {id: 'ET', text: 'Ethiopia'},
          {id: 'FK', text: 'Falkland Islands (Malvinas)'},
          {id: 'FO', text: 'Faroe Islands'},
          {id: 'FJ', text: 'Fiji'},
          {id: 'FI', text: 'Finland'},
          {id: 'FR', text: 'France'},
          {id: 'GF', text: 'French Guiana'},
          {id: 'PF', text: 'French Polynesia'},
          {id: 'TF', text: 'French Southern Territories'},
          {id: 'GA', text: 'Gabon'},
          {id: 'GM', text: 'Gambia'},
          {id: 'GE', text: 'Georgia'},
          {id: 'DE', text: 'Germany'},
          {id: 'GH', text: 'Ghana'},
          {id: 'GI', text: 'Gibraltar'},
          {id: 'GR', text: 'Greece'},
          {id: 'GL', text: 'Greenland'},
          {id: 'GD', text: 'Grenada'},
          {id: 'GP', text: 'Guadeloupe'},
          {id: 'GU', text: 'Guam'},
          {id: 'GT', text: 'Guatemala'},
          {id: 'GG', text: 'Guernsey'},
          {id: 'GN', text: 'Guinea'},
          {id: 'GW', text: 'Guinea-Bissau'},
          {id: 'GY', text: 'Guyana'},
          {id: 'HT', text: 'Haiti'},
          {id: 'HM', text: 'Heard Island & Mcdonald Islands'},
          {id: 'VA', text: 'Holy See (Vatican City State)'},
          {id: 'HN', text: 'Honduras'},
          {id: 'HK', text: 'Hong Kong'},
          {id: 'HU', text: 'Hungary'},
          {id: 'IS', text: 'Iceland'},
          {id: 'IN', text: 'India'},
          {id: 'ID', text: 'Indonesia'},
          {id: 'IR', text: 'Iran}, Islamic Republic Of'},
          {id: 'IQ', text: 'Iraq'},
          {id: 'IE', text: 'Ireland'},
          {id: 'IM', text: 'Isle Of Man'},
          {id: 'IL', text: 'Israel'},
          {id: 'IT', text: 'Italy'},
          {id: 'JM', text: 'Jamaica'},
          {id: 'JP', text: 'Japan'},
          {id: 'JE', text: 'Jersey'},
          {id: 'JO', text: 'Jordan'},
          {id: 'KZ', text: 'Kazakhstan'},
          {id: 'KE', text: 'Kenya'},
          {id: 'KI', text: 'Kiribati'},
          {id: 'KR', text: 'Korea'},
          {id: 'KW', text: 'Kuwait'},
          {id: 'KG', text: 'Kyrgyzstan'},
          {id: 'LA', text: 'Lao People\'s Democratic Republic'},
          {id: 'LV', text: 'Latvia'},
          {id: 'LB', text: 'Lebanon'},
          {id: 'LS', text: 'Lesotho'},
          {id: 'LR', text: 'Liberia'},
          {id: 'LY', text: 'Libyan Arab Jamahiriya'},
          {id: 'LI', text: 'Liechtenstein'},
          {id: 'LT', text: 'Lithuania'},
          {id: 'LU', text: 'Luxembourg'},
          {id: 'MO', text: 'Macao'},
          {id: 'MK', text: 'Macedonia'},
          {id: 'MG', text: 'Madagascar'},
          {id: 'MW', text: 'Malawi'},
          {id: 'MY', text: 'Malaysia'},
          {id: 'MV', text: 'Maldives'},
          {id: 'ML', text: 'Mali'},
          {id: 'MT', text: 'Malta'},
          {id: 'MH', text: 'Marshall Islands'},
          {id: 'MQ', text: 'Martinique'},
          {id: 'MR', text: 'Mauritania'},
          {id: 'MU', text: 'Mauritius'},
          {id: 'YT', text: 'Mayotte'},
          {id: 'MX', text: 'Mexico'},
          {id: 'FM', text: 'Micronesia}, Federated States Of'},
          {id: 'MD', text: 'Moldova'},
          {id: 'MC', text: 'Monaco'},
          {id: 'MN', text: 'Mongolia'},
          {id: 'ME', text: 'Montenegro'},
          {id: 'MS', text: 'Montserrat'},
          {id: 'MA', text: 'Morocco'},
          {id: 'MZ', text: 'Mozambique'},
          {id: 'MM', text: 'Myanmar'},
          {id: 'NA', text: 'Namibia'},
          {id: 'NR', text: 'Nauru'},
          {id: 'NP', text: 'Nepal'},
          {id: 'NL', text: 'Netherlands'},
          {id: 'AN', text: 'Netherlands Antilles'},
          {id: 'NC', text: 'New Caledonia'},
          {id: 'NZ', text: 'New Zealand'},
          {id: 'NI', text: 'Nicaragua'},
          {id: 'NE', text: 'Niger'},
          {id: 'NG', text: 'Nigeria'},
          {id: 'NU', text: 'Niue'},
          {id: 'NF', text: 'Norfolk Island'},
          {id: 'MP', text: 'Northern Mariana Islands'},
          {id: 'NO', text: 'Norway'},
          {id: 'OM', text: 'Oman'},
          {id: 'PK', text: 'Pakistan'},
          {id: 'PW', text: 'Palau'},
          {id: 'PS', text: 'Palestinian Territory, Occupied'},
          {id: 'PA', text: 'Panama'},
          {id: 'PG', text: 'Papua New Guinea'},
          {id: 'PY', text: 'Paraguay'},
          {id: 'PE', text: 'Peru'},
          {id: 'PH', text: 'Philippines'},
          {id: 'PN', text: 'Pitcairn'},
          {id: 'PL', text: 'Poland'},
          {id: 'PT', text: 'Portugal'},
          {id: 'PR', text: 'Puerto Rico'},
          {id: 'QA', text: 'Qatar'},
          {id: 'RE', text: 'Reunion'},
          {id: 'RO', text: 'Romania'},
          {id: 'RU', text: 'Russian Federation'},
          {id: 'RW', text: 'Rwanda'},
          {id: 'BL', text: 'Saint Barthelemy'},
          {id: 'SH', text: 'Saint Helena'},
          {id: 'KN', text: 'Saint Kitts And Nevis'},
          {id: 'LC', text: 'Saint Lucia'},
          {id: 'MF', text: 'Saint Martin'},
          {id: 'PM', text: 'Saint Pierre And Miquelon'},
          {id: 'VC', text: 'Saint Vincent And Grenadines'},
          {id: 'WS', text: 'Samoa'},
          {id: 'SM', text: 'San Marino'},
          {id: 'ST', text: 'Sao Tome And Principe'},
          {id: 'SA', text: 'Saudi Arabia'},
          {id: 'SN', text: 'Senegal'},
          {id: 'RS', text: 'Serbia'},
          {id: 'SC', text: 'Seychelles'},
          {id: 'SL', text: 'Sierra Leone'},
          {id: 'SG', text: 'Singapore'},
          {id: 'SK', text: 'Slovakia'},
          {id: 'SI', text: 'Slovenia'},
          {id: 'SB', text: 'Solomon Islands'},
          {id: 'SO', text: 'Somalia'},
          {id: 'ZA', text: 'South Africa'},
          {id: 'GS', text: 'South Georgia And Sandwich Isl.'},
          {id: 'ES', text: 'Spain'},
          {id: 'LK', text: 'Sri Lanka'},
          {id: 'SD', text: 'Sudan'},
          {id: 'SR', text: 'Suriname'},
          {id: 'SJ', text: 'Svalbard And Jan Mayen'},
          {id: 'SZ', text: 'Swaziland'},
          {id: 'SE', text: 'Sweden'},
          {id: 'CH', text: 'Switzerland'},
          {id: 'SY', text: 'Syrian Arab Republic'},
          {id: 'TW', text: 'Taiwan'},
          {id: 'TJ', text: 'Tajikistan'},
          {id: 'TZ', text: 'Tanzania'},
          {id: 'TH', text: 'Thailand'},
          {id: 'TL', text: 'Timor-Leste'},
          {id: 'TG', text: 'Togo'},
          {id: 'TK', text: 'Tokelau'},
          {id: 'TO', text: 'Tonga'},
          {id: 'TT', text: 'Trinidad And Tobago'},
          {id: 'TN', text: 'Tunisia'},
          {id: 'TR', text: 'Turkey'},
          {id: 'TM', text: 'Turkmenistan'},
          {id: 'TC', text: 'Turks And Caicos Islands'},
          {id: 'TV', text: 'Tuvalu'},
          {id: 'UG', text: 'Uganda'},
          {id: 'UA', text: 'Ukraine'},
          {id: 'AE', text: 'United Arab Emirates'},
          {id: 'GB', text: 'United Kingdom'},
          {id: 'US', text: 'United States'},
          {id: 'UM', text: 'United States Outlying Islands'},
          {id: 'UY', text: 'Uruguay'},
          {id: 'UZ', text: 'Uzbekistan'},
          {id: 'VU', text: 'Vanuatu'},
          {id: 'VE', text: 'Venezuela'},
          {id: 'VN', text: 'Viet Nam'},
          {id: 'VG', text: 'Virgin Islands}, British'},
          {id: 'VI', text: 'Virgin Islands}, U.S.'},
          {id: 'WF', text: 'Wallis And Futuna'},
          {id: 'EH', text: 'Western Sahara'},
          {id: 'YE', text: 'Yemen'},
          {id: 'ZM', text: 'Zambia'},
          {id: 'ZW', text: 'Zimbabwe'}
        ];

        function formatCountry(country) {
          if (!country.id) {
            return country.text;
          }
          var $country = $(
              '<span data-iso="' + country.id.toLowerCase() + '" class="flag-icon flag-icon-' + country.id.toLowerCase() + ' flag-icon-squared"></span>' +
              '<span class="flag-text">' + country.text + "</span>"
          );
          return $country;
        };

        //Assuming you have a select element with name country
        // e.g. <select name="name"></select>
        $("[name='country']").select2({
          placeholder: "Select a country",
          templateResult: formatCountry,
          data: isoCountries
        });

        $("[name='country']").on("change", function (e) {
          console.log($("[name='country']").val());
          var product_id = {{$productDetail['id']}} ;

          var params = {
            url: "{{url('store/checkProductShippingCountryByISO')}}",
            type: "POST",
            data: {
              products_ids: [product_id],
              country_iso: $("[name='country']").val()
            },
            success: function (response) {
              //if($.inArray( ""+product_id, response.allowedProducts )){
              if ($.inArray("" + product_id, response.allowedProducts) != -1) {
                $("#shipping-error").hide();
                $(".add_cart").removeClass("disabled");
              } else {
                $(".add_cart").addClass("disabled");
                $("#shipping-error").show();
              }
            },
            error: function (x, t, m) {
              $(".add_cart").addClass("disabled");
              $("#shipping-error").show();
            }
          };
          $.ajax(params);

          $(".select2-selection__rendered").prepend('<span class="flag-custom mr10 flag-icon flag-icon-' + $("[name='country']").val().toLowerCase() + ' flag-icon-squared"></span>')


        });


        $("[name='country']").val("{{ ($user["country"])? $user["country"]->iso : ""}}").trigger("change")


      });


      /////////////////////

    });


    jQuery(document).on('click', '.share-post-kinnct', function (e) {
      e.preventDefault();
      var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
      $("body").append(appendthis);

      $(".modal-overlay").fadeTo(500, 0.7);

      jQuery('#share-product-post').show();
    });
    jQuery(document).on('click', '#confirm', function (e) {
      e.preventDefault();
      var shareText = $.trim($(".share-product-pp-txt").val());
      var reference = $(".feed-options").data("action");
      if (shareText) {
        reSharePost({
          text: shareText,
          object_id: reference,
          object_type: "product"
        });
      }

    });

    jQuery(document).on('input', '#product_quatity_<?php echo $productDetail->id ?>', function (e) {
      var qtyToCheck = $("#product_quatity_<?php echo $productDetail->id ?>").val();

      jQuery.ajax({
        url: '{{url('cart/product-quantity-check')}}',
        type: "Post",
        data: {product_id: '<?php echo $productDetail->id ?>', qtyToCheck: qtyToCheck},

        success: function (data) {
          if (data <= 0) {
            $('#error').show();
            $('#quantity_overflow').hide();
            return false;
          } else {
            $('#error').hide();
            $('#quantity_overflow').show();
          }


        }, error: function (xhr, ajaxOptions, thrownError) {
          alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
      });
    });

    function changeProductAttributes(){
      var attributeToBeCheckedId = '';
      $(".cart_product_color_selection").removeClass("disable");
      $(".cart_product_color_selection").each(function () {
        $(this).show();

        if ($(this).hasClass('active')) {
          var id = $(this).attr('id').split("_")[1];
          attributeToBeCheckedId +=id;
        }

      });

      var item = $("#isExistsAttribute_"+attributeToBeCheckedId);

      var price = item.data("price");
      var quantity = item.data("quantity");
      var discount = item.data("discount");

      if(typeof price == 'undefined'){
        $(".cart_product_color_selection").each(function () {
          if ($(this).hasClass('active')) {
            $(this).addClass('disable');
          }
        });
        price = 0.00;
      }
      //alert("This is selected product price: "+price+" and quantity remaining is "+ quantity);

      $(".range").html(price.toFixed(2)+"<sub> /piece</sub>");
      $(".off").html("");
      var discountedAmount = price.toFixed(2);

      $(".actual-price").html("$ "+discountedAmount);

      //original price in case of discount
      if(discount > 0){
        $(".off").html("$ "+price.toFixed(2));
        discountedAmount = price - (price / 100) * discount;
        $(".range").html("$ "+discountedAmount.toFixed(2)+"<sub> /piece</sub>");
        $(".actual-price").html("$ "+discountedAmount.toFixed(2));
      }

      $(".isQtyAvailable").html('<span class="available">Not In stock</span>');
      $(".add_cart").hide();

      if(quantity > 0){
        $(".add_cart").show();
        $(".isQtyAvailable").html('<span class="available">In stock</span>');
      }

    }

    $(".master_attribute_1").click(function (event) {

      var idAttribute = event.target.id;

      $(".master_attribute_1").removeClass('active');
      $("#"+idAttribute).addClass('active');

      idAttribute = idAttribute.split("_");
      changeProductAttributes();
    });

    $(".master_attribute_2").click(function (event) {

      var idAttribute = event.target.id;

      $(".master_attribute_2").removeClass('active');
      $("#"+idAttribute).addClass('active');

      idAttribute = idAttribute.split("_");
      changeProductAttributes();
    });


    $("#productQtyValueForCart").keyup(function (event) {
      var totalInCart = $("#productQtyValueForCart").val();

      if (totalInCart < 1) {
        return false;
      }

      var totalInStock = $("#product_qty_available").html();

      if (totalInCart > totalInStock) {
        return false;
      }

      totalInStock = totalInStock.match(/\d+/)[0];

      $("#product_qty_available").html(totalInStock - totalInCart);

    });

    $(".addRemoveQtyFromCart").click(function (event) {
      var updateCartRemoveAdd = event.target.id;

      var totalInCart = $("#productQtyValueForCart").val();
      var totalInStock = $("#product_qty_available").html();
      //totalInStock = totalInStock.match(/\d+/)[0];

      if (updateCartRemoveAdd === "remove_product_qty_for_cart") {
        if (totalInCart < 2) {
          return false;
        }

        $("#productQtyValueForCart").val(totalInCart - 1);
        $("#product_qty_available").html(+totalInStock + +1);
      }

      if (updateCartRemoveAdd === "add_product_qty_for_cart") {
        if (totalInStock == 0) {
          return false;
        }
        totalInCart = +totalInCart + +1;
        totalInStock = totalInStock - 1;

        $("#productQtyValueForCart").val(totalInCart);
        $("#product_qty_available").html(totalInStock);

      }

    });

    changeProductAttributes();
    $(".returnToLink").click(function () {
      var targetLink = $( ".breadcrumb li:nth-last-child(2)").html();
      targetLink = targetLink.split('"')[1];
      $(".returnToLink").attr("href", targetLink);
    });

    $(".search-category-products-btn").click(function(evt){
      evt.preventDefault();
      var search_term = $("#srch-term").val();
      var category_id = $("#srch-term").data("categoryId");
      var urlToSubmit = '{{url('category').'/'.$category->slug}}?srch-term='+search_term+'&cat='+category_id;

      window.location.href = urlToSubmit;
    });


    <!-- Script for share on social media -->
    /* HOW TO USE (for more information > adobewordpress.com)

     You do not need to do any development. This script will collect your page title and url automatically.

     Remove comments from line 7 and 33. Write your Twitter username to line 9. At last go to line 32 and change div.border to body. Everything is ready. Enjoy! */

    // if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

    var twitterUser = '@cartimatic'; /* Your Twitter Username */

    // No need to change anything else :)

    var shareURL = '{{url('product/'.$productDetail->id)}}';
    var shareTitle = document.getElementsByTagName("title")[0].innerHTML.replace(/\s/g, '');
    var shareTweetdata = shareTitle + ' ' + twitterUser + ' ';

    // If Font Awesome not included to project, we create related link tag inside of <head></head> elements.
    document.fonts.ready.then(function() {
      if (document.fonts.check('1em "FontAwesome"') != true) {
        $('head').append('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">');
      }
    });

    var dataList = '<section class="socialShare">' +
        '<a class="fb" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + shareURL + '"><i class="zmdi zmdi-facebook"></i></a>' +
        '<a class="tw" target="_blank" href="https://twitter.com/intent/tweet?text=' + shareTweetdata + '&amp;url=' + shareURL + '"><i class="zmdi zmdi-twitter"></i></a>' +
        '<a class="pt" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + shareURL + '"><i class="zmdi zmdi-pinterest"></i></a>' +
        '<a class="inst" target="_blank" href="https://twitter.com/intent/tweet?text=' + shareTweetdata + '&amp;url=' + shareURL + '"><i class="zmdi zmdi-instagram"></i></a>' +
        '<a class="share" target="_blank" href="https://twitter.com/intent/tweet?text=' + shareTweetdata + '&amp;url=' + shareURL + '"><i class="zmdi zmdi-share"></i></a>' +


        //'<a class="gp" target="_blank" href="https://www.google.com/shareArticle?mini=true&amp;url=' + shareURL + '&amp;title=' + shareTitle + '"></a>'+
        '</section>';

    $('div.share_on_social_media').append(dataList);
    // }

    /* DEMO */
    if(parent==top) {
      $('a.article').show();
    }
    <!-- End of Script for share on social media -->
  </script>
@endsection

@section('footer-scripts')
  <script src="{{getAssetPath($theme)}}/js/imagezoom.js"></script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script defer src="{{getAssetPath($theme)}}/js/jquery.flexslider.js"></script>
  <link rel="stylesheet" href="{{getAssetPath($theme)}}/css/flexslider.css" type="text/css" media="screen"/>

  <script>
    // Can also be used with $(document).ready()
    $(window).load(function () {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
    });
  </script>

  <script src="{{getAssetPath($theme)}}/js/simpleCart.min.js"></script>
  <!-- slide -->
  <script src="{{getAssetPath($theme)}}/js/bootstrap.min.js"></script>
@endsection
