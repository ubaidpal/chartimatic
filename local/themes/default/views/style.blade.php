
<?php

$base_font_family = get_theme_option($theme_id,'base-font-family',"'Roboto', sans-serif",true);
$heading_font_family = get_theme_option($theme_id,'headings-font-family',"'Roboto', sans-serif",true);

?>

/*************************
*******Typography******
**************************/

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


@import url(http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700,100);
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,800,300,600,700);
@import url(http://fonts.googleapis.com/css?family=Abel);


body {
  font-family: {!! $base_font_family !!};
  background-color:{!! get_theme_option($theme_id,'background-color','#ffffff') !!};
  color : <?php get_theme_option($theme_id,'color','#333'); ?>;
  position: relative;
  font-size : {!! get_theme_option($theme_id,'base-font-size','12px') !!};
  font-weight:400;
}

ul li {
  list-style: none;
}

a:hover {
outline: none;
text-decoration:none;
}

a:focus {
  outline:none;
  outline-offset: 0;
}

a {
  -webkit-transition: 300ms;
  -moz-transition: 300ms;
    -o-transition: 300ms;
    transition: 300ms;
}

h1, h2, h3, h4, h5, h6 {
  font-family: {!! $heading_font_family !!};
}

.btn:hover,
.btn:focus{
  outline: none;
  box-shadow: none;
}

.navbar-toggle {
  background-color: #000;
}

a#scrollUp {
  bottom: 0px;
  right: 10px;
  padding: 5px 10px;
  background: #FE980F;
  color: #FFF;
  -webkit-animation: bounce 2s ease infinite;
  animation: bounce 2s ease infinite;
}

a#scrollUp i{
  font-size: 30px;
}


/*************************
*******Header CSS******
**************************/

.header_top {
  background: none repeat scroll 0 0 #F0F0E9;
}

.contactinfo ul li:first-child{
    margin-left: -15px;
}

.contactinfo ul li a{
  font-size: 12px;
  color: #696763;
  font-family: {!! $base_font_family !!};
}


.contactinfo ul li a:hover{
	background:inherit;
}


.social-icons ul li a {
  border: 0 none;
  border-radius: 0;
  color: #696763;
  padding:0px;
}


.social-icons ul li{
	display:inline-block;
}

.social-icons ul li a i {
  padding: 11px 15px;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}

.social-icons ul li a i:hover{
  color: #fff;
   transition: all 0.9s ease 0s;
  -moz-transition: all 0.9s ease 0s;
  -webkit-transition: all 0.9s ease 0s;
  -o-transition: all 0.9s ease 0s;
}


.fa-facebook:hover {
  background: #0083C9;
}

.fa-twitter:hover  {
	background:#5BBCEC;
}

.fa-linkedin:hover  {
	background:#FF4518;
}

.fa-dribbble:hover  {
	background:#90C9DC;
}

.fa-google-plus:hover  {
	background:#CE3C2D;
}

.header-middle .container .row {
  border-bottom: 1px solid #f5f5f5;
  margin-left: 0;
  margin-right: 0;
  padding-bottom: 20px;
  padding-top: 20px;
}

.header-middle .container .row .col-sm-4{
  padding-left: 0;
}

.header-middle .container .row .col-sm-8 {
	padding-right:0;
}

.usa {
  border-radius: 0;
  color: #B4B1AB;
  font-size: 12px;
  margin-right: 20px;
  padding: 2px 15px;
  margin-top: 10px;
}

.usa:hover {
	background:#FE980F;
	color:#fff;
	border-color:#FE980F;
}

.usa:active, .usa.active {
  background: none repeat scroll 0 0 #FE980F;
  box-shadow: inherit;
  outline: 0 none;
}

.btn-group.open .dropdown-toggle {
  background: rgba(0, 0, 0, 0);
  box-shadow: none;
}

.dropdown-menu  li  a:hover, .dropdown-menu  li  a:focus {
  background-color: #FE980F;
  color: #FFFFFF;
  font-family: {!! $base_font_family !!};
  text-decoration: none;
}


.shop-menu ul li {
	display:inline-block;
  padding-left: 15px;
  padding-right: 15px;
}

.shop-menu ul li:last-child {
  padding-right: 0;
}


.shop-menu ul li a {
  background: #FFFFFF;
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 300;
  padding:0;
  padding-right: 0;
  margin-top: 10px;
}


.shop-menu ul li a i{
	margin-right:3px;
}


.shop-menu ul li a:hover {
	color:#fe980f;
	background:#fff;
}


.header-bottom {
  padding-bottom: 30px;
  padding-top: 30px;
}

.navbar-collapse.collapse{
  padding-left: 0;
}

.mainmenu ul li{
  padding-right: 15px;
  padding-left: 15px;
}

.mainmenu ul li:first-child{
  padding-left: 0px;
}

.mainmenu ul li a {
	color: #696763;
	font-family: {!! $base_font_family !!};
	font-size: 17px;
	font-weight: 300;
	padding: 0;
	padding-bottom: 10px;
}

.mainmenu ul li a:hover, .mainmenu ul li a.active,  .shop-menu ul li a.active{
	background:none;
	color:#fdb45e;
}

.search_box input {
    background: #F0F0E9;
    border: medium none;
    color: #B2B2B2;
    font-family: {!! $base_font_family !!};
    font-size: 12px;
    font-weight: 300;
    height: 35px;
    outline: medium none;
    padding-left: 10px;
    width: 155px;
    background-image: url({{getAssetPath()}}/images/home/searchicon.png);
    background-repeat: no-repeat;
    background-position: 130px;
    border-radius: 0;
    border: none;
    box-shadow: none;
}


/*  Dropdown menu*/

.navbar-header
.navbar-toggle .icon-bar {
    background-color: #fff;
}


.nav.navbar-nav > li:hover > ul.sub-menu{
  display: block;
  -webkit-animation: fadeInUp 400ms;
  -moz-animation: fadeInUp 400ms;
  -ms-animation: fadeInUp 400ms;
  -o-animation: fadeInUp 400ms;
  animation: fadeInUp 400ms;
}

ul.sub-menu {
	position: absolute;
	top: 30px;
	left: 0;
	background: rgba(0, 0, 0, 0.6);
	list-style: none;
	padding: 0;
	margin: 0;
	width: 220px;
	-webkit-box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
	display: none;
	z-index: 999;
}

.dropdown ul.sub-menu li .active{
  color: #FDB45E;
  padding-left: 0;
}


.navbar-nav li ul.sub-menu li{
  padding: 10px 20px 0 ;
}

.navbar-nav li ul.sub-menu li:last-child{
  padding-bottom: 20px;
}

.navbar-nav li ul.sub-menu li a{
  color: #fff;
}

.navbar-nav li ul.sub-menu li a:hover{
    color: #FDB45E;
}

.fa-angle-down{
  padding-left: 5px;
}

@-webkit-keyframes fadeInUp {
  0% {
    opacity: 0;
    -webkit-transform: translateY(20px);
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    -webkit-transform: translateY(0);
    transform: translateY(0);
  }
}

/*************************
*******Footer CSS******
**************************/

#footer {
  background: #F0F0E9;
}


.footer-top .container {
  border-bottom: 1px solid #E0E0DA;
  padding-bottom: 20px;
}

.companyinfo {
  margin-top: 57px;
}

.companyinfo h2 {
  color: #B4B1AB;
  font-family: {!! $heading_font_family !!};
  font-size: 27px;
  text-transform: uppercase;
}

.companyinfo h2  span{
  color:#FE980F;
}

.companyinfo p {
  color: #B3B3AD;
  font-family: {!! $base_font_family !!};
  font-size: 12px;
  font-weight: 300;
}

.footer-top .col-sm-3{
  overflow: hidden;
}

.video-gallery {
  margin-top: 57px;
  position: inherit;
}

.video-gallery a img {
  height: 100%;
  width: 100%;
}

.iframe-img {
  position: relative;
  display: block;
  height: 61px;
  margin-bottom: 10px;
  border: 2px solid #CCCCC6;
  border-radius: 3px;
}

.overlay-icon {
  position: absolute;
  top: 0;
  width: 100%;
  height: 61px;
  background: #FE980F;
  border-radius: 3px;
  color: #FFF;
  font-size: 20px;
  line-height: 0;
  display: block;
  opacity: 0;
   -webkit-transition: 300ms;
  -moz-transition: 300ms;
    -o-transition: 300ms;
    transition: 300ms;
}

.overlay-icon i {
  position: relative;
  top: 50%;
  margin-top: -20px;
}

.video-gallery a:hover .overlay-icon{
  opacity: 1;
}

.video-gallery p {
  color: #8C8C88;
  font-family: {!! $base_font_family !!};
  font-size: 12px;
  font-weight: 500;
  margin-bottom:0px;
}

.video-gallery  h2 {
  color: #8c8c88;
  font-family: {!! $heading_font_family !!};
  font-size: 12px;
  font-weight: 300;
  text-transform:uppercase;
  margin-top:0px;
}


.address {
  margin-top: 30px;
  position: relative;
  overflow: hidden;
}
.address  img {
	width:100%;
}

.address p {
  color: #666663;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 300;
  left: 25px;
  position: absolute;
  top: 50px;
}

.footer-widget {
  margin-bottom: 68px;
}

