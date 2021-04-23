@extends('layouts.main')

@section('content')
<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>
					<?php $map_enabled =  get_theme_option($theme_id,'contac-us-map-enable',null,true); ?>
					@if($map_enabled)
					<div id="map" class="contact-map">
					</div>
					@endif
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" action="{{url('postContactUs')}}" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
						<?php $info =  get_theme_option($theme_id,'contact-us-info','Contact us info',true); ?>
	    				<address>
							<p>
							{!! nl2br($info) !!}
							</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<?php
								$array = [
										'social-media-facebook' => 'fa-facebook',
										'social-media-twitter' => 'fa-twitter',
										'social-media-linkedin' => 'fa-linkedin',
										'social-media-dribble' => 'fa-dribbble',
										'social-media-google-plus' => 'fa-google-plus'
								];
								?>
								@foreach($array as $key => $class)
								<?php $social_media = get_theme_option($theme_id,(STRING)$key,'',true); ?>

								<li><a target="_blank" href="{{$social_media}}"><i class="fa {{$class}}"></i></a></li>

								@endforeach

							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div>
@endsection
@section('footer-scripts')
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
<script type="text/javascript">
	var marker;
	<?php
	$map_lat = get_theme_option($theme_id,'contact-us-map-lat','59.325',true);
	$map_lng = get_theme_option($theme_id,'contact-us-map-lng','18.070',true);
	?>
	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 13,
			center: {
				lat: {{$map_lat}},
				lng: {{$map_lng}}
			}
		});

		marker = new google.maps.Marker({
			map: map,
			animation: google.maps.Animation.DROP,
			position: {lat: {{$map_lat}}, lng: {{$map_lng}}}
		});
	}
</script>
@endsection
