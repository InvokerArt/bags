<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>环保降解袋</title>
    <link href="/css/advertising/default.css" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        @yield('content')
        <!-- JavaScripts -->
        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script>
        @yield('js')
    </div>
</body>
</html>
