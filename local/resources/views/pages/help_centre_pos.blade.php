@extends('layouts.dashboard')

@section('content')

<!-- Cartimatic Header html-->
<div class="help_centre_bg help_center_pos">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>Help Centre</h2>
            <p>What are you looking for?</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Need help with?" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Search</span>
            </div>
            <div class="free-trail">Get your store online in just a few minutes</div>
        </div>
    </div>

    <div class="container ">
        <div class="hcp-nav-container">
            <ul class="hcp-nav">
                <li><a href="javascript:void(0);">Home</a></li>
                <li>POS</li>
            </ul>
        </div>
    </div>
</div>

<div class="container nopadding">
    <div class="hcp-content">
        <div class="col-md-8">
            <div class="hcp-lead">Point of Sale (POS)</div>
            <div class="hcp-info">
                <div class="icon"></div>
                <div class="hcp-info-text">This documentation is always evolving. If you've not been here for a while, perhaps check out the new(ish) Handlebars guide</div>
            </div>
            <p class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable.</p>
            <p class="text">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
            <div class="hcp-h2">Aenean vulputate eleifend tellus</div>
            <p class="text">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.</p>
            <div class="hcp-h2">Eleifend tellus</div>
            <p class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable.</p>
            <div class="hcp-feedback">
                <div class="hcp-lead">Was this article helpful to you?</div>
                <div class="btn-container">
                    <a href="javascript:void(0);" class="btn btn-hcp">Yes</a>
                    <a href="javascript:void(0);" class="btn btn-hcp">No</a>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="How else could we imporive it?">
                </div>
                <a href="javascript:void(0);" class="btn btn-hcp-green">Submit Feedback</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hcp-aside-item">
                <div class="aside-h2">Contact Us</div>
                <p>Couldn’t find what your are looking for? Why not send us an email and let us help you.</p>
                <a href="javascript:void(0);" class="btn btn-hcp-green">Write to Us Now</a>
            </div>
            <div class="hcp-aside-item categories">
                <div class="aside-h3">POS Related Topics<br>Categories</div>
                <ul class="hcp-aside-links">
                    <li class="links-item">
                        <a href="javascript:void(0);">Introduction</a>
                        <ul>
                            <li class="links-item"><a href="javascript:void(0);">How to use this documentation?</a></li>
                            <li class="links-item"><a href="javascript:void(0);">How to find topics??</a></li>
                            <li class="links-item"><a href="javascript:void(0);">What is included and why??</a></li>
                            <li class="links-item"><a href="javascript:void(0);">Basic knowledge requirments.</a></li>
                            <li class="links-item"><a href="javascript:void(0);">Getting Started & What is next.?</a></li>
                        </ul>
                    </li>
                    <li class="links-item"><a href="javascript:void(0);">Lorem ipsum dolor sit amet</a></li>
                    <li class="links-item"><a href="javascript:void(0);">Etuer adipiscing elit.</a></li>
                    <li class="links-item"><a href="javascript:void(0);">Aenean commodo ligula eget</a></li>
                    <li class="links-item"><a href="javascript:void(0);">Penatibus et magnis</a></li>
                    <li class="links-item"><a href="javascript:void(0);">Cum sociis natoque </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="clrfix"></div>
@endsection
