@charset "utf-8";
@import url("http://fonts.googleapis.com/css?family=Open+Sans:regular,italic,bold");

<?php

$base_font_family = get_theme_option($theme_id,'base-font-family',"'Open Sans', arial, tahoma, sans-serif",true);
$heading_font_family = get_theme_option($theme_id,'headings-font-family',"'Open Sans', arial, tahoma, sans-serif",true);

?>

@if(substr( $base_font_family, 0, 6 ) === "Google")
	<?php
	$base_font = explode('_',$base_font_family);
	$base_font_family = str_replace('+',' ',$base_font[1]);
	?>
	@import url(http://fonts.googleapis.com/css?family={{$base_font[1]}}:{{$base_font[2]}});
@endif

@if(substr( $heading_font_family, 0, 6 ) === "Google")
	<?php
	$heading_font = explode('_',$heading_font_family);
	$heading_font_family = str_replace('+',' ',$heading_font[1]);
	?>
	@import url(http://fonts.googleapis.com/css?family={{$heading_font[1]}}:{{$heading_font[2]}});
@endif

/* common
----------------------------------------------------------------------------- */
body{
	font-size: {!! get_theme_option($theme_id,'base-font-size','12px') !!};
	font-family: {!! $base_font_family !!};
	background:url({{getAssetPath($theme)}}/images/bg.png) repeat 0 0 fixed;
}
label, input, button, select, textarea{
	font-size: 12px;
}
ul li a,a{
	color:#333;
	outline:0; 
	-webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
}
a{
	color:#eb4800;
}
a:hover{
	color:#fd4004;
	text-decoration:none;
}
.img-al{
	margin: 0 10px 10px 0;
	float:left;
}
.img-ar{
	margin: 0 0 10px 10px;
	float:right;
}
.left{
	text-align:left !important;
}
.center{
	text-align:center !important;
}
.right{
	text-align:right !important;
}
.myCarousel.carousel{
	margin-bottom:0;
}
.breadcrumb{
	margin:10px -10px 20px -10px;
	background-color:#ddd;
}
.breadcrumb{
	background:none;
}
.breadcrumb li{
	border:0px solid #ddd;
	border-radius:30px;
	padding:2px 15px 2px 10px;
	background-color:#ddd;
	margin-right:-23px;
}
.accordion .accordion-heading {
	background-color: #eee;
}
.nav-tabs li.active, .accordion .accordion-heading {
	font-weight: bold;
	font-size: 12px;
}
#wrapper,#top-bar{
	background: #fff;
	margin: 20px auto 20px auto;
	box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.2);
	padding:0px 10px;
}
section.homepage-slider,
section.navbar,
section.google_map,
section#footer-bar,
section#copyright{
	margin-left: -10px; 
	margin-right: -10px;	
}
section.header_text{
	background:url({{getAssetPath($theme)}}/images/bg_h.png) no-repeat bottom;
	text-align:center;
	padding:15px 0 20px 0;
	font-size:16px;
	line-height:30px;
	border-bottom:1px solid #fff;
}
section.homepage-slider{
	border-bottom:1px dotted #eb4800;
	padding-bottom:1px;
	position: relative;
	top:0;
	z-index:99;
	border-bottom:2px solid #ddd;	
	background-color:#efeeed;
	min-height:100px;
}
section.homepage-slider div.intro{
	position:absolute;
	top:20%;
	left:7%;
	opacity:.7;
}
section.homepage-slider h1{
	background-color:#eb4800;
	color:#fff;
	padding:2px 7px;
	font-size:30px;
	text-transform:uppercase;
	float:left;
	width:auto;
	font-family: {!! $heading_font_family !!};
}
section.homepage-slider p{
	overflow:hidden;
	width:100%;
	margin-bottom:2px;
}
section.homepage-slider span{
	background-color:#fff;
	color:#000;	
	padding:2px 10px;
	line-height:30px;
	font-size:28px;
	float:left;
	width:auto;
}
section.header_text.sub{
	font-size:14px;
	margin-bottom:40px;
}
section.header_text.sub h4{
	text-transform:uppercase;
	margin:0;
	font-family: {!! $heading_font_family !!};
}
iframe{
	border-bottom:2px solid #eee;
}
/* end common */

