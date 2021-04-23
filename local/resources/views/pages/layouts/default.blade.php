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
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/cartimatic-main.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/style.css') !!}">
    @yield('styles')
</head>
<body>
<div class="cd-container">
    @include('pages.includes.header')
    <div class="container category">
        <div class="row">
            @yield('content')
        </div>
    </div>
    @include('pages.includes.footer')
</div>
<a href="#0" class="cd-top">Top</a>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/jquery-2.1.3.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/collapse.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/dropdown.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/custom.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/smartWizard.js') !!}"></script>
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/bootstrap-tooltip.js') !!}
{!! HTML::script('local/public/assets/bootstrap/javascripts/bootstrap/confirmation.js') !!}
<script src="{!! asset('local/public/assets/js/global/global.js') !!}"></script>
@include('Store::modal.master')
@yield('footer-scripts')
<style>
    .no-padding{
        padding: 0 !important;
    }
    .mar-bt-10{
        margin-bottom: 10px;
    }
</style>
</body>
</html>
