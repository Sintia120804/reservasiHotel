<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Hotel Sintia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f6f7fb;
        }
        .admin-sidebar {
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #eee;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 240px;
            z-index: 100;
        }
        .admin-sidebar .logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4f46e5;
            letter-spacing: 1px;
            padding: 32px 0 16px 0;
            text-align: center;
        }
        .admin-sidebar .avatar {
            text-align: center;
            margin-bottom: 16px;
        }
        .admin-sidebar .avatar img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e0e7ff;
        }
        .admin-sidebar .avatar .name {
            font-weight: 600;
            margin-top: 8px;
        }
        .admin-sidebar .avatar .email {
            font-size: 0.9rem;
            color: #888;
        }
        .admin-sidebar .nav-link {
            color: #444;
            font-weight: 500;
            padding: 12px 24px;
            border-radius: 8px 0 0 8px;
            margin-bottom: 4px;
            transition: background 0.2s, color 0.2s;
        }
        .admin-sidebar .nav-link.active, .admin-sidebar .nav-link:hover {
            background: #e0e7ff;
            color: #4f46e5;
        }
        .admin-main {
            margin-left: 240px;
            min-height: 100vh;
            padding: 0;
        }
        .admin-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-header .search-box {
            width: 300px;
        }
        .admin-header .date {
            color: #888;
            font-size: 0.95rem;
        }
        @media (max-width: 991px) {
            .admin-sidebar { width: 100px; }
            .admin-main { margin-left: 100px; }
            .admin-sidebar .logo, .admin-sidebar .avatar .name, .admin-sidebar .avatar .email { display: none; }
            .admin-sidebar .avatar img { width: 40px; height: 40px; }
            .admin-sidebar .nav-link { padding: 12px 10px; font-size: 1.2rem; text-align: center; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-sidebar d-flex flex-column">
        <div class="logo">
            <i class="fas fa-hotel me-2"></i>Hotel Sintia
        </div>
        <div class="avatar mb-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4f46e5&color=fff" alt="Avatar">
            <div class="name">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
        </div>
        <nav class="nav flex-column px-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
                <i class="fas fa-chart-line me-2"></i> <span class="d-none d-lg-inline">Dashboard</span>
            </a>
            <a href="{{ route('admin.room-types') }}" class="nav-link{{ request()->routeIs('admin.room-types') ? ' active' : '' }}">
                <i class="fas fa-layer-group me-2"></i> <span class="d-none d-lg-inline">Kategori Kamar</span>
            </a>
            <a href="{{ route('admin.rooms') }}" class="nav-link{{ request()->routeIs('admin.rooms') ? ' active' : '' }}">
                <i class="fas fa-bed me-2"></i> <span class="d-none d-lg-inline">Kamar</span>
            </a>
            <a href="{{ route('admin.facilities') }}" class="nav-link{{ request()->routeIs('admin.facilities') ? ' active' : '' }}">
                <i class="fas fa-star me-2"></i> <span class="d-none d-lg-inline">Fasilitas</span>
            </a>
            <a href="{{ route('admin.reservations') }}" class="nav-link{{ request()->routeIs('admin.reservations') ? ' active' : '' }}">
                <i class="fas fa-calendar-alt me-2"></i> <span class="d-none d-lg-inline">Reservasi</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="nav-link text-danger w-100 text-start"><i class="fas fa-sign-out-alt me-2"></i> <span class="d-none d-lg-inline">Logout</span></button>
            </form>
        </nav>
    </div>
    <div class="admin-main">
        <div class="admin-header">
            <div class="fw-bold fs-4">@yield('header', 'Dashboard')</div>
            <div class="d-flex align-items-center gap-3">
                <form class="search-box d-none d-md-block">
                    <input type="text" class="form-control" placeholder="Search here...">
                </form>
                <div class="date">
                    <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('d-m-Y') }}
                </div>
            </div>
        </div>
        <main class="p-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 