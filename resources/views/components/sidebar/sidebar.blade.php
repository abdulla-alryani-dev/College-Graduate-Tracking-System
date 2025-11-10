<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-3">متابعة الخريجين </div>
        <div class="sidebar-brand-icon">
           <img src="\img\logo.png" alt="logo" style="logo" width="80" height="80">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-dashboard.sidebar.nav-item title="Dashboard" url="/" icon="fas fa-fw fa-tachometer-alt"/>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        الادارة
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
           <span>المستخدمين</span>
           <i class="fas fa-fw fa-user"></i>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">بيانات المستخدمين</h6>
                <x-dashboard.sidebar.collapse-item url="{{ route('graduate.index') }}" title="الخريحن"/>
                <x-dashboard.sidebar.collapse-item url="supervisor" title="المشرفين"/>
                <x-dashboard.sidebar.collapse-item url="" title="هيئات توظيف"/>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
           <span>الادارة</span>
           <i class="fas fa-fw fa-cog"></i>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <x-dashboard.sidebar.collapse-item url="{{route('users.index')}}" title="ادارة المستخدمين"/>
                <x-dashboard.sidebar.collapse-item url="{{route('roles.index')}}" title="ادارة الصلاحيات - الادوار"/>
                <x-dashboard.sidebar.collapse-item url="{{route('user-roles.index')}}" title="ادارة ادوار المستخدمين"/>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        الموقع
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
           <span>صفحات الموقع</span>
           <i class="fas fa-fw fa-folder"></i>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <x-dashboard.sidebar.collapse-item url="" title="Login"/>
                <x-dashboard.sidebar.collapse-item url="" title="Register"/>
                <x-dashboard.sidebar.collapse-item url="" title="Forgot Password"/>

                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="">404 Page</a>
                <a class="collapse-item" href="">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <x-dashboard.sidebar.nav-item title="اي شي" url="" icon="fas fa-fw fa-chart-area"/>
    <!-- Nav Item - Tables -->
    <x-dashboard.sidebar.nav-item title="الجداول" url="" icon="fas fa-fw fa-table"/>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
