@extends('layouts.shopin-main')
@section('content')
  <?php $section_selected = true ?>
	@for($i = 1; $i <= 3; $i++)
		<?php $section = get_theme_option($theme_id,'section-'.$i,null,true);
		?>

		@if($section == 'slider')
			<?php $section_selected = false; ?>
			@include('includes.shopin-slider')
		@elseif($section == 'featured-products')
			<?php $section_selected = false ?>
			@include('includes.shopin-featured')
		@elseif($section == 'page-content')
			<?php $section_selected = false ?>
			@include('includes.shopin-page-content')
		@endif
	@endfor
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
