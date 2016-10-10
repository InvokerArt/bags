<!-- 侧边栏开始 -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- 侧边菜单开始 -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-search-wrapper hidden-xs">
                <!-- 快速搜索开始 -->
                {{-- <form class="sidebar-search sidebar-search-bordered sidebar-search-solid" action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form> --}}
                <!-- 快速搜索结束 -->
            </li>
            <li class="start {{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.dashboard')) }} ">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.dashboard') }}">
                    <i class="icon-home"></i>
                    <span class="title">首页</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news*')) }}">
                <a href="javascript:;">
                    <i class="icon-pencil"></i>
                    <span class="title">行业资讯</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.news.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.index') }}">资讯</a>
                    </li>
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.news.categories.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.tags*')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.tags.index') }}">
                    <i class="icon-tag"></i>
                    <span class="title">标签管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.comments*')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.comments.index') }}">
                    <i class="icon-bubble"></i>
                    <span class="title">评论管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access*')) }}">
                <a href="javascript:;">
                    <i class="icon-people"></i>
                    <span class="title">用户管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.access.user.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.user.index') }}">所有用户</a>
                    </li>
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.access.admin.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.admin.index') }}">管理员</a>
                    </li>
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.access.role.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.role.index') }}">角色管理</a>
                    </li>
                    <li class="{{ active_class(if_route(env('APP_BACKEND_PREFIX').'.access.permission.index')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.permission.index') }}">权限管理</a>
                    </li>
                </ul>
            </li>
            <li class="last">
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">系统管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="/admin/log/all">操作日志</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- 侧边菜单结束 -->
    </div>
</div>
<!-- 侧边栏结束