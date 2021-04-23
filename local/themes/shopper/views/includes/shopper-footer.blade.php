<section id="footer-bar">
	<?php
	$footer_navs = get_theme_options($theme_id,'footer-nav-name',[],true);
	?>
	<div class="row">
		@if(!empty($footer_navs))
		@foreach($footer_navs as $nav)
		<div class="span4">
			<h4>{{$nav->value}}</h4>
			<ul class="nav">
				<?php
				$footer_nav_items = get_theme_options($theme_id,'footer-nav-item-name',[],true,['parent_id' => $nav->id])
				?>
				@if(!empty($footer_nav_items))
					@foreach($footer_nav_items as $option)
					<?php
					$theme_option = get_theme_option_by_parent_id($theme_id,$option->id);
					?>
				<li><a @if($theme_option->key == 'link') target="_blank" @endif href="@if($theme_option->key == 'link') {{$theme_option->value}} @elseif($theme_option->key == 'page') {{url('pages/'.$theme_option->value)}} @endif">{{$option->value}}</a></li>
					@endforeach
				@endif

			</ul>
		</div>
		@endforeach
		@endif

		<div class="span5 pull-right">
			<p class="logo"><img src="<?php get_theme_option($theme_id,'header-logo',getAssetPath($theme).'/images/home/logo.png') ?>" class="site_logo" alt=""></p>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
			<br/>
			<span class="social_icons">
				<?php
				$array = [
					'social-media-facebook' => 'facebook',
					'social-media-twitter' => 'twitter',
					'social-media-linkedin' => 'vkype',
					'social-media-dribble' => 'vimeo',
					'social-media-google-plus' => 'google-plus'
				];
				?>
				@foreach($array as $key => $class)
				<?php $social_media = get_theme_option($theme_id,(STRING)$key,'',true); ?>
				@if(!empty($social_media))
				<a class="{{$class}}" target="_blank" href="{{$social_media}}">{{ucfirst($class)}}</a>
				@endif
				@endforeach
			</span>
		</div>
	</div>
</section>
<section id="copyright">
	<span>Copyright {{date('Y')}} Cartimatic  All right reserved.</span>
</section>