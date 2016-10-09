@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
编辑资讯
@stop

@section('content')
{{ Form::model($news, ['route' => [env('APP_BACKEND_PREFIX').'.news.update', $news], 'method' => 'PATCH', 'id' => 'edit-news']) }}
    <div class="row">
        <div class="col-xs-10">
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
        <div class="col-xs-2 news-sidebar">
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
                        <input type="text" name="newtag" class="form-control" placeholder="添加标签" value="{{ $newsTag }}">
                        <p class="help-block">多个标签请用英文逗号（,）分开</p>
                    </div>
                    <div class="margin-top-10">
                        <select class="select2 form-control" name="tags" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
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
    </script>
@stop