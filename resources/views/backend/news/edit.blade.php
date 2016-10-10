@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
编辑资讯
@stop

@section('content')
{{ Form::model($news, ['route' => [env('APP_BACKEND_PREFIX').'.news.update', $news], 'method' => 'PATCH', 'id' => 'edit-news']) }}
    <div id="poststuff">
        <div class="news-body-content">
            <div class="news-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="在此输入资讯标题" value="{{ $news->title }}">
                </div>
                <div class="inside">
                    <div id="edit-slug-box" class="hide-if-no-js"> <strong>固定链接：</strong>
                        <span id="sample-permalink">
                            {{ env('APP_URL').'news/' }}
                            <span id="editable-post-name">
                                <input type="text" id="slug" class="form-control" name="slug" autocomplete="off" value="{{ str_replace(env('APP_URL').'news/', '', $news->slug) }}"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group margin-top-15">
                    <textarea name="subtitle" class="form-control" placeholder="在此输入资讯简介">{{ $news->subtitle }}</textarea>
                    <span class="help-block">字数建议控制在100字以内</span>
                </div>
                <div class="form-group">
                    <textarea name="content" id="editor" class="form-control">{{ $news->content }}</textarea>
                </div>
            </div>
        </div>
        <div class="news-sidebar">
            <div class="newsbox margin-bottom-15">
                <h2>
                    <span>发布</span>
                </h2>
                <div class="inside">
                    <input type="text" name="published_at" class="form-control date-timepicker" placeholder="发布时间" value="{{ $news->published_at }}">
                    <button href="javascript:;" class="btn green margin-top-10">
                        <i class="fa fa-eye"></i>
                        预览 
                    </button>
                    <button href="javascript:;" class="btn red pull-right margin-top-10">
                        <i class="fa fa-edit"></i>
                        发布 
                    </button>
                </div>
            </div>
            <div class="newsbox margin-bottom-15">
                <h2>
                    <span>分类目录</span>
                </h2>
                <div class="inside news-categories">
                </div>
                <input type="hidden" name="categories_id" id="categories">
            </div>
            <div class="newsbox margin-bottom-15">
                <h2>
                    <span>标签</span>
                </h2>
                <div class="inside">
                    <div>
                        <input type="text" name="newtag" class="form-control newtag">
                        <button type="button" class="btn add-tag pull-right">添加</button>
                        <p class="help-block">多个标签请用英文逗号（,）分开</p>
                    </div>
                    <div class="tagchecklist">
                        @foreach ($newsTags as $newsTag)
                        <span>
                        <a id="post_tag-check-num-0" class="ntdelbutton" tabindex="0"><i class="icon-close"></i></a>&nbsp;{{ $newsTag }}
                        </span>
                        @endforeach
                    </div>
                    <div class="hide-if-no-js">
                        <a href="javascript:;" class="tagcloud-link" id="link-post_tag">从常用标签中选择</a>
                        <p id="tagcloud-post_tag" class="the-tagcloud">
                            <a href="javascript:;" data-id="1" class="tag-link">世界</a>
                            <a href="javascript:;" data-id="2" class="tag-link">我的</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="newsbox margin-bottom-15">
                <h2>
                    <span>特色图片</span>
                </h2>
                <div class="inside">
                    <a href="javascript:;">
                        <img width="100%" src="http://www.testwordpress.com/wp-content/uploads/2016/09/mocha-1.jpg">
                    </a>
                    <p class="help-block" id="set-post-thumbnail-desc">点击图片来修改或更新</p>
                    <p class="help-block">
                        <a href="#" id="remove-post-thumbnail" onclick="WPRemoveThumbnail('1529892b00');return false;">移除特色图片</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('js')
    @include('UEditor::head')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            var checkNodeIds = "{{ implode(',', $categories) }}".split(",");
            $('.select2').select2({
                placeholder: "从常用标签中选择"
            })

            $('.news-categories').jstree({
                core: {
                    strings : { 
                        loading : "加载中 ..."
                    },
                    themes : {
                        responsive: false,
                        icons:false
                    },
                    check_callback: !0,
                    data: {
                        url: function(e) {
                            return "{{ route(env('APP_BACKEND_PREFIX').'.news.categories.children') }}"
                        },
                        data: function(e) {
                            return {
                                parent: e.id,
                                disabled: 1
                            }
                        }
                    }
                },
                'plugins': ["wholerow", "checkbox", "types"]
            })
            .on("changed.jstree", function (e, data){
                var categories = [];
                var categoriesElms = $('.news-categories').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.news-categories').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.news-categories').find("li").each(function() {
                    for (var i = 0; i < checkNodeIds.length; i++) {
                        if ($(this).attr("id") == checkNodeIds[i]) {
                            $('.news-categories').jstree("check_node", $(this));
                        }
                    }
                });
            });
        })

        /**
         * 百度编辑器
         */
        UE.delEditor('editor');
        var ue = UE.getEditor('editor',{
            initialFrameHeight:350,//设置编辑器高度
            scaleEnabled:true
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        });

        //获取常用标签
        $('.tagcloud-link').on('click', function (){

        });

    </script>
@stop