.footer-widget .container {
  border-top: 1px solid #FFFFFF;
  padding-top: 15px;
}

.single-widget h2 {
  color: #666663;
  font-family: {!! $heading_font_family !!};
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 22px;
  text-transform: uppercase;
}

.single-widget h2 i{
	margin-right:15px;
}

.single-widget ul li a{
	color: #8C8C88;
	font-family: {!! $base_font_family !!};
	font-size: 14px;
	font-weight: 300;
	padding: 5px 0;
}

.single-widget ul li a i {
  margin-right: 18px;
}

.single-widget ul li a:hover{
	background:none;
	color:#FE980F;
}


.searchform input {
  border: 1px solid #DDDDDD;
  color: #CCCCC6;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  margin-top: 0;
  outline: medium none;
  padding: 8px;
  width: 212px;
}


.searchform button {
  background: #FE980F;
  border: medium none;
  border-radius: 0;
  margin-left: -5px;
  margin-top: -3px;
  padding: 7px 17px;
}

.searchform button i {
  color: #FFFFFF;
  font-size: 20px;
}

.searchform  button:hover,
.searchform  button:focus{
	background-color:#FE980F;
}

.searchform p {
  color: #8C8C88;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 300;
  margin-top: 25px;
}

.footer-bottom {
  background: #D6D6D0;
  padding-top: 10px;
}

.footer-bottom p {
  color: #363432;
  font-family: {!! $base_font_family !!};
  font-weight: 300;
  margin-left: 15px;
}

.footer-bottom p span a {
  color: #FE980F;
  font-style: italic;
  text-decoration: underline;
}


/*************************
******* Home ******
**************************/


#slider {
  padding-bottom: 45px;
}

.carousel-indicators li {
  background: #C4C4BE;
}

.carousel-indicators li.active {
	  background: #FE980F;
}

.item {
  padding-left: 100px;
}


.pricing {
  position: absolute;
  right: 40%;
  top: 52%;
}

.girl {
  margin-left: 0;
}

.item h1 {
  color: #B4B1AB;
  font-family: {!! $heading_font_family !!};
  font-size: 48px;
  margin-top: 115px;
}

.item h1 span {
	color:#FE980F;
}

.item h2 {
  color: #363432;
  font-family: {!! $heading_font_family !!};
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 22px;
  margin-top: 10px;
}

.item  p {
	color:#363432;
	font-size:16px;
	font-weight:300;
	font-family: {!! $base_font_family !!};
}

.get {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  color: #FFFFFF;
  font-family: {!! $base_font_family !!};
  font-size: 16px;
  font-weight: 300;
  margin-top: 23px;
}


.item button:hover {
  background: #FE980F;
}

.control-carousel {
  position: absolute;
  top: 50%;
  font-size: 60px;
  color: #C2C2C1;
}

.control-carousel:hover{
  color: #FE980F ;
}

.right {
  right: 0;
}

.category-products {
  border: 1px solid #F7F7F0;
  margin-bottom: 35px;
  padding-bottom: 10px;
  padding-top: 10px;
}

.left-sidebar h2, .brands_products h2, .pro-header h1, .bread-wrapper h1, .title-box h1 {
  color: #FE980F;
  font-family: {!! $heading_font_family !!};
  font-size: 18px;
  font-weight: 700;
  margin: 0 auto 15px;
  text-align: center;
  text-transform: uppercase;
  position: relative;
  z-index:3;
}

.left-sidebar h2:after, h2.title:after, .pro-header h1:after, .bread-wrapper h1:after, .title-box h1:after {
	content: " ";
	position: absolute;
	border: 1px solid #f5f5f5;
	bottom:8px;
	left: 0;
	width: 100%;
	height: 0;
	z-index: -2;
}

.left-sidebar h2:before, .pro-header h1:before, .bread-wrapper h1:before, .title-box h1:before{
	content: " ";
	position: absolute;
	background: #fff;
	bottom: -6px;
	width: 130px;
	height: 30px;
	z-index: -1;
	left: 50%;
	margin-left: -65px;
}

h2.title:before{
	content: " ";
	position: absolute;
	background: #fff;
	bottom: -6px;
	width: 220px;
	height: 30px;
	z-index: -1;
	left: 50%;
	margin-left: -110px;
}

.bread-wrapper h1{ margin:0;}
.bread-wrapper h1:before{ width:270px; margin-left:-136px;}
.title-box h1:before{ width:300px; margin-left:-150px;}
.pro-header h1:before{ width:300px; margin-left:-150px;}
.pro-header .breadcrumb, .bread-wrapper .breadcrumb{ background:none; padding:5px 15px;}
.pro-header .breadcrumb a, .bread-wrapper .breadcrumb a{color:#FE980F;}
.pro-header h1, .bread-wrapper .h1{ margin:0px;}
.pro-info-header select{ width: auto; display: inline-block;}

.categories-list .col-item{ border:1px solid #F7F7F0;}
.categories-list .col-item .info{ border-top:1px solid #F7F7F0; overflow:hidden;}
.categories-list .col-item .info h5{ font-size: 16px; font-weight: 700; color:#FE980F;}
.categories-list .col-item .info h4{ font-size: 14px; font-weight: normal; color:#696763;}

.specific-category{ overflow:hidden; margin-top:30px;}
.category-products .panel {
	background-color: #FFFFFF;
	border: 0px;
	border-radius: 0px;
	box-shadow:none;
	margin-bottom: 0px;
}

.category-products .panel-default .panel-heading {
  background-color: #FFFFFF;
  border: 0 none;
  color: #FFFFFF;
  padding: 5px 20px;
}

.category-products .panel-default .panel-heading .panel-title a {
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  text-decoration: none;
  text-transform: uppercase;
}

.panel-group .panel-heading + .panel-collapse .panel-body {
  border-top: 0 none;
}

.category-products .badge {
  background:none;
  border-radius: 10px;
  color: #696763;
  display: inline-block;
  font-size: 12px;
  font-weight: bold;
  line-height: 1;
  min-width: 10px;
  padding: 3px 7px;
  text-align: center;
  vertical-align: baseline;
  white-space: nowrap;
}

.panel-body ul{
  padding-left: 20px;
}


.panel-body ul li a {
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-size: 12px;
  text-transform: uppercase;
}

.brands-name {
  border: 1px solid #F7F7F0;
  padding-bottom: 20px;
  padding-top: 15px;
}


.brands-name .nav-stacked li a {
  background-color: #FFFFFF;
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  padding: 5px 25px;
  text-decoration: none;
  text-transform: uppercase;
}

.brands-name .nav-stacked li a:hover{
  background-color: #fff;
  color: #696763;
}

.shipping {
  background-color: #F2F2F2;
  margin-top: 40px;
  overflow: hidden;
  padding-top: 20px;
  position: relative;
}


.price-range{
  margin-top:30px;
}

.well {
  background-color: #FFFFFF;
  border: 1px solid #F7F7F0;
  border-radius: 4px;
  box-shadow: none;
  margin-bottom: 20px;
  min-height: 20px;
  padding: 35px;
}


.tooltip-inner {
  background-color: #FE980F;
  border-radius: 4px;
  color: #FFFFFF;
  max-width: 200px;
  padding: 3px 8px;
  text-align: center;
  text-decoration: none;
}

.tooltip.top .tooltip-arrow {
  border-top-color: #FE980F;
  border-width: 5px 5px 0;
  bottom: 0;
  left: 50%;
  margin-left: -5px;
}


.padding-right {
  padding-right: 0;
}

.features_items{
	overflow:hidden;
}


h2.title {
  color: #FE980F;
  font-family: {!! $heading_font_family !!};
  font-size: 18px;
  font-weight: 700;
  margin: 0 15px;
  text-transform: uppercase;
  margin-bottom: 30px;
  position: relative;
}

.product-image-wrapper{
	border:1px solid #F7F7F5;
	overflow: hidden;
	margin-bottom:30px;
}

.single-products {
  position: relative;
}

.new, .sale {
  position: absolute;
  top: 0;
  right: 0;
}

.productinfo h2{
	color: #FE980F;
	font-family: {!! $heading_font_family !!};
	font-size: 24px;
	font-weight: 700;
}
.product-overlay h2{
	color: #fff;
	font-family: {!! $heading_font_family !!};
	font-size: 24px;
	font-weight: 700;
}


.productinfo p{
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 400;
  color: #696763;
}

.productinfo img{
  width: 100%;
}

.productinfo{
 position:relative;
}

.product-overlay {
  background:#FE980F;
  top: 0;
  display: none;
  height: 0;
  position: absolute;
  transition: height 500ms ease 0s;
  width: 100%;
  display: block;
  opacity:;
}

.single-products:hover .product-overlay {
  display:block;
  height:100%;
}


.product-overlay .overlay-content {
  bottom: 0;
  position: absolute;
  bottom: 0;
  text-align: center;
  width: 100%;
}

.product-overlay .add-to-cart {
  background:#fff;
  border: 0 none;
  border-radius: 0;
  color: #FE980F;
  font-family: {!! $base_font_family !!};
  font-size: 15px;
  margin-bottom: 25px;
}

.product-overlay .add-to-cart:hover {
  background:#fff;
  color: #FE980F;
}


.product-overlay p{
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 400;
  color: #fff;
}



.add-to-cart {
  background:#F5F5ED;
  border: 0 none;
  border-radius: 0;
  color: #696763;
  font-family: 'Roboto', sans-serif;
  font-size: 15px;
  margin-bottom: 25px;
}

.add-to-cart:hover {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  color: #FFFFFF;
}

.add-to{
  margin-bottom: 10px;
}

.add-to-cart i{
	margin-right:5px;
}

.add-to-cart:hover {
  background: #FE980F;
  color: #FFFFFF;
}

.choose {
  border-top: 1px solid #F7F7F0;
}

.choose ul li a {
  color: #B3AFA8;
  font-family: {!! $base_font_family !!};
  font-size: 13px;
  padding-left: 0;
  padding-right: 0;
}

.choose ul li a i{
	margin-right:5px;
}

.choose ul li a:hover{
	background:none;
	color:#FE980F;
}

.category-tab {
  overflow: hidden;
}

.category-tab ul {
  background: #40403E;
  border-bottom: 1px solid #FE980F;
  list-style: none outside none;
  margin: 0 0 30px;
  padding: 0;
  width: 100%;
}

.category-tab ul li a {
  border: 0 none;
  border-radius: 0;
  color: #B3AFA8;
  display: block;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  text-transform: uppercase;
}

.category-tab ul  li  a:hover{
	background:#FE980F;
	color:#fff;
}

.nav-tabs  li.active  a, .nav-tabs  li.active  a:hover, .nav-tabs  li.active  a:focus {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #FE980F;
  border:0px;
  color: #FFFFFF;
  cursor: default;
  margin-right:0;
  margin-left:0;
}

.nav-tabs  li  a {
  border: 1px solid rgba(0, 0, 0, 0);
  border-radius: 4px 4px 0 0;
  line-height: 1.42857;
  margin-right:0;
}

.recommended_items {
  overflow: hidden;
}

#recommended-item-carousel .carousel-inner .item {
  padding-left: 0;
}

.recommended-item-control {
  position: absolute;
  top: 41%;
}

.recommended-item-control i {
  background: none repeat scroll 0 0 #FE980F;
  color: #FFFFFF;
  font-size: 20px;
  padding: 4px 10px;
}

.recommended-item-control i:hover {
  background: #ccccc6;
}

.recommended_items  h2 {
}

.our_partners{
  overflow:hidden;
}

.our_partners ul {
  background: #F7F7F0;
  margin-bottom: 50px;
}


.our_partners ul li a:hover{
	background:none;
}

/*************************
*******Shop CSS******
**************************/


#advertisement {
  padding-bottom: 45px;
}

#advertisement img {
  width: 100%;
}

.pagination {
  display: inline-block;
  margin-bottom: 25px;
  margin-top: 0;
  padding-left: 15px;
}

.pagination  li:first-child  a, .pagination  li:first-child  span {
  border-bottom-left-radius: 0;
  border-top-left-radius: 0;
  margin-left: 0;
}

.pagination  li:last-child  a, .pagination  li:last-child  span {
  border-bottom-right-radius: 0;
  border-top-right-radius: 0;
}

.pagination  .active  a, .pagination  .active  span, .pagination  .active  a:hover, .pagination  .active  span:hover, .pagination  .active  a:focus, .pagination  .active  span:focus {
  background-color: #FE980F;
  border-color: #FE980F;
  color: #FFFFFF;
  cursor: default;
  z-index: 2;
}

.pagination  li  a, .pagination  li  span {
  background-color: #f0f0e9;
  border: 0;
  float: left;
  line-height: 1.42857;
  margin-left: -1px;
  padding: 6px 12px;
  position: relative;
  text-decoration: none;
  margin-right: 5px;
  color:#000;
}

.pagination  li  a:hover{
	background:#FE980F;
	color:#fff;
}



/*************************
*******Product Details CSS******
**************************/

.product-details{
	overflow:hidden;
}


#similar-product {
  margin-top: 40px;
}


#reviews {
  padding-left: 25px;
  padding-right: 25px;
}

