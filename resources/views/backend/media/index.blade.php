@extends('backend.layouts.app')

@section('content')
<div class="portlet">
    <div class="note note-danger no-margin margin-bottom-10">上传图片不能包含中文或非法字符！双击文件夹进入文件夹</div>
    <div class="portlet-body">
        <div class="tabbable-bordered">
            <div class="tab-content">
                <media-manager></media-manager>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/media-manager.js') }}"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>  
        new Vue({
            el: 'body',
            events:{
                'media-manager-notification' : function(message, type, time)
                {   
                    swal({   
                        title: "Auto close alert!",   
                        text: message,   
                        timer: 2000,   
                        showConfirmButton: false 
                    });
                }
            }
        });
    </script>
@stop