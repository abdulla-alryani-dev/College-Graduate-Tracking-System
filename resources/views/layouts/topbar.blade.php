{{--<nav class="topbar">--}}
{{--    <!-- Mobile Toggle -->--}}
{{--    <button class="btn btn-link me-2 d-lg-none" id="mobileSidebarToggle">--}}
{{--        <i class="fas fa-bars"></i>--}}
{{--    </button>--}}

{{--    <!-- Brand -->--}}
{{--    <a href="{{ route('dashboard') }}" class="topbar-brand">--}}
{{--        <i class="fas fa-graduation-cap topbar-brand-icon"></i>--}}
{{--        <span>نظام متابعة الخريجين</span>--}}
{{--    </a>--}}

{{--    <!-- Search -->--}}
{{--    <div class="topbar-search">--}}
{{--        <i class="fas fa-search topbar-search-icon"></i>--}}
{{--        <input type="text" placeholder="بحث...">--}}
{{--    </div>--}}

{{--    <!-- Navigation Items -->--}}
{{--    <div class="topbar-items">--}}
{{--        <!-- Notification Dropdown -->--}}
{{--        <div class="topbar-item dropdown">--}}
{{--            <button class="topbar-item-btn" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                <i class="far fa-bell"></i>--}}
{{--                <span class="topbar-item-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>--}}
{{--            </button>--}}
{{--            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 320px;">--}}
{{--                <div class="px-3 py-2 border-bottom">--}}
{{--                    <h6 class="mb-0">الإشعارات</h6>--}}
{{--                </div>--}}
{{--                <div style="max-height: 300px; overflow-y: auto;">--}}
{{--                    @forelse(auth()->user()->unreadNotifications as $notification)--}}
{{--                        <a href="#" class="notification-item">--}}
{{--                            <div class="notification-icon notification-icon-primary">--}}
{{--                                <i class="fas fa-user-graduate"></i>--}}
{{--                            </div>--}}
{{--                            <div class="notification-content">--}}
{{--                                <div class="notification-title">{{ $notification->data['title'] }}</div>--}}
{{--                                <p class="mb-1 text-muted">{{ $notification->data['message'] }}</p>--}}
{{--                                <div class="notification-time">--}}
{{--                                    <i class="far fa-clock"></i> {{ $notification->created_at->diffForHumans() }}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @empty--}}
{{--                        <div class="px-3 py-2 text-center text-muted">لا توجد إشعارات جديدة</div>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
{{--                <div class="px-3 py-2 border-top text-center">--}}
{{--                    <a href="{{ route('admin.notifications.index') }}" class="text-primary">عرض جميع الإشعارات</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- User Dropdown -->--}}
{{--        <div class="topbar-item dropdown">--}}
{{--            <div class="topbar-user dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                <img src="{{ auth()->user()->avatar_url }}" class="topbar-user-avatar" alt="User">--}}
{{--                <div class="topbar-user-info">--}}
{{--                    <span class="topbar-user-name">{{ auth()->user()->name }}</span>--}}
{{--                    <span class="topbar-user-role">{{ auth()->user()->role }}</span>--}}
{{--                </div>--}}
{{--                <i class="fas fa-chevron-down topbar-user-arrow"></i>--}}
{{--            </div>--}}
{{--            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">--}}
{{--                <a href="{{ route('profile.show') }}" class="dropdown-item">--}}
{{--                    <i class="fas fa-user dropdown-item-icon"></i>--}}
{{--                    <span>الملف الشخصي</span>--}}
{{--                </a>--}}
{{--                <a href="" class="dropdown-item">--}}
{{--                    <i class="fas fa-cog dropdown-item-icon"></i>--}}
{{--                    <span>الإعدادات</span>--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}
{{--                    <button type="submit" class="dropdown-item">--}}
{{--                        <i class="fas fa-sign-out-alt dropdown-item-icon"></i>--}}
{{--                        <span>تسجيل الخروج</span>--}}
{{--                    </button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

<nav class="topbar">
    <!-- Brand -->
    <button class="btn btn-link me-2 d-lg-none" id="mobileSidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <a href="#" class="topbar-brand">
        <i class="fas fa-graduation-cap topbar-brand-icon"></i>
        <span>نظام متابعة الخريجين</span>
    </a>



    <!-- Navigation Items -->
    <div class="topbar-items">
        <!-- Notification Dropdown -->
        <div class="topbar-item dropdown">
            <button class="topbar-item-btn" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="topbar-item-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 320px;">
                <div class="px-3 py-2 border-bottom">
                    <h6 class="mb-0">الإشعارات</h6>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                    @forelse(auth()->user()->unreadNotifications as $notification)
                        <a href="#" class="notification-item">
                            <div class="notification-icon notification-icon-primary">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="notification-content">
                                <div class="notification-title">{{ $notification->data['title'] }}</div>
                                <p class="mb-1 text-muted">{{ $notification->data['message'] }}</p>
                                <div class="notification-time">
                                    <i class="far fa-clock"></i> {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-3 py-2 text-center text-muted">لا توجد إشعارات جديدة</div>
                    @endforelse
                </div>
                <div class="px-3 py-2 border-top text-center">
                    <a href="{{ route('admin.notifications.index') }}" class="text-primary">عرض جميع الإشعارات</a>
                </div>
            </div>
        </div>

        <!-- Messages Dropdown -->
        <div class="topbar-item dropdown">
            <button class="topbar-item-btn" type="button" id="messagesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="far fa-envelope"></i>
                <span class="topbar-item-badge">٥</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="messagesDropdown" style="width: 320px;">
                <div class="px-3 py-2 border-bottom">
                    <h6 class="mb-0">الرسائل</h6>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                    <a href="#" class="notification-item">
                        <div class="notification-icon">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle" width="40" height="40" alt="User">
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">محمد أحمد</div>
                            <p class="mb-1 text-muted">هل يمكنك مساعدتي في مشكلة تواجهني؟</p>
                            <div class="notification-time">
                                <i class="far fa-clock"></i> منذ ٣٠ دقيقة
                            </div>
                        </div>
                    </a>
                    <a href="#" class="notification-item">
                        <div class="notification-icon">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle" width="40" height="40" alt="User">
                        </div>
                        <div class="notification-content">
                            <div class="notification-title">سارة خالد</div>
                            <p class="mb-1 text-muted">لدي استفسار بخصوص التقرير الشهري</p>
                            <div class="notification-time">
                                <i class="far fa-clock"></i> منذ ساعة
                            </div>
                        </div>
                    </a>
                </div>
                <div class="px-3 py-2 border-top text-center">
                    <a href="#" class="text-primary">عرض جميع الرسائل</a>
                </div>
            </div>
        </div>

        <!-- User Dropdown -->
        <div class="topbar-item dropdown">
            <div class="topbar-user dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="topbar-user-avatar" alt="User">
                <div class="topbar-user-info">
                    <span class="topbar-user-name">أحمد محمد</span>
                    <span class="topbar-user-role">مدير النظام</span>
                </div>
                <i class="fas fa-chevron-down topbar-user-arrow"></i>
            </div>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user dropdown-item-icon"></i>
                    <span>الملف الشخصي</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog dropdown-item-icon"></i>
                    <span>الإعدادات</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-list dropdown-item-icon"></i>
                    <span>سجل النشاط</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt dropdown-item-icon"></i>
                    <span>تسجيل الخروج</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Search -->
    {{--    <div class="topbar-search">--}}
    {{--        <i class="fas fa-search topbar-search-icon"></i>--}}
    {{--        <input type="text" placeholder="بحث...">--}}
    {{--    </div>--}}

    <form dir="ltr" class="d-none d-sm-inline-block form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <button  class="btn btn-primary" type="button" >
                <i class="fas fa-search fa-sm"></i>
            </button>
            <input  dir="ltr" type="text" class="form-control bg-light border-0 small" placeholder="بحث..." aria-label="Search">

        </div>
    </form>
</nav>
