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

       
        .mclaren-main-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0; 
            height: 2px;
            background-color: #E4002B;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        
        /* Hiệu ứng gạch chân khi hover/active */
        .mclaren-main-navbar .nav-link:hover,
        .mclaren-main-navbar .nav-link.active {
            background-color: transparent; 
            color: #E4002B !important; 
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
        
      
        .navbar-nav {
            margin-right: 170px !important; 
        }


        /* ---------------------------------------------------- */
        /* 3. NÚT RETAILER (ICON LUÔN HIỂN THỊ VÀ CĂN GIỮA) */
        /* ---------------------------------------------------- */
        .retailer-wrapper {
            position: absolute;
            top: 50%;
            right: 15px; 
            transform: translateY(-50%);
            height: 40px; 
            z-index: 1052;
            overflow: hidden; 
            width: 40px; 
            border-radius: 20px;
            transition: width 0.3s ease; 
        }

        .retailer-wrapper:hover {
            width: 160px; 
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
            
            transform: translateX(0); 
            padding: 0; 
        }
        
        .retailer-wrapper:hover .btn-retailer-gradient {
            transform: translateX(0); 
            justify-content: space-between; 
            padding: 8px 15px;
        }
        
        .btn-retailer-gradient .retailer-text {
            opacity: 0;
            font-weight: 600;
            white-space: nowrap;
            font-size: 0.9rem;
            order: 1;
            transition: opacity 0.3s ease;
        }

        .retailer-wrapper:hover .btn-retailer-gradient .retailer-text {
            opacity: 1;
            transition: opacity 0.2s ease 0.1s;
        }
        
       
        .btn-retailer-gradient i.fa-map-marker-alt {
            font-size: 1rem;
            flex-shrink: 0;
            order: 2;
            
            
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
            
             position: relative;
             width: 24px; 
             transform: translateX(0); 
        }
        
        
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
        /* --- SEARCH OVERLAY (GLOBAL) --- */
    .search-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.98); z-index: 9999;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        opacity: 0; visibility: hidden; transition: all 0.5s ease; backdrop-filter: blur(15px);
    }
    .search-overlay.active { opacity: 1; visibility: visible; }
    
    .search-input {
        background: transparent; border: none; border-bottom: 1px solid #444;
        color: #fff; font-size: 2rem; text-align: center; padding: 20px; width: 80%; max-width: 900px;
        text-transform: uppercase; font-weight: 300; letter-spacing: 2px; outline: none;
        transition: border-color 0.3s;
    }
    .search-input:focus { border-color: #FF7E00; } /* Đã thay var(--mclaren-orange) bằng mã màu trực tiếp hoặc bạn phải khai báo :root */
    
    .search-results { margin-top: 40px; max-height: 50vh; overflow-y: auto; width: 100%; max-width: 900px; }
    .search-result-item {
        display: flex; justify-content: space-between; padding: 20px; 
        border-bottom: 1px solid #222; color: #999; text-decoration: none; transition: 0.3s;
        font-size: 1.1rem; text-transform: uppercase; letter-spacing: 1px;
    }
    .search-result-item:hover { color: #fff; padding-left: 30px; background: linear-gradient(90deg, #FF7E00, transparent); }

    .close-search {
        position: absolute; top: 40px; right: 40px; color: #fff; font-size: 2rem; cursor: pointer; transition: 0.3s;
    }
    .close-search:hover { color: #FF7E00; transform: rotate(90deg); }
    </style>
    @stack('styles')
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
            
            @guest
                {{-- Nếu là khách (chưa đăng nhập) --}}
                <a href="{{ route('login') }}">ĐĂNG NHẬP</a>
                <span class="mx-1">/</span>
                <a href="{{ route('register') }}">ĐĂNG KÝ</a>
            @else
                
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
    
    <a class="nav-link" href="#">
        MODELS <i class="fas fa-chevron-down"></i>
    </a>
    
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('heritage') }}">Heritage <i class="fas fa-chevron-down"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('experience') }}">EXPERIENCES <i class="fas fa-chevron-down"></i></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('mso') }}">MSO <i class="fas fa-chevron-down"></i></a></li>
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
                        
                        <i class="fas fa-map-marker-alt retailer-icon-compact"></i> 
                        <i class="fas fa-map-marker-alt retailer-icon-expanded"></i>
                    </a>
                </div>
            </div>
        </nav>
        
    </header>
    
    
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
    <div id="fullscreen-search" class="search-overlay">
    <div class="close-search" id="close-search-btn">&times;</div>
    <h3 style="color: #fff; letter-spacing: 4px; font-size: 0.9rem; margin-bottom: 30px; opacity: 0.7;">TÌM KIẾM BỘ SƯU TẬP</h3>
    <input type="text" id="search-input-field" class="search-input" placeholder="Nhập tên dòng xe (VD: 750S, P1)...">
    <div id="search-results-container" class="search-results"></div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/slideshow.js') }}"></script>
    {{-- SCRIPT CHỨC NĂNG GLOBAL SELECTOR MỚI --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedRegionText = document.getElementById('selectedRegionText');
        const regionLinks = document.querySelectorAll('.region-select-link');
        const globeIcon = document.querySelector('#globalSelectorTrigger .fa-globe');

        
        function loadSavedRegion() {
            const savedRegion = localStorage.getItem('selectedRegion');
            
          
            if (savedRegion && selectedRegionText) {
                selectedRegionText.textContent = savedRegion;
            }
            
            if (savedRegion !== 'GLOBAL' && globeIcon) {
                 
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
                        
                      
                    }
                });
            });
        }
        
        // Gọi hàm tải khu vực khi DOM đã sẵn sàng
        loadSavedRegion();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // --- LOGIC TÌM KIẾM GLOBAL ---
        const overlay = document.getElementById('fullscreen-search');
        const input = document.getElementById('search-input-field');
        const results = document.getElementById('search-results-container');
        const closeBtn = document.getElementById('close-search-btn');

        // LẤY DỮ LIỆU TỪ LARAVEL (AppServiceProvider)
        // Biến $globalSearchCars đã được share toàn cục
        const carList = @json($globalSearchCars ?? []); 

        // Các event listener giữ nguyên
        document.querySelectorAll('.nav-link').forEach(l => {
            if(l.innerText.includes('TÌM KIẾM')) {
                l.addEventListener('click', (e) => { 
                    e.preventDefault(); 
                    overlay.classList.add('active'); 
                    setTimeout(()=>input.focus(), 300); 
                });
            }
        });

        if(closeBtn) closeBtn.onclick = () => overlay.classList.remove('active');

        input.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            results.innerHTML = '';
            if(!val) return;
            
            const filtered = carList.filter(c => c.name.toLowerCase().includes(val));
            
            if(filtered.length) {
                filtered.forEach(c => {
                    // Tạo URL động
                    let url = "{{ route('car.details', ':key') }}";
                    url = url.replace(':key', c.model_key);
                    
                    results.innerHTML += `
                        <a href="${url}" class="search-result-item">
                            <span>${c.name}</span> <i class="fas fa-chevron-right"></i>
                        </a>`;
                });
            } else {
                results.innerHTML = '<div style="padding:20px; text-align:center; color:#555;">Không tìm thấy kết quả</div>';
            }
        });
    });
