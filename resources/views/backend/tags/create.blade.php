@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
添加标签
@stop

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.tags.store', 'method' => 'post', 'id' => 'create-user']) }}
    <div class="row">
        <div class="col-xs-10">
            <div class="tags-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="在此输入标签标题"></div>
                <div class="inside">
                    <div id="edit-slug-box" class="hide-if-no-js"> <strong>固定链接：</strong>
                        <span id="sample-permalink">
                            {{ env('APP_URL') }}
                            <span id="editable-post-name">
                                <input type="text" id="slug" value="" class="form-control" name="slug" autocomplete="off"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group margin-top-15">
                    <textarea name="subtitle" class="form-control" placeholder="在此输入标签简介"></textarea>
                </div>
                <div class="form-group">
                    <textarea name="content" id="editor" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="col-xs-2 tags-sidebar">
            <div class="tagsbox margin-bottom-15">
                <h2>
                    <span>发布</span>
                </h2>
                <div class="inside">
                    <input type="text" name="published_at" class="form-control date-timepicker" placeholder="发布时间">
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
            <div class="tagsbox margin-bottom-15">
                <h2>
                    <span>分类目录</span>
                </h2>
                <div class="inside tags-categories">
                </div>
            </div>
            <div class="tagsbox margin-bottom-15">
                <h2>
                    <span>标签</span>
                </h2>
                <div class="inside">
                    <div>
                        <input type="text" name="tags[]" class="form-control" placeholder="添加标签">
                        <p class="help-block">多个标签请用英文逗号（,）分开</p>
                    </div>
                    <div class="margin-top-10">
                        <select class="select2 form-control" name="tags[]" multiple>
                            <option value="">标签1</option>
                            <option value="">标签2</option>
                            <option value="">标签3</option>
                        </select>
                        <p class="help-block">从常用标签中选择</p>
                    </div>
                </div>
            </div>
            <div class="tagsbox margin-bottom-15">
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