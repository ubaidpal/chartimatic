<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cartimatic: Shipping Address</title>
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/style.css') !!}">
    <script src="{!! asset('local/public/assets/js/jquery-2.1.3.js') !!}"></script>
  </head>
    <body>
    	@include('Store::includes.header-plane')
        
        @yield('content')
        
        @include('Store::includes.footer')
  </body>
</html>
