@extends('layouts.app')

@section('title', 'McLaren Việt Nam - Official')

@push('styles')
<style>
    .main-container { padding-top: 0 !important; }
    .section-gap { padding: 120px 0; }

    /* --- HERO SECTION (CINEMATIC) --- */
    .hero-wrap { position: relative; height: 100vh; width: 100%; overflow: hidden; }
    #hero-bg {
        position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
        animation: slowZoom 30s infinite alternate; filter: brightness(0.9);
    }
    @keyframes slowZoom { from { transform: scale(1); } to { transform: scale(1.15); } }
    
    .hero-shade { position: absolute; inset: 0; background: linear-gradient(to top, #000 0%, transparent 50%); }
    .hero-txt {
        position: absolute; bottom: 15%; left: 5%; z-index: 2; color: #fff; max-width: 900px;
        opacity: 0; transform: translateY(30px); animation: fadeUp 1s ease forwards 0.5s;
    }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

    .hero-h1 { font-size: clamp(4rem, 8vw, 7rem); font-weight: 900; text-transform: uppercase; line-height: 0.9; margin-bottom: 20px; letter-spacing: -2px; }
    .hero-sub { color: #FF7E00; font-weight: 700; letter-spacing: 4px; text-transform: uppercase; margin-bottom: 15px; display: block; font-size: 0.9rem; }

    /* --- LUXURY CARDS --- */
    .lux-card {
        background: #0a0a0a; border: none; height: 100%; transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
        position: relative; overflow: hidden; border-bottom: 1px solid #222;
    }
    .lux-card:hover { transform: translateY(-15px); border-bottom-color: #FF7E00; box-shadow: 0 30px 60px rgba(0,0,0,0.9); }
    .lux-card img { width: 100%; height: 320px; object-fit: cover; transition: 0.6s; filter: grayscale(30%); }
    .lux-card:hover img { transform: scale(1.05); filter: grayscale(0%); }
    
    .card-body { padding: 2rem; }
    .card-title { color: #fff; font-weight: 800; text-transform: uppercase; font-size: 1.6rem; margin-bottom: 10px; }
    .card-desc { color: #888; font-size: 0.95rem; line-height: 1.6; margin-bottom: 25px; min-height: 50px; font-weight: 300; }

    /* --- BUTTONS --- */
    .btn-mc {
        background: #FF7E00; color: #fff; border: none; padding: 15px 45px;
        text-transform: uppercase; font-weight: 700; letter-spacing: 2px; transition: 0.3s;
        text-decoration: none; display: inline-block; font-size: 0.9rem;
    }
    .btn-mc:hover { background: #fff; color: #000; }
    
    .btn-outline-mc {
        border: 1px solid #444; color: #fff; padding: 12px 20px; text-transform: uppercase; letter-spacing: 2px;
        width: 100%; display: block; text-align: center; text-decoration: none; transition: 0.3s; font-size: 0.8rem;
    }
    .btn-outline-mc:hover { border-color: #FF7E00; background: #FF7E00; color: #fff; }

    /* --- 3D SECTION --- */
    .section-3d-black {
        background-color: #000000 !important;
        padding: 100px 0;
        position: relative;
    }
    .feature-item { margin-bottom: 3rem; padding: 1.5rem; border-left: 2px solid #333; transition: 0.3s; }
    .feature-item:hover { border-left-color: #FF7E00; padding-left: 2rem; }
    .feature-item.align-right { text-align: right; border-left: none; border-right: 2px solid #333; }
    .feature-item.align-right:hover { border-right-color: #FF7E00; padding-right: 2rem; padding-left: 1.5rem; }
    .feature-icon { font-size: 1.8rem; color: #FF7E00; margin-bottom: 15px; display: block; }
    .feature-title { color: #fff; font-weight: 700; text-transform: uppercase; font-size: 1.1rem; margin-bottom: 5px; }
    .feature-desc { color: #777; font-size: 0.9rem; line-height: 1.5; margin: 0; }
    .model-viewer-container { height: 500px; width: 100%; background-color: #000000; display: flex; align-items: center; justify-content: center; }
    model-viewer { width: 100%; height: 100%; --poster-color: transparent; }

    /* --- MSO PARALLAX --- */
    .mso-bg {
        background-image: url("{{ asset('images/senna-1.jpg') }}"); 
        background-attachment: fixed; background-size: cover; position: relative; padding: 180px 0; text-align: center;
    }
</style>
@endpush

@section('content')

    {{-- HERO SECTION (DỮ LIỆU ĐỘNG) --}}
    <section class="hero-wrap">
        @if(isset($heroCar) && $heroCar)
            <img id="hero-bg" src="{{ asset($heroCar->image_url) }}" alt="{{ $heroCar->name }}">
            <div class="hero-shade"></div>
            <div class="hero-txt">
                <span class="hero-sub">The New Benchmark</span>
                <h1 class="hero-h1">McLaren {{ $heroCar->name }}</h1>
                <p class="d-none d-md-block mb-5 fs-5 text-white-50 fw-light">{{ $heroCar->description }}</p>
                <a href="{{ route('car.details', ['modelKey' => $heroCar->model_key]) }}" class="btn-mc">Khám Phá Ngay</a>
            </div>
        @else
            {{-- Fallback nếu không tìm thấy xe 750s trong DB --}}
            <div class="hero-txt">
                <h1 class="hero-h1">MCLAREN</h1>
                <p class="mb-5 fs-5 text-white-50">Performance Amplified.</p>
                <a href="{{ route('cars') }}" class="btn-mc">Xem Bộ Sưu Tập</a>
            </div>
        @endif
    </section>

    {{-- FEATURED MODELS (DỮ LIỆU ĐỘNG) --}}
    <section class="section-gap bg-black">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <span class="text-warning fw-bold text-uppercase ls-2">Bộ Sưu Tập</span>
                <h2 class="text-white display-3 fw-bold mt-2">DÒNG XE NỔI BẬT</h2>
            </div>
            
            <div class="row g-4">
                @foreach($featuredCars as $car)
                <div class="col-lg-4 col-md-6 reveal">
                    <div class="lux-card">
                        <img src="{{ asset($car->image_url) }}" alt="{{ $car->name }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $car->name }} {{ $car->series }}</h4>
                            <p class="card-desc">{{ Str::limit($car->slogan, 60) }}</p>
                            <a href="{{ route('car.details', ['modelKey' => $car->model_key]) }}" class="btn-outline-mc">Chi Tiết</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5 reveal">
                <a href="{{ route('cars') }}" class="btn-mc px-5 py-3">Xem Tất Cả Dòng Xe</a>
            </div>
        </div>
    </section>

    {{-- 3D MODEL SECTION (GIỮ NGUYÊN TĨNH MẪU 600LT ĐỂ SHOWCASE) --}}
    <section class="section-3d-black">
        <div class="container">
            <div class="text-center mb-5 reveal">
                <span class="text-warning fw-bold text-uppercase ls-2">Di Sản Đường Đua</span>
                <h2 class="text-white display-4 fw-bold mt-2">KHÁM PHÁ 600LT</h2>
                <p class="text-secondary">Trải nghiệm chi tiết mẫu xe Longtail huyền thoại từ mọi góc độ.</p>
            </div>

            <div class="row align-items-center">
                {{-- LEFT COLUMN --}}
                <div class="col-lg-3 reveal">
                    <div class="feature-item align-right">
                        <i class="fas fa-feather-alt feature-icon"></i>
                        <div class="feature-title">Trọng Lượng Siêu Nhẹ</div>
                        <p class="feature-desc">Chỉ 1,247kg nhờ khung gầm MonoCell II và thân vỏ sợi carbon.</p>
                    </div>
                    <div class="feature-item align-right">
                        <i class="fas fa-wind feature-icon"></i>
                        <div class="feature-title">Khí Động Học</div>
                        <p class="feature-desc">Cánh gió cố định tạo ra 100kg lực ép xuống mặt đường ở 250km/h.</p>
                    </div>
                </div>

                {{-- CENTER MODEL --}}
                <div class="col-lg-6 reveal">
                    <div class="model-viewer-container">
                        <model-viewer 
                            src="{{ asset('models/2019_mclaren_600lt.glb') }}" 
                            camera-controls auto-rotate ar shadow-intensity="2"
                            camera-orbit="45deg 75deg 105%" style="background-color: #000000;"
                            poster="{{ asset('images/600lt-1.jpg') }}">
                        </model-viewer>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('car.details', ['modelKey' => '600lt']) }}" class="text-white text-decoration-none fw-bold text-uppercase ls-2" style="font-size: 0.9rem;">
                            Xem Chi Tiết 600LT <i class="fas fa-arrow-right ms-2 text-warning"></i>
                        </a>
                    </div>
                </div>

                {{-- RIGHT COLUMN --}}
                <div class="col-lg-3 reveal">
                    <div class="feature-item">
                        <i class="fas fa-tachometer-alt feature-icon"></i>
                        <div class="feature-title">Động Cơ V8 Twin-Turbo</div>
                        <p class="feature-desc">Sức mạnh 600PS và 620Nm mô-men xoắn. Tăng tốc 0-100km/h trong 2.9s.</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-fire feature-icon"></i>
                        <div class="feature-title">Ống Xả Top-Exit</div>
                        <p class="feature-desc">Thiết kế ống xả đặt trên đỉnh độc đáo, giảm trọng lượng và tăng uy lực.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MSO PARALLAX --}}
    <section class="mso-bg">
        <div style="position:absolute; inset:0; background:rgba(0,0,0,0.85);"></div>
        <div class="container position-relative reveal">
            <span class="text-warning fw-bold fs-4 ls-2">MSO</span>
            <h2 class="text-white display-3 fw-bold my-3">KHÔNG GIỚI HẠN</h2>
            <p class="text-light lead mx-auto opacity-75 mb-5" style="max-width:700px; font-weight:300;">
                McLaren Special Operations (MSO) biến giấc mơ độc bản của bạn thành hiện thực. Màu sắc, vật liệu, hiệu suất - tất cả đều theo ý bạn.
            </p>
            <a href="{{ route('mso') }}" class="btn-mc">Tìm Hiểu Thêm</a>
        </div>
    </section>

@endsection

@push('scripts')
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
    <script>
        // Reveal Animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if(e.isIntersecting) {
                    e.target.style.opacity = 1; e.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach(el => {
            el.style.opacity = 0; el.style.transform = 'translateY(40px)';
            el.style.transition = 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            observer.observe(el);
        });
    </script>
@endpush