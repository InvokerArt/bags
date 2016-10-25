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
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.index') }}">资讯</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.news.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.news.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions*')) }}">
                <a href="javascript:;">
                    <i class="icon-globe"></i>
                    <span class="title">展会信息</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.exhibitions.index') }}">展会</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.exhibitions.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.exhibitions.categories.index') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.media.index')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.media.index') }}">
                    <i class="icon-folder-alt"></i>
                    <span class="title">媒体库</span>
                </a>
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
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.favorites*')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.favorites.index') }}">
                    <i class="icon-like"></i>
                    <span class="title">收藏管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.jobs*')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.jobs.index') }}">
                    <i class="icon-like"></i>
                    <span class="title">招聘管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.users*')) }}">
                <a href="{{ route(env('APP_BACKEND_PREFIX').'.users.index') }}">
                    <i class="icon-people"></i>
                    <span class="title">会员管理</span>
                </a>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies*')) }}">
                <a href="javascript:;">
                    <i class="icon-briefcase"></i>
                    <span class="title">公司管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.index') }}">公司列表</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.companies.categories*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.companies.categories.index', 'role=1') }}">分类</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access*')) }}">
                <a href="javascript:;">
                    <i class="icon-user-following"></i>
                    <span class="title">管理员管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.admin*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.user.index') }}">管理员</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.role*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.role.index') }}">角色管理</a>
                    </li>
                    <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'.access.permission*')) }}">
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.access.permission.index') }}">权限管理</a>
                    </li>
                </ul>
            </li>
            <li class="{{ active_class(if_route_pattern(env('APP_BACKEND_PREFIX').'log-viewer*')) }} last">
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">系统管理</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.log-viewer::dashboard') }}">主页</a>
                        <a href="{{ route(env('APP_BACKEND_PREFIX').'.log-viewer::logs.list') }}">日志</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- 侧边菜单结束 -->
    </div>
</div>
<!-- 侧边栏结束