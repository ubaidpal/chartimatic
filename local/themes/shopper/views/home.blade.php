@extends('layouts.shopper-main')

@section('content')
	<?php $section_selected = true ?>
	@for($i = 1; $i <= 3; $i++)
		<?php $section = get_theme_option($theme_id,'section-'.$i,null,true); ?>

		@if($section == 'slider')
			<?php $section_selected = false ?>
			@include('includes.shopper-slider')
		@elseif($section == 'featured-products')
			<?php $section_selected = false ?>
			@include('includes.shopper-featured')
		@elseif($section == 'page-content')
			<?php $section_selected = false ?>
			@include('includes.shopper-page-content')
		@endif

	@endfor
	<?php /*
	<section class="our_client">
			<h4 class="title"><span class="text">Manufactures</span></h4>
			<div class="row">
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/14.png"></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/35.png"></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/1.png"></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/2.png"></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/3.png"></a>
				</div>
				<div class="span2">
					<a href="#"><img alt="" src="{{getAssetPath($theme)}}/images/clients/4.png"></a>
				</div>
			</div>
		</section>
	*/ ?>
@endsection

@section('footer-scripts')
	<script src="{{getAssetPath($theme)}}/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript">
		$(function() {
			$(document).ready(function() {
				$('.flexslider').flexslider({
					animation: "fade",
					slideshowSpeed: 4000,
					animationSpeed: 600,
					controlNav: false,
					directionNav: true,
					controlsContainer: ".flex-container" // the container that holds the flexslider
				});
			});
		});
	</script>
@endsection
