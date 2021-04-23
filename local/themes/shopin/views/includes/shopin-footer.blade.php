
<!--//footer-->
<div class="footer">
	<div class="footer-middle">
		<div class="container">
			<div class="col-md-3 footer-middle-in">
				<a href="index.html"><img src="{{getAssetPath($theme)}}/images/log.png" alt=""></a>
				<p>Suspendisse sed accumsan risus. Curabitur rhoncus, elit vel tincidunt elementum, nunc urna tristique nisi, in interdum libero magna tristique ante. adipiscing varius. Vestibulum dolor lorem.</p>
			</div>
      <?php
      $footer_navs = get_theme_options($theme_id,'footer-nav-name',[],true);
      ?>
			<div class="col-md-3 footer-middle-in">
				<h6>Information</h6>
			@if(!empty($footer_navs))
					@foreach($footer_navs as $nav)
							<ul class=" in">
                <?php
                $footer_nav_items = get_theme_options($theme_id,'footer-nav-item-name',[],true,['parent_id' => $nav->id])
                ?>
								@if(!empty($footer_nav_items))
									<?php $countNavLinks=0; ?>
									@foreach($footer_nav_items as $option)
                    <?php
                      if($countNavLinks > 12){continue;}
                    $theme_option = get_theme_option_by_parent_id($theme_id,$option->id);
                    $countNavLinks++;
                    if($countNavLinks > 6){
                      echo '</ul><ul class="in in1">';
										}
                    ?>
										<li><a @if($theme_option->key == 'link') target="_blank" @endif href="@if($theme_option->key == 'link') {{$theme_option->value}} @elseif($theme_option->key == 'page') {{url('pages/'.$theme_option->value)}} @endif">{{$option->value}}</a></li>
									@endforeach
								@endif
							</ul>
					@endforeach
				@endif
		</div>
			<div class="col-md-3 footer-middle-in">
				<h6>Tags</h6>
				<ul class="tag-in">
					<li><a href="#">Lorem</a></li>
					<li><a href="#">Sed</a></li>
					<li><a href="#">Ipsum</a></li>
					<li><a href="#">Contrary</a></li>
					<li><a href="#">Chunk</a></li>
					<li><a href="#">Amet</a></li>
					<li><a href="#">Omnis</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-middle-in">
				<h6>Newsletter</h6>
				<span>Sign up for News Letter</span>
				<form>
					<input type="text" value="Enter your E-mail" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Enter your E-mail';}">
					<input type="submit" value="Subscribe">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<ul class="footer-bottom-top">
				<li><a href="#"><img src="{{getAssetPath($theme)}}/images/f1.png" class="img-responsive" alt=""></a></li>
				<li><a href="#"><img src="{{getAssetPath($theme)}}/images/f2.png" class="img-responsive" alt=""></a></li>
				<li><a href="#"><img src="{{getAssetPath($theme)}}/images/f3.png" class="img-responsive" alt=""></a></li>
			</ul>
			<p class="footer-class">&copy; 2016 Shopin. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--//footer-->
