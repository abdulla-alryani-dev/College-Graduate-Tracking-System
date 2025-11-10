
<nav class="topbar">
    <!-- Brand -->
    <button class="btn btn-link me-2 d-lg-none" id="mobileSidebarToggle">
        <i class="fas fa-bars"></i>
    </button>
    <a href="#" class="topbar-brand">
        {{-- <i class="fas fa-graduation-cap topbar-brand-icon"></i> --}}
        <span>{{ $brand ?? 'نظام متابعة الخريجين' }}</span>
    </a>

    <!-- Navigation Items -->
    <div class="topbar-items">
        <!-- User Dropdown -->
        <div class="topbar-item dropdown">
            <div class="topbar-user dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                {{--                auth()->user()->profile_picture--}}
                @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            @if(Auth::user()->img)
                <img src="{{ asset('storage/' . Auth::user()->img) }}"
                     class="rounded-circle mx-2"
                     style="width: 50px; height: 50px; object-fit: cover;"
     id="profileImagePreview">
            @else
                <img src="{{ asset('assets/img/profile-image.png') }}"
                     class="rounded-circle mx-2"
                     style="width: 50px; height: 50px; object-fit: cover;"
                     id="profileImagePreview">
            @endif
                            <div class="topbar-user-info">
                    <span class="topbar-user-name">{{ auth()->user()->name }}</span>
                    <span class="topbar-user-role">{{ auth()->user()->role }}</span>
                </div>
                <i class="fas fa-chevron-down topbar-user-arrow"></i>
            </div>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <a href="{{ route('profile.show') }}" class="dropdown-item">
                    <i class="fas fa-user dropdown-item-icon"></i>
                    <span>الملف الشخصي</span>
                </a>
                <a href="{{ route('setting') }}" class="dropdown-item">
                    <i class="fas fa-cog dropdown-item-icon"></i>
                    <span>الإعدادات</span>
                </a>
                <a href="" class="dropdown-item">
                    <i class="fas fa-list dropdown-item-icon"></i>
                    <span>سجل النشاط</span>
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt dropdown-item-icon"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </div>
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
                                <div class="notification-title">{{ isset($notification->data['title']) }}</div>
                                <p class="mb-1 text-muted">{{ isset($notification->data['message']) }}</p>
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
                    <!-- Example of dynamic messages -->
                    @foreach($messages as $message)
                        <a href="#" class="notification-item">
                            <div class="notification-icon">
{{--                                $message->user->profile_picture--}}
                                <img src="{{ asset('assets/icons/brands/android.svg') }}" class="rounded-circle" width="40" height="40" alt="User">
                            </div>
                            <div class="notification-content">
{{--                                $message->user->name--}}
                                <div class="notification-title">required full access</div>
                                <p class="mb-1 text-muted">message content</p>
                                <div class="notification-time">
                                    <i class="far fa-clock"></i>
{{--                                    {{ $message->created_at->diffForHumans() }}--}}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="px-3 py-2 border-top text-center">
                    <a href="" class="text-primary">عرض جميع الرسائل</a>
                </div>
            </div>
        </div>



    </div>
    <!-- Search Form -->
    <form dir="ltr" class="d-none d-sm-inline-block form-inline me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
            <input dir="ltr" type="text" class="form-control bg-light border-0 small" placeholder="بحث..." aria-label="Search">
        </div>
    </form>


</nav>
