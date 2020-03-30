<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
       <title>
        @yield('title')
    </title>
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/front/css/responsive.css')}}" rel="stylesheet">

</head>
<body>
    @include('layouts.includes.shop.header')	
    @yield('content')
    @include('layouts.includes.shop.footer') 
<script src="{{ asset('assets/front/js/jquery.js') }}"></script>
<script src="{{ asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{ asset('assets/front/js/price-range.js')}}"></script>
<script src="{{ asset('assets/front/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{ asset('assets/front/js/main.js') }}"></script>
<script src="{{ asset('js/customer.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@yield('javascript');
</body>
</html>
