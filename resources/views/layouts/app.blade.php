<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Suicide Squad 11.5</title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">

    <link rel="shortcut icon" href="{{ asset('frontend/assets/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('frontend/assets/favicon/site.webmanifest') }}">
    @yield('styles')
</head>
<body class="admin-body">
<div class="admin-layout">
    <div class="admin-overlay" id="adminOverlay"></div>

    <aside class="admin-sidebar" id="adminSidebar">
        <a href="{{ route('admin.dashboard') }}" class="admin-sidebar__brand">
            <img src="{{ asset('images/EMBLEM.PNG') }}" alt="Suicide Squad 11.5">
            <div class="admin-sidebar__brand-text">
                <strong>Suicide Squad 11.5</strong>
                <span>Admin Panel</span>
            </div>
        </a>

        <div class="admin-sidebar__user">
            <div class="admin-sidebar__user-label">Signed in as</div>
            <div class="admin-sidebar__user-name">{{ Auth::user()->name }}</div>
        </div>

        @include('layouts.navigation')

        <div class="admin-sidebar__footer">
            <a href="{{ route('homepage') }}" target="_blank" rel="noopener">
                <i class="bx bx-link-external"></i> View Website
            </a>
        </div>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="admin-topbar__left">
                <button type="button" class="admin-topbar__toggle" id="sidebarToggle" aria-label="Toggle menu">
                    <i class="bx bx-menu"></i>
                </button>
                <div class="admin-topbar__breadcrumb">
                    <strong>@yield('title', 'Dashboard')</strong>
                </div>
            </div>

            <div class="admin-topbar__actions">
                <div class="admin-topbar__user">
                    <button type="button" class="admin-topbar__user-btn" id="userMenuBtn">
                        <span class="admin-topbar__avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        <i class="bx bx-chevron-down"></i>
                    </button>
                    <div class="admin-topbar__dropdown" id="userDropdown">
                        <a href="{{ route('admin.profile.show') }}">
                            <i class="bx bx-user"></i> My Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                <i class="bx bx-log-out"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="admin-content">
            @if ($errors->any())
                <div class="admin-alert admin-alert--danger" role="alert">
                    <i class="bx bx-error-circle"></i>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="admin-alert__close" aria-label="Close">&times;</button>
                </div>
            @endif

            @if (session()->has('message'))
                @php
                    $alertType = match (session('alert-type')) {
                        'success' => 'success',
                        'danger' => 'danger',
                        'warning' => 'warning',
                        default => 'info',
                    };
                @endphp
                <div class="admin-alert admin-alert--{{ $alertType }}" role="alert">
                    <i class="bx bx-check-circle"></i>
                    <span>{{ session('message') }}</span>
                    <button type="button" class="admin-alert__close" aria-label="Close">&times;</button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="admin-footer">
            &copy; {{ date('Y') }} Suicide Squad 11.5 &middot; Eleven Five Roots CMS
        </footer>
    </div>
</div>

<script src="{{ asset('admin/js/admin.js') }}" defer></script>
@yield('scripts')
</body>
</html>
