<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if(isset($title))
            {{$title}} - Cartimatic
        @else
            Cartimatic
        @endif
    </title>
    <link href="{!! asset('local/public/assets/gentelella/fonts/css/font-awesome.min.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="{!! asset('local/public/assets/bootstrap/style.css') !!}">
    @yield('styles')
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="cd-container">
    @include('includes.header')

        @yield('content')

    @include('includes.footer')
</div>
<a href="#0" class="cd-top hidden-xs">Top</a>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/jquery-2.1.3.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap.min.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/collapse.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/dropdown.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/custom.js') !!}"></script>
<script src="{!! asset('local/public/assets/bootstrap/javascripts/bootstrap/smartWizard.js') !!}"></script>
<script src="{!! asset('local/public/assets/js/global/global.js') !!}"></script>
@yield('footer-scripts')
</body>
</html>
