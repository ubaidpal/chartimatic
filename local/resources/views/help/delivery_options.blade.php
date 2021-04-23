@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Delivery Options</h1>
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
                          <li><a @if(isset($help_link_number)) @if($help_link_number == 1) class="active" @endif @endif href="{{url('help/create-an-account')}}">Create an Account</a></li>
                          <li><a @if(isset($help_link_number)) @if($help_link_number == 2) class="active" @endif @endif href="{{url('help/making-payments')}}">Making Payments</a></li>
                          <li><a @if(isset($help_link_number)) @if($help_link_number == 3) class="active" @endif @endif href="{{url('help/delivery-options')}}">Delivery Options</a></li>
                          <li><a @if(isset($help_link_number)) @if($help_link_number == 4) class="active" @endif @endif href="{{url('help/buyer-protection')}}">Buyer Protection</a></li>
                          <li><a @if(isset($help_link_number)) @if($help_link_number == 5) class="active" @endif @endif href="{{url('help/new-user-guide')}}">New User Guide</a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="order-title-box">
                    <h1>Delivery Options help page content</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
