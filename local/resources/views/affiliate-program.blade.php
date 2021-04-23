@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="pro-header">
			<h1>Affiliate Program</h1>
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
                      <li><a @if(isset($partner_promotion)) @if($partner_promotion == 1) class="active" @endif @endif href="{{url('partnership')}}">Partnership</a></li>
                      <li><a @if(isset($partner_promotion)) @if($partner_promotion == 2) class="active" @endif @endif href="{{url('affiliate-program')}}">Affiliate Program</a></li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="order-title-box">
                    <h1>Affiliate Program page content</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
