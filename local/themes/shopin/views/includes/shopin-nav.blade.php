<section class="navbar main-menu">
	<div class="navbar-inner main-menu">
		<a href="{{url('/')}}" class="logo pull-left"><img width="<?php get_theme_option($theme_id,'header-logo-width','150') ?>" src="<?php get_theme_option($theme_id,'header-logo',getAssetPath($theme).'/images/home/logo.png') ?>" class="site_logo" alt=""></a>
		<nav id="menu" class="pull-right">
			<ul>
				<?php $menus = get_theme_options($theme_id,'menu',null,true); ?>
				@if(!empty($menus))
				@foreach($menus as $menu)
				<li><a href="#">{{$menu->value}}</a>
					<?php $menu_items = get_theme_options_by_parent_id($theme_id,$menu->id) ?>
					<ul>
						@if(!empty($menu_items))
						@foreach($menu_items as $menu_item)
						<?php $category = getCategory($menu_item->value)?>
						<li><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a></li>
						@endforeach
						@endif
					</ul>
				</li>
				@endforeach
				@endif
			</ul>
		</nav>
	</div>
</section>