.product-details {
  margin-bottom: 40px;
  overflow: hidden;
  margin-top: 10px;
}



.view-product {
  position: relative;
}

.view-product img {
  border: 1px solid #F7F7F0;
  height: 380px;
  width: 100%;
}

.view-product h3 {
  background: #FE980F;
  bottom: 0;
  color: #FFFFFF;
  font-family: {!! $heading_font_family !!};
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 0;
  padding: 8px 20px;
  position: absolute;
  right: 0;
}

#similar-product .carousel-inner .item{
	padding-left:0px;
}

#similar-product .carousel-inner .item img {
  display: inline-block;
  margin-left: 15px;
}

.item-control {
  position: absolute;
  top: 35%;
}
.item-control i {
  background: #FE980F;
  color: #FFFFFF;
  font-size: 20px;
  padding: 5px 10px;
}

.item-control i:hover{
	background:#ccccc6;
}

.product-information {
  border: 1px solid #F7F7F0;
  overflow: hidden;
  padding: 30px;
  position: relative;
  min-height:380px;
}

.newarrival{
	position:absolute;
	top:0;
	left:0
}

.product-information h2 {
  color: #363432;
  font-family: {!! $heading_font_family !!};
  font-size: 20px;
  margin-top: 0;
}

.product-information p {
  color: #696763;
  font-family: {!! $base_font_family !!};
  margin-bottom: 5px;
}

