<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McLaren Việt Nam - @yield('title', 'Hiệu Suất Đỉnh Cao')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    {{-- Sử dụng Font Awesome 6 cho các icon mới --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    
    @yield('styles')

    {{-- CSS TÙY CHỈNH CHO HEADER --}}
    <style>
        /* Định nghĩa biến cục bộ cho Header */
        .mclaren-header-white {
            background-color: #FFFFFF !important;
            box-shadow: 0 1px 10px rgba(0,0,0,0.05); /* Bóng mờ nhẹ */
            padding: 0.5rem 0;
            position: relative; 
            z-index: 1050; 
            border-bottom: 1px solid #f0f0f0; 
        }
        
        header {
            position: relative;
        }
        
        /* Top Bar Info (GLOBAL & MCLAREN.COM) */
        .top-info-bar {
            background-color: #FFFFFF;
            padding: 5px 0;
            font-size: 0.75rem;
            color: #888888;
            border-bottom: 1px solid #f0f0f0;
            z-index: 1051;
            position: relative;
        }
        
        /* ---------------------------------------------------- */
        /* GLOBAL DROPDOWN STYLES */
        /* ---------------------------------------------------- */
        .global-selector-wrapper {
            position: relative;
            cursor: pointer;
            display: inline-block;
            font-weight: 600;
        }
        
        .global-selector-trigger {
            padding: 0 10px;
            color: #333333;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
        }
        .global-selector-trigger:hover {
             color: #E4002B;
        }

        .global-selector-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 200px;
            background-color: #FFFFFF;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            padding: 10px 0;
            border-radius: 4px;
            border-top: 2px solid #E4002B;
            list-style: none;
            margin: 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 1055;
            text-align: left;
        }

        .global-selector-wrapper:hover .global-selector-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .global-selector-dropdown li a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            color: #333333;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        .global-selector-dropdown li a:hover {
            background-color: #F8F8F8;
            color: #E4002B;
        }

        .global-selector-dropdown .flag-icon {
            width: 18px;
            height: 12px;
            margin-right: 10px;
            object-fit: cover;
            border: 1px solid #ccc;
        }
        
        .global-selector-dropdown .fa-globe {
            font-size: 1.1em;
            margin-right: 10px;
            color: #333333;
        }
        .top-auth-links {
            font-size: 0.75rem;
            font-weight: 600;
        }
        .top-auth-links a {
            color: #888888;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .top-auth-links a:hover {
            color: #E4002B; /* Màu đỏ của thương hiệu */
        }
        .top-auth-links span {
             color: #888888;
        }

        /* Container cho Navbar chính */
        .navbar-main-content {
            position: relative;
        }

        /* ---------------------------------------------------- */
        /* 1. LINKS VÀ HIỆU ỨNG HOVER (GẠCH CHÂN CAM GIẢ) */
        /* ---------------------------------------------------- */
        .mclaren-main-navbar .nav-link {
            color: #333333 !important; 
            font-weight: 500;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin: 0 0.5rem; 
            position: relative;
            padding: 6px 10px 8px !important; 
            transition: color 0.3s ease; 
            border-radius: 0; 
            border: none; 
        }

        /* Gạch chân giả */
        .mclaren-main-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0; /* Ban đầu không hiển thị */
            height: 2px;
            background-color: #E4002B;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        /* Hiệu ứng gạch chân khi hover/active */
        .mclaren-main-navbar .nav-link:hover,
        .mclaren-main-navbar .nav-link.active {
            background-color: transparent; 
            color: #E4002B !important; /* Đổi màu chữ khi hover */
        }
        
        .mclaren-main-navbar .nav-link:hover::after,
        .mclaren-main-navbar .nav-link.active::after {
            width: 80%; /* Chiều rộng gạch chân khi hover */
        }
        
        .mclaren-main-navbar .nav-link i.fa-chevron-down {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.6rem;
            transition: transform 0.3s ease;
        }

        /* ---------------------------------------------------- */
        /* 2. MENU DROPDOWN */
        /* ---------------------------------------------------- */
        .nav-item.dropdown-mega {
            position: relative; 
        }
        .mega-menu {
            position: absolute;
            top: 100%; 
            left: 50%; 
            transform: translateX(-50%) translateY(-5px); 
            width: max-content; 
            min-width: 200px;
            background-color: #FFFFFF;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1040;
            border-radius: 4px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
            pointer-events: none;
            border-top: 2px solid #E4002B; 
        }

        /* Căn chỉnh đặc biệt cho Mega Menu MSO */
        .mso-dropdown {
            left: auto; 
            right: 0; 
            transform: translateY(-5px);
        }

        .dropdown-mega:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0); 
            pointer-events: auto;
        }
        .dropdown-mega:hover .mso-dropdown {
            transform: translateY(0); 
        }
        
        .mega-menu a {
            color: #333333;
            padding: 4px 0;
            display: block;
        }
        .mega-menu a:hover {
            color: #E4002B;
        }
        
        /* Cần đẩy khối menu sang trái để tạo khoảng trống an toàn cho nút Retailer */
        .navbar-nav {
            margin-right: 170px !important; /* Chiều rộng tối đa của Retailer (160px) + khoảng đệm */
        }


        /* ---------------------------------------------------- */
        /* 3. NÚT RETAILER (ICON LUÔN HIỂN THỊ VÀ CĂN GIỮA) */
        /* ---------------------------------------------------- */
        .retailer-wrapper {
            position: absolute;
            top: 50%;
            right: 15px; /* Đẩy sát góc phải của container-xl */
            transform: translateY(-50%);
            height: 40px; 
            z-index: 1052;
            overflow: hidden; 
            width: 40px; /* Chiều rộng ban đầu */
            border-radius: 20px;
            transition: width 0.3s ease; 
        }

        .retailer-wrapper:hover {
            width: 160px; /* Chiều rộng khi hover */
        }

        .btn-retailer-gradient {
            background: linear-gradient(to right, #FF7B00, #E4002B); /* Gradient cam-đỏ */
            color: white !important;
            border: none;
            border-radius: 20px; 
            height: 40px; 
            width: 160px; 
            
            display: flex;
            align-items: center;
            justify-content: center; 
            cursor: pointer;
            
            position: absolute;
            top: 0;
            right: 0; 
            
            transition: all 0.3s ease;
            
            transform: translateX(0); /* KHÔNG DỊCH CHUYỂN NÚT */
            padding: 0; 
        }
        
        .retailer-wrapper:hover .btn-retailer-gradient {
            transform: translateX(0); 
            justify-content: space-between; /* Đẩy chữ và icon ra hai bên */
            padding: 8px 15px; /* Padding mở rộng */
        }
        
        .btn-retailer-gradient .retailer-text {
            opacity: 0;
            font-weight: 600;
            white-space: nowrap;
            font-size: 0.9rem;
            order: 1; /* Chữ nằm bên trái */
            /* Thay đổi: Ẩn chữ bằng opacity, không dùng transform */
            transition: opacity 0.3s ease;
        }

        .retailer-wrapper:hover .btn-retailer-gradient .retailer-text {
            opacity: 1;
            transition: opacity 0.2s ease 0.1s;
        }
        
        /* Icon GPS phải luôn hiển thị và căn giữa tuyệt đối */
        .btn-retailer-gradient i.fa-map-marker-alt {
            font-size: 1rem;
            flex-shrink: 0;
            order: 2; /* Icon nằm bên phải */
            
            /* Sửa lỗi: Căn icon vào giữa vùng 40x40. 
            Icon GPS giờ là một phần tử *tuyệt đối* để luôn nằm giữa 40x40 */
            position: absolute;
            top: 0;
            right: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }

        .retailer-wrapper:hover .btn-retailer-gradient i.fa-map-marker-alt {
             /* Khi mở rộng, icon dịch chuyển về bên phải của nút 160px */
             position: relative;
             width: 24px; 
             transform: translateX(0); 
        }
        
        /* Logo SVG: Sửa lỗi để trông giống hình ảnh */
        .mclaren-icon-logo {
            width: 100px; 
            height: 20px;
            fill: black; 
        }
        .logo-text-red {
            fill: #E4002B; 
        }
        .navbar-brand span {
            display: none; 
        }
    </style>
</head>
<body>
    <header>
        {{-- TOP INFO BAR --}}
<div class="top-info-bar d-none d-lg-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="global-selector-wrapper">
            {{-- Thêm ID cho trigger và text --}}
            <a href="#" class="global-selector-trigger" id="globalSelectorTrigger">
                <i class="fas fa-globe"></i> <span id="selectedRegionText">GLOBAL</span> <i class="fas fa-chevron-down fa-xs ms-1"></i>
            </a>
            
            {{-- GLOBAL DROPDOWN CONTENT --}}
            <ul class="global-selector-dropdown">
                {{-- Thêm class và data-region cho mỗi link --}}
                <li><a href="#" class="region-select-link" data-region="GLOBAL" data-icon="fas fa-globe"><i class="fas fa-globe"></i> GLOBAL</a></li>
                <li><a href="#" class="region-select-link" data-region="UK" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=UK" alt="UK Flag"> UK</a></li>
                <li><a href="#" class="region-select-link" data-region="US" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=US" alt="US Flag"> US</a></li>
                <li><a href="#" class="region-select-link" data-region="AUSTRALIA" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=AU" alt="Australia Flag"> AUSTRALIA</a></li>
                <li><a href="#" class="region-select-link" data-region="GERMAN" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=DE" alt="German Flag"> GERMAN</a></li>
                <li><a href="#" class="region-select-link" data-region="SPANISH" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=ES" alt="Spanish Flag"> SPANISH</a></li>
                <li><a href="#" class="region-select-link" data-region="FRENCH" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=FR" alt="French Flag"> FRENCH</a></li>
                <li><a href="#" class="region-select-link" data-region="ITALIAN" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=IT" alt="Italian Flag"> ITALIAN</a></li>
                <li><a href="#" class="region-select-link" data-region="PORTUGUESE" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=PT" alt="Portuguese Flag"> PORTUGUESE</a></li>
                <li><a href="#" class="region-select-link" data-region="CHINESE" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=CN" alt="Chinese Flag"> CHINESE</a></li>
                <li><a href="#" class="region-select-link" data-region="JAPANESE" data-icon=""><img class="flag-icon" src="https://placehold.co/18x12/1C1C1C/ffffff?text=JP" alt="Japanese Flag"> JAPANESE</a></li>
            </ul>
        </div>
       <div class="top-auth-links">
            {{-- Sử dụng Blade directives để kiểm tra người dùng đã đăng nhập chưa --}}
            @guest
                {{-- Nếu là khách (chưa đăng nhập) --}}
                <a href="{{ route('login') }}">ĐĂNG NHẬP</a>
                <span class="mx-1">/</span>
                <a href="{{ route('register') }}">ĐĂNG KÝ</a>
            @else
                {{-- Nếu đã đăng nhập --}}
                
                {{-- Tùy chọn: Thêm link tới trang Admin nếu là Admin --}}
                {{-- @if(Auth::user()->is_admin) --}}
                {{--      <a href="{{ route('admin.dashboard') }}">ADMIN PANEL</a> --}}
                {{--      <span class="mx-1">/</span> --}}
                {{-- @endif --}}
                
                {{-- SỬA LỖI: Dùng toán tử an toàn Null (?->) cho tên --}}
                <span class="me-2">Chào, {{ Auth::user()?->name }}</span>
                <span class="mx-1">/</span>
                
                {{-- Nút Đăng xuất cần một form --}}
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ĐĂNG XUẤT
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</div>

        {{-- MAIN NAVIGATION BAR --}}
        <nav class="navbar navbar-expand-lg navbar-light fixed-top mclaren-header-white mclaren-main-navbar"> 
            <div class="container-fluid container-xl navbar-main-content"> 
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    {{-- Logo Text/Icon Mclaren đơn giản --}}
                    <svg class="mclaren-icon-logo" viewBox="0 0 100 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.83 20H0L9.83 0H21.66L11.83 20Z" fill="black"/>
                        <path d="M25.83 20H14L23.83 0H35.66L25.83 20Z" fill="black"/>
                        <path d="M39.83 20H28L37.83 0H49.66L39.83 20Z" fill="black"/>
                        <path d="M53.83 20H42L51.83 0H63.66L53.83 20Z" fill="black"/>
                        <path d="M67.83 20H56L65.83 0H77.66L67.83 20Z" fill="black"/>
                        <path d="M82.83 20H71L80.83 0H92.66L82.83 20Z" class="logo-text-red"/> 
                    </svg>
                    <span>MCLAREN</span>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
                        
                        {{-- 1. Trang chủ (Home) --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">TRANG CHỦ</a>
                        </li>
                        
                        {{-- 2. MODELS (Linked to Cars Page) --}}
                       <li class="nav-item dropdown-mega">
    {{-- LOẠI BỎ: dropdown-toggle, id, role, data-bs-toggle, aria-expanded --}}
    <a class="nav-link" href="#">
        MODELS <i class="fas fa-chevron-down"></i>
    </a>
    {{-- Xóa lớp 'dropdown-menu' để chỉ dùng CSS tùy chỉnh --}}
    <div class="mega-menu" aria-labelledby="modelsDropdown"> 
        <div class="p-3">
            <h6 class="fw-bold mb-3" style="color: #E4002B;">MẪU XE</h6>
            <ul class="list-unstyled">
                <li><a href="{{ route('cars') }}" class="text-dark">XEM TẤT CẢ MẪU XE</a></li> 
                <li><a href="{{ route('technology') }}" class="text-dark">CÔNG NGHỆ</a></li>
            </ul>
        </div>
    </div>
</li>
                        
                    
                        {{-- 4. Các mục menu khác --}}
                        <li class="nav-item"><a class="nav-link" href="#">OWNERSHIP <i class="fas fa-chevron-down"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="#">EXPERIENCES <i class="fas fa-chevron-down"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="#">THÔNG TIN <i class="fas fa-chevron-down"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="#">TÌM KIẾM <i class="fas fa-chevron-down"></i></a></li>
                        
                        {{-- 5. Liên hệ (Contact) --}}
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">LIÊN HỆ</a>
                        </li>
                    </ul>

                </div>
                
                {{-- Nút Retailer (Icon to Text on Hover - KHÔNG XÊ DỊCH CÁC NÚT KHÁC) --}}
                <div class="retailer-wrapper">
                    <a class="btn-retailer-gradient" href="{{ route('retailers') }}" title="Tìm Nhà Bán Lẻ">
                        <span class="retailer-text">TÌM NHÀ BÁN LẺ</span>
                        {{-- Thêm icon GPS (absolute) để nó luôn nằm giữa 40x40 --}}
                        <i class="fas fa-map-marker-alt retailer-icon-compact"></i> 
                        <i class="fas fa-map-marker-alt retailer-icon-expanded"></i>
                    </a>
                </div>
            </div>
        </nav>
        
    </header>
    
    {{-- Giảm padding-top vì navbar hiện tại mỏng hơn --}}
    <div class="main-container" style="padding-top: 0%;"> 
        <main>
            @yield('content')
        </main>
    </div>
    

    <footer class="site-footer">
        <div class="container footer-container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 footer-column">
                    <h3>VỀ MCLAREN</h3>
                    <ul>
                        <li><a href="#">Lịch sử & Di sản</a></li>
                        <li><a href="#">Công nghệ & Kỹ thuật</a></li>
                        <li><a href="#">Tin tức mới nhất</a></li>
                        <li><a href="#">Nhà máy</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-column">
                    <h3>KHÁM PHÁ CÁC MẪU XE</h3>
                    <ul>
                        {{-- Để lại query series nếu bạn muốn dùng JS để lọc --}}
                        <li><a href="{{ route('cars') }}?series=super">Supercars</a></li>
                        <li><a href="{{ route('cars') }}?series=ultimate">Ultimate Series</a></li>
                        <li><a href="#">Xe đã qua sử dụng chính hãng</a></li>
                        <li><a href="#">Tùy chỉnh cá nhân (MSO)</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-column">
                    <h3>LIÊN HỆ VÀ HỖ TRỢ</h3>
                    <ul>
                        <li><a href="{{ route('contact') }}">Gửi yêu cầu liên hệ</a></li>
                        <li><a href="{{ route('retailers') }}">Tìm nhà bán lẻ chính thức</a></li>
                        <li><a href="#">Dịch vụ sau bán hàng</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-column">
                    <h3>THEO DÕI CHÚNG TÔI</h3>
                    <ul class="social-icons-list">
                        <li><a href="https://www.facebook.com/McLarenRacing" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/mclaren/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.youtube.com/user/McLarenAutomotive" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="https://x.com/McLarenIOW" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom-bar">
            <div class="container">
                <div class="footer-bottom-links">
                    <ul>
                        <li><a href="#">CHÍNH SÁCH BẢO MẬT</a></li>
                        <li><a href="#">ĐIỀU KHOẢN & ĐIỀU KIỆN</a></li>
                        <li><a href="#">CHÍNH SÁCH COOKIE</a></li>
                        <li><a href="#">TUYÊN BỐ CHỐNG CHẾ ĐỘ NÔ LỆ</a></li>
                    </ul>
                </div>
                <p>© {{ date('Y') }} McLaren Automotive Limited. Đã đăng ký Bản quyền. Tất cả các quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    {{-- SCRIPT CHỨC NĂNG GLOBAL SELECTOR MỚI --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedRegionText = document.getElementById('selectedRegionText');
        const regionLinks = document.querySelectorAll('.region-select-link');
        const globeIcon = document.querySelector('#globalSelectorTrigger .fa-globe');

        // --- Hàm 1: Tải khu vực đã chọn khi trang tải lại ---
        function loadSavedRegion() {
            const savedRegion = localStorage.getItem('selectedRegion');
            
            // Nếu có khu vực đã lưu, cập nhật text
            if (savedRegion && selectedRegionText) {
                selectedRegionText.textContent = savedRegion;
            }
            
            // Nếu khu vực không phải GLOBAL, ẩn biểu tượng quả địa cầu
            if (savedRegion !== 'GLOBAL' && globeIcon) {
                 // Giữ lại logic này nếu bạn muốn ẩn biểu tượng khi chọn quốc gia
                // globeIcon.style.display = 'none'; 
            }
        }

        // --- Hàm 2: Xử lý sự kiện khi chọn khu vực mới ---
        if (regionLinks.length > 0) {
            regionLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const newRegion = this.getAttribute('data-region');
                    
                    if (newRegion && selectedRegionText) {
                        // 1. Cập nhật văn bản hiển thị
                        selectedRegionText.textContent = newRegion;
                        
                        // 2. Lưu lựa chọn vào Local Storage
                        localStorage.setItem('selectedRegion', newRegion);
                        
                        // Tùy chọn: Xử lý icon
                        // if (globeIcon) {
                        //      globeIcon.style.display = (newRegion === 'GLOBAL' || newRegion === 'VIETNAM') ? 'inline-block' : 'none';
                        // }
                        
                        // Tùy chọn: Chuyển hướng nếu cần (ví dụ: window.location.href = this.href;)
                    }
                });
            });
        }
        
        // Gọi hàm tải khu vực khi DOM đã sẵn sàng
        loadSavedRegion();
    });
</script>
    @yield('scripts')
</body>
</html>