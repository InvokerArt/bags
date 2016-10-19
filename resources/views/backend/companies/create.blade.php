@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
添加公司
@stop

@section('content')
    <div class="portlet light portlet-fit portlet-form bordered" id="form_wizard">
        <div class="portlet-body">
            {{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.companies.store', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'submit_form']) }}
            <div class="form-wizard" id="company">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab" class="step" aria-expanded="true">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>基本信息
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>公司营业执照
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step active">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                    <i class="fa fa-check"></i>公司照片
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"> </div>
                    </div>
                    <div class="tab-content">
                        <div class="alert alert-danger display-none">
                            <button class="close" data-dismiss="alert"></button> 请完成必填项信息输入！
                        </div>
                        <div class="alert alert-success display-none">
                            <button class="close" data-dismiss="alert"></button> 您的表单验证成功！
                        </div>
                        <div class="tab-pane active" id="tab1">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    所属会员用户名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('username', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司名
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司电话
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('telephone', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司地址
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::text('address', null, ['class' => 'form-control', 'autocomplete' => 'true']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    主营分类
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    <div class="form-control height-auto">
                                        <div class="categories-companies"></div>
                                    </div>
                                    <input type="hidden" name="categories" id="categories">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    加盟须知
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('notes', null, ['class' => 'form-control', 'autocomplete' => 'true', 'rows' => '5']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司简介
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                    {{ Form::textarea('content', null, ['class' => 'form-control editor', 'autocomplete' => 'true', 'id' => 'editor']) }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success"> <i class="fa fa-plus"></i>
                                    选择图片
                                </a>
                                <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                    <i class="fa fa-share"></i>
                                    上传图片
                                </a>
                            </div>
                            <div class="row">
                                <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"></div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th>Image</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="../assets/pages/media/works/img1.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../assets/pages/media/works/img1.jpg" alt=""></a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-default btn-sm">
                                                <i class="fa fa-times"></i>
                                                删除
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../assets/pages/media/works/img2.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../assets/pages/media/works/img2.jpg" alt=""></a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-default btn-sm">
                                                <i class="fa fa-times"></i>
                                                删除
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../assets/pages/media/works/img3.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../assets/pages/media/works/img3.jpg" alt=""></a>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-default btn-sm">
                                                <i class="fa fa-times"></i>
                                                删除
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    公司照片
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-10">
                            <a href="javascript:;" class="btn default button-previous disabled" style="display: none;">
                                <i class="fa fa-angle-left"></i>返回</a>
                            <a href="javascript:;" class="btn btn-outline green button-next">
                                下一步
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a href="javascript:;" class="btn green button-submit" style="display: none;">
                                提交
                                <i class="fa fa-check"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('js/vendor/plupload/plupload.full.min.js')}}"></script>
    <script src="{{asset('js/vendor/plupload/i18n/zh_CN.js')}}"></script>
    @include('UEditor::head')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    {{-- {!! JsValidator::formRequest('App\Http\Requests\Backend\Companies\CompanyStoreOrUpdateRequest', '#submit_form') !!} --}}
    <script type="text/javascript">
        $(function(){
            $('.select2').select2({
                placeholder: "从常用标签中选择"
            })

            //分类
            $('.categories-companies').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.companies.categories.children') }}"
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
                var categoriesElms = $('.categories-companies').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            });

            if (!jQuery().bootstrapWizard) {
                return;
            }

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            $.validator.setDefaults({ignore: ":hidden:not(#categories,.editor)"});
            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    username: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    categories: {
                        required: true
                    },
                    notes: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                },

                messages: { 
                    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "categories_id") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Theme.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "主营分类") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard').find('.button-previous').hide();
                } else {
                    $('#form_wizard').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard').find('.button-next').hide();
                    $('#form_wizard').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard').find('.button-next').show();
                    $('#form_wizard').find('.button-submit').hide();
                }
                Theme.scrollTo($('.page-title'));
            }
            
            // default form wizard
            $('#form_wizard').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard').find('.button-previous').hide();
            $('#form_wizard .button-submit').click(function () {
                alert('请完成所有信息！');
            }).hide();
        })

        //图片上传
        var uploader = new plupload.Uploader({
            // add X-CSRF-TOKEN in headers attribute to fix this issue
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            runtimes : 'html5,flash,silverlight,html4',
             
            browse_button : document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself
             
            url : "{{ route(env("APP_BACKEND_PREFIX").'.upload.company') }}",
             
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "图片文件", extensions : "jpg,gif,png"}
                ]
            },
            flash_swf_url : "{{ asset("js/vendor/plupload/Moxie.swf") }}",
            silverlight_xap_url : '{{ asset("js/vendor/plupload/Moxie.xap") }}',          
         
            init: {
                PostInit: function() {
                    $('#tab_images_uploader_filelist').html("");
         
                    $('#tab_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });

                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        uploader.removeFile($(this).parent('.added-files').attr("id"));    
                        $(this).parent('.added-files').remove();                     
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);

                    if (response.result && response.result == 'OK') {
                        var id = response.id; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> Done'); // set successfull upload
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> Failed'); // set failed upload
                        Theme.alert({type: 'danger', message: '其中一个上传失败。 请重试。', closeInSeconds: 10, icon: 'warning'});
                    }
                },
         
                Error: function(up, err) {
                    Theme.alert({type: 'danger', message: err.message, closeInSeconds: 10, icon: 'warning'});
                }
            }
        });

        uploader.init();

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