.product-information span {
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
  color:#686765;
  min-width:100px;
}
a.cart_product_color_selection{color:#686765; position:relative;}
a.cart_product_color_selection:after{content:'|'; right: -15px; position: absolute; color: #686765;}
a.cart_product_color_selection.active{color:#fe980f; text-decoration:underline;}
a.cart_product_color_selection:last-child:after{ content:'';}

.product-thumbnails{ overflow:hidden; margin-top:20px;}
.product-thumbnails a{ float:left; margin-right:10px;}
.product-thumbnails a:last-child{margin-right:0;}

.product-colors{ margin-bottom:20px; margin-top:30px;}
.product-colors a{ margin-left:10px; margin-right:10px; }
.product-colors div a:first-of-type{margin-left:0px;}
.product-colors .color-1{ margin-bottom:10px;}

.qty-wrapper{ overflow:hidden; display:table;}
.qty-wrapper .title{display:table-cell; padding-right:10px; vertical-align:middle;}
.qty-wrapper .select-qty{ display:table-cell;}
.qty-wrapper .select-qty input{float:left; -webkit-appearance: none; appearance: none; width:auto; border-left:0; border-right:0; height:33px;box-shadow: none;}

.qty-wrapper .select-qty .qty-btn{ float:left;}
.qty-wrapper .select-qty .qty-btn button{ background:none; border-radius:0px; border:1px solid #ccc;}
.qty-wrapper .select-qty .qty-btn button i{ color: #686765; font-size: 12px; font-weight: 100;}

.total-price{ display:table; padding: 20px 0;}
.total-price .title{ font-size:20px;}
.total-price .cartBtn button{ margin:0px;background: #fe980f; color: #fff;}

.p-title span img{ margin-left:-4px;}

.social-share{ overflow:hidden; margin-top:20px;}
.social-share span{padding-top:8px; font-weight:bold; float:left;}
.social-share a{ margin-right: 10px; float: left; font-size: 22px; width: 30px; height: 30px; text-align: center; background-color: #aab4bc; color:#ffffff; margin-top:0;}

.social-share a.fb:hover{ background-color:#2879b8;}
.social-share a.tw:hover{ background-color:#1da1f3;}				
.social-share a.pt:hover{ background-color:#be091c;}
.social-share a.inst:hover{ background-color:#375987;}
.social-share a.share:hover{ background-color:#21bfbe;}
				
.wishlist{ margin-left: 56px; margin-top: 20px;}
.wishlist a.favourite{color:#fe980f;}
.wishlist a.favourite:hover{text-decoration:underline;}

.actual-price{ margin-right: 20px;  min-width: 142px;  font-size: 20px !important; color: #fe980f !important;}

.order-title-box{ border: 1px solid #f1f1f1;  padding: 10px; margin-top: 15px; overflow:hidden; background: #f0efea;}
.order-title-box .select-category{float:right;}
.order-wrapper {
  overflow: hidden;
  background: #ffffff;
  margin-bottom: 15px;
  box-shadow: 0px 0px 1px #e2e2e2; }
  .order-wrapper .order-list-wrapper {
    overflow: hidden;
    padding: 0px;
    border-bottom: 1px solid #e2e2e2; display:table; width:100%;}
  .order-wrapper .order-list-wrapper [class*='col-']{display:table-cell; float:none; vertical-align:top; border-right:1px solid #f1f1f1;}
  .order-wrapper .order-list-wrapper [class*='col-']:last-child{border-right:none;}
    .order-wrapper .order-list-wrapper .product-det-txt {
      line-height: 20px; margin-top:20px;
      color: #333333; }
    .order-wrapper .order-list-wrapper .finance span {
      display: inline-block;
      padding: 0 10px;
      min-width: 90px; }
    .order-wrapper .order-list-wrapper .store-name {
      padding-bottom: 10px; padding-top:20px;}
    .order-wrapper .order-list-wrapper .time {
      color: #666666;}
    .order-wrapper .order-list-wrapper .delete-list a {
      border-bottom: 1px solid #00aeef;
      padding-bottom: 5px; }
      .order-wrapper .order-list-wrapper .delete-list a:hover {
        text-decoration: none; }
    .order-wrapper .order-list-wrapper a{color:#fdb45e;}
    .order-wrapper .order-list-wrapper a:hover{color:#FE980F;}
    .order-wrapper .order-list-wrapper .per-piece { font-size: 16px; font-weight: bold;  margin-top: 15px; color:#666666; }
      .order-wrapper .order-list-wrapper .per-piece sub {
        color: #959595;
        font-size: 14px;
        font-weight: normal; }
    .order-wrapper .order-list-wrapper .del-s {
            text-align: center;
            vertical-align: middle;
            border-left: 0;
		}
  .order-wrapper .order-detail-wrapper {
    overflow: hidden;
    padding: 15px;
    border-bottom: 1px solid #e2e2e2; }
    .order-wrapper .order-detail-wrapper .left-col {
      float: left; }
      .order-wrapper .order-detail-wrapper .left-col .status {
        padding-bottom: 6px; }
    .order-wrapper .order-detail-wrapper .right-col {
      float: right; }
      .order-wrapper .order-detail-wrapper .right-col .sc {
        padding-bottom: 6px; }
      .order-wrapper .order-detail-wrapper .right-col span {
        color: #333333; }
  .order-wrapper .order-status-wrapper {
    overflow: hidden;
    background: #fafafa;
    padding: 15px 0; }
    .order-wrapper .order-status-wrapper .status-title {
      padding-bottom: 6px;
      color: #505050; }
    .order-wrapper .order-status-wrapper .order-status {
      color: #333333;
      font-weight: bold; }
    .order-wrapper .order-status-wrapper .seller-name {
      padding-bottom: 6px; }
    .order-wrapper .order-status-wrapper button {
      width: 100%; }

.pagination-wrapper {
  overflow: hidden;
  background: #ffffff;
  padding: 15px;
  margin-bottom: 30px;
  border: 1px solid #f1f1f1; 
  }
  .pagination-wrapper .pages-limit {
    float: left;
    overflow: hidden; }
    .pagination-wrapper .pages-limit label, .pagination-wrapper .pages-limit select {
      float: left;
      margin-right: 10px;
      width: auto; }
    .pagination-wrapper .pages-limit label {
      margin-top: 10px; }
  .pagination-wrapper .pagination-box {
    float: right;
    height: 30px; }
    .pagination-wrapper .pagination-box .pagination {
      margin: 0; }
      .pagination-wrapper .pagination-box .pagination li {
        border: none; }
        .pagination-wrapper .pagination-box .pagination li.active a, .pagination-wrapper .pagination-box .pagination li a:hover {
          background: #00aeef;
          color: #ffffff; }
        .pagination-wrapper .pagination-box .pagination li span {
          border: none; }
        .pagination-wrapper .pagination-box .pagination li a {
          background: #e9e9e9;
          font-family: sans-serif, arial;
          color: #666666;
          border: none;
          border-radius: 0;
          margin-left: 5px; }

#suggesstion-box
{
	position: absolute;
	width: auto;
	display: none;
	overflow: hidden;
	background-color:#F0F0E9;
	z-index: 99999999;
	right:15px;
}
#suggesstion-box .no-suggestion{ padding:20px 18px;}

#suggesstion-box ul {
	list-style-type: none;
	margin: 0;
	padding: 0;
	width: auto;
	background-color: #F0F0E9;
}
#suggesstion-box ul li{ border-bottom: 1px solid #ccc;}

#suggesstion-box li a {
	display: block;
	color: #333;
	padding: 10px;
	text-decoration: none;
    white-space:nowrap;
}
#suggesstion-box li a span{
	white-space:nowrap;
}

#suggesstion-box li a:hover {
	background-color:#fafafa;
	color: #333;
}


.product-information span span {
  color: #FE980F;
  float: left;
  font-family: {!! $base_font_family !!};
  font-size: 30px;
  font-weight: 700;
  margin-right: 20px;
  margin-top: 0px;
}
.product-information span input {
  border: 1px solid #DEDEDC;
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-size: 20px;
  font-weight: 700;
  height: 33px;
  outline: medium none;
  text-align: center;
  width: 50px;
}

.product-information span label {
  color: #696763;
  font-family: {!! $base_font_family !!};
  font-weight: 700;
  margin-right: 5px;
}

.share {
  margin-top: 15px;
}


.cart {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  color: #FFFFFF;
  font-family: {!! $base_font_family !!};
  font-size: 15px;
  margin-bottom: 10px;
  margin-left: 20px;
}


.shop-details-tab {
  border: 1px solid #F7F7F0;
  margin-bottom: 75px;
  margin-left: 15px;
  margin-right: 15px;
  padding-bottom: 10px;
}
.shop-details-tab .col-sm-12 {
	padding-left: 0;
	padding-right: 0;
}


#reviews ul {
  background: #FFFFFF;
  border: 0 none;
  list-style: none outside none;
  margin: 0 0 20px;
  padding: 0;
}

#reviews  ul  li {
	display:inline-block;
}

#reviews ul li a {
  color: #696763;
  display: block;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  padding-right: 15px;
}

#reviews ul li a i{
	color:#FE980F;
	padding-right:8px;
}

#reviews ul li a:hover{
	background:#fff;
	color:#FE980F;
}

#reviews p{
	color:#363432;
}

#reviews  form span {
  display: block;
}

#reviews form span input {
  background:#F0F0E9;
  border: 0 none;
  color: #A6A6A1;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  outline: medium none;
  padding: 8px;
  width: 48%;
}
#reviews form span input:last-child {
  margin-left: 3%;
}

#reviews textarea {
  background: #F0F0E9;
  border: medium none;
  color: #A6A6A1;
  height: 195px;
  margin-bottom: 25px;
  margin-top: 15px;
  outline: medium none;
  padding-left: 10px;
  padding-top: 15px;
  resize: none;
  width: 99.5%;
}

#reviews button {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  color: #FFFFFF;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
}


/*************************
*******404 CSS******
**************************/

.logo-404 {
  margin-top: 60px;
}

.content-404 h1 {
  color: #363432;
  font-family: {!! $heading_font_family !!};
  font-size: 41px;
  font-weight: 300;
}

.content-404 img {
 margin:0 auto;
}

.content-404 p {
  color: #363432;
  font-family: {!! $base_font_family !!};
  font-size: 18px;
}

.content-404  h2 {
  margin-top:50px;
}

.content-404 h2 a {
  background: #FE980F;
  color: #FFFFFF;
  font-family: {!! $base_font_family !!};
  font-size: 44px;
  font-weight: 300;
  padding: 8px 40px;
}


/*************************
*******login page CSS******
**************************/

#form {
  display: block;
  margin-bottom: 185px;
  margin-top: 185px;
  overflow: hidden;
}

.login-form {

}

.signup-form {

}

.login-form h2, .signup-form h2 {
  color: #696763;
  font-family: {!! $heading_font_family !!};
  font-size: 20px;
  font-weight: 300;
  margin-bottom: 30px;
}


.login-form form input, .signup-form form input {
  background: #F0F0E9;
  border: medium none;
  color: #696763;
  display: block;
  font-family: {!! $base_font_family !!};
  font-size: 14px;
  font-weight: 300;
  height: 40px;
  margin-bottom: 10px;
  outline: medium none;
  padding-left: 10px;
  width: 100%;
}

.login-form form span{
  line-height: 25px;
}

.login-form form span input {
  width: 15px;
  float: left;
  height: 15px;
  margin-right: 5px;
}

.login-form form button {
  margin-top: 23px;
}

.login-form form button, .signup-form form button {
  background: #FE980F;
  border: medium none;
  border-radius: 0;
  color: #FFFFFF;
  display: block;
  font-family: {!! $base_font_family !!};
  padding: 6px 25px;
}

.login-form label{

}


.login-form label input {
  border: medium none;
  display: inline-block;
  height: 0;
  margin-bottom: 0;
  outline: medium none;
  padding-left: 0;
}


.or{
	background: #FE980F;
	border-radius: 40px;
	color: #FFFFFF;
	font-family: {!! $base_font_family !!};
	font-size: 16px;
	height: 50px;
	line-height: 50px;
	margin-top: 75px;
	text-align: center;
	width: 50px;
}


/*************************
*******Cart CSS******
**************************/

#do_action {
  margin-bottom: 50px;
}

.breadcrumbs {
  position: relative;
}

.breadcrumbs .breadcrumb {
  background:transparent;
  margin-bottom: 75px;
  padding-left: 0;
}

.breadcrumbs .breadcrumb li a {
  background:#FE980F;
  color: #FFFFFF;
  padding: 3px 7px;
}

.breadcrumbs .breadcrumb li a:after {
  content:"";
  height:auto;
  width: auto;
  border-width: 8px;
  border-style: solid;
  border-color:transparent transparent transparent #FE980F;
  position: absolute;
  top: 11px;
  left:48px;

}

.breadcrumbs .breadcrumb > li + li:before {
  content: " ";
}

#cart_items .cart_info {
  border: 1px solid #E6E4DF;
  margin-bottom: 50px
}


#cart_items .cart_info .cart_menu {
  background: #FE980F;
  color: #fff;
  font-size: 16px;
  font-family: {!! $base_font_family !!};
  font-weight: normal;
}

#cart_items .cart_info .table.table-condensed thead tr {
  height: 51px;
}


#cart_items .cart_info .table.table-condensed tr {
  border-bottom: 1px solid#F7F7F0
}

#cart_items .cart_info .table.table-condensed tr:last-child {
  border-bottom: 0
}

.cart_info table tr td {
  border-top: 0 none;
  vertical-align: inherit;
}


#cart_items .cart_info .image {
  padding-left: 30px;
}


#cart_items .cart_info .cart_description h4 {
  margin-bottom: 0
}

#cart_items .cart_info .cart_description h4 a {
  color: #363432;
  font-family: {!! $base_font_family !!};
  font-size: 20px;
  font-weight: normal;

}

#cart_items .cart_info .cart_description p {
  color:#696763
}


#cart_items .cart_info .cart_price p {
  color:#696763;
  font-size: 18px
}


