<!-- 头部开始 -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- LOGO开始 -->
        <div class="page-logo">
            <a href="/admin">
            <img src="{!! asset('images/logo.png') !!}" alt="logo" class="logo-default"/>
            </a>
            <!-- 侧边栏切换开关开始 -->
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
            <!-- 侧边栏切换结束 -->
        </div>
        <!-- LOGO结束 -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" class="img-circle" src="{!! asset('images/avatar3_small.jpg') !!}"/>
                    <span class="username">
                    Bob </span>
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="extra_profile.html">
                            <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="page_calendar.html">
                            <i class="icon-calendar"></i> My Calendar </a>
                        </li>
                        <li>
                            <a href="inbox.html">
                            <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
                            3 </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
                            7 </span>
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="extra_lock.html"> Lock Screen </a>
                        </li>
                        <li>
                            <a href="{{ route(env('APP_BACKEND_PREFIX').'.auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-lock"></i>
                                退出
                            </a>
                            <form id="logout-form" action="{{ route(env('APP_BACKEND_PREFIX').'.auth.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- 头部结束 -->