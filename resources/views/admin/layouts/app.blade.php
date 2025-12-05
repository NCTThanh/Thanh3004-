<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root { --mc-red: #E4002B; --mc-dark: #121212; --mc-light: #f8f8f8; }
        body { font-family: 'Inter', sans-serif; background-color: var(--mc-light); }
        .sidebar { 
            height: 100vh; width: 250px; position: fixed; top: 0; left: 0; 
            background-color: var(--mc-dark); padding-top: 20px; color: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            z-index: 1000;
        }
        .sidebar a { color: #ccc; padding: 12px 15px; display: block; text-decoration: none; transition: 0.3s; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { color: white; background-color: rgba(228, 0, 43, 0.4); border-left: 4px solid var(--mc-red); }
        .sidebar .logo-text { font-size: 1.6rem; font-weight: 900; color: var(--mc-red); margin-bottom: 40px; text-align: center; }
        .content { margin-left: 250px; padding: 20px; }
        .navbar-top { margin-bottom: 20px; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .card-stat { border-left: 5px solid var(--mc-red); }
        .btn-mc { background-color: var(--mc-red); color: white; transition: 0.3s; }
        .btn-mc:hover { background-color: #A0001D; color: white; }
    </style>
</head>
<body>
    
    <div class="sidebar">
        <div class="logo-text">MCLAREN ADMIN</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.cars.index') }}" class="mt-2 {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
            <i class="fas fa-car me-2"></i> Quản lý Xe
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="mt-2 {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            <i class="fas fa-headset me-2"></i> Quản lý Liên hệ
        </a>
        <a href="#" class="mt-2">
            <i class="fas fa-users me-2"></i> Quản lý Users
        </a>
        <a href="{{ route('admin.orders.index') }}" class="mt-2 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
    <i class="fas fa-file-invoice-dollar me-2"></i> Quản lý Đặt cọc
</a>
<a href="{{ route('admin.users.index') }}" class="mt-2 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <i class="fas fa-users-cog me-2"></i> Quản lý Khách hàng
</a>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="mt-5 text-danger">
            <i class="fas fa-sign-out-alt me-2"></i> Đăng Xuất
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
        
    </div>

    <div class="content">
        <nav class="navbar-top navbar navbar-expand-lg">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">@yield('title', 'Admin Dashboard')</span>
                <span class="navbar-text">
                    Xin chào, {{ Auth::user()->name }}
                </span>
            </div>
        </nav>
        
        {{-- Hiển thị thông báo Success/Error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>