#cart_items .cart_info .cart_total_price {
  color: #FE980F;
  font-size: 24px;
}

.cart_product {
  display: block;
  margin: 15px -70px 10px 25px;
}

.cart_quantity_button a {
  background:#F0F0E9;
  color: #696763;
  display: inline-block;
  font-size: 16px;
  height: 28px;
  overflow: hidden;
  text-align: center;
  width: 35px;
  float: left;
}


.cart_quantity_input {
  color: #696763;
  float: left;
  font-size: 16px;
  text-align: center;
  font-family: {!! $base_font_family !!};

}


.cart_delete  {
  display: block;
  margin-right: -12px;
  overflow: hidden;
}


.cart_delete a {
  background:#F0F0E9;
  color: #FFFFFF;
  padding: 5px 7px;
  font-size: 16px
}

.cart_delete a:hover {
  background:#FE980F
}


.bg h2.title {
  margin-right:0;
  margin-left:0;
  margin-top: 0;
}

.heading h3 {
  color: #363432;
  font-size: 20px;
  font-family: {!! $heading_font_family !!};
}

.heading p {
  color: #434343;
  font-size: 16px;
  font-weight: 300;
}


#do_action .total_area {
  padding-bottom: 18px !important;
}

#do_action .total_area, #do_action .chose_area {
  border: 1px solid #E6E4DF;
  color: #696763;
  padding: 30px 25px 30px 0;
  margin-bottom: 80px;
}

.total_area span {
  float: right;
}

.total_area ul li {
  background:#E6E4DF;
  color: #696763;
  margin-top: 10px;
  padding: 7px 20px;
}


.user_option label {
  color: #696763;
  font-weight: normal;
  margin-left: 10px;
}


.user_info {
  display: block;
  margin-bottom: 15px;
  margin-top: 20px;
  overflow: hidden;
}

.user_info label {
  color: #696763;
  display: block;
  font-size: 15px;
  font-weight: normal;

}

.user_info .single_field {
  width: 31%
}

.user_info .single_field.zip-field input {
  background: transparent;
  border: 1px solid#F0F0E9
}

.user_info > li {
  float: left;
  margin-right: 10px
}

.user_info > li > span {
}

.user_info input, select, textarea {
  background: #F0F0E9;
  border:0;
  color: #696763;
  padding: 5px;
  width: 100%;
  border-radius: 0;
  resize: none
}

.user_info select:focus {
  border: 0
}


.chose_area .update {
  margin-left: 40px;
}

.update, .check_out {
  background: #FE980F;
  border-radius: 0;
  color: #FFFFFF;
  margin-top: 18px;
  border: none;
  padding: 5px 15px;
}
.update{
    margin-left: 40px;
}

.check_out {
  margin-left: 20px
}



/*************************
*******checkout CSS******
**************************/

.step-one {
  margin-bottom: -10px
}

.register-req, .step-one .heading {
  background: none repeat scroll 0 0 #F0F0E9;
  color: #363432;
  font-size: 20px;
  margin-bottom: 35px;
  padding: 10px 25px;
  font-family: {!! $base_font_family !!};
}

.checkout-options {
  padding-left: 20px
}


.checkout-options h3 {
  color: #363432;
  font-size: 20px;
  margin-bottom: 0;
  font-weight: normal;
  font-family: {!! $heading_font_family !!};
}

.checkout-options p {
  color: #434343;
  font-weight: 300;
  margin-bottom: 25px;
}

.checkout-options .nav li {
  float: left;
  margin-right: 45px;
  color: #696763;
  font-size: 18px;
  font-family: {!! $base_font_family !!};
  font-weight: normal;
}

.checkout-options .nav label {
  font-weight: normal;
}

.checkout-options .nav li a {
  color: #FE980F;
  font-size: 18px;
  font-weight: normal;
  padding: 0
}

.checkout-options .nav li a:hover {
  background: inherit;
}

.checkout-options .nav i {
  margin-right: 10px;
  border-radius: 50%;
  padding: 5px;
  background: #FE980F;
  color:#fff;
  font-size: 14px;
  padding: 2px 3px;
}


.register-req  {
  font-size: 14px;
  font-weight: 300;
  padding: 15px 20px;
  margin-top: 35px;

}

.register-req p {
  margin-bottom: 0
}



.shopper-info p,
.bill-to p,
.order-message p {
  color: #696763;
  font-size: 20px;
  font-weight: 300
}


.shopper-info .btn-primary {
  background: #FE980F;
  border: 0 none;
  border-radius: 0;
  margin-right: 15px;
  margin-top: 20px;
}


.form-two, .form-one {
  float: left;
  width: 47%
}


.shopper-info > form > input,
.form-two > form > select,
.form-two > form > input,
.form-one > form > input {
  background:#F0F0E9;
  border: 0 none;
  margin-bottom:10px;
  padding: 10px;
  width: 100%;
  font-weight: 300
}

.form-two > form > select {
  padding:10px 5px
}

.form-two {
  margin-left: 5%
}


.order-message textarea {
  font-size: 12px;
  height: 335px;
  margin-bottom: 20px;
  padding: 15px 20px;
}

.order-message label {
  font-weight:300;
  color: #696763;
  font-family: {!! $base_font_family !!};
  margin-left: 10px;
  font-size: 14px
}


.review-payment h2 {
  color: #696763;
  font-size: 20px;
  font-weight: 300;
  margin-top: 45px;
  margin-bottom: 20px
}

.payment-options {
  margin-bottom:125px;
  margin-top: -25px
}

.payment-options span label {
  color: #696763;
  font-size: 14px;
  font-weight: 300;
  margin-right: 30px;
}

#cart_items .cart_info
.table.table-condensed.total-result {
  margin-bottom: 10px;
  margin-top: 35px;
  color: #696763
}

#cart_items .cart_info
.table.table-condensed.total-result tr {
  border-bottom: 0
}

#cart_items .cart_info
.table.table-condensed.total-result span {
  color: #FE980F;
  font-weight: 700;
  font-size: 16px
}

#cart_items .cart_info
.table.table-condensed.total-result
.shipping-cost {
  border-bottom: 1px solid #F7F7F0;
}




/*************************
*******Blog CSS******
**************************/



.blog-post-area
.single-blog-post h3 {
  color: #696763;
  font-size: 16px;
  font-family: {!! $heading_font_family !!};
  text-transform: uppercase;
  font-weight: 500;
  margin-bottom: 17px;
}

.single-blog-post > a {
}

.blog-post-area
.single-blog-post a img {
  border: 1px solid #F7F7F0;
  width: 100%;
  margin-bottom: 30px
}

.blog-post-area
.single-blog-post p {
  color: #363432
}

.blog-post-area
.post-meta {
  display: block;
  margin-bottom: 25px;
  overflow: hidden;
}

.blog-post-area
.post-meta ul {
  padding:0;
  display: inline;
}

.blog-post-area
.post-meta ul li {
  background:#F0F0E9;
  float: left;
  margin-right: 10px;
  padding: 0 5px;
  font-size: 11px;
  color: #393b3b;
  position: relative;
}

.blog-post-area
.post-meta ul li i {
  background:#FE980F;
  color: #FFFFFF;
  margin-left: -4px;
  margin-right: 7px;
  padding: 4px 7px;
}

.sinlge-post-meta li i:after,
.blog-post-area
.post-meta ul li i:after {
  content: "";
  position: absolute;
  width: auto;
  height: auto;
  border-color:transparent transparent transparent #FE980F;
  border-width:4px;
  border-style: solid;
  top:6px;
  left:24px
}

.blog-post-area
.post-meta ul span {
  float: right;
  color: #FE980F
}

.post-meta span{
    float: right;
}

.post-meta span i{
  color: #FE980F
}


.blog-post-area
.single-blog-post
.btn-primary {
  background:#FE980F;
  border: medium none;
  border-radius: 0;
  color: #FFFFFF;
  margin-top: 17px;
}


.pagination-area {
  margin-bottom:45px;
  margin-top:45px
}

.pagination-area
.pagination li a {
  background:#F0F0E9;
  border: 0 none;
  border-radius: 0;
  color: #696763;
  margin-right: 5px;
  padding: 4px 12px;
}

.pagination-area
.pagination li a:hover,
.pagination-area
.pagination li .active {
  background:#FE980F;
  color: #fff
}



