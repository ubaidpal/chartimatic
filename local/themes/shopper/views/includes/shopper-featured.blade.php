<section class="main-content">
	<div class="row">
		<div class="span12">
			<div class="row">
				<div class="span12">
					<?php $options = get_theme_options($theme_id,'product-id',null,true); ?>
					<div id="myCarousel" class="myCarousel carousel slide">
						<div class="carousel-inner">
							<div class="active item">
								<ul class="thumbnails">
								@if(!empty($options))
									@foreach($options as $index => $option)
									<li class="span3">
										<div class="product-box">
											<?php
											$product = getProductDetailsByID($option->value);
											$category = getCategoryById($product->category_id);
											?>
											<span class="sale_tag"></span>
											<p><a href="{{url('view-product/'.$product->id)}}"><img src="{{getRandomImageOfProduct($option->value)}}" alt="" /></a></p>
											<a href="{{url('view-product/'.$product->id)}}" class="title">{{$product->title}}</a><br/>
											<a href="{{url('category/'.$category->slug)}}" class="category">{{$category->name}}</a>
											<p class="price">${{wishListPrice($option->value)}}</p>
										</div>
									</li>
									@endforeach
								@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br/>
		</div>
	</div>
</section>