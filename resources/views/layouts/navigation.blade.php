<!-- Sidebar -->
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('admin.profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>{{ __('Users') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.contact_messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact_messages.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>{{ __('Messages') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Events</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>Shop Products</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.gallery_items.index') }}" class="nav-link {{ request()->routeIs('admin.gallery_items.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-images"></i>
                    <p>{{ __('Gallery') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>{{ __('Pages') }}</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        Blog
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.blogs.*') ? 'block' : 'none' }};">
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blog Posts</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