/*************************
*******Blog Single CSS******
**************************/

.pager-area {
  overflow: hidden;
}

.pager-area .pager li a {
  background:#F0F0E9;
  border: 0 none;
  border-radius: 0;
  color: #696763;
  font-size: 12px;
  font-weight: 700;
  padding: 4px;
  text-transform: uppercase;
  width: 57px;
}

.pager-area
.pager li a:hover {
  background: #FE980F;
  color: #fff
}

.rating-area {
  border: 1px solid #F7F7F0;
  direction: block;
  overflow: hidden;
}

.rating-area ul li {
  float: left;
  padding: 5px;
  font-size: 12px
}

.rating-area .ratings {
  float: left;
  padding-left: 0;
  margin-bottom: 0
}


.rating-area
.ratings li i {
  color:#CCCCCC
}

.rating-area .rate-this {
  color: #363432;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
}

.rating-area
.ratings .color,
.rating-area .color {
  color: #FE980F
}


.rating-area .tag {
  float: right;
  margin-bottom: 0;
  margin-right: 10px;
}

.rating-area .tag li {
  padding: 5px 2px;
}
.rating-area .tag li span {
  color: #363432;
}


.socials-share {
  margin-bottom: 30px;
  margin-top: 18px;
}


.commnets
.media-object {
  margin-right: 15px;
  width: 100%;
}

.commnets {
  border: 1px solid #F7F7F0;
  padding: 18px 18px 18px 0;
  margin-bottom: 50px
}

.commnets .pull-left {
  margin-right: 22px
}

.commnets p,
.response-area p,
.replay-box p {
  font-size: 12px
}

.media-heading {
  color: #363432;
  font-size: 14px;
  font-weight: 700;
  font-family: {!! $base_font_family !!};
  margin-bottom: 15px
}

.blog-socials {
  margin-bottom: -9px;
  margin-top: 14px;
}

.blog-socials ul {
  padding-left: 0;
  overflow: hidden;
  float: left;
}

.blog-socials .btn.btn-primary{
  margin-top: 0;
}

.blog-socials ul li {

  float: left;
  height: 17px;
  margin-right: 5px;
  text-align: center;
  width: 17px;
}


.blog-socials ul li a {
  color: #393B3B;
  display: block;
  font-size: 10px;
  padding: 1px;
  background:#F0F0E9;
}

.blog-socials ul li a:hover {
  color: #fff;
  background:#FE980F
}


.media-list .btn-primary,
.commnets .btn-primary {
  background:#FC9A11;
  border: 0 none;
  border-radius: 0;
  color: #FFFFFF;
  float: left;
  font-size: 10px;
  padding: 1px 7px;
  text-transform: uppercase;
}

.response-area h2 {
  color: #363432;
  font-size: 20px;
  font-weight: 700;
}

.response-area .media {
  border: 1px solid #F7F7F0;
  padding: 18px 18px 18px 0;
  margin-bottom: 27px
}

.response-area .media img{
  height: 102px;
  width: 100%;
}

.response-area .media .pull-left {
  margin-right: 25px
}

.response-area .second-media {
  margin-left: 5%;
  width: 95%;
}


.sinlge-post-meta {
  overflow: hidden;
  padding-left: 0;
  margin-bottom: 15px
}



.sinlge-post-meta li {
  background:#F0F0E9;
  color: #363432;
  float: left;
  font-size: 10px;
  font-weight: 700;
  margin-right: 10px;
  padding: 0 10px 0 0;
  position: relative;
  text-transform: uppercase;
}

.sinlge-post-meta li i {
  background:#FE980F;
  color: #FFFFFF;
  margin-right: 10px;
  padding: 8px 10px;
}

.sinlge-post-meta li i:after {
  top: 7px;
  border-width: 6px;
  left: 27px;
}


.replay-box {
  margin-bottom: 107px;
  margin-top: 55px;
}

.replay-box h2 {
  font-weight: 700;
  font-size: 20px;
  color: #363432;
  margin-top: 0;
  margin-bottom: 45px
}

.replay-box label {
  background:#FE980F;
  color: #FFFFFF;
  margin-bottom: 15px;
  padding: 3px 15px;
  float: left;
  font-weight: 400;
}

.replay-box span {
  color: #FE980F;
  float: right;
  font-weight: 700;
  margin-top: 21px;
}

.replay-box form input {
  border: 1px solid #F7F7F0;
  color: #ADB2B2;
  font-size: 12px;
  margin-bottom: 22px;
  padding: 8px;
  width: 100%;
}

.replay-box form input:hover,
.text-area textarea:hover {
  border: 1px solid #FE980F;
}

.text-area {
  margin-top: 66px
}

.text-area textarea {
  background: transparent;
  border: 1px solid#F7F7F0
}

.btn.btn-primary {
  background:#FE980F;
  border: 0 none;
  border-radius: 0;
  margin-top: 16px;
}

.blank-arrow {
  position: relative;
}

.blank-arrow label:after {
  content: "";
  position: absolute;
  width: auto;
  height: auto;
  border-style: solid;
  border-width: 8px;
  border-color:#FE980F transparent transparent transparent;
  top: 25px;
  left: 5px
}



/*************************
******* Contact CSS ********
**************************/

.contact-map {
  width: 100%;
  height: 385px;
  margin-bottom: 70px
}

.contact-info .heading,
.contact-form .heading {
  text-transform: capitalize;
}

.contact-form .form-group {
  margin-bottom: 20px;
}

#contact-page
.form-control::-moz-placeholder {
  color: #8D8D8D;
}

#contact-page .form-control {
  background-color: #fff;
  border: 1px solid #ddd;
  color: #696763;
  height: 46px;
  padding: 6px 12px;
  width: 100%;
  font-size: 16px;
  border-radius: 4px;
  box-shadow:inherit;
}

#contact-page #message {
  height:160px;
  resize:none;
}

#main-contact-form .btn-primary {
  margin-bottom: 15px;
  margin-top: 20px;
}


#contact-page .form-control:focus,
#contact-page .form-control:hover {
  box-shadow: inherit;
  border-color: #FDB45E;
}

#contact-page .contact-info {
  padding: 0 20px;
}

#contact-page .contact-info address {
  margin-bottom: 40px;
  margin-top: -5px;
}

#contact-page .contact-info p {
  margin-bottom: 0;
  color: #696763;
  font-size: 16px;
  line-height: 25px;
}

.social-networks{
  overflow: hidden;
  text-align: center;
}

.social-networks ul {
  margin-top: -5px;
  padding: 0;
  display: inline-block;
}

.social-networks ul li {
  float: left;
  text-decoration: none;
  list-style: none;
  margin-right: 20px;
}

.social-networks ul li:last-child{
  margin-right: 0;
}

.social-networks ul li a {
  color: #999;
  font-size: 25px;
}

.contact-info .social-networks ul li a i{
  background: none;
}

.contact-info .social-networks ul li a:hover{
  color: #FE980F;
}

.signup-wrapper {margin: 30px auto;overflow: hidden;}
.signup-wrapper.w-650 {width: 650px !important;}



/* Cartimatic Cart*/
.continue-link {
  font-family: sans-serif, arial;
  font-size: 14px;
  float: right;
  color: #fdb45e;
  margin-bottom: 5px; }
  
