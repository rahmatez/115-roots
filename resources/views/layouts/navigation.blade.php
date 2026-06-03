<nav class="admin-nav">
    <div class="admin-nav__section">Main</div>
    <ul class="admin-nav__list">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="admin-nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bx bx-grid-alt"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.contact_messages.index') }}" class="admin-nav__link {{ request()->routeIs('admin.contact_messages.*') ? 'active' : '' }}">
                <i class="bx bx-envelope"></i>
                Messages
                @if(($newMessageCount ?? 0) > 0)
                    <span class="badge badge-warning" style="margin-left:auto;font-size:0.6875rem;">{{ $newMessageCount }}</span>
                @endif
            </a>
        </li>
    </ul>

    <div class="admin-nav__section">Content</div>
    <ul class="admin-nav__list">
        <li>
            <a href="{{ route('admin.blogs.index') }}" class="admin-nav__link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bx bx-book-content"></i>
                Blog Posts
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="admin-nav__link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bx bx-purchase-tag"></i>
                Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.events.index') }}" class="admin-nav__link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                <i class="bx bx-calendar-event"></i>
                Events
            </a>
        </li>
        <li>
            <a href="{{ route('admin.gallery_items.index') }}" class="admin-nav__link {{ request()->routeIs('admin.gallery_items.*') ? 'active' : '' }}">
                <i class="bx bx-images"></i>
                Event Photos
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}" class="admin-nav__link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bx bx-store"></i>
                Shop Products
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}" class="admin-nav__link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bx bx-cart"></i>
                Orders
            </a>
        </li>
        <li>
            <a href="{{ route('admin.pages.index') }}" class="admin-nav__link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="bx bx-file"></i>
                Pages
            </a>
        </li>
    </ul>

    <div class="admin-nav__section">Settings</div>
    <ul class="admin-nav__list">
        <li>
            <a href="{{ route('admin.users.index') }}" class="admin-nav__link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bx bx-user"></i>
                Users
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile.show') }}" class="admin-nav__link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="bx bx-cog"></i>
                My Profile
            </a>
        </li>
    </ul>
</nav>