/* top bar
----------------------------------------------------------------------------- */
#top-bar{
	background-color:#fff;
	padding:10px;
	margin: 20px auto -22px auto;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}
#top-bar .user-menu {
	margin: 0;
	padding: 0;
	list-style: none;
}
#top-bar .user-menu li {
	display: inline-block;
	*display: inline;
	zoom: 1;
	border-right: 1px solid #eee;
	padding: 5px 12px;
}
#top-bar .user-menu li:last-child{
	border-right:0;
}
/* footer 
----------------------------------------------------------------------------- */
section#footer-bar,
section#copyright{
	padding:10px 10px;
}
section#footer-bar{
	margin-top:20px;
	padding-top:10px;
	background-color:#242424;
	border-top:1px solid #ddd;
	color:#777;
}
section#footer-bar .post {
	overflow:hidden;
	margin: 0 0 0px 0;
	border-bottom:1px dotted #333;
	border-top:1px dotted #000;
	padding:5px 0;
}
section#footer-bar .post span{
	font-size:10px;
}
section#footer-bar .posts .post:first-child{
	border-top:0;
}
section#footer-bar .posts .post:last-child{
	border-bottom:0;
}
section#footer-bar p.logo{
	margin-top:10px;
	width:120px;
}
section#footer-bar a{
	text-indent:15px;
	color:#fff;
}
section#footer-bar  a:hover{
	color:#999;
	text-decoration:underline;
}
section#footer-bar  .nav a{
	background: url({{getAssetPath($theme)}}/images/trigger_right.png) no-repeat 5px 7px;
}
section#footer-bar h4 {
	padding: 0;
	font-size: 16px;
	color: #fff;
	font-weight:normal;
	margin: 10px 0 18px;	
}
section#footer-bar .social_icons a {
	display: block;
	float: left;
	width: 29px;
	height: 28px;
	text-indent: -9999px;
	background-image: url({{getAssetPath($theme)}}/images/social-icons.png);
	background-repeat: no-repeat;
	margin-right: 10px;
	-webkit-transition: all 0.4s;
	-moz-transition: all 0.4s;
	-o-transition: all 0.4s;
	-ms-transition: all 0.4s;
	transition: all 0.4s;
}
section#footer-bar .social_icons a.facebook:hover {
	background-position: 0 -29px;
}
section#footer-bar .social_icons a.twitter {
	background-position: -38px 0;
}
section#footer-bar .social_icons a.twitter:hover {
	background-position: -38px -29px;
}
section#footer-bar .social_icons a.skype {
	background-position: -76px 0;
}
section#footer-bar .social_icons a.skype:hover {
	background-position: -76px -29px;
}
section#footer-bar .social_icons a.vimeo {
	background-position: -115px 0;
}
section#footer-bar .social_icons a.vimeo:hover {
	background-position: -115px -29px;
}
section#copyright{
	background-color:#111111;
	color:#fff;
	font-size:10px;
	text-transform:uppercase;	
}
/* end footer */

/* top navigation
----------------------------------------------------------------------------- */
section.navbar{
	margin-bottom:0;
}
.navbar-inner.main-menu {	
	height: 40px;
	padding-left:10px;	
	padding-right:0;	
	border-right: 0;
	border-left: 0;
	border-top: 0;
	border-bottom:5px solid #eb4800;
	-webkit-border-radius: 0;
	-moz-border-radius: 0;	
	border-radius: 0;
	filter: none;	
}
.navbar-inner.main-menu a.logo{
	position:absolute;
}
.navbar-inner.main-menu ul ul a{
	font-size:13px;
	font-weight:normal;
	line-height:17px;
	text-transform: none;
}
#menu > ul{
    display: block;
    margin-left:0;	
}
#menu > ul > li{
    list-style: none;
    float: left;
    position: relative;   
	margin-right: 0px;
}
#menu > ul > li > a {
	font-size: 11px;
	color: #111;
	display: block;
	text-transform: uppercase;
	font-weight: bold;
	text-align: center;
	padding: 10px 14px;
	}
#menu > ul > li.active{
	background-color:#eb4800;
}
#menu > ul > li.active > a{
	color:#fff;
}
#menu > ul a:hover{
	color: #eb4800; 
	text-decoration:none;
}
#menu .current{color: #eb4800 !important;}

#menu ul ul {
    background: none repeat scroll 0 0 #eee;
    box-shadow: 0 4px 5px rgba(0, 0, 0, 0.1);
    padding: 0px;
    position: absolute;
    min-width:170px;
	display:none;
}
#menu > ul > li > ul{
    margin-left:10px;
    margin-top:-12px;
	border:1px solid #ddd;
	border-top:0;
}
#menu ul ul li {
    list-style: none outside none;
    position: relative;
	border-top:1px solid #fff;
	border-bottom:1px solid #ddd;
}
#menu ul ul li:last-child{
    border-bottom: none !important
}
#menu ul ul li.menu-last{border-bottom: none;}
#menu ul ul a{
    display: block;
    padding:7px 10px;
    color: #333;
    font-size: 12px;
}
#menu ul ul a:hover,#menu > ul > li:hover > a{color: #fff;background-color:#eb4800}
#menu ul ul a:hover{background-color:#eb4800;}
#menu > ul > li:hover {visibility: inherit;}
#menu li:hover {visibility: inherit;}
#menu li:hover ul,
#menu li.sfHover ul {
    left: -10px;
    top: 52px;
    z-index: 2299;
}
#menu li li:hover ul,
#menu li li.sfHover ul {
    left: 130px;
    top: 0px;
}
#menu li.sfHover > a{
	color:#eb4800;
}
#menu .sf-sub-indicator{
	display:none;
}
/* feature box
----------------------------------------------------------------------------- */
.feature_box{
	margin-bottom:20px;	
}
.feature_box h4{
	margin:0 0 10px 0;
	font-weight:normal;	
}
.feature_box img{	
	margin-bottom:10px;
	background-color:#eb4800;
	padding:25px;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;	
	border-radius: 50%;
}
.feature_box .service{	
	margin-top:3px;
	padding:3px;	
	text-align:center;
}
.feature_box .service:hover{
	background-color:#f4f4f4;
}
.feature_box .service:hover img{
	-webkit-transition: all 0.7s linear;
	-webkit-transform: rotate(6.28rad);
	transition: all 0.7s;
	transform: rorate(6.28rad);
}
.feature_box .service div{	
	padding:5px 5px 0 5px;
}
/* end feature box */

/* product box
----------------------------------------------------------------------------- */
.product-box{
	text-align:center;
	padding-bottom:15px;
	position: relative;
	background-color:#f8f8f8;
	border-radius: 4px;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-bottom:1px solid #eee;
}
.product-box span.sale_tag {
	background: url({{getAssetPath($theme)}}/images/sprites.png) no-repeat scroll 0 0 transparent;
	height: 54px;
	position: absolute;
	width: 55px;
	z-index: 100;
	top:0;
	left:0;
}
.product-box:hover{
	background-color:#eb4800;
	-webkit-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    transition: all 0.2s linear;
	box-shadow: 0px 0px 5px #ccc;
}
.product-box:hover a{
	color:#fff !important;
}
.product-box img{
	overflow:hidden;
}
.product-box a.title{
	text-transform:uppercase;
	color:#111111;
	display:inline-block;
	font-weight:bold;
	font-size:11px;
	margin:15px 0 0px 0;
}
.product-box a.category{
	color:#eb4800;
}
.product-box p.price{
	font-size:20px;
	font-weight:300;
	padding:10px 0;
}
/* end product box */

