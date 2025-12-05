@extends('layouts.app')

@section('title', 'Bộ Sưu Tập McLaren')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        :root {
            --mclaren-orange: #FF7E00;
            --dark-bg: #050505;
            --text-muted: #888;
        }
        body { background-color: var(--dark-bg); font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* Ẩn phần thừa từ template cũ nếu có */
        .cars-page-header, .filter-bar, .cars-listing-page { display: none !important; }

        /* --- MAIN SLIDER --- */
        .models-slider-container {
            height: 100vh; width: 100%; display: flex; align-items: center; justify-content: center;
            background: radial-gradient(circle at center, #1f1f1f 0%, #000000 85%);
            position: relative; padding-top: 0;
        }
        .bg-watermark {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            font-size: 22vw; font-weight: 900; color: rgba(255,255,255,0.02);
            pointer-events: none; user-select: none; white-space: nowrap;
        }

        .swiper { width: 100%; height: 90vh; padding: 20px 0; }
        .swiper-slide {
            width: 700px; height: 100%; position: relative;
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            transition: all 0.6s ease; opacity: 0.2; filter: grayscale(100%) blur(2px); transform: scale(0.8);
        }
        .swiper-slide-active { opacity: 1; filter: grayscale(0%) blur(0); transform: scale(1); z-index: 10; }

        .car-visual { width: 100%; height: 60%; display: flex; align-items: center; justify-content: center; }
        .car-slide-image {
            max-width: 135%; max-height: 100%; object-fit: contain;
            filter: drop-shadow(0 50px 40px rgba(0,0,0,0.9));
            transition: transform 0.6s ease; cursor: pointer;
        }
        .swiper-slide-active:hover .car-slide-image { transform: scale(1.05); }

        .car-info { text-align: center; opacity: 0; transform: translateY(40px); transition: 0.8s ease 0.2s; }
        .swiper-slide-active .car-info { opacity: 1; transform: translateY(0); }

        .car-name {
            font-size: 4.5rem; font-weight: 800; color: #fff; margin: 0;
            text-transform: uppercase; letter-spacing: -2px; line-height: 1;
            text-shadow: 0 10px 30px rgba(0,0,0,0.7);
        }
        .car-desc { font-size: 1rem; color: #aaa; margin: 15px auto 30px; max-width: 80%; font-weight: 300; letter-spacing: 0.5px; }

        .btn-explore {
            padding: 14px 50px; border: 1px solid rgba(255,255,255,0.15); color: #fff;
            text-decoration: none; text-transform: uppercase; letter-spacing: 3px; font-size: 0.85rem;
            transition: all 0.4s ease; position: relative; overflow: hidden; display: inline-block;
            background: rgba(0,0,0,0.3); backdrop-filter: blur(5px);
        }
        .btn-explore:hover { border-color: var(--mclaren-orange); background: var(--mclaren-orange); }

        /* Nav Buttons */
        .nav-btn {
            position: absolute; top: 50%; width: 60px; height: 60px;
            border: 1px solid rgba(255,255,255,0.1); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,0.4); cursor: pointer; z-index: 50; transition: 0.3s;
            transform: translateY(-50%); backdrop-filter: blur(10px);
        }
        .nav-btn:hover { border-color: var(--mclaren-orange); color: #fff; box-shadow: 0 0 20px rgba(255,126,0,0.4); }
        .prev-btn { left: 40px; }
        .next-btn { right: 40px; }

        @media (max-width: 768px) {
            .swiper-slide { width: 90%; }
            .car-name { font-size: 3rem; }
            .nav-btn { display: none; }
        }
    </style>
@endpush

@section('content')
    <div class="models-slider-container">
        <div class="bg-watermark">MCLAREN</div>
        <div class="nav-btn prev-btn"><i class="fas fa-chevron-left"></i></div>
        <div class="nav-btn next-btn"><i class="fas fa-chevron-right"></i></div>

        <div class="swiper models-swiper">
            <div class="swiper-wrapper">
                
                {{-- LẶP QUA DATABASE --}}
                @foreach($cars as $car)
                <div class="swiper-slide">
                    <div class="car-visual">
                        {{-- Hiển thị ảnh từ thư mục public --}}
                        <img src="{{ asset($car->image_url) }}" class="car-slide-image" alt="{{ $car->name }}">
                    </div>
                    <div class="car-info">
                        <h2 class="car-name">{{ $car->name }}</h2>
                        {{-- Ưu tiên hiển thị Tagline, nếu không có thì hiện Series --}}
                        <p class="car-desc">{{ $car->tagline ?? $car->series }}</p>
                        
                        {{-- Link tới trang chi tiết dựa vào model_key --}}
                        <a href="{{ route('car.details', ['modelKey' => $car->model_key]) }}" class="btn-explore">Khám Phá</a>
                    </div>
                </div>
                @endforeach
                {{-- KẾT THÚC VÒNG LẶP --}}

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.models-swiper', {
                effect: 'coverflow', grabCursor: true, centeredSlides: true,
                slidesPerView: 'auto', initialSlide: 0, loop: true, speed: 800,
                coverflowEffect: { rotate: 0, stretch: 50, depth: 300, modifier: 1, slideShadows: false },
                navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' },
                keyboard: { enabled: true },
                mousewheel: { forceToAxis: true },
                breakpoints: { 320: { slidesPerView: 1, effect: 'slide' }, 1024: { slidesPerView: 'auto' } }
            });
        }); 
    </script>
@endpush