<section  class="homepage-slider" id="home-slider">
	<div class="container">
		<div class="flexslider">
			<ul class="slides">
				@for($i = 1; $i <= 6; $i++)
				<?php $option_img = get_theme_option($theme_id,'slider-img-'.$i.'-enable',0,true); ?>

					@if(@$option_img == 1)
				<li>
					<?php $img_url = get_theme_option($theme_id,'slider-img-'.$i.'-link','',true); ?>
					@if(!empty($img_url))
					<a href="{{$img_url}}">
						<img src="<?php get_theme_option($theme_id,'slider-img-'.$i,getAssetPath($theme).'/images/carousel/banner-2.jpg') ?>" alt="" />
					</a>
					@else
						<img src="<?php get_theme_option($theme_id,'slider-img-'.$i,getAssetPath($theme).'/images/carousel/banner-2.jpg') ?>" alt="" />
					@endif
					<div class="intro">
						<h1><?php get_theme_option($theme_id,'slider-img-'.$i.'-heading','') ?></h1>
						<p><span><?php get_theme_option($theme_id,'slider-img-'.$i.'-subheading','') ?></span></p>
						<p><span><?php get_theme_option($theme_id,'slider-img-'.$i.'-description','') ?></span></p>
					</div>
				</li>
					@endif
				@endfor
			</ul>
		</div>
	</div>
</section>