/* title style for h4 tag
----------------------------------------------------------------------------- */
h4.title{
	background: url({{getAssetPath($theme)}}/images/line_bar.png) 0 8px repeat-x;
	padding-bottom:5px;
	margin-bottom:15px;
	overflow:hidden;
	text-transform:uppercase;
	font-size:15px;
	min-height:27px;
	width:100%;
}
h4.title.m{
	margin-top:15px;	
	overflow:hidden;
	width:100%;
}
h4.title strong{
	color:#eb4800;
}
h4.title span.text{
	background-color:#fff;
	padding-right:10px;
}
h4.title .left{
	background: url({{getAssetPath($theme)}}/images/arrow-pleft.png) #eee no-repeat center center;
	margin-right:2px;	
}
h4.title .right{
	background: url({{getAssetPath($theme)}}/images/arrow-p.png) #eee no-repeat center center;
}
h4.title .pull-right{
	background-color:#fff;
	padding-left:10px;	
}
h4.title .left,h4.title .right{
	display: inline-block;
	width: 22px;
	height: 22px;
	cursor: pointer;
}
h4.title .left:hover,h4.title .right:hover{
	background-color:#eb4800;
}
h4.title .button:hover{
	text-decoration: none;
}
/* end h4 title style */

/* our clients
----------------------------------------------------------------------------- */
section.our_client{
	margin-top:20px;
}
section.our_client .row{
	text-align:center;
}
/* end our clients */
.search_form {
	margin-bottom:0;
}
.search_form input{
	background: url({{getAssetPath($theme)}}/images/search.png) #fff no-repeat 97% 6px;
	color:#fff;
	text-shadow:none;
	padding-right:25px;	
	border:1px solid #eee;
}
#homeTab{
	min-height:210px;
}
#homeTab li{
	font-size:11px;
}
#homeTab li.active{
	font-weight:bold;
}
#homeTab li.active a{
	border-top:3px solid #ddd;
}
/* Pricing
----------------------------------------------------------------------------- */
.pricing .plan {
	-webkit-box-shadow: 0 0 1px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 0 1px rgba(0,0,0,0.2);
	box-shadow: 0 0 1px rgba(0,0,0,0.2);
	color: #666;
	margin-bottom:40px;
	overflow: hidden;
	-webkit-transition: box-shadow .2s ease-in-out;
	-moz-transition: box-shadow .2s ease-in-out;
	-ms-transition: box-shadow .2s ease-in-out;
	-o-transition: box-shadow .2s ease-in-out;
	transition: box-shadow .2s ease-in-out;
}
.pricing .plan:hover {
	box-shadow: 0 0 6px rgba(0,0,0,0.45);
	-moz-box-shadow: 0 0 6px rgba(0,0,0,0.45);
	-webkit-box-shadow: 0 0 6px rgba(0,0,0,0.45);
}
.pricing .title {
	text-align: center;
	text-shadow: none;
	font-size: 22px;
	line-height: 1.5em;
	margin: 0;
	padding:7px;
	background: #111111;
	font-weight: 100;
	color: #fff;
	text-transform:uppercase;
	border-radius: 3px 3px 0 0;
	-moz-border-radius: 3px 3px 0 0;
	-webkit-border-radius: 3px 3px 0 0;
	background-image: -webkit-gradient(linear,0 45%,0 55%,from(rgba(255,255,255,.1)),to(rgba(255,255,255,0)));
	background-image: -moz-linear-gradient(270deg,rgba(255,255,255,.1) 45%,rgba(255,255,255,.0) 55%);
}
.pricing p {
	margin: 0;
	text-align: center;
}
.pricing ul {
	list-style-type: none;
	margin: 0 0 20px 0;
}
.pricing ul li {
	border-bottom: 1px solid #eee;
	padding: 6px 0;
	font-size: 1.2em;
	color: #222;
}
.pricing .price {
	border: 1px solid #ccc;
	border-bottom: 0;
	margin: 0;
	text-align: center;
	padding: 20px 0;
	text-shadow: none;
	font-size: 20px;
	font-weight:80px;
}
.pricing .well {
	border: 1px solid #ccc;
	margin-top: 0;
	margin-bottom: 0;
	box-shadow: 0 0 10px rgba(0,0,0,0.1);
	-moz-box-shadow: 0 0 10px rgba(0,0,0,0.1);
	-webkit-box-shadow: 0 0 10px rgba(0,0,0,0.1);
	border-radius: 0 0 3px 3px;
	-moz-border-radius: 0 0 3px 3px;
	-webkit-border-radius: 0 0 3px 3px;
}

