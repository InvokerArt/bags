<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>环保降解袋</title>
    <meta name="keywords" content="laravel,restful,api,vue.js,vuejs"/>
    <meta name="description"
          content="Someline Starter is a framework for quick building Web Apps or APIs, with modern PHP design pattern foundation, which is built on top of popular Laravel 5 framework, Vue.js, Restful API, Repository Design, OAuth2, JWT, Unit Tests, isolated front-end and back-end layer."/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link href="{{url(elixir('css/wap/app.css'))}}">
    <script type="text/javascript">
        <?php
        $data = [
                'csrfToken' => csrf_token(),
        ];
        echo 'window.Laravel = ' . json_encode($data);
        ?>
    </script>
</head>
<body>
<div id="app" class="app">
</div>
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery/jquery-2.2.4.min.js')}}"><\/script>')</script>
<script src="{{url(elixir("js/wap.js"))}}"></script>
</body>
</html>
