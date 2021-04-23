<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cartimatic</title>
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/style.css') !!}">
    @yield('styles')
</head>
<body>
@include('includes.header')
<div class="container category">
    <div class="row">
        @yield('content')

    </div>

    @include('Admin::modals.master')

</div>
@include('includes.footer')
<script src="{!! asset('local/public/assets/bootstrap/javascripts/jquery-2.1.3.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/collapse.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/dropdown.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/global/global.js') !!}"></script>
@yield('settings-footer-scripts')
</body>
</html>
