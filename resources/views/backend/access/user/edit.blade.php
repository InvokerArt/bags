@extends('backend.layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
<link rel="stylesheet" href="/js/vendor/cropper/cropper.min.css">
<link rel="stylesheet" href="/js/vendor/cropper/main.css">
@stop
@section('page-title')
    编辑用户
@stop

@section('content')
{{ Form::model($user, ['route' => [env('APP_BACKEND_PREFIX').'.access.user.update', $user], 'class' => 'form-horizontal', 'method' => 'PATCH', 'id' => 'edit-user']) }}
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
                                <div class="pull-left col-xs-offset-2">
                                    <div class="avatar-view" data-toggle="tooltip" data-placement="bottom" title="修改头像">
                                        <img src="{{ asset('uploads/avatars/default/medium.png') }}" class="user-profile-image" />
                                    </div>
                                </div>
                            </div>
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
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    身份
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="radio-list">
                                        <label for="" class="radio-inline">
                                        {{ Form::radio('role[]', 1, true,  ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                        </label>
                                        <label for="" class="radio-inline">
                                        {{ Form::radio('role[]', 2, false,  ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                        </label>
                                        <label for="" class="radio-inline">
                                        {{ Form::radio('role[]', 3, false,  ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                        </label>
                                    </div>
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
                                </label>
                                <div class="col-md-10">
                                    <div class="user-categories"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司营业执照
                                </label>
                                <div class="col-md-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司照片
                                </label>
                                <div class="col-md-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    加盟须知
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司简介
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
<!-- Cropping modal -->
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['route' => env('APP_BACKEND_PREFIX').'.access.user.avatar', 'class' => 'avatar-form', 'method' => 'POST']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="avatar-modal-label">设置新头像</h4>
            </div>
            <div class="modal-body">
                <div class="avatar-body">

                    <!-- Upload image and data -->
                    <div class="avatar-upload">
                        <input type="hidden" class="avatar-src" name="avatar_src">
                        <input type="hidden" class="avatar-data" name="avatar_data">
                        <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                    </div>

                    <!-- Crop and preview -->
                    <div class="row">
                        <div class="col-md-9">
                            <div class="avatar-wrapper"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="avatar-preview preview-lg"></div>
                            300*300
                            <div class="avatar-preview preview-md"></div>
                            150*150
                            <div class="avatar-preview preview-sm"></div>
                            65*65
                        </div>
                    </div>

                    <div class="row avatar-btns">
                        <div class="col-md-9">
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-5" title="向左旋转">
                                <span class="docs-tooltip" data-toggle="tooltip" data-method="rotate" data-option="-5" title="" data-original-title="向左旋转">
                                    <span class="fa fa-rotate-left" data-method="rotate" data-option="-5"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="5" title="向右旋转">
                                <span class="docs-tooltip" data-toggle="tooltip" data-method="rotate" data-option="5" title="" data-original-title="向右旋转">
                                    <span class="fa fa-rotate-right" data-method="rotate" data-option="5"></span>
                                </span>
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block avatar-save">完成</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div><!-- /.modal -->

<!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
@stop

@section('js')
    @include('UEditor::head')
    <script src="/js/vendor/cropper/cropper.min.js"></script>
    <script src="/js/vendor/cropper/main.js"></script>
    <script type="text/javascript">
        $(function(){

            $('input').iCheck({
                radioClass: 'iradio_flat-green'
            });

            //分类目录
            $('.users-categories').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.users.categories.children') }}"
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