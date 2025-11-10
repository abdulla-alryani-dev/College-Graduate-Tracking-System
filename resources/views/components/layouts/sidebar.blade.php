
<div id="sidebar">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="{{$brand['brand-icon']}}"></i>
        </div>
        <div class="sidebar-brand-text">{{$brand['brand-name']}}</div>
        </div>
    <hr class="sidebar-divider">

    <div class="sidebar-nav">
        @foreach($menuConfig as $section)
            @isset($section['heading'])
                <div class="sidebar-heading">{{ $section['heading'] }}</div>
            @endisset

            @foreach($section['items'] as $item)
                @if(isset($item['submenu']))
                    <!-- Collapsible Menu Item -->
                    <a class="nav-link {{ $isActive($item['active_routes']) ? 'active' : '' }}"
                       data-bs-toggle="collapse"
                       href="#{{ $item['collapse_id'] }}">
                        <div class="nav-link-icon">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <div class="nav-link-text">{{ $item['text'] }}</div>
                        @isset($item['badge'])
                            <div class="nav-link-badge">{{ $item['badge'] }}</div>
                        @endisset
                        <div class="nav-link-arrow">
                            <i class="fas fa-angle-down"></i>
                        </div>
                    </a>

                    <!-- Submenu Items -->
                    <div class="collapse nav-collapse {{ $isActive($item['active_routes']) ? 'show' : '' }}"
                         id="{{ $item['collapse_id'] }}">
                        @foreach($item['submenu'] as $subItem)
                            <a href="{{ route($subItem['route']) }}"
                               class="nav-link {{ $isActive($subItem['active_routes']) ? 'active' : '' }}">
                                <div class="nav-link-icon">
                                    <i class="{{ $subItem['icon'] }}"></i>
                                </div>
                                <div class="nav-link-text">{{ $subItem['text'] }}</div>
                                @isset($subItem['badge'])
                                    <div class="nav-link-badge">{{ $subItem['badge'] }}</div>
                                @endisset
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- Simple Menu Item -->
                    <a href="{{ route($item['route']) }}"
                       class="nav-link {{ $isActive($item['active_routes']) ? 'active' : '' }}">
                        <div class="nav-link-icon">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <div class="nav-link-text">{{ $item['text'] }}</div>
                        @isset($item['badge'])
                            <div class="nav-link-badge">{{ $item['badge'] }}</div>
                        @endisset
                    </a>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