/* Product Detail
----------------------------------------------------------------------------- */
.thumbnails.small {
	margin-top: 10px;
}
/* end Product Detail */

/* Block 
----------------------------------------------------------------------------- */
.block {
	text-align: center;
	padding: 7px;
	border: 1px solid #ddd;
	border-top: 3px solid #eb4800;
	-moz-box-shadow: 0 0 3px 0 #ccc;
	-webkit-box-shadow: 0 0 3px 0 #ccc;
	box-shadow: 0 0 3px 0 #ccc;
	margin-bottom: 20px;
}
.small-product {
	margin: 0;
	padding: 0;
	list-style: none;
}
.small-product li {
	text-align: left;
	border-bottom: 1px dotted #eee;
	padding: 5px 0;
	font-size:11px;
}
.small-product li img {
	width: 50px;
}
.block .carousel{
	margin-bottom:-30px;
}
.block h4{
	background: url({{getAssetPath($theme)}}/images/bg_h.png) no-repeat bottom left;
	margin: 0 0 20px 0;
	border-bottom:1px solid #eee;	
}
/* end Block */

/* Navigation list */
.nav-header{
	color:#333;
	background: url({{getAssetPath($theme)}}/images/bg_h.png) no-repeat bottom left;
	margin-bottom:10px;
}
.nav-list li{
	text-align:left;
}
.nav-list li a{
	background: url({{getAssetPath($theme)}}/images/trigger_right.png) transparent no-repeat 5px 8px;
}
.nav-list > .active > a, .nav-list > .active > a:hover{
	background-color: transparent;
	color:#eb4800;
	text-shadow: none;	
	font-weight: bold;
}

/* Toogle Menu
----------------------------------------------------------------------------- */
._toggleMenu{
	margin:0 -10px;
	display:none;
	background:#eb4800;	
}
._toggleMenu a{
	color:#fff;
	text-indent:10px;
	padding:5px 0;
	display:block;
	width:100%;
}
._toggleMenu ul  > li{
	text-transform:uppercase;
}
._toggleMenu ul  > li > ul > li{
	text-transform:none;
}
._toggleMenu a:hover{
	color:#fff;
	background-color:#df403d !important;
}
._toggleMenu .nav {
	margin:0;
	padding:0;
}
.toggleMenu {
	display:block;
	width:100%;    
    padding:10px 0;
	text-align:center;	
	font-weight:bold;
	background:url({{getAssetPath($theme)}}/images/i_submenu.png) no-repeat 98% center;
}
._toggleMenu ul  > li a.parent{
	background:url({{getAssetPath($theme)}}/images/i_plus.png) no-repeat 98% center;
}
._toggleMenu .nav  ul{
	list-style: none;
	display:none;
}
._toggleMenu .nav  ul ul{
	text-transform:none !important;
}
._toggleMenu .nav > li.hover > ul {
    display:block;
}

/* Responsive
----------------------------------------------------------------------------- */
@media (max-width: 767px){	
	#top-bar input{
		*padding-right:0 !important;
	}
	.navbar-inner.main-menu{
		border-bottom:0 !important;
	}
	section.homepage-slider{
		display:none;
	}
	.account.pull-right{
		width:100%;
		text-align:center;
	}
	.myCarousel .thumbnails li{
		border-bottom:1px solid #eee;
		margin-bottom:0;
	}
	.product-box{
		padding-top:10px;
		padding-bottom:10px;		
	}
	.product-box:hover{
		background-color:#f8f8f8;
	}
	.product-box:hover a{
		color:#333 !important;
	}
	#menu ul{display: none;}
	.navbar-inner.main-menu a.logo{
		left:50%;
		margin-left:-99px;
	}
	#copyright,#footer-bar{
		padding:0 10px;
	}
	#footer-bar .nav{overflow:hidden}
	#footer-bar .nav li{float:left;}
	#footer-bar  .nav a:hover{
		background-color:transparent;
		color:#eb4800;
	}
	.feature_box .service{	
		border-bottom:1px solid #eee;
	}
}