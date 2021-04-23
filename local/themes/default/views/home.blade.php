@extends('layouts.main')

	@section('content')
	<?php $section_selected = true ?>
	@for($i = 1; $i <= 4; $i++)
    <?php $section = get_theme_option($theme_id,'section-'.$i,null,true); ?>

	@if($section == 'slider')
		<?php $section_selected = false ?>
        @include('includes.slider')
    @elseif($section == 'featured-products')
		<?php $section_selected = false ?>
        @include('includes.featured')
	@elseif($section == 'page-content')
		<?php $section_selected = false ?>
		@include('includes.page-content')
    @elseif($section == 'custom-section')
        <?php $section_selected = false ?>
        @include('includes.custom-section')
	@endif

	@endfor

	@if($section_selected)
		@include('includes.slider-default')
		@include('includes.featured-default')
		@include('includes.page-content-default')
	@endif
@endsection