<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if(isset($title))
            {{$title}}
        @else
            {{ ucwords( Auth::user()->name ) }} : Store
        @endif
    </title>
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jplayer.blue.monday.min.css') !!}">
    <link rel="stylesheet" href="//releases.flowplayer.org/6.0.4/skin/functional.css">
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/style.css') !!}">
    <script src="{!! asset('local/public/assets/js/jquery-2.1.3.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/custom-feedback.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/popup.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/scroll-bar.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/store-admin.js') !!}"></script>
    <script src="{!! asset('local/public/assets/js/custom.js') !!}"></script>
{{--    <script src="{!! asset('local/public/assets/js/script.js') !!}"></script>--}}
</head>
<body>
@include('includes.header')

@yield('content')
@include('includes.footer')

@yield('includes')
@yield('footer-scripts')


</body>
</html>
