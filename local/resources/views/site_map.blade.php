@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Site Map</h1>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="col-md-3">
        	<div class="row">
            	<div class="cart-left-nav">
                	<nav>
                      <ul class="nav">
                          <li><a @if(isset($site_map_or_contact_link_number)) @if($site_map_or_contact_link_number == 1) class="active" @endif @endif href="{{url('contact-us')}}">Contact Us</a></li>
                        <li><a @if(isset($site_map_or_contact_link_number)) @if($site_map_or_contact_link_number == 2) class="active" @endif @endif href="{{url('site-map')}}">Site Map</a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="order-title-box">
                    <h1>Site Map page content</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