.continue-link:hover{color: #FE980F;}

.cart-box {
  margin-bottom: 15px;
  overflow: hidden;
  background: #ffffff;
  border: 1px solid #e2e2e2; }

.cart-title-box {
  overflow: hidden;
  padding: 20px 0px;
  border-bottom: 1px solid #f1f1f1; 
  background:#f0efea;
  }
  .cart-title-box .seller {
    font-family: sans-serif, arial; }
    .cart-title-box .seller a {
      text-decoration: underline; }
  .cart-title-box .product-head {
    font-family: sans-serif, arial;
    color: #666666;
    overflow: hidden; }

.product-added-box [class*='col-']{ display:table-cell; float:none; vertical-align:top; border-left:1px solid #e2e2e2;}

.product-added-box .del-s{text-align:center; vertical-align:middle; border-left:0;}
.product-added-box { display:table; overflow: hidden; border-bottom: 1px solid #f1f1f1; width:100%; }
  .product-added-box .thumb { padding: 15px 0px;}
    .product-added-box .thumb img {
      width: 100%; }
  .product-added-box .product-name {
    padding-top: 10px; }
    .product-added-box .product-name h1 {
      font-size: 18px;
      color: #333333;
      margin-bottom: 10px; }
    .product-added-box .product-name div.cs {
      color: #666666;
      margin-bottom: 5px;
      font-size: 14px; }
      .product-added-box .product-name div.cs span {
        font-weight: normal;
        color: #333333; }
  .product-added-box .price {
    font-size: sans-serif, arial;
    font-size: 18px;
    color: #333333;
    margin-top: 20px; }
    .product-added-box .price sub {
      color: #666666;
      font-size: 14px; }
  .product-added-box .delete-product {
    color: #FE980F;
    display: inline-block;}

.product-added-box .select-qty {
  margin-top: 20px;
  width: 140px;
  border: 1px solid #f1f1f1;
  border-right: none; }
.product-added-box  .select-qty input {
    background: none;
    box-shadow: none;
    border: none;
    z-index: inherit !important; 
     border-right:2px solid #f1f1f1;}
 .product-added-box .select-qty .btn {
    background: #fff;
    border-radius: 0;
    color:#666666;
    border-right: 1px solid #f1f1f1;
    z-index: inherit !important; }

.t-amount { padding-right: 0px; }
  .t-amount .subTotal {
    font-size: 18px;
    color: #333333; }
    .t-amount .subTotal span {
      font-size: 14px;
      color: #666666; }
  .t-amount .sub-price {
    font-size: 18px;
    color: #333333;
    text-align: right; }
  .t-amount .total-wraper { overflow: hidden; border-top: 1px solid #f1f1f1; padding-top: 10px; margin-top:15px;}
    .t-amount .total-wraper .total {
      font-size: 24px;
      color: #333333; }
    .t-amount .total-wraper .total-price {
    	padding:0px;
      font-size: 30px;
      color: #333333;
      text-align: right;
      width:100%;
      }
  .t-amount .sep {padding: 15px; border-bottom: 1px solid #f1f1f1; border-left: 1px solid #f1f1f1;}
  .t-amount .buy-this { padding: 20px 15px; overflow: hidden; }
  .t-amount .buy-this a{ margin:0px; min-width:100px;}
    .t-amount .buy-this button {
      border: medium none;
      border-radius: 0;
      color: white;
      font-family: sans-serif, arial;
      font-size: 14px;
      text-transform: uppercase;
      float: right; }
.clrfix{clear:both; height:0; line-height:0;}
.features {
  overflow: hidden;
  margin-top: 20px; }
  .features span {
    background: url(../bootstrap/images/protection-icon.jpg) no-repeat scroll left top/32px 32px;
    color: #1d81dd;
    display: block;
    font-size: 18px;
    line-height: 18px;
    padding: 0 0 17px 46px; }
  .features ul {
    margin-left: 47px;
    margin-top: -15px; }
    .features ul li {
      background: transparent url(../bootstrap/images/buyer_protection_checkmark.svg) no-repeat scroll left center;
      margin-top: 5px;
      padding-left: 20px;
      position: relative;
      font-family: sans-serif, arial;
      font-size: 14px;
      color: #666666; }

.signup-wrapper {
  margin: 30px auto;
  width: 768px;
  overflow: hidden; }
  .signup-wrapper h1 {
    font-size: 26px;
    color: #333333;
    margin-bottom: 20px; }
  .signup-wrapper .modal-body {
    overflow: hidden;
    padding: 0; }
    .signup-wrapper .modal-body .new-user {
      padding: 20px; }
      .signup-wrapper .modal-body .new-user p {
        font-size: 14px;
        font-family: sans-serif, arial;
        color: #666666;
        margin-bottom: 20px;
        line-height: 18px; }
    .signup-wrapper .modal-body .social-user {
      padding: 20px;
      border-left: 1px solid #ccc; }
  .signup-wrapper.w-650 {
    width: 650px !important; }

.omb_login {
  position: relative;
  margin-top: 15px; }

.omb_hr {
  background-color: #cdcdcd;
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important; }

.omb_span {
  display: block;
  position: absolute;
  left: 50%;
  top: -0.6em;
  margin-left: -7.5em;
  background-color: white;
  color:#FE980F;
  width: 15em;
  text-align: center;
  text-transform: uppercase; }

.omb_loginOr {
  position: relative;
  margin-top: 30px; }

.omb_hrOr {
  background-color: #cdcdcd;
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important; }

.omb_spanOr {
  display: block;
  position: absolute;
  left: 50%;
  top: -0.6em;
  margin-left: -2.5em;
  background-color: white;
  color:#FE980F;
  width: 5em;
  text-align: center;
  text-transform: uppercase; }

.omb_socialButtons {
  overflow: hidden;
  margin-top: 25px; }
  .omb_socialButtons a {
    color: #ffffff; }
    .omb_socialButtons a:hover {
      color: #ffffff; }
    .omb_socialButtons a span {
      color: #ffffff; }
  .omb_socialButtons .omb_btn-facebook {
    background: #3b5998; }
  .omb_socialButtons .omb_btn-google {
    background: #c32f10; }
    .login-container {
  margin-top: 20px; }
  .login-container label {
    margin-bottom: 5px !important;
    font-weight: bold; }
  .login-container .forgot-pass {
    float: right;
    color: #FE980F; }
  .login-container .btn-login {
    background: #FE980F;
    min-width: 150px;
    color: #ffffff; }
  .login-container .checkbox {
    margin-bottom: 15px; }
    .login-container .checkbox input {
      margin-top: 1px; }
  .login-container .form-group {
    margin: 0; }

.btn-register {
  background: #f1f1f1;
  min-width: 150px;
  color: #666666;
  text-transform: uppercase; }
  
  /*Vertical Form Wizard*/
.stepContainer {
  float: right;
  width: 50%;
  min-height: 255px; }

.wizard_verticle {
  padding: 20px;
  overflow: hidden; }

.wizard_verticle ul.wizard_steps {
  display: table;
  float: left;
  list-style: outside none none;
  margin: 0 0 20px;
  position: relative;
  width: 50%; }

.wizard_verticle ul.wizard_steps li {
  display: list-item;
  text-align: center; }

.wizard_verticle ul.wizard_steps li a {
  height: 80px; }
  .wizard_verticle ul.wizard_steps li a label {
    padding-top: 14px !important;
    padding-left: 15px !important;
    float: left; }

.wizard_verticle ul.wizard_steps li a:first-child {
  margin-top: 20px; }

.wizard_verticle ul.wizard_steps li a, .wizard_verticle ul.wizard_steps li:hover {
  color: #666666;
  display: block;
  opacity: 1;
  position: relative; }

.wizard_verticle ul.wizard_steps li a::before {
  background: #cccccc none repeat scroll 0 0;
  content: "";
  height: 100%;
  left: 6%;
  position: absolute;
  top: 20px;
  width: 4px;
  z-index: 4; }

.wizard_verticle ul.wizard_steps li a.disabled .step_no {
  background: #cccccc none repeat scroll 0 0; }

.wizard_verticle ul.wizard_steps li a .step_no {
  border-radius: 100px;
  display: block;
  font-size: 16px;
  height: 40px;
  line-height: 40px;
  /* margin: 0 auto 5px;*/
  position: relative;
  text-align: center;
  width: 40px;
  z-index: 5;
  float: left; }

.wizard_verticle ul.wizard_steps li a.selected::before, .step_no {
  background: #FE980F;
  color: white; }

.wizard_verticle ul.wizard_steps li a.selected label {
  color: #FE980F; }

.wizard_verticle ul.wizard_steps li a.done::before, .wizard_verticle ul.wizard_steps li a.done .step_no {
  background: #666666;
  color: white; }

.wizard_verticle ul.wizard_steps li:first-child a::before {
  left: 6%; }

.wizard_verticle ul.wizard_steps li:first-child a {
  margin-top: 0; }

.wizard_verticle ul.wizard_steps li:last-child a::before {
  left: auto;
  width: 0; }

.actionBar {
  float: right; }
  .actionBar .btn-success {
    min-width: 150px;
    background: #FE980F;
    border: none;
    margin-right: 0 !important; }
  
  .actionBar a {
    color: #ffffff;
    background: #FE980F;
    border: 0 none;
    border-radius: 0;
 }

.joinAs {
  overflow: hidden;
  margin-bottom: 15px !important; }
  .joinAs label {
    margin-top: 10px;
    margin-right: 10px; }
  .joinAs select {
    width: auto;
    min-width: 130px; }

.gender {
  overflow: hidden; }
  .gender select {
    width: auto;
    min-width: 130px; }

.tp {
  background: #666666 none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: white;
  float: right;
  height: 17px;
  padding: 0;
  text-align: center;
  width: 18px; }

.shape {
  border-style: solid;
  border-width: 0px 0 46px 46px;
  height: 0px;
  width: 0px;
  position: absolute;
  -webkit-transform: rotate(180deg);
  -moz-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg); }
  .shape.discount {
    border-color: transparent transparent #ff7200 transparent; }
  .shape.new {
    border-color: transparent transparent #3fe206 transparent; }
  .shape.hot {
    border-color: transparent transparent #ed1651 transparent; }

.shape-text {
  color: #fff;
  font-size: 9px;
  position: relative;
  display: table-cell;
  font-family: sans-serif, arial;
  font-style: italic;
  height: 20px;
  left: -21px;
  text-transform: lowercase;
  top: 21px;
  vertical-align: middle;
  -ms-transform: rotate(30deg);
  /* IE 9 */
  -o-transform: rotate(360deg);
  /* Opera 10.5 */
  -webkit-transform: rotate(46deg);
  /* Safari and Chrome */
  transform: rotate(180deg); }
  
.order-link-wrapper{ overflow:hidden; margin:25px 0 0;}
.order-link-wrapper a{margin:0px 5px; color:#333;}
.order-link-wrapper a:hover{color:#FE980F;}

.shipping-form{ overflow:hidden;}
.shipping-form p{line-height:28px;}
.shipping-form .title-box{margin-bottom:30px;}
.shipping-form .form-box{margin-bottom:20px;}
.shipping-form h4{margin-top:32px;}
.shipping-form .form-box .btn.btn-primary{ margin-top:0px; color:#ffffff; height:35px;}

.shipping-form form input, .shipping-form form select{
	background: #F0F0E9;
    border: medium none;
    color: #B2B2B2;
    font-family: Droid Sans;
    font-size: 12px;
    font-weight: 300;
    height: 40px;
    outline: medium none;
    box-shadow: none;
    border-radius: 0;
}

.panel-body{ margin-top:20px;}
.panel-body .form-group input[type="email"], .panel-body .form-group input[type="password"]{
	background: #F0F0E9;
    border: medium none;
    color: #B2B2B2;
    font-family: Droid Sans;
    font-size: 12px;
    font-weight: 300;
    height: 40px;
    outline: medium none;
    box-shadow: none;
    border-radius: 0;
}

.panel-body .form-group .btn-primary{min-width:100px; margin-top:0px;}
.panel-body .form-group .btn-link{ margin-top: 14px; float: right;}


.c-profile-edit {
  padding: 25px;
  overflow: hidden;
  border: 1px solid #dfe4ea;
  background-color: #ffffff; 
  margin:50px 0px;
  }

.profile-edit-img {
  position: relative;
  width: 100px;
  height: 100px;
  margin: 0 auto; }

.profile-edit-img-wrapper {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  overflow: hidden; }
  .profile-edit-img-wrapper img {
    display: block;
    width: 100%;
    height: 100%; }
  .profile-edit-img-wrapper:hover .edit-btn {
    display: block; }

.edit-btn {
  position: absolute;
  bottom: 1px;
  left: 37px;
  cursor: pointer;
  display: none; }
  .edit-btn:hover {
    text-decoration: underline; }

.profile-edit-form {
  overflow: hidden; }

.form-group-item {
  margin-bottom: 15px; }
  .form-group-item label {
    line-height: 40px;
    font-weight: bold; }
  .form-group-item .form-control {
    height: 40px;
    border-radius: 0; }
  .form-group-item .radio {
    display: inline-block;
    margin: 0 20px 0 0px; }
    .form-group-item .radio input[type="radio"] {
      margin-top: 13px; }
  .form-group-item .zip {
    padding: 0;
    margin-left: 15px; }
  .form-group-item .buyer-detail {
    line-height: 40px;
    font-size: 16px; }

.btn-profile-edit {
  border-radius: 0;
  line-height: 40px;
  padding: 0 20px;
  border: none;
  color: #00adef;
  text-transform: uppercase; }
  .btn-profile-edit:hover {
    color: #00adef;
    text-decoration: underline; }
  .btn-profile-edit.active {
    background-color: #FE980F;
    box-shadow: none;
    color: #fff; }
    .btn-profile-edit.active:hover {
      text-decoration: none; }
 .profile-edit-form input[type="text"], .profile-edit-form select{border:none; box-shadow:none; background:#F0F0E9;}
.btn-profile-save{background-color: #FE980F; box-shadow: none; color: #fff; border: none; border-radius: 0; line-height: 40px; padding: 0 10px; min-width:76px;}
.btn-profile-save:hover{background-color: #FE980F; box-shadow: none; color: #fff;}

@media screen and (min-width: 768px){
    .modal-dialog {
        width: 900px;
        margin: 30px auto;
    }
}


/********************************Messages CSS**********************************************/
.messages-wrapper {
  border: 1px solid #e2e2e2;
  overflow: hidden;
  background: #ffffff;
  margin: 15px 0px; }
  .messages-wrapper .messages-list {
    border-bottom: 1px solid #e2e2e2;
    overflow: hidden;
    padding: 15px 0;
    cursor: pointer; }
    .messages-wrapper .messages-list.unread {
      background: #f8fcfe; }
      .messages-wrapper .messages-list.unread .msg-icon {
        background: url({{getAssetPath()}}/images/message_sprite.svg) no-repeat scroll center 2px;
        width: 15px;
        height: 15px;
        margin: 0 auto;
        text-indent: -99999px;
        display: block; }
    .messages-wrapper .messages-list .msg-icon {
      background: url({{getAssetPath()}}/images/message_sprite.svg) no-repeat scroll center bottom;
      width: 15px;
      height: 15px;
      margin: 0 auto;
      text-indent: -99999px;
      display: block; }
    .messages-wrapper .messages-list .msg-title {
      color: #333333;
      padding-bottom: 10px; }
    .messages-wrapper .messages-list .msg-desc {
      color: #666666;
      line-height: normal;
      font-family: sans-serif, arial; }
    .messages-wrapper .messages-list .date {
      font-family: sans-serif, arial;
      color: #333333; }
  .messages-wrapper .msg-detial-box {
    padding: 15px 0 0; }
  .messages-wrapper .user-messages {
    overflow: hidden;
    padding-bottom: 15px; }
    .messages-wrapper .user-messages .user-name {
      color: #333333;
      padding-bottom: 10px;
      font-family: sans-serif, arial; }
    .messages-wrapper .user-messages .msg-date {
      color: #666666;
      font-family: sans-serif, arial;
      font-size: 12px; }
    .messages-wrapper .user-messages .text-message {
      border: 1px solid #cccccc;
      color: #333333;
      padding: 15px;
      font-family: sans-serif, arial;
      line-height: normal;
      float: left; }
  .messages-wrapper .my-messages {
    overflow: hidden;
    padding-bottom: 15px; }
    .messages-wrapper .my-messages .user-name {
      color: #333333;
      padding-bottom: 10px;
      font-family: sans-serif, arial; }
    .messages-wrapper .my-messages .msg-date {
      color: #666666;
      font-family: sans-serif, arial;
      font-size: 12px; }
    .messages-wrapper .my-messages .text-message {
      border: 1px solid #00aeef;
      color: #333333;
      padding: 15px;
      font-family: sans-serif, arial;
      line-height: normal;
      float: right; }
  .messages-wrapper .write-msg-box {
    overflow: hidden;
    border-top: 1px solid #ccc;
    padding: 15px 0px; }
    .messages-wrapper .write-msg-box textarea {
      border: none;
      box-shadow: none;
      font-family: sans-serif, arial;
      font-size: 12px;
      color: #666666;
      width: 100%;
      resize: none;
      line-height: normal; }
    .messages-wrapper .write-msg-box .attachment {
      float: right;
      text-indent: -99999px;
      background: url({{getAssetPath()}}/images/message_icons_sprite.svg) no-repeat scroll left top;
      width: 11px;
      height: 21px;
      margin: 10px 20px 0 0; }
    .messages-wrapper .write-msg-box .send-msg {
      text-indent: -99999px;
      background: #FE980F url({{getAssetPath()}}/images/message_icons_sprite.svg) no-repeat scroll 12px -37px;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: block;
      float: right; }
.mt30{margin-top:30px;}

.add-on input, .add-on button{border:none; border-radius:0; box-shadow:none; background:#F0F0E9; height:36px;}

.shiping-address {
  padding: 20px 5px; }
  .shiping-address .buyer-name {
    font-size: 18px;
    color: #333333;
    margin-bottom: 10px; }
  .shiping-address address {
    font-size: 14px;
    color: #333333;
    line-height: 25px; }
  .shiping-address .btn-group {
    margin-top: 10px; }
    .shiping-address .btn-group a {
      float: left; }
    .shiping-address .btn-group .btn-primary {
      margin-right: 5px; margin-top:0px;}
    .shiping-address .btn-group .btn-edit {
      margin-right: 5px;
      background: #e6e6e6 url({{getAssetPath()}}/images/edit-icon.jpg) no-repeat scroll center center;
      text-indent: -99999px;
      width: 34px;
      height: 34px;
      border-radius: 0; }
    .shiping-address .btn-group .btn-delete {
      border-radius: 0;
      background: #e6e6e6 url({{getAssetPath()}}/images/delete-icon.jpg) no-repeat scroll center center;
      text-indent: -99999px;
      width: 34px;
      height: 34px;
      border-radius: 0; }
      
.cart-box .head-title{ overflow: hidden; line-height: 20px; padding: 14px 20px; border-bottom: 1px solid #f1f1f1;}
.cart-box .head-title h1 {
    color: #FE980F;
    float: left;
    font-size: 16px;
    text-transform: uppercase;
    position: relative;
    font-weight: bold;
    margin:0;
}
.mr15{ margin-right:15px;}
.mb15{margin-bottom:15px;}

.pro-list-wraper {
  overflow: hidden;
  padding: 20px 0px 15px;
  border-bottom: 1px solid #f1f1f1; }
  .pro-list-wraper .product-information .os {
    color: #666666;
    margin-bottom: 6px; }
    .pro-list-wraper .product-information .os span {
      color: #333333; }
  .pro-list-wraper .product-information p {
    color: #333333;
    line-height: 20px;
    margin-bottom: 7px; }
  .pro-list-wraper .pr {
    color: #333333; }

.subT {
  color: #333333;
  font-size: 16px;
  padding: 20px;
  border-bottom: 1px solid #f1f1f1;
  text-align: right; }
  .subT div:first-child {
    margin-bottom: 5px; }

.gt {
  padding: 20px;
  text-align: right; }
  .gt div {
    color: #333333;
    font-size: 16px; }
    .gt div span {
      color: #FE980F; }
.pro-list-wraper .product-information{
    border: none;
    overflow: hidden;
    padding: 0px;
     position: relative;
     min-height: auto; 

}