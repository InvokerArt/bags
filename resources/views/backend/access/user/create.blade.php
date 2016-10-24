@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
    创建用户
@stop

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.access.user.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'create-user']) }}
    <div class="portlet" id="crop-avatar">
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.access.user.index') }}'">
                    <i class="fa fa-angle-left"></i>
                    返回
                </button>
                <button class="btn btn-secondary-outline" type="reset">
                    <i class="fa fa-rotate-left"></i>
                    重置
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-check"></i>
                    保存
                </button>
            </div>
        </div>
        <div class="portlet-body">
            <div class="tabbable-bordered">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#user" data-toggle="tab">个人资料</a>
                    </li>
                    <li>
                        <a href="#company" data-toggle="tab">公司信息</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="user">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    手机号
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('mobile', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    邮箱
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="company">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司名
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司电话
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('telephone', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司地址
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('address', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    主营分类
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="user-categories"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司营业执照
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司照片
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    加盟须知
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司简介
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'editor']) }}
                                </div>
                            </div>
                        </div>
                    </div>
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
            $('input').iCheck({
                radioClass: 'iradio_flat-green'
            });

            //分类目录
            $('.user-categories').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.company.categories.children') }}"
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
        })
    </script>
@stop