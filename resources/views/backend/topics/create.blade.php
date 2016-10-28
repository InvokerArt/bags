@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/global/vendor/jstree/themes/default/style.min.css')}}">
@stop

@section('page-title')
添加话题
@stop

@section('content')
{{ Form::open(['route' => env('APP_BACKEND_PREFIX').'.topics.store', 'method' => 'post', 'id' => 'create-topic']) }}
    <div id="poststuff">
        <div class="left-body-content">
            <div class="topics-body">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="在此输入话题标题">
                </div>
                {{-- <div class="inside">
                    <div id="edit-slug-box" class="hide-if-no-js"> <strong>固定链接：</strong>
                        <span id="sample-permalink">
                            {{ env('APP_URL').'topics/' }}
                            <span id="editable-post-name">
                                <input type="text" id="slug" class="form-control" name="slug" autocomplete="off" value="{{ str_replace(env('APP_URL').'topics/', '', $topics->slug) }}"></span>
                        </span>
                    </div>
                </div> --}}
                <div class="form-group">
                    <textarea name="content" id="editor" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="right-sidebar">
            <div class="box margin-bottom-15">
                <h2>
                    <span>分类目录</span>
                </h2>
                <div class="inside topics-categories">
                </div>
                <input type="hidden" name="categories_id" id="categories">
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>特色图片</span>
                </h2>
                <div class="inside">
                    <input type="hidden" name="image" class="thumbnail" v-model="image">
                    <a href="javascript:;" class="update-thumbnail" @click="openFromPageImage()">
                        <img v-if="image" class="img img-responsive" id="page-image-preview" style="width:100%" :src="image">
                    </a>
                    <p class="help-block" id="how-to" v-if="image" @click="openFromPageImage()">点击图片来修改或更新</p>
                    <p class="help-block" v-if="image">
                        <a href="javascript:;" class="topics-thumbnail" @click="removeImage()">移除特色图片</a>
                    </p>
                    <p class="help-block" v-else="image">
                        <a href="javascript:;" @click="openFromPageImage()">添加特色图片</a>
                    </p>
                </div>
            </div>
            <div class="box margin-bottom-15">
                <h2>
                    <span>话题属性</span>
                </h2>
                <div class="inside">
                    <div class="form-group">
                        <input type="user_id" name="title" class="form-control" placeholder="用户">
                    </div>
                    <div class="form-group">
                        <select name="excellent" class="form-control form-filter input-sm select2">
                            <option value="">请选择</option>
                            <option value="yes"> 是 </option>
                            <option value="yes"> 否 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="blocked" class="form-control form-filter input-sm select2">
                            <option value="">请选择</option>
                            <option value="yes"> 是 </option>
                            <option value="yes"> 否 </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="user_id" name="title" class="form-control" placeholder="回复数">
                    </div>
                    <div class="form-group">
                        <input type="user_id" name="title" class="form-control" placeholder="投票数">
                    </div>
                    <div class="form-group">
                        <button href="javascript:;" class="btn green btn-block margin-top-10">
                            <i class="fa fa-edit"></i>
                            发布 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
<media-modal :show.sync="showMediaManager">
    <media-manager
            :is-modal="true"
            :selected-event-name.sync="selectedEventName"
            :show.sync="showMediaManager"
    >
    </media-manager>
</media-modal>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/media-manager.js') }}"></script>
    @include('UEditor::head')
    <script src="{{asset('js/jstree.min.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            $('.select2').select2({
                placeholder: "从常用标签中选择"
            })

            //分类目录
            $('.topics-categories').jstree({
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
                            return "{{ route(env('APP_BACKEND_PREFIX').'.topics.categories.children') }}"
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
                var categoriesElms = $('.topics-categories').jstree("get_selected", true);
                $.each(categoriesElms, function() {
                    categories.push(this.id);
                });
                $('#categories').val(categories);
            })
            .bind("loaded.jstree", function (event, data) {
                $('.topics-categories').jstree("open_all");
            })
            .bind("ready.jstree", function (event, data) {
                $('.topics-categories').find("li").each(function() {
                    for (var i = 0; i < checkNodeIds.length; i++) {
                        if ($(this).attr("id") == checkNodeIds[i]) {
                            $('.topics-categories').jstree("check_node", $(this));
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
        })

        //媒体库逻辑
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        new Vue({
            el: 'body',
            data: {
                image: null,
                selectedEventName: null,
                showMediaManager: false,
                simpleMde: null
            },

            ready: function () {
                //移除图片
                // $(document).on('click', '.topics-thumbnail', function(){
                //     $('.thumbnail').val('');
                // })
            },

            events: {
                'media-manager-selected-image': function (file) {
                    this.image = file.relativePath;
                    this.showMediaManager = false;
                },

                'media-manager-notification' : function(message, type, time)
                {
                    swal({   
                        title: "提示信息",   
                        text: message,   
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                }

            },

            methods: {

                openFromPageImage: function()
                {
                    this.showMediaManager = true;
                    this.selectedEventName = 'image';
                },

                removeImage: function()
                {
                    this.image = '';
                }
            }
        });


    </script>
@stop
