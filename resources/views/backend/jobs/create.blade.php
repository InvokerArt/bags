@extends('backend.layouts.app')

@section('page-title')
添加招聘
@stop

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.jobs.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'submit_form']) }}
    <div class="portlet">            
        <div class="portlet-title">
            <div class="actions btn-set">
                <button type="button" name="back" class="btn btn-secondary-outline" onclick="location.href='{{ route(env('APP_BACKEND_PREFIX').'.jobs.index') }}'">
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
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    所属公司名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'name']) }}
                                    <span class="help-block"><a href="javascript:;" class="company-info" style="display:none">公司资料</a></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    招聘简介
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control editor', 'autocomplete' => 'true', 'id' => 'editor']) }}
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
    <script type="text/javascript">
        $(function(){
            //公司资料
            $(document).on('change', '#name', function(){
                if ($('#name').val()){
                    $('.company-info').show();
                } else {
                    $('.company-info').hide();
                }
            })
            $(document).on('click', '.company-info', function(){
                var newWindow = window.open("","_blank");
                if ($('#name').val()){
                    $.get("{{ route(env('APP_BACKEND_PREFIX').'.companies.ajax.info') }}", {name: $('#name').val()}, function(data){
                        newWindow.location.href = "/"+"{{ env('APP_BACKEND_PREFIX') }}"+"/companies/"+data.id+"/edit";
                    });
                }
            })
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
        })
    </script>
@stop
