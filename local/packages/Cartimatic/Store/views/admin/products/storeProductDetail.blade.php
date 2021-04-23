@extends('layouts.default')

@section('content')

	<div class="col-md-12">
		<div class="row">
			<div class="pro-header">
				<div class="col-md-9">
					<div class="row">
						@include('includes.breadcrumbs', array('category'=> $productDetail->category_id))
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<form class="navbar-form p0 m0" role="search">
							<div class="input-group add-on">
								<input type="text" class="form-control" placeholder="Search in laptops" name="srch-term" id="srch-term">
								<div class="input-group-btn">
									<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="row">
			<div class="product-detial-box">
				<div class="col-md-5">
					<div class="row">
						<img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/images/cartimatic/product-large-image.jpg">
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="product-info">
							<h1>{{$productDetail['title']}}</h1>
							<div class="ref">
								view all products by <a href="#">{{getStoreName($productDetail['owner_id'])}}</a>
							</div>

							<div class="social-share">
								<div class="col-md-3">
									<div class="row">
										<label>Share</label>
									</div>
								</div>
								<div class="col-md-9">
									<a href="#" class="fb"></a>
									<a href="#" class="tw"></a>
									<a href="#" class="yt"></a>
									<a href="#" class="vi"></a>
									<a href="#" class="gp"></a>

								</div>
							</div>

							<div class="shipping-wrap">
								<div class="col-md-3">
									<div class="row">
										<span class="title">Shipping:</span>
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="courier-price">$21.84 to Pakistan via DHL</div>
										<p>Estimated Delivery Time: 4-8 days (ships out within 7 business days)</p>
									</div>
								</div>
							</div>

							<?php $count = 0; ?>

							<div class="p-common-box">
								<div class="col-md-3">
									<div class="row">
										<span class="title">Color:</span>
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="size-wraper">
											@if($productKeepingDetail)
												<?php $countingForColors = 0;
												$distinctColors = [];?>
												@foreach($productKeepingDetail as $attr)
													<?php $countingForColors++;
													if(isset($attr->color)){
													if( !in_array($attr->color, $distinctColors) ){
													$distinctColors = array_merge([$attr->color], $distinctColors);
													?>
													<a href="javascript:void(0);" id="{{$attr->color}}_{{$attr->id}}" class="cs-item cart_product_color_selection  @if($countingForColors == 1) active @endif">{{$attr->color}}</a>
													<?php
													}
													}
													?>
												@endforeach
											@endif
										</div>
									</div>
								</div>

								<div class="col-md-3">
									<div class="row">
										<span class="title">Size:</span>
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="size-wraper">
											@if($productKeepingDetail)
												<?php $countingForColors = 0;
												$distinctSizes = [];?>
												@foreach($productKeepingDetail as $attr)
													<?php $countingForColors++;
													if(isset($attr->size)){
													if( !in_array($attr->size, $distinctSizes) ){
													$distinctSizes = array_merge([$attr->size], $distinctSizes);
													?>
													<a href="javascript:void(0);" id="{{$attr->size}}_{{$attr->id}}" class="cs-item cart_product_size_selection  @if($countingForColors == 1) active @endif">{{$attr->size}}</a>
													<?php
													}
													}
													?>
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>


							<div class="p-common-box">
								<div class="col-md-3">
									<div class="row">
										<span class="title">Total Price:</span>
									</div>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="actual-price">$
											@if($productKeepingDetail)
												<?php $countingForColors = 1;
												$distinctSizes = [];?>
												@foreach($productKeepingDetail as $attr)
													<span @if($countingForColors > 1) style="display: none;" @endif class="total_price {{"price_".$attr->color."_".$attr->size}}">{{$attr->price}}</span>
													<?php $countingForColors++; ?>
												@endforeach
											@endif
										</div>
									</div>
									{!! productFavoriteHtml($productDetail->id) !!}
									<a href="{{ URL::to('viewWishList/'.$productDetail->id) }}"
									   class="favourite">View My WishList</a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="cart-detail-wrapper">
						<div class="returnTo"><span>&gt;</span>&nbsp; Return to the <a href="#">Product List</a></div>

						<div class="add-cart-box">
							<div class="price-range">
								<div class="off">$ 18,510</div>
								<div class="range">$1200.00 - 1900.00 <sub>/piece</sub></div>
								<div class="stock"><span class="available">In stock</span></div>
							</div>

							<div class="btn-cart">
								@if($storeName == Auth::user()->username)
									<a class="btn btn-default" href="{{url('/store/'.$storeName.'/admin/edit/product/'.$productDetail['id'])}}">Edit this Product</a>
								@else
									@if($productDetail->quantity > 0)
										<button type="button" id="add_in_cart_{{$productDetail['id']}}" class="btn btn-default add_cart" data-toggle="modal" data-target="#myModal">
											Add to Cart
										</button>
										{{-- <a class="add_cart" id="add_in_cart_{{$productDetail['id']}}" href="#">Add to Cart</a>--}}
									@endif
								@endif
								<span>Guranted Seller</span>
							</div>
						</div>

						<div class="refund-wrapper">
							<div class="refund full">
								<strong>Full Refund</strong>
								<span>If you don't receive your order</span>
							</div>
							<div class="refund partial">
								<strong>Full or Partial Refund</strong>
								<span>If the item is not as described</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="product-desc-wrapper">
				<div class="container">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_a" data-toggle="tab">Product Description </a></li>
						<li><a href="#tab_b" data-toggle="tab">Reviews</a></li>
						<li><a href="#tab_c" data-toggle="tab">SHIPPMENT AND PAYMENT</a></li>
						<li><a href="#tab_d" data-toggle="tab">SELLER GUARANTEES</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_a">
							<div class="col-md-6">
								<div class="row">
									{{$productDetail->description}}
								</div>
							</div>
							<div class="col-md-6">
								<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
							</div>
						</div>
						<div class="tab-pane" id="tab_b">
							<div class="col-md-6">
								<div class="row">
									<p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt.</p>
									<ul>
										<li>^ Length: 74cm</li>
										<li>^ Regular fit</li>
										<li>^ Notched lapels</li>
										<li>^ Twin button front fastening</li>
										<li>^ Front patch pockets; chest pocket</li>
										<li>^ Please refer to the garment for care instructions.</li>
										<li>^ Length: 74cm</li>
										<li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
							</div>
						</div>
						<div class="tab-pane" id="tab_c">
							<div class="col-md-6">
								<div class="row">
									<p>The River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2�? (189cm) tall with a 38�? (96 cm) chest and a 31�? (78 cm) waist.</p>
									<ul>
										<li>^ Length: 74cm</li>
										<li>^ Regular fit</li>
										<li>^ Notched lapels</li>
										<li>^ Twin button front fastening</li>
										<li>^ Front patch pockets; chest pocket</li>
										<li>^ Centre-back vent</li>
										<li>^ Please refer to the garment for care instructions.</li>
										<li>^ Length: 74cm</li>
										<li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
							</div>
						</div>
						<div class="tab-pane" id="tab_d">
							<div class="col-md-6">
								<div class="row">
									<p>The River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2�? (189cm) tall with a 38�? (96 cm) chest and a 31�? (78 cm) waist.</p>
									<ul>
										<li>^ Length: 74cm</li>
										<li>^ Regular fit</li>
										<li>^ Notched lapels</li>
										<li>^ Twin button front fastening</li>
										<li>^ Front patch pockets; chest pocket</li>
										<li>^ Centre-back vent</li>
										<li>^ Please refer to the garment for care instructions.</li>
										<li>^ Length: 74cm</li>
										<li>^ Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="pro-img"><img alt="promotion banner" class="img-responsive" src="http://localhost/shalmi/local/public/assets/bootstrap/images/desc-img.jpg"></div>
							</div>
						</div>
					</div><!-- tab content -->
				</div><!-- end of container -->
			</div>
		</div>
	</div>

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
					<a style="width:150px;" class="btn fltL blue mr10 js-modal-close" href="#">Continue Shopping</a>
					<a style="width:150px;background-color:#6ad700" class="btn fltL blue mr10"
					   href="{{url('store/cart')}}">View Shopping Cart</a>
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="{{url("local/public/js/select2.min.js")}}"></script>
	<script>

		$(document).on("click", ".product-favorite-btn", function(evt){
			evt.preventDefault();
			var product_id = evt.target.id;
			var imgSrc = "{!! asset('local/public/images/loading.gif') !!}";
			$(".product-favorite-wrap").append('<img src="'+imgSrc+'" title="loading" alt="loading..."/>');
			if(product_id > 0) {
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
		$(document).on("click", ".product-un-favorite-btn", function(evt){
			evt.preventDefault();
			var product_id = evt.target.id;
			var imgSrc = "{!! asset('local/public/images/loading.gif') !!}";
			$(".product-favorite-wrap").append('<img src="'+imgSrc+'" title="loading" alt="loading..."/>');
			if(product_id > 0){
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
			jQuery('body').css('overflow','hidden');
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
				function() {
					$(this).prevAll().andSelf().attr("src" , "{!! asset('local/public/assets/images/rattingstar.png') !!}");
					$(this).nextAll().attr("src" , "{!! asset('local/public/assets/images/star.png') !!}");
				},
				// Handles the mouseout
				function() {
					$(this).prevAll().andSelf().attr("src" , "{!! asset('local/public/assets/images/rattingstar.png') !!}");
				},

				$('.rating_stars').click(function(){
					var count =  $(this).prevAll().length;
					document.getElementById("stars_rating").value = count;
					var var1= document.getElementById("stars_rating").value;
				})
		);

		jQuery(document).on('click','.cart_del',function (e) {
			e.preventDefault();
			var url = jQuery(this).attr('href');
			jQuery.ajax({
				url : url,
			}).done(function (data) {
				jQuery('.add_cart_container').css('display','');
				jQuery('.remove_cart_container').css('display','none');
				updateCartCounter(data.total_items);
			});
		});

		jQuery(document).on('click', '.add_cart', function (e) {
			e.preventDefault();
			var validationErr = false;
			if($(e.target).hasClass("disabled")){
				validationErr = true;
			}

			if($(".cart_product_size_selection").length > 0 && $(".cart_product_size_selection.active").length < 1){
				validationErr = true;
				$(".size-error").show();
			}else{
				$(".size-error").hide();
			}


			if($(".cart_product_color_selection").length > 0 && $(".cart_product_color_selection.active").length < 1){
				validationErr = true;
				$(".color-error").show();
			}else{
				$(".color-error").hide();
			}

			if(validationErr){
				return false;
			}


			var productColorId = $(".cs-item.active.cart_product_color_selection").attr("id");

			if (typeof productColorId === 'undefined') {
			}else{
				productColorId     = productColorId.match(/\d+/)[0];
			}

			var productSizeId = $(".cs-item.active.cart_product_size_selection").attr("id");

			if (typeof productSizeId === 'undefined') {
			}else{
				productSizeId     = productSizeId.match(/\d+/)[0];
			}

			var id = e.target.id;

			id = id.match(/\d+/)[0];
			//var quantity = $('#productQtyValueForCart').val();
			var quantity = 1;

			jQuery.ajax({
				url: '{{url('store/cart/add-product/')}}',
				type: "Post",
				data: {product_id: id, quantity: quantity, productSizeId: productSizeId, productColorId: productColorId},

				success: function (data) {
					if(data.message == 'quantity_overflow'){
						jQuery('#quantity_overflow').addClass('error').text(data.message_text);
					}else {
						jQuery('#quantity_overflow').removeClass('error').text('In Stock');
						jQuery('.add_cart_container').css('display', 'none');
						jQuery('.remove_cart_container').css('display', '');
						updateCartCounter(data.total_items)

						var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
						$("body").append(appendthis);
						//$('body').css({'overflow-y': 'scroll', 'position': 'fixed', 'width': '100%'});
						jQuery('body').css('overflow','hidden');
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
		jQuery(document).on('change','input[name="quantity_update"]',function (e) {
			quantityUpdate();
		});

		var timer = null;
		function quantityUpdate(){
			window.clearTimeout(timer);
			timer = window.setTimeout(function() {
				updateProductQuantity();
			}, 500);
		};

		updateProductQuantity = function () {
			var quantity =$('input[name="quantity_update"]').val();

			var dataString = {
				quantity: quantity,
				product_id: '{{$productDetail['id']}}'
			};

			$.ajax({
				type: 'POST',
				url: '{{url('store/cart/quantityUpdate')}}',
				data: dataString,
				success: function (response) {
					if(response.message == 'quantity_overflow'){
						jQuery('#quantity_overflow').addClass('error').text(response.message_text);
					}else {
						jQuery('#quantity_overflow').removeClass('error').text('In Stock');
						updateCartCounter(response.total_items);
					}
				}
			});
		};
		updateCartCounter = function (total) {
			if(total > 0) {
				$("#the_cart").html('<span class="skore">' + total + '</span>');
			}else{
				$("#the_cart").html('');
			}
		};


		//JS Related to feed options, like,dislike, share etc
		var ajaxPathPrefix = "{{url('')}}";

		function likePost(id){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/likeStatus/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_liked"){
						$(".").removeClass("")
					}
				},
				error: function (x, t, m) {

				}
			};
			$.ajax(params);
		}

		function dislikePost(id, $ele){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/dislikeStatus/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_disliked"){
						$('.feed-options .like-post').removeClass('active');
						$ele.addClass('active');
						$('.likes-count').text(response.likes.like_count+' Likes');
						$('.dislikes-count').text(response.likes.dislike_count+' Dislikes');
					}
				},
				error: function (x, t, m) {

				}
			};
			$.ajax(params);
		}

		function unlikePost(id, $ele){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/unlikeStatus/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_unliked"){
						$ele.removeClass('active');
						$('.likes-count').text(response.likes.like_count+' Likes');
					}
				},
				error: function (x, t, m) {

				}
			};
			$.ajax(params);
		}


		function likePost(id, $ele){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/likeStatus/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_liked"){
						$('.feed-options .dislike-post').removeClass('active');
						$ele.addClass('active');
						$('.likes-count').text(response.likes.like_count+' Likes');
						$('.dislikes-count').text(response.likes.dislike_count+' Dislikes');
					}
				},
				error: function (x, t, m) {

				}
			};

			$.ajax(params);
		}
		function unDoDislikePost(id, $ele){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/undoDislike/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "undone_unlike"){

						$ele.removeClass('active');
						$('.dislikes-count').text(response.likes.dislike_count+' Dislikes');
					}
				},
				error: function (x, t, m) {

				}
			};

			$.ajax(params);
		}


		function makeFavourite(id, el){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/makeActivityFavourite/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_fav"){
						el.addClass("active");
					}
				},
				error: function (x, t, m) {
					alert("Error in Unliking post");
				}

			};
			$.ajax(params);
		}

		function undoPostFavourite(id, el){
			var requestData = {
				"id": id
			};
			var params = {
				url: ajaxPathPrefix+"/removeActivityFavourite/"+id,
				type: "GET",
				contentType: 'application/json; charset=utf-8',
				dataType: 'json',
				data: requestData,
				success: function (response) {
					if(response.message == "status_unfav"){
						el.removeClass("active");
					}
				},
				error: function (x, t, m) {
					alert("Error in Unliking post");
				}

			};
			$.ajax(params);
		}


		function reSharePost(options){
			var requestData = {
				"text" : options.text,
				"object_id" : options.object_id,
				"object_type" : options.object_type,
			};

			var params = {
				url: ajaxPathPrefix+"/shareActivity",
				type: "POST",
				//contentType: 'application/json; charset=utf-8',
				//dataType: 'json',
				data: requestData,
				beforeSend : function(xhr){
					$(".modal-box, .modal-overlay").fadeOut(500, function () {
						jQuery('textarea.share-product-pp-txt').val('');
						$(".modal-overlay").remove();
					});
				},
				success: function (response) {
					if(response.message == "status_shared"){

					}else {
						alert((response.message).replace('_',' '));
					}
				},
				error: function (x, t, m) {
				}

			};
			$.ajax(params);
		}

		$(document).ready(function(){
			var reference = $(".feed-options").data("action");
			$(".feed-options .like-post").click(function(){
				var $this = $(this);
				if($this.hasClass('active')){
					unlikePost(reference, $this)
				}else{
					likePost(reference, $this)
				}

			});

			$(".feed-options .dislike-post").click(function(){
				var $this = $(this);
				if($this.hasClass('active')){
					unDoDislikePost(reference, $this)
				}else{
					dislikePost(reference, $this)
				}

			});


			$(".feed-options .favourite-post").click(function(){
				var $this = $(this);
				if(!$this.hasClass('active')){
					makeFavourite(reference, $this)
				}else{
					undoPostFavourite(reference, $this)
				}
			});



			//////////////////

			$(function() {
				var isoCountries = [
					{ id: 'AF', text: 'Afghanistan'},
					{ id: 'AX', text: 'Aland Islands'},
					{ id: 'AL', text: 'Albania'},
					{ id: 'DZ', text: 'Algeria'},
					{ id: 'AS', text: 'American Samoa'},
					{ id: 'AD', text: 'Andorra'},
					{ id: 'AO', text: 'Angola'},
					{ id: 'AI', text: 'Anguilla'},
					{ id: 'AQ', text: 'Antarctica'},
					{ id: 'AG', text: 'Antigua And Barbuda'},
					{ id: 'AR', text: 'Argentina'},
					{ id: 'AM', text: 'Armenia'},
					{ id: 'AW', text: 'Aruba'},
					{ id: 'AU', text: 'Australia'},
					{ id: 'AT', text: 'Austria'},
					{ id: 'AZ', text: 'Azerbaijan'},
					{ id: 'BS', text: 'Bahamas'},
					{ id: 'BH', text: 'Bahrain'},
					{ id: 'BD', text: 'Bangladesh'},
					{ id: 'BB', text: 'Barbados'},
					{ id: 'BY', text: 'Belarus'},
					{ id: 'BE', text: 'Belgium'},
					{ id: 'BZ', text: 'Belize'},
					{ id: 'BJ', text: 'Benin'},
					{ id: 'BM', text: 'Bermuda'},
					{ id: 'BT', text: 'Bhutan'},
					{ id: 'BO', text: 'Bolivia'},
					{ id: 'BA', text: 'Bosnia And Herzegovina'},
					{ id: 'BW', text: 'Botswana'},
					{ id: 'BV', text: 'Bouvet Island'},
					{ id: 'BR', text: 'Brazil'},
					{ id: 'IO', text: 'British Indian Ocean Territory'},
					{ id: 'BN', text: 'Brunei Darussalam'},
					{ id: 'BG', text: 'Bulgaria'},
					{ id: 'BF', text: 'Burkina Faso'},
					{ id: 'BI', text: 'Burundi'},
					{ id: 'KH', text: 'Cambodia'},
					{ id: 'CM', text: 'Cameroon'},
					{ id: 'CA', text: 'Canada'},
					{ id: 'CV', text: 'Cape Verde'},
					{ id: 'KY', text: 'Cayman Islands'},
					{ id: 'CF', text: 'Central African Republic'},
					{ id: 'TD', text: 'Chad'},
					{ id: 'CL', text: 'Chile'},
					{ id: 'CN', text: 'China'},
					{ id: 'CX', text: 'Christmas Island'},
					{ id: 'CC', text: 'Cocos (Keeling) Islands'},
					{ id: 'CO', text: 'Colombia'},
					{ id: 'KM', text: 'Comoros'},
					{ id: 'CG', text: 'Congo'},
					{ id: 'CD', text: 'Congo}, Democratic Republic'},
					{ id: 'CK', text: 'Cook Islands'},
					{ id: 'CR', text: 'Costa Rica'},
					{ id: 'CI', text: 'Cote D\'Ivoire'},
					{ id: 'HR', text: 'Croatia'},
					{ id: 'CU', text: 'Cuba'},
					{ id: 'CY', text: 'Cyprus'},
					{ id: 'CZ', text: 'Czech Republic'},
					{ id: 'DK', text: 'Denmark'},
					{ id: 'DJ', text: 'Djibouti'},
					{ id: 'DM', text: 'Dominica'},
					{ id: 'DO', text: 'Dominican Republic'},
					{ id: 'EC', text: 'Ecuador'},
					{ id: 'EG', text: 'Egypt'},
					{ id: 'SV', text: 'El Salvador'},
					{ id: 'GQ', text: 'Equatorial Guinea'},
					{ id: 'ER', text: 'Eritrea'},
					{ id: 'EE', text: 'Estonia'},
					{ id: 'ET', text: 'Ethiopia'},
					{ id: 'FK', text: 'Falkland Islands (Malvinas)'},
					{ id: 'FO', text: 'Faroe Islands'},
					{ id: 'FJ', text: 'Fiji'},
					{ id: 'FI', text: 'Finland'},
					{ id: 'FR', text: 'France'},
					{ id: 'GF', text: 'French Guiana'},
					{ id: 'PF', text: 'French Polynesia'},
					{ id: 'TF', text: 'French Southern Territories'},
					{ id: 'GA', text: 'Gabon'},
					{ id: 'GM', text: 'Gambia'},
					{ id: 'GE', text: 'Georgia'},
					{ id: 'DE', text: 'Germany'},
					{ id: 'GH', text: 'Ghana'},
					{ id: 'GI', text: 'Gibraltar'},
					{ id: 'GR', text: 'Greece'},
					{ id: 'GL', text: 'Greenland'},
					{ id: 'GD', text: 'Grenada'},
					{ id: 'GP', text: 'Guadeloupe'},
					{ id: 'GU', text: 'Guam'},
					{ id: 'GT', text: 'Guatemala'},
					{ id: 'GG', text: 'Guernsey'},
					{ id: 'GN', text: 'Guinea'},
					{ id: 'GW', text: 'Guinea-Bissau'},
					{ id: 'GY', text: 'Guyana'},
					{ id: 'HT', text: 'Haiti'},
					{ id: 'HM', text: 'Heard Island & Mcdonald Islands'},
					{ id: 'VA', text: 'Holy See (Vatican City State)'},
					{ id: 'HN', text: 'Honduras'},
					{ id: 'HK', text: 'Hong Kong'},
					{ id: 'HU', text: 'Hungary'},
					{ id: 'IS', text: 'Iceland'},
					{ id: 'IN', text: 'India'},
					{ id: 'ID', text: 'Indonesia'},
					{ id: 'IR', text: 'Iran}, Islamic Republic Of'},
					{ id: 'IQ', text: 'Iraq'},
					{ id: 'IE', text: 'Ireland'},
					{ id: 'IM', text: 'Isle Of Man'},
					{ id: 'IL', text: 'Israel'},
					{ id: 'IT', text: 'Italy'},
					{ id: 'JM', text: 'Jamaica'},
					{ id: 'JP', text: 'Japan'},
					{ id: 'JE', text: 'Jersey'},
					{ id: 'JO', text: 'Jordan'},
					{ id: 'KZ', text: 'Kazakhstan'},
					{ id: 'KE', text: 'Kenya'},
					{ id: 'KI', text: 'Kiribati'},
					{ id: 'KR', text: 'Korea'},
					{ id: 'KW', text: 'Kuwait'},
					{ id: 'KG', text: 'Kyrgyzstan'},
					{ id: 'LA', text: 'Lao People\'s Democratic Republic'},
					{ id: 'LV', text: 'Latvia'},
					{ id: 'LB', text: 'Lebanon'},
					{ id: 'LS', text: 'Lesotho'},
					{ id: 'LR', text: 'Liberia'},
					{ id: 'LY', text: 'Libyan Arab Jamahiriya'},
					{ id: 'LI', text: 'Liechtenstein'},
					{ id: 'LT', text: 'Lithuania'},
					{ id: 'LU', text: 'Luxembourg'},
					{ id: 'MO', text: 'Macao'},
					{ id: 'MK', text: 'Macedonia'},
					{ id: 'MG', text: 'Madagascar'},
					{ id: 'MW', text: 'Malawi'},
					{ id: 'MY', text: 'Malaysia'},
					{ id: 'MV', text: 'Maldives'},
					{ id: 'ML', text: 'Mali'},
					{ id: 'MT', text: 'Malta'},
					{ id: 'MH', text: 'Marshall Islands'},
					{ id: 'MQ', text: 'Martinique'},
					{ id: 'MR', text: 'Mauritania'},
					{ id: 'MU', text: 'Mauritius'},
					{ id: 'YT', text: 'Mayotte'},
					{ id: 'MX', text: 'Mexico'},
					{ id: 'FM', text: 'Micronesia}, Federated States Of'},
					{ id: 'MD', text: 'Moldova'},
					{ id: 'MC', text: 'Monaco'},
					{ id: 'MN', text: 'Mongolia'},
					{ id: 'ME', text: 'Montenegro'},
					{ id: 'MS', text: 'Montserrat'},
					{ id: 'MA', text: 'Morocco'},
					{ id: 'MZ', text: 'Mozambique'},
					{ id: 'MM', text: 'Myanmar'},
					{ id: 'NA', text: 'Namibia'},
					{ id: 'NR', text: 'Nauru'},
					{ id: 'NP', text: 'Nepal'},
					{ id: 'NL', text: 'Netherlands'},
					{ id: 'AN', text: 'Netherlands Antilles'},
					{ id: 'NC', text: 'New Caledonia'},
					{ id: 'NZ', text: 'New Zealand'},
					{ id: 'NI', text: 'Nicaragua'},
					{ id: 'NE', text: 'Niger'},
					{ id: 'NG', text: 'Nigeria'},
					{ id: 'NU', text: 'Niue'},
					{ id: 'NF', text: 'Norfolk Island'},
					{ id: 'MP', text: 'Northern Mariana Islands'},
					{ id: 'NO', text: 'Norway'},
					{ id: 'OM', text: 'Oman'},
					{ id: 'PK', text: 'Pakistan'},
					{ id: 'PW', text: 'Palau'},
					{ id: 'PS', text: 'Palestinian Territory, Occupied'},
					{ id: 'PA', text: 'Panama'},
					{ id: 'PG', text: 'Papua New Guinea'},
					{ id: 'PY', text: 'Paraguay'},
					{ id: 'PE', text: 'Peru'},
					{ id: 'PH', text: 'Philippines'},
					{ id: 'PN', text: 'Pitcairn'},
					{ id: 'PL', text: 'Poland'},
					{ id: 'PT', text: 'Portugal'},
					{ id: 'PR', text: 'Puerto Rico'},
					{ id: 'QA', text: 'Qatar'},
					{ id: 'RE', text: 'Reunion'},
					{ id: 'RO', text: 'Romania'},
					{ id: 'RU', text: 'Russian Federation'},
					{ id: 'RW', text: 'Rwanda'},
					{ id: 'BL', text: 'Saint Barthelemy'},
					{ id: 'SH', text: 'Saint Helena'},
					{ id: 'KN', text: 'Saint Kitts And Nevis'},
					{ id: 'LC', text: 'Saint Lucia'},
					{ id: 'MF', text: 'Saint Martin'},
					{ id: 'PM', text: 'Saint Pierre And Miquelon'},
					{ id: 'VC', text: 'Saint Vincent And Grenadines'},
					{ id: 'WS', text: 'Samoa'},
					{ id: 'SM', text: 'San Marino'},
					{ id: 'ST', text: 'Sao Tome And Principe'},
					{ id: 'SA', text: 'Saudi Arabia'},
					{ id: 'SN', text: 'Senegal'},
					{ id: 'RS', text: 'Serbia'},
					{ id: 'SC', text: 'Seychelles'},
					{ id: 'SL', text: 'Sierra Leone'},
					{ id: 'SG', text: 'Singapore'},
					{ id: 'SK', text: 'Slovakia'},
					{ id: 'SI', text: 'Slovenia'},
					{ id: 'SB', text: 'Solomon Islands'},
					{ id: 'SO', text: 'Somalia'},
					{ id: 'ZA', text: 'South Africa'},
					{ id: 'GS', text: 'South Georgia And Sandwich Isl.'},
					{ id: 'ES', text: 'Spain'},
					{ id: 'LK', text: 'Sri Lanka'},
					{ id: 'SD', text: 'Sudan'},
					{ id: 'SR', text: 'Suriname'},
					{ id: 'SJ', text: 'Svalbard And Jan Mayen'},
					{ id: 'SZ', text: 'Swaziland'},
					{ id: 'SE', text: 'Sweden'},
					{ id: 'CH', text: 'Switzerland'},
					{ id: 'SY', text: 'Syrian Arab Republic'},
					{ id: 'TW', text: 'Taiwan'},
					{ id: 'TJ', text: 'Tajikistan'},
					{ id: 'TZ', text: 'Tanzania'},
					{ id: 'TH', text: 'Thailand'},
					{ id: 'TL', text: 'Timor-Leste'},
					{ id: 'TG', text: 'Togo'},
					{ id: 'TK', text: 'Tokelau'},
					{ id: 'TO', text: 'Tonga'},
					{ id: 'TT', text: 'Trinidad And Tobago'},
					{ id: 'TN', text: 'Tunisia'},
					{ id: 'TR', text: 'Turkey'},
					{ id: 'TM', text: 'Turkmenistan'},
					{ id: 'TC', text: 'Turks And Caicos Islands'},
					{ id: 'TV', text: 'Tuvalu'},
					{ id: 'UG', text: 'Uganda'},
					{ id: 'UA', text: 'Ukraine'},
					{ id: 'AE', text: 'United Arab Emirates'},
					{ id: 'GB', text: 'United Kingdom'},
					{ id: 'US', text: 'United States'},
					{ id: 'UM', text: 'United States Outlying Islands'},
					{ id: 'UY', text: 'Uruguay'},
					{ id: 'UZ', text: 'Uzbekistan'},
					{ id: 'VU', text: 'Vanuatu'},
					{ id: 'VE', text: 'Venezuela'},
					{ id: 'VN', text: 'Viet Nam'},
					{ id: 'VG', text: 'Virgin Islands}, British'},
					{ id: 'VI', text: 'Virgin Islands}, U.S.'},
					{ id: 'WF', text: 'Wallis And Futuna'},
					{ id: 'EH', text: 'Western Sahara'},
					{ id: 'YE', text: 'Yemen'},
					{ id: 'ZM', text: 'Zambia'},
					{ id: 'ZW', text: 'Zimbabwe'}
				];

				function formatCountry (country) {
					if (!country.id) { return country.text; }
					var $country = $(
							'<span data-iso="'+ country.id.toLowerCase() +'" class="flag-icon flag-icon-'+ country.id.toLowerCase() +' flag-icon-squared"></span>' +
							'<span class="flag-text">'+ country.text+"</span>"
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
							products_ids:[  product_id],
							country_iso: $("[name='country']").val()
						},
						success: function (response) {
							//if($.inArray( ""+product_id, response.allowedProducts )){
							if($.inArray( ""+product_id, response.allowedProducts) != -1){
								$("#shipping-error").hide();
								$(".add_cart").removeClass("disabled");
							}else{
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

					$(".select2-selection__rendered").prepend('<span class="flag-custom mr10 flag-icon flag-icon-'+$("[name='country']").val().toLowerCase()+' flag-icon-squared"></span>')


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
			if(shareText){
				reSharePost({
					text: shareText,
					object_id: reference,
					object_type : "product"
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
					if(data <= 0){
						$('#error').show();
						$('#quantity_overflow').hide();
						return false;
					}else{
						$('#error').hide();
						$('#quantity_overflow').show();
					}



				}, error: function (xhr, ajaxOptions, thrownError) {
					alert("ERROR:" + xhr.responseText + " - " + thrownError);
				}
			});
		});

		$(".cart_product_color_selection").click(function(event){
			var id = event.target.id;
			$(".cart_product_color_selection").removeClass("active");
			$("#"+id).addClass("active");
			$(".total_price").hide();

			var allColorsAndSizes = '{{$allColorSizes}}';
			$( ".cart_product_size_selection" ).each(function() {
				$( this ).hide();
				$(".total_price").hide();
			});

			$( ".cart_product_size_selection" ).each(function() {
				var idColor = event.target.id.split("_");
				var isExist = idColor[0]+"_"+$( this ).html();

				if($( this ).hasClass('active')){
					$(".price_"+isExist).show();
				}

				if (allColorsAndSizes.indexOf(isExist) >= 0) {
					$(this).show();
				}
			});

		});

		$(".cart_product_size_selection").click(function(event){
			var id = event.target.id;

			id = id.split("_");
			var allColorsAndSizes = '{{$allColorSizes}}';
			$( ".cart_product_color_selection" ).each(function() {
				$( this ).hide();
				$(".total_price").hide();
			});

			$( ".cart_product_color_selection" ).each(function() {
				var isExist = $( this ).html()+"_"+id[0];
				if (allColorsAndSizes.indexOf(isExist) >= 0){
					$( this ).show();

					if($( this ).hasClass('active')){
						$(".price_"+isExist).show();
					}

				}
			});

			$(".cart_product_size_selection").removeClass("active");
			$("#"+event.target.id).addClass("active");
		});

		$("#productQtyValueForCart").keyup(function(event){
			var totalInCart  = $("#productQtyValueForCart").val();

			if(totalInCart < 1){return false;}

			var totalInStock = $("#product_qty_available").html();

			if(totalInCart > totalInStock){return false;}

			totalInStock     = totalInStock.match(/\d+/)[0];

			$("#product_qty_available").html(totalInStock - totalInCart);

		});

		$(".addRemoveQtyFromCart").click(function(event){
			var updateCartRemoveAdd = event.target.id;

			var totalInCart  = $("#productQtyValueForCart").val();
			var totalInStock = $("#product_qty_available").html();
			totalInStock     = totalInStock.match(/\d+/)[0];

			if(updateCartRemoveAdd === "remove_product_qty_for_cart"){
				if(totalInCart < 2){return false;}

				$("#productQtyValueForCart").val(totalInCart - 1);
				$("#product_qty_available").html(+totalInStock + +1);
			}

			if(updateCartRemoveAdd === "add_product_qty_for_cart"){
				if(totalInStock == 0){
					return false;
				}
				totalInCart  = +totalInCart + +1;
				totalInStock = totalInStock - 1;

				$("#productQtyValueForCart").val(totalInCart);
				$("#product_qty_available").html(totalInStock);

			}

		});


	</script>
@endsection
