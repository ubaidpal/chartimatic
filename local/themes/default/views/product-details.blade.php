@extends('layouts.main')

@section('styles')
<link href="{{getAssetPath()}}/css/material-design-iconic-font.min.css" rel="stylesheet">
@endsection
@section('content')
	<style>
		.disable{
			background-color: #e3e3e3;
			opacity: 0.3;
		}
	</style>

	<div class="col-md-12">
		<div class="row">
			<div class="pro-header">
				@include('includes.breadcrumbs', array('category'=> $productDetail->category_id))
				<?php $category = getCategoryById($productDetail->category_id); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-12">
		<div class="row">
			<div class="product-details clearfix">
				<div class="col-md-4">
					<div class="view-product">
						<img alt="product-image" class="img-responsive"
							 id="zoom_09"
							 data-zoom-image="{{getRandomImageOfProduct($productDetail->id)}}"
							 src="{{getRandomImageOfProduct($productDetail->id)}}" >
					</div>
					<div class="product-thumbnails" id="gallery_09">
						<?php $images = getAllImagesOfProduct($productDetail->id);

						foreach($images as $image){ ?>
						<a class="elevatezoom-gallery" data-update="" data-image="{{$image}}" data-zoom-image="{{$image}}">
							<img width="50" height="44" alt="product-image" class="img-responsive"
								 src="{{$image}}"  onError="this.onerror=null;this.src='<?php echo url('local/storage/app/')?>/product-images/default.jpg';" />
						</a>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-8">
					<div class="product-information">
							<a href="{{url('messages/contact-bidder/'.\Vinkla\Hashids\Facades\Hashids::connection('message')->encode($brand->id))}}">Contact Seller</a>
							<h2>{{$productDetail['title']}}</h2>

							<?php $count = 0; ?>

							<div class="product-colors">
								<div class="color-1">
									<?php $countAttribute = 0; $attributes1 = explode(",", $masterAttribute1)?>
									@foreach($attributes1 as $i)
										<?php $countAttribute++ ?>
										@if(isset($attributes1[0]) and $countAttribute == 1)
											<?php $item = explode('_', $attributes1[0]) ?>
											<span class="title master_attribute1_label">{{(isset($item[1]))?$item[1]:''}}:</span>
										@endif
									@endforeach



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
								<div>
									<?php $countAttribute = 0; $attributes2 = explode(",", $masterAttribute2)?>
									@foreach($attributes2 as $i)
										<?php $countAttribute++ ?>
										@if(isset($attributes2[0]) and $countAttribute == 1)
											<?php $item = explode('_', $attributes2[0]) ?>
											<span class="title master_attribute2_label">{{(isset($item[1]))?$item[1]:''}}:</span>
										@endif
									@endforeach

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

							<?php $allMasterAttributeArray =  explode(',', $allMasterAttribute);?>

							@foreach($allMasterAttributeArray as $i)
								<?php
								$i = explode('_', $i);
								if(!isset($i[1])){continue;}
								?>
								<div class="all-attribute-items" data-discount="{{$i[3]}}"  data-price="{{$i[1]}}" data-quantity="{{$i[2]}}" style="display: none;" id="isExistsAttribute_{{$i[0]}}"></div>
							@endforeach


							<div class="qty-wrapper">
								<span class="title">Quantity:</span>
								<div class="input-group select-qty">
									<div class="qty-btn">
										<button type="button" class="btn bdrL glyphicon-minus-btn" data-type="plus" data-field="product_quatity_<?php echo $productDetail->id ?>">
											<i class="glyphicon glyphicon-minus" data-field="product_quatity_<?php echo $productDetail->id ?>"></i>
										</button>
									</div>
									<input id="product_quatity_{{$productDetail->id}}" type="number" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style="text-align: center;">
									<div class="qty-btn">
										<button type="button" class="btn bdrL glyphicon-plus-btn" data-type="plus" data-field="product_quatity_<?php echo $productDetail->id ?>">
											<i class="glyphicon glyphicon-plus" data-field="product_quatity_<?php echo $productDetail->id ?>"></i>
										</button>
									</div>
								</div>
							</div>

							<div class="total-price">
								<span class="title">Price:</span>
								<span class="actual-price">$
								@if(!$productKeepingDetail)
									<?php $countingForColors = 1;
									$distinctSizes = [];?>
									@foreach($productKeepingDetail as $attr)
										<span @if($countingForColors > 1) style="display: none;"
											  @endif class="total_price {{"price_".preg_replace('/\s+/', '_', $attr->color)."_".preg_replace('/\s+/', '_', $attr->size)}}">{{$attr->price}}</span>
										<?php $countingForColors++; ?>
									@endforeach
								@endif
								</span>
								<span class="cartBtn">
									@if($storeName == (isset(Auth::user()->username)?Auth::user()->username:-1))
										<a class="btn btn-default"
										   href="{{url('/store/'.$storeName.'/admin/edit-product/'.$productDetail['id'])}}">Edit this
											Product</a>
									@else
										@if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) != 2 )
											<button type="button" id="add_in_cart_{{$productDetail['id']}}" class="add_cart btn btn-default add-to-cart"
													data-toggle="modal" data-target="#myModal">
												Add to Cart
											</button>

										@endif
									@endif
								</span>


								<div class="wishlist">
									@if((isset(Auth::user()->user_type)?Auth::user()->user_type:-1) != -1 AND Auth::user()->user_type != 2)
										{!! productFavoriteHtml($productDetail->id) !!}
										<a href="{{ URL::to('wishlist/') }}" class="favourite">View My WishList</a>
									@endif
								</div>
							</div>

							<div>
								<span class="p-title">Payment:</span>
								<span>
									<img data-toggle="modal" data-target="#star" width="250" height="26" src="{!! asset('local/public/assets/bootstrap/images/payment-method.png') !!}" alt="Rating"/>
								</span>
							</div>

							<div class="social-share shipping-wrap">
								<span>Share:</span>
								<div class="share_on_social_media"></div>
							</div>
						</div>
				</div>
			</div>

			<div class="product-desc-wrapper">
				<div class="container">
					<div class="category-tab">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_a" data-toggle="tab">Product Description </a></li>
							<li><a href="#tab_features" data-toggle="tab">Features</a></li>
							<li><a href="#tab_b" data-toggle="tab">Reviews</a></li>
						</ul>
					</div>
					<div class="tab-content">

						<div class="tab-pane active" id="tab_a">
							<div class="col-md-12">
								<div class="row">
									{!! ($productDetail->description != '')?$productDetail->description:'No description is available' !!}
								</div>
							</div>
							<!--<div class="col-md-6">
							  <div class="pro-img"><img alt="promotion banner" class="img-responsive"
														src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg">
							  </div>
							</div>-->
						</div>
						<div class="tab-pane" id="tab_features">
							<div class="col-md-12">
								<div class="row">
									@if($key_feature > 0)
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
						</div>

						<div class="tab-pane" id="tab_b">
							<div class="col-md-12">
								<div class="row">
									<!--Review Here-->

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
					</div><!-- tab content -->
				</div><!-- end of container -->
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					<p class="mt10" style="width: 400px;height: 30px;line-height: normal">A new item has been added to
						your Shopping Cart. You now have <span id="countCartItemText"><strong>1</strong></span> item in
						your Shopping Cart. </p></br>
				</div>
				<div class="modal-footer">
					<div id="loading_icon" style="text-align:center"><img src="{{asset('local/public/assets/images/cartimatic/loading.svg')}}" title="Loading please wait." /> </div>
					<a id="continue_shopping_btn" style="width:150px;  display: none;" class="btn fltL blue mr10 js-modal-close" href="{{url('/')}}">Continue Shopping</a>
					<a id="view_shopping_cart_btn" style="width:150px;background-color:#6ad700; display: none; color:#ffffff;" class="btn fltL blue mr10"
					   href="{{url('cart')}}">View Shopping Cart</a>
				</div>
			</div>
		</div>
	</div>

	<script src="{{getAssetPath()}}/js/jquery.elevatezoom.js"></script>
	<script src="{{getAssetPath()}}/js/select2.full.js"></script>
	<script type="text/javascript">

		$(".glyphicon-minus-btn").click(function(evt){
			var inputId = $(this).data("field");
			var oldValue =  $("#"+inputId).val();
			if(oldValue > 1) {
				$("#" + inputId).val(parseInt(oldValue, 10) - 1);
			}
//			var product_id = inputId.match(/\d+/)[0];
//			quantityUpdate(oldValue, product_id, evt);
		});

		$(".glyphicon-plus-btn").click(function(evt){
			var inputId = $(this).data("field");
			var oldValue =  $("#"+inputId).val();
			$("#"+inputId).val(parseInt(oldValue,10) + 1);
//			var product_id = inputId.match(/\d+/)[0];
//			quantityUpdate(oldValue, product_id, evt);
		});

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
			var quantity = $('#product_quatity_{{$productDetail->id}}').val();
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