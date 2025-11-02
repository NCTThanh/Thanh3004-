@extends('layouts.app')

@section('title', 'Trang Chủ Chính Thức - McLaren')

@push('styles')
<style>
    /* (SỬA LỖI) Kéo section lên đụng header */
    .main-container {
        padding-top: 0 !important;
    }

    /* (SỬA LỖI) Thêm khoảng cách cho section đầu tiên sau hero */
    .featured-models-section {
        /* Bạn có thể thay đổi giá trị này */
        padding-top: 150px !important; 
    }

    /* Biến màu (giữ nguyên từ style.css) */
    :root {
        --color-mclaren-orange: #FF7E00;
        --color-background: #0A0A0A;
        --color-surface: #1C1C1C;
        --color-border: #333333;
        --color-text-primary: #FFFFFF;
        --color-text-secondary: #AAAAAA;
    }

    /* ============================================= */
    /* 1. CSS HERO VIDEO/IMAGE (ĐÃ SỬA LỖI FULL-SCREEN) */
    /* ============================================= */
   /* Hero Section */
.hero-section {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

/* Nền ảnh/video */
.hero-section img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Lớp phủ tối */
.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1;
}

/* Chữ đè lên ảnh */
.hero-content {
    position: absolute;
    bottom: 8%;
    left: 5%;
    color: #fff;
    z-index: 2; /* cao nhất */
    max-width: 600px;
    text-shadow: 0 4px 10px rgba(0,0,0,0.8);
}

.hero-content h1 {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.hero-content a {
    display: inline-block;
    background: #ff7f00;
    color: #fff;
    padding: 10px 24px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
}

.hero-content a:hover {
    background: #ff9933;
}

    /* ============================================= */
    /* 2. KHU VỰC 3D SHOWCASE */
    /* ============================================= */
    .interactive-3d-showcase {
        padding: 120px 0; /* Giữ padding chuẩn */
        background-color: #000000;
        position: relative;
    }
    .showcase-title-container {
        text-align: center;
        margin-bottom: 80px;
    }
    .showcase-title-container .tagline {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--color-mclaren-orange);
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    .showcase-title-container h2 {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        color: var(--color-text-primary);
        line-height: 1.1;
        margin-top: 1rem;
    }
    .model-viewer-wrapper {
        height: 70vh;
        min-height: 500px;
        border-radius: 12px;
        position: relative;
    }
    model-viewer {
        width: 100%;
        height: 100%;
        --progress-bar-color: var(--color-mclaren-orange);
        --poster-color: transparent;
        background-color: #000;
        border-radius: 12px;
    }
    
    .feature-column {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }
    .feature-item {
        margin-bottom: 3rem;
        padding: 1.5rem;
        border-radius: 8px;
        background-color: rgba(28, 28, 28, 0.5);
        border: 1px solid var(--color-border);
    }
    .feature-item .icon {
        font-size: 2rem;
        color: var(--color-mclaren-orange);
        margin-bottom: 1rem;
    }
    .feature-item h4 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--color-text-primary);
        margin-bottom: 0.5rem;
    }
    .feature-item p {
        color: var(--color-text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .feature-item.align-right {
        text-align: right;
    }
    .feature-column.right-col {
        align-items: flex-end;
    }
    .showcase-cta {
        text-align: center;
        margin-top: 80px;
    }
    .btn-link-arrow {
        color: var(--color-mclaren-orange);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        font-size: 1.2rem;
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .btn-link-arrow:hover {
        color: #ff9f33;
        transform: translateX(5px);
    }
    .btn-link-arrow i {
        margin-left: 8px;
    }

    /* ============================================= */
    /* 3. CSS DÒNG XE NỔI BẬT (Card) */
    /* ============================================= */
    .section-padding {
        /* Đây là class chuẩn cho các section */
        padding: 120px 0;
    }
    .featured-models-section {
        background-color: var(--color-background);
    }
    .mclaren-card {
        background-color: var(--color-surface);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .mclaren-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0, 0.5);
        border-color: var(--color-mclaren-orange); /* Thêm hiệu ứng viền cam */
    }
    .mclaren-card .card-img-top {
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .mclaren-card:hover .card-img-top {
        transform: scale(1.05);
    }
    .mclaren-card .card-body {
        padding: 1.5rem;
    }
    .mclaren-card .card-title {
        color: var(--color-mclaren-orange);
        font-size: 1.5rem;
        font-weight: 800;
    }
    .mclaren-card .card-text {
        color: var(--color-text-secondary);
    }
    
    /* Chung: Tiêu đề section */
    .section-title-container {
        text-align: center;
        margin-bottom: 80px;
    }
    .section-title-container h2 {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        color: var(--color-text-primary);
        line-height: 1.1;
    }
    .section-title-container .lead {
        font-size: 1.2rem;
        color: var(--color-text-secondary);
        max-width: 700px;
        margin: 1rem auto 0;
    }

    /* ============================================= */
    /* 4. CSS RACING DNA (Di sản) */
    /* ============================================= */
    .racing-dna-section {
        background-color: #0f0f0f;
    }
    .racing-dna-section .content-box {
        background-color: var(--color-surface);
        padding: clamp(2rem, 5vw, 4rem); /* Responsive padding */
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .racing-dna-section img {
        border-radius: 12px;
        object-fit: cover;
        height: 100%;
        max-height: 500px; /* Giới hạn chiều cao ảnh */
        width: 100%;
    }
    
    /* ============================================= */
    /* 5. CSS MSO (Độc bản - Parallax) */
    /* ============================================= */
    .mso-section {
        /* Hiệu ứng Parallax */
        background-image: url("{{ asset('images/mso-hero.jpg') }}");
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    .mso-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7); /* Lớp phủ tối */
    }
    .mso-section .container {
        position: relative;
        z-index: 2;
    }
    .mso-section .lead {
        font-size: 1.25rem;
        max-width: 800px;
    }
    
    /* ============================================= */
    /* 6. CSS DỊCH VỤ */
    /* ============================================= */
    .service-section {
        background-color: var(--color-background);
    }
    .service-card {
        background-color: var(--color-surface);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 2.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        height: 100%;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border-color: var(--color-mclaren-orange);
    }
    .service-card .icon {
        font-size: 2.5rem;
        color: var(--color-mclaren-orange);
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@section('content')

    <section class="hero-video-section" aria-label="Hero section">
    <img id="hero-video" src="{{ asset('images/750s.webp') }}" alt="McLaren 750S background">

    <div class="hero-overlay" aria-hidden="true"></div>

    <div class="hero-content reveal" role="region" aria-label="Hero content">
        <span class="tagline">Benchmark Supercar</span>
        <h1>McLaren 750S</h1>
        <p class="d-none d-md-block">Định nghĩa mới về hiệu suất thuần khiết và trải nghiệm lái xe không đối thủ. Đây là chuẩn mực mới.</p>
        {{-- SỬA LỖI: Dùng 'car' thay vì 'model' --}}
        <a href="{{ route('car.details', ['car' => '750s']) }}" class="btn btn-mclaren btn-lg mt-3" aria-label="Khám Phá 750S">Khám Phá 750S</a>
    </div>
</section>


    <section class="featured-models-section section-padding">
        <div class="container py-lg-5">
            <div class="section-title-container reveal">
                <h2>Khám Phá Các Dòng Xe</h2>
                <p class="lead">Từ đường đua đến đường phố, mỗi chiếc xe đều mang trong mình DNA của hiệu suất thuần khiết.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="mclaren-card h-100">
                        <img src="{{ asset('images/750s.webp') }}" class="card-img-top" alt="McLaren 750S">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">McLaren 750S</h5>
                            <p class="card-text flex-grow-1">Sự tiến hóa của một huyền thoại. Nhẹ nhất, mạnh nhất trong series.</p>
                            {{-- SỬA LỖI: Dùng 'car' thay vì 'model' --}}
                            <a href="{{ route('car.details', ['car' => '750s']) }}" class="btn btn-mclaren-outline mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="mclaren-card h-100">
                        <img src="{{ asset('images/artura-2.jpg') }}" class="card-img-top" alt="McLaren Artura">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">McLaren Artura</h5>
                            <p class="card-text flex-grow-1">Cách mạng hybrid. Hiệu suất điện khí hóa thế hệ mới.</p>
                            {{-- SỬA LỖI: Dùng 'car' thay vì 'model' --}}
                            <a href="{{ route('car.details', ['car' => 'artura']) }}" class="btn btn-mclaren-outline mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="mclaren-card h-100">
                        <img src="{{ asset('images/gt-1.jpg') }}" class="card-img-top" alt="McLaren GTS">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">McLaren GTS</h5>
                            <p class="card-text flex-grow-1">Sang trọng, linh hoạt. Một con quái thú trong làng siêu xe.</p>
                            {{-- SỬA LỖI: Dùng 'car' thay vì 'model'. *Lưu ý: GTS không có trong data mẫu, dùng gt nếu cần* --}}
                            <a href="{{ route('car.details', ['car' => 'gt']) }}" class="btn btn-mclaren-outline mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 reveal">
                <a href="{{ route('cars') }}" class="btn btn-mclaren btn-lg">Xem Tất Cả Dòng Xe</a>
            </div>
        </div>
    </section>

    <section class="interactive-3d-showcase">
        <div class="container-fluid px-lg-5"> <div class="showcase-title-container reveal">
                <span class="tagline">Di Sản Longtail</span>
                <h2>Khám Phá Từ Mọi Góc Độ</h2>
            </div>

            <div class="row align-items-center">
                
                <div class="col-lg-3 feature-column reveal">
                    <div class="feature-item">
                        <div class="icon"><i class="fas fa-feather-alt"></i></div>
                        <h4>Trọng Lượng Siêu Nhẹ</h4>
                        <p>Với 1,247kg, 600LT là đỉnh cao của triết lý tối ưu hóa trọng lượng, sử dụng rộng rãi sợi carbon.</p>
                    </div>
                    <div class="feature-item">
                        <div class="icon"><i class="fas fa-wind"></i></div>
                        <h4>Khí Động Học Longtail</h4>
                        <p>Cánh gió sau cố định và bộ khuếch tán lớn tạo ra 100kg lực ép ở 250km/h.</p>
                    </div>
                </div>

                <div class="col-lg-6 reveal">
                    <div class="model-viewer-wrapper">
                        <model-viewer 
                            src="{{ asset('models/2019_mclaren_600lt.glb') }}" 
                            alt="Mô hình 3D của McLaren 600LT"
                            camera-controls 
                            auto-rotate
                            ar
                            shadow-intensity="1.5"
                            exposure="1.1"
                            poster="https://placehold.co/1200x800/000/FF7E00?text=Đang+tải+mô+hình+3D+McLaren+600LT...">
                        </model-viewer>
                    </div>
                </div>

                <div class="col-lg-3 feature-column right-col reveal">
                    <div class="feature-item align-right">
                        <div class="icon"><i class="fas fa-cogs"></i></div>
                        <h4>Động Cơ 3.8L V8</h4>
                        <p>600PS và 620Nm mô-men xoắn. Trái tim của 600LT mang lại hiệu suất đáng kinh ngạc.</p>
                    </div>
                    <div class="feature-item align-right">
                        <div class="icon"><i class="fas fa-fire"></i></div>
                        <h4>Ống Xả Top-Exit</h4>
                        <p>Thiết kế ống xả đặt trên đỉnh độc đáo không chỉ giảm trọng lượng mà còn tạo ra âm thanh đặc trưng.</p>
                    </div>
                </div>

            </div> <div class="showcase-cta reveal">
                {{-- SỬA LỖI: Dùng 'car' thay vì 'model' --}}
                   <a href="{{ route('car.details', ['car' => '600lt']) }}" class="btn-link-arrow">
                    Tìm hiểu chi tiết về 600LT <i class="fas fa-arrow-right"></i>
                </a>
            </div>

        </div> </section>

    <section class="racing-dna-section section-padding">
        <div class="container py-lg-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 reveal">
                    <img src="{{ asset('images/mclaren-f1.jpg') }}" alt="Xe đua McLaren F1" class="img-fluid w-100">
                </div>
                <div class="col-lg-6 reveal">
                    <div class="content-box">
                        <span class="tagline">Di Sản Đua Xe</span>
                        <h2 class="display-5 mb-4">Sinh Ra Từ Đường Đua</h2>
                        <p class="text-secondary fs-5 mb-4">
                            Từ Công thức 1 đến Le Mans, tinh thần cạnh tranh là cốt lõi của mọi chiếc xe chúng tôi tạo ra.
                        </p>
                        <p class="text-secondary">
                            Chúng tôi không chỉ áp dụng công nghệ F1 - chúng tôi sinh ra từ nó. Mỗi siêu xe đều được thừa hưởng sự chính xác, khí động học và hiệu suất đỉnh cao.
                        </p>
                        <a href="#" class="btn btn-mclaren-outline mt-4">Khám Phá Di Sản</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mso-section section-padding">
        <div class="container text-center text-white py-lg-5">
            <div class="row justify-content-center">
                <div class="col-lg-9 reveal">
                    <span class="tagline">McLaren Special Operations</span>
                    <h2 class="display-3 mb-4">Tầm Nhìn Của Bạn. <br> Sứ Mệnh Của Chúng Tôi.</h2>
                    <p class="lead mb-5">
                        MSO là nơi biến điều không thể thành có thể. Từ một chi tiết carbon độc đáo đến một chiếc xe "one-off" hoàn toàn, nếu bạn có thể mơ ước, chúng tôi có thể tạo ra.
                    </p>
                    <a href="#" class="btn btn-mclaren btn-lg">Khám Phá MSO</a>
                </div>
            </div>
        </div>
    </section>

    <section class="service-section section-padding">
        <div class="container py-lg-5">
            <div class="section-title-container reveal">
                <h2>Trải Nghiệm Sở Hữu</h2>
                <p class="lead">Dịch vụ vượt trội dành cho cỗ máy của bạn. Cam kết của chúng tôi kéo dài suốt vòng đời chiếc xe.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="service-card">
                        <div class="icon"><i class="fas fa-tools"></i></div>
                        <h4>Dịch Vụ & Bảo Dưỡng</h4>
                        <p class="text-secondary">Được thực hiện bởi các kỹ thuật viên được đào tạo chuyên sâu bởi McLaren. Đảm bảo hiệu suất tối ưu.</p>
                        <a href="#" class="btn-link-arrow mt-3">Tìm Hiểu Thêm</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="service-card">
                        <div class="icon"><i class="fas fa-car-side"></i></div>
                        <h4>Phụ Kiện Chính Hãng</h4>
                        <p class="text-secondary">Nâng cấp và cá nhân hóa chiếc xe của bạn với các phụ kiện MSO và chính hãng McLaren.</p>
                        <a href="#" class="btn-link-arrow mt-3">Khám Phá Phụ Kiện</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="service-card">
                        <div class="icon"><i class="fas fa-calendar-check"></i></div>
                        <h4>Đặt Lịch Hẹn</h4>
                        <p class="text-secondary">Dễ dàng đặt lịch hẹn dịch vụ trực tuyến tại đại lý gần nhất của bạn.</p>
                        <a href="{{ route('retailers') }}" class="btn-link-arrow mt-3">Đặt Lịch Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script typeR="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        
        // --- Logic cho Hiệu ứng Reveal on Scroll ---
        const revealElements = document.querySelectorAll('.reveal');
        if (revealElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 }); // Kích hoạt khi 10% phần tử hiển thị

            revealElements.forEach(el => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                observer.observe(el);
            });
        }
    });
    </script>
@endpush