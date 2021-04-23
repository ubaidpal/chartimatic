<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>
        @if(isset($title))
            {{$title}} - Cartimatic
        @else
            Cartimatic
        @endif
    </title>
    <script src="{!! asset('local/public/assets/bootstrap/javascripts/jquery-2.1.3.js') !!}"></script>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/slick/slick.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('local/public/slick/slick-theme.css') !!}"/>
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/animate.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/material-design-iconic-font.min.css') !!}">
    
    @yield('styles')
</head>
<style>
    div.fadeMe {
        opacity:    0.5;
        background: #000;
        width:      100%;
        height:     100%;
        z-index:    1250;
        top:        0;
        left:       0;
        position:   fixed;
    }
</style>
<body class="white">
<div class="fadeMe hide"></div>
<div class="cd-container">
    @yield('content')
    
    @include('includes.footer-dashboard')
</div>
<a href="#0" class="cd-top hidden-xs">Top</a>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/collapse.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/dropdown.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/custom.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/smartWizard.js') !!}"></script>
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
<script src="{!! asset('local/public/assets/js/global/global.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/jquery.form.min.js') !!}"></script>
@include('Store::modal.master')
@yield('footer-scripts')
@yield('footer-scripts-header-search')
<style>
    .no-padding{
        padding: 0 !important;
    }
    .mar-bt-10{
        margin-bottom: 10px;
    }
	

</style>

<script src="{!! asset('local/public/assets/bootstrap/javascripts/jquery.flexisel.js') !!}"></script>

<script type="text/javascript">
$(window).load(function() {
    $("#flexiselDemo3").flexisel({
        visibleItems: 4,
        itemsToScroll: 1,
        autoPlay: {
            enable: true,
            interval: 5000,
            pauseOnHover: true
        }        
    });

        if(window.location.hash) {
            var hash = window.location.hash;
            $(hash).modal('toggle');
        }

});
</script>
</body>
</html>