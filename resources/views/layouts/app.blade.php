<!DOCTYPE html>
<html lang="lang="{{ str_replace('_', '-', app()->getLocale()) }}"" class="wide wow-animation">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,maximum-scale=1,user-scalable=0">
    <link rel="icon" href="{{asset('theme/images/favicon.ico')}}" type="image/x-icon">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
</head>
<body>

    <div class="page">
        @include('elements.header')
        @yield('slide')
        @yield('title')
        @yield('search')
        @yield('content')
    </div>

    <script src="{{asset('theme/js/core.min.js')}}"></script>
    <script src="{{asset('theme/js/script.js')}}"></script>

</body>
</html>