@extends('backend.layouts.app')

@section('page-title')
    资讯列表
@stop
@section('content')
<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="actions">
            <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.create') }}" class="btn green btn-info">
                <i class="fa fa-plus"></i>
                <span class="hidden-xs">添加资讯</span>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-container">
            <table class="table table-striped table-bordered table-hover" id="news-table">
                <thead>
                <tr role="row" class="heading">
                    <th class="check-column">
                        <input type="checkbox" class="group-checkable">
                    </th>
                    <th class="column-id">ID</th>
                    <th>标题</th>
                    <th class="column-author">作者</th>
                    <th class="column-categories">分类目录</th>
                    <th class="column-tags">标签</th>
                    <th class="column-comments">评论</th>
                    <th class="column-date">发布日期</th>
                    <th class="column-actions">操作</th>
                </tr>
                <tr role="row" class="filter">
                    <td>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="id">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="title">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="author">
                    </td>
                    <td>
                        <select name="categories" class="form-control form-filter input-sm select2">
                            <option value="">请选择</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="tag">
                    </td>
                    <td>
                        <input type="text" class="form-control form-filter input-sm" name="comment">
                    </td>
                    <td>
                        <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control form-filter input-sm" readonly="" name="published_from" placeholder="开始时间">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                        <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control form-filter input-sm" readonly="" name="published_to" placeholder="结束时间">
                            <span class="input-group-btn">
                                <button class="btn btn-sm default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="margin-bottom-5">
                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom"><i class="fa fa-search"></i>搜索</button>
                        </div>
                        <button class="btn btn-sm red btn-outline filter-cancel"><i class="fa fa-times"></i>重置</button>
                    </td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(function() {
            $.fn.dataTableExt.oStdClasses.sWrapper = "dataTables_wrapper";
            var grid = new Datatable();
            grid.init({
                src: $('#news-table'),
                dataTable: {
                    serverSide: true,
                    bFilter: false,
                    bStateSave: true,
                    filterApplyAction: "filter",
                    filterCancelAction: "filter_cancel",
                    resetGroupActionInputOnSuccess: true,
                    orderCellsTop: true,
                    pagingType: "bootstrap_extended",
                    autoWidth: false,
                    ajax: {
                        url: '{{ route(env('APP_BACKEND_PREFIX').".news.get") }}',
                    },
                    columns: [
                        {data: 'ids', name: '',"orderable": false,"searchable": false},
                        {data: 'id', name: '',"orderable": true,"searchable": true},
                        {data: 'title', name: '',"orderable": true,"searchable": true},
                        {data: 'author', name: '',"orderable": true,"searchable": true},
                        {data: 'categories', name: '',"orderable": true,"searchable": true},
                        {data: 'tags', name: '',"orderable": true,"searchable": false},
                        {data: 'comments', name: '',"orderable": true,"searchable": false},
                        {data: 'published_at', name: '',"orderable": true,"searchable": true},
                        {data: 'actions', name: '', orderable: false, searchable: false}
                    ],
                    "lengthMenu": [[20, 40, 100, -1], [20, 40, 100, "全部"]],
                    "order": [
                        [1, "desc"]
                    ],
                    "pageLength": 20,
                }
            });
            
            $(document).ajaxComplete(function(){
                Customer.addDeleteForms();
            });

            /**
             * 删除操作
             */
            $('body').on('submit', 'form[name=delete_item]', function(e){
                e.preventDefault();
                var form = this;
                var link = $('a[data-method="delete"]');
                var cancel = (link.attr('data-trans-button-cancel')) ? link.attr('data-trans-button-cancel') : "返回";
                var confirm = (link.attr('data-trans-button-confirm')) ? link.attr('data-trans-button-confirm') : "确定";
                var title = (link.attr('data-trans-title')) ? link.attr('data-trans-title') : "警告";
                var text = (link.attr('data-trans-text')) ? link.attr('data-trans-text') : "你确定要删除这个项目吗？";

                swal({
                    title: title,
                    text: text,
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: cancel,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: confirm,
                    closeOnConfirm: true
                }, function(confirmed) {
                    if (confirmed)
                        form.submit();
                });
            });
        })
    </script>
@stop