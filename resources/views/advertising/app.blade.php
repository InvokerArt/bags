@extends('advertising.layouts.default')

@section('css')
<style type="text/css">
    .myslide {
        overflow: hidden;
        width: 100%;  
        height: 740px;
        position: relative;
    }
    .myslidetwo {
        overflow: hidden;
        height: 740px;
        text-align: center;
        padding: 0;
        width: 100%;
    }
    .myslidetwo li {
        width: 100%;
        height:740px;
    }
    .myslidetwo img {
        max-width: 100%;
        height: 740px;
    }
    .arrows{    
        width: 1100px;
        margin: 0 auto;
        display: block;
        position: relative;
    }
    .arrows a{
        display: block;
        width: 60px;
        height: 60px;
        z-index: 1;
    }
    .arrows a:hover{
        cursor: pointer;
    }
    .arrows .pre{
        position: absolute;
        left:0px;  
        top:-400px;
        background: url('images/advertising/pre.png') top center no-repeat;
    }
    .arrows .pre:hover{
        background: url('images/advertising/pre-hover.png') top center no-repeat;
    }
    .arrows .next{
        position: absolute;
        right:0px;  
        top:-400px;
        background: url('images/advertising/next.png') top center no-repeat;
    }
    .arrows .next:hover{
        background: url('images/advertising/next-hover.png') top center no-repeat;
    }
    .header .log{
        width:100%;
        height:90px;
        display: block;
        overflow: hidden;
        background:#323831 url('images/advertising/logo.png') top center no-repeat;
    }
    .banner{
        width:100%;
        height:635px;
        display: block;
        overflow: hidden;
        background:#63a021 url('images/advertising/banner.png') top center no-repeat;
    }
    .banner2{
        width:100%;
        height:270px;
        display: block;
        overflow: hidden;
        background:#63a021 url('images/advertising/banner2.png') top center no-repeat;
    }
    .wap-show{
        width:100%;
        height:864px;
        display: block;
        overflow: hidden;
        background:#63a021 url('images/advertising/wap-show.png') top center no-repeat;
    }
    .ready-test{
        width:100%;
        height:601px;
        display: block;
        overflow: hidden;
        background:#63a021 url('images/advertising/ready-test.png') top center no-repeat;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="header">
        <div class="log"></div>
    </div>
    <div class="banner">
    </div>
    <div class="myslide">
        <ul class="myslidetwo">
            <li style="background:url(/images/advertising/slider1.png) top center"></li>
            <li style="background:url(/images/advertising/slider2.png) top center"></li>
            <li style="background:url(/images/advertising/slider3.png) top center"></li>
        </ul>
        <p class="arrows">
            <a class="pre"></a>
            <a class="next"></a>
        </p>
    </div>
    <div class="banner2">
    </div>
    <div class="wap-show">
    </div>
    <div class="ready-test">
    </div>
</div>
@endsection

@section('js')<script>
    $(document).ready(function () {
        var _now=0;
        var oul = $(".myslidetwo");
        var numl = $(".myslidetwo li");
        var wid = $(".myslide").eq(0).width();
        var count = $(".myslidetwo li").length;
        //数字图标实现
        //左右箭头轮播
        $(".pre").click(function () {
            if (_now>=1) _now--;
            else _now=count;
            ani();
        });
        $(".next").click(function () {
            if (_now == count - 1) {
                _now = 0;
            }
            else _now++;
            ani();
        });
        //动画函数
        function ani(){
            numl.eq(_now-1).fadeOut(200);
            numl.eq(_now).addClass("current").fadeIn(200).siblings().removeClass();
        }
        //以下代码如果不需要自动轮播可删除
        //自动动画
        // var _interval=setInterval(showTime,2000);
        // function  showTime() {
        //     if (_now == numl.size() - 1) {
        //         _now = 0;
        //     }
        //     else _now++;
        //     ani();
        // }
        // //鼠标停留在画面时停止自动动画，离开恢复
        // $(".myslide").mouseover(function(){
        //     clearTimeout(_interval);
        // });
        // $(".myslide").mouseout(function(){
        //     _interval=setInterval(showTime,2000);
        // });
    });
</script>
@endsection