<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>环保降解袋</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.4/??flexible_css.js,flexible.js"></script>
    <link rel="stylesheet" type="text/css" href="{{url(elixir("css/wap/app.css"))}}">
    <script>
        function isIosOrAndroid(){
            var u = navigator.userAgent;
            var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1; //android终端
            var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            if (isAndroid) {
                window.location.href="http://www.51hbjjd.com/";
            }
            if (isiOS) {
                window.location.href="http://www.51hbjjd.com/";
            }
        }
    </script>
</head>
<body onclick="isIosOrAndroid();">
    <div id="app"></div>
    <script src="{{url(elixir("js/wap.js"))}}"></script>
</body>
</html>