</script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            // --- LOGIC TÌM KIẾM GLOBAL ---
            const overlay = document.getElementById('fullscreen-search');
            const input = document.getElementById('search-input-field');
            const results = document.getElementById('search-results-container');
            const closeBtn = document.getElementById('close-search-btn');

            // LẤY DỮ LIỆU TỪ LARAVEL
            const carList = @json($globalSearchCars ?? []); 

            // Mở tìm kiếm
            document.querySelectorAll('.nav-link').forEach(l => {
                if(l.innerText.includes('TÌM KIẾM')) {
                    l.addEventListener('click', (e) => { 
                        e.preventDefault(); 
                        overlay.classList.add('active'); 
                        setTimeout(()=>input.focus(), 300); 
                    });
                }
            });

            // Đóng tìm kiếm
            if(closeBtn) closeBtn.onclick = () => overlay.classList.remove('active');

            // Xử lý nhập liệu
            input.addEventListener('input', (e) => {
                const val = e.target.value.toLowerCase();
                results.innerHTML = ''; // Xóa kết quả cũ
                
                if(!val) {
                    return; 
                }

                // 1. Lọc danh sách xe theo tên
                const filtered = carList.filter(c => c.name.toLowerCase().includes(val));

                if(filtered.length > 0) {
                    // 2. GOM NHÓM (GROUP BY SERIES)
                    // Kết quả sẽ dạng: { "Supercars": [xe1, xe2], "Ultimate": [xe3] }
                    const groups = filtered.reduce((acc, car) => {
                        const series = car.series || 'Khác'; // Nếu không có series thì đưa vào 'Khác'
                        if (!acc[series]) {
                            acc[series] = [];
                        }
                        acc[series].push(car);
                        return acc;
                    }, {});

                    // 3. HIỂN THỊ RA MÀN HÌNH
                    // Duyệt qua từng nhóm (Series)
                    for (const [seriesName, carsInGroup] of Object.entries(groups)) {
                        
                        // A. Tạo tiêu đề nhóm (Ví dụ: SUPERCARS)
                        const groupHeader = document.createElement('div');
                        groupHeader.style.cssText = 'color: #FF7E00; font-size: 0.85rem; font-weight: bold; padding: 15px 20px 5px; text-transform: uppercase; letter-spacing: 2px; border-bottom: 1px solid #333; margin-top: 10px;';
                        groupHeader.textContent = seriesName;
                        results.appendChild(groupHeader);

                        // B. Tạo danh sách xe trong nhóm đó
                        carsInGroup.forEach(c => {
                            // Tạo URL động
                            let url = "{{ route('car.details', ':key') }}";
                            url = url.replace(':key', c.model_key);
                            
                            // Tạo thẻ a
                            const itemLink = document.createElement('a');
                            itemLink.href = url;
                            itemLink.className = 'search-result-item';
                            // CSS inline đè lên class cũ để đẹp hơn
                            itemLink.style.cssText = 'display: flex; justify-content: space-between; padding: 15px 20px 15px 40px; border-bottom: 1px solid #222; color: #ccc; text-decoration: none; transition: 0.3s; font-size: 1.1rem; text-transform: uppercase;';
                            
                            itemLink.innerHTML = `<span>${c.name}</span> <i class="fas fa-chevron-right" style="font-size: 0.8rem;"></i>`;
                            
                            // Hiệu ứng hover thủ công
                            itemLink.onmouseover = function() { 
                                this.style.color = '#fff'; 
                                this.style.background = 'linear-gradient(90deg, rgba(255, 126, 0, 0.1), transparent)';
                                this.style.paddingLeft = '50px';
                            };
                            itemLink.onmouseout = function() { 
                                this.style.color = '#ccc'; 
                                this.style.background = 'transparent';
                                this.style.paddingLeft = '40px';
                            };

                            results.appendChild(itemLink);
                        });
                    }

                } else {
                    results.innerHTML = '<div style="padding:20px; text-align:center; color:#555;">Không tìm thấy kết quả phù hợp</div>';
                }
            });
        });
    </script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>