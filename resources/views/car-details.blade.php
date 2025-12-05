@extends('layouts.app')

@section('title', $car->name . ' - Chi Tiết')

@section('styles')
<style>
    :root { --mclaren-orange: #FF7E00; --bg-dark: #050505; }
    body { background: var(--bg-dark); color: #f0f0f0; font-family: 'Inter', sans-serif; }
    
    .hero-wrapper { position: relative; height: 90vh; overflow: hidden; display: flex; align-items: flex-end; }
    .hero-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;
        animation: zoomIn 20s infinite alternate; opacity: 0.9; 
        transition: opacity 0.4s ease;
    }
    @keyframes zoomIn { from { transform: scale(1); } to { transform: scale(1.15); } }
    
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to top, #050505 10%, transparent 70%); z-index: 1; }
    .hero-content { position: relative; z-index: 10; padding-bottom: 6rem; width: 100%; }
    
    .hero-series { color: var(--mclaren-orange); font-weight: 700; letter-spacing: 4px; text-transform: uppercase; margin-bottom: 10px; display: block; font-size: 0.9rem; }
    .hero-title { font-size: clamp(3.5rem, 7vw, 6.5rem); font-weight: 900; text-transform: uppercase; line-height: 0.9; margin-bottom: 1rem; letter-spacing: -2px; }
    .hero-tagline { font-size: 1.3rem; color: #ccc; font-weight: 300; max-width: 700px; padding-left: 20px; border-left: 3px solid var(--mclaren-orange); }

    .section-padding { padding: 100px 0; }
    .stat-box {
        border-top: 1px solid #333; padding: 30px 0; transition: 0.3s;
    }
    .stat-box:hover { border-color: var(--mclaren-orange); }
    .stat-value { font-size: 3.5rem; font-weight: 800; color: #fff; line-height: 1; margin-bottom: 5px; }
    .stat-label { font-size: 0.8rem; text-transform: uppercase; color: #888; letter-spacing: 2px; }

    .model-container { height: 70vh; background: radial-gradient(circle, #222 0%, #000 100%); position: relative; border-radius: 0; overflow: hidden; }
    model-viewer { width: 100%; height: 100%; --poster-color: transparent; }
    .media-video, .media-fallback-img { width: 100%; height: 100%; object-fit: cover; }
    
    .thumb-list { display: flex; gap: 15px; margin-top: 30px; overflow-x: auto; padding-bottom: 10px; }
    .thumb-item { width: 110px; height: 65px; object-fit: cover; opacity: 0.5; cursor: pointer; transition: 0.3s; border-radius: 4px; border: 2px solid transparent;}
    .thumb-item:hover, .thumb-item.active { opacity: 1; border-color: var(--mclaren-orange); }

    .specs-table li { display: flex; justify-content: space-between; padding: 18px 0; border-bottom: 1px solid #222; color: #aaa; font-size: 1.05rem; }
    .specs-table li strong { color: #fff; }
    .story-card { background: #111; border-left: 3px solid var(--mclaren-orange); }

    @media(max-width:768px) { .hero-wrapper { height: 70vh; } .hero-content { padding-bottom: 100px; } }
</style>
@endsection

@section('content')
    {{-- HERO SECTION --}}
    <div class="hero-wrapper">
        <img id="hero-img" src="{{ asset('storage/' . $car->image_url) }}" class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <span class="hero-series">{{ $car->series }}</span>
            <h1 class="hero-title">{{ $car->name }}</h1>
            <p class="hero-tagline">{{ $car->tagline }}</p>
            <a href="{{ route('contact') }}" class="btn btn-outline-light mt-5 px-5 py-2 text-uppercase fw-bold" style="letter-spacing: 2px; border-radius: 0;">Yêu Cầu Báo Giá</a>
        </div>
    </div>

    {{-- OVERVIEW --}}
    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold text-white mb-4">{{ $car->slogan }}</h2>
                    <p class="text-secondary fs-5" style="line-height: 1.8; font-weight: 300;">{{ $car->description }}</p>
                    
                    {{-- GALLERY (THUMBNAILS) --}}
                    <div class="mt-5">
                        <small class="text-uppercase text-warning ls-2">Thư viện hình ảnh</small>
                        <div class="thumb-list" id="gallery">
                            @if($car->gallery_images && is_iterable($car->gallery_images))
                                @foreach($car->gallery_images as $img) 
                                    <img src="{{ asset('storage/' . $img) }}" class="thumb-item" 
                                        onclick="changeHeroImage('{{ asset('storage/' . $img) }}', this)">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div id="stats-grid">
                        {{-- Stats: Thêm kiểm tra is_iterable() --}}
                        @if($car->stats && is_iterable($car->stats))
                            @foreach($car->stats as $stat)
                                <div class="stat-box">
                                    <div class="stat-value counter-anim" 
                                        data-target="{{ $stat['v'] }}" 
                                        data-decimal="{{ isset($stat['d']) ? 'true' : 'false' }}">0</div>
                                    <div class="stat-label">{{ $stat['l'] }}</div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    
                    {{-- SPECS TABLE --}}
                    <div class="mt-5">
                        <h5 class="text-white mb-4 text-uppercase ls-2">Thông số kỹ thuật</h5>
                        <ul class="list-unstyled specs-table">
                            {{-- Specs: Thêm kiểm tra is_iterable() --}}
                            @if($car->specs && is_iterable($car->specs))
                                @foreach($car->specs as $key => $val)
                                    <li><span>{{ $key }}</span> <strong>{{ $val }}</strong></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- STORIES SECTION --}}
    @if(!empty($car->stories) && is_iterable($car->stories))
    <section class="story-section py-5 bg-darker">
        <div class="container">
            <h3 class="text-warning text-uppercase fw-bold ls-2 mb-5">Câu chuyện & Di sản</h3>
            <div class="row g-4">
                @foreach($car->stories as $story)
                <div class="col-md-4">
                    <div class="story-card p-4 h-100" style="background: #111; border-left: 3px solid #FF7E00;">
                        <h5 class="text-white text-uppercase fw-bold mb-3">{{ $story['title'] }}</h5>
                        <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ $story['content'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    
    {{-- MEDIA FALLBACK SECTION (3D -> VIDEO -> IMAGE) --}}
    <section class="py-5 bg-black position-relative">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <span class="text-warning text-uppercase fw-bold ls-2">Góc nhìn chi tiết</span>
                    <h2 class="text-white display-6 fw-bold">TRẢI NGHIỆM TƯƠNG TÁC</h2>
                </div>
            </div>
            <div class="model-container">
                @if($car->model_3d_url)
                    <model-viewer id="car-3d" src="{{ asset($car->model_3d_url) }}" 
                        camera-controls auto-rotate shadow-intensity="1.5" environment-image="neutral" exposure="1"
                        poster="{{ asset('storage/' . $car->image_url) }}" style="width: 100%; height: 100%;"></model-viewer>
                
                @elseif($car->video_url)
                    <video class="media-video" controls autoplay loop muted playsinline>
                        <source src="{{ $car->video_url }}" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ video MP4.
                    </video>
                
                @else
                    <img src="{{ asset('storage/' . $car->image_url) }}" class="media-fallback-img" alt="Ảnh chi tiết xe">
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
    window.changeHeroImage = function(src, el) {
        document.getElementById('hero-img').src = src;
        document.querySelectorAll('.thumb-item').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
    }

    function startCounter(target, endValue, duration = 2000, isDecimal = false) {
        let start = 0; const stepTime = 20; const steps = duration / stepTime;
        const increment = endValue / steps;
        const timer = setInterval(() => {
            start += increment;
            if (start >= endValue) { start = endValue; clearInterval(timer); }
            target.textContent = isDecimal ? start.toFixed(1) : Math.floor(start);
        }, stepTime);
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.counter-anim').forEach(el => {
            const target = parseFloat(el.getAttribute('data-target'));
            const isDecimal = el.getAttribute('data-decimal') === 'true';
            setTimeout(() => startCounter(el, target, 2000, isDecimal), 500);
        });

        const heroImg = document.getElementById('hero-img');
        
        const gallery = @json($car->gallery_images ?? []);

        if(gallery.length > 1) {
            let index = -1;
            
            setInterval(() => {
                index = (index + 1) % gallery.length;
                
                if (!gallery[index]) return; 
                
                const nextSrc = "{{ asset('storage/') }}" + "/" + gallery[index]; 

                heroImg.style.opacity = '0.4';
                
                setTimeout(() => {
                    heroImg.src = nextSrc;
                    heroImg.style.opacity = '1'; 
                }, 400);
            }, 5000);
        }
    });
</script>
@endsection