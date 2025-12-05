@extends('layouts.app')
@section('title', 'Di Sản McLaren')

@push('styles')
<style>
  
    :root { --mclaren-orange: #FF7E00; --gold: #D4AF37; --bg-dark: #0a0a0a; }
    body { background-color: var(--bg-dark); color: #fff; font-family: 'Inter', sans-serif; }
   
    .heritage-hero { height: 80vh; display: flex; align-items: center; justify-content: center; background: url('https://mclaren.scene7.com/is/image/mclaren/McLaren-Racing-Heritage-01:crop-16x9?wid=1920&hei=1080') center/cover fixed; position: relative; }
    .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.6); }
    .hero-content { z-index: 2; text-align: center; }
    /* CSS cho Timeline */
    .timeline-wrapper { position: relative; padding: 100px 0; overflow: hidden; } /* Thêm overflow: hidden để tránh tràn */
    .timeline-line { position: absolute; left: 50%; top: 0; height: 100%; width: 1px; background: #333; }
    .era-block { 
        display: flex; 
        justify-content: space-between; 
        margin-bottom: 100px; 
        align-items: center; 
        position: relative; /* Đảm bảo mỗi khối là độc lập */
        z-index: 10; /* Đưa khối lên trên nếu có lỗi nền */
    }
    .era-image-box { width: 45%; height: 400px; }
    .era-image-box img { width: 100%; height: 100%; object-fit: cover; }
    .era-content-box { 
        width: 45%; 
        padding: 40px; 
        background: #111; /* Đảm bảo nền màu đặc */
        border-left: 3px solid var(--mclaren-orange); 
        position: relative; 
    }
    .year-bg { position: absolute; top: -30px; right: 20px; font-size: 5rem; font-weight: 900; color: rgba(255,255,255,0.05); }
    
    /* Đảo chiều */
    .era-block.reverse { flex-direction: row-reverse; }
    .era-block.reverse .era-content-box { border-left: none; border-right: 3px solid var(--mclaren-orange); text-align: right; }
    .era-block.reverse .year-bg { right: auto; left: 20px; }
    
    @media(max-width:992px) { 
        .timeline-line{display:none} 
        .era-block, .era-block.reverse{flex-direction:column} 
        .era-image-box, .era-content-box{width:100%} 
    }
</style>
@endpush

@section('content')
    <section class="heritage-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="display-1 fw-bold text-white">THE RACING DNA</h1>
            <p class="lead text-light">Từ 1963 đến Vĩnh cửu.</p>
        </div>
    </section>

    {{-- KHỐI CHỨA DÒNG THỜI GIAN (ĐƯỢC CHỨNG MINH LÀ CHỈ LẶP LẠI NỘI DUNG TỪ DATABASE) --}}
    <div class="container timeline-wrapper">
        <div class="timeline-line"></div>

        @if(isset($timelines) && $timelines->count() > 0)
            @foreach($timelines as $index => $item)
                {{-- Logic: Nếu index là lẻ thì thêm class reverse để đảo chiều --}}
                <div class="era-block {{ $index % 2 != 0 ? 'reverse' : '' }}">
                    <div class="era-image-box">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
                    </div>
                    <div class="era-content-box">
                        <div class="year-bg">{{ $item->year }}</div>
                        <span class="text-warning fw-bold ls-2 text-uppercase">{{ $item->tag }}</span>
                        <h2 class="fw-bold mt-2 mb-3">{{ $item->title }}</h2>
                        <p class="text-secondary">{{ $item->description }}</p>
                    </div>
                </div>
            @endforeach
        @else
             {{-- Hiển thị thông báo nếu không có dữ liệu --}}
             <div class="text-center py-5">
                 <h3 class="text-danger">Lỗi: Không tìm thấy dữ liệu dòng thời gian (Timelines).</h3>
                 <p class="text-muted">Vui lòng kiểm tra lại quá trình seeding database hoặc truy vấn trong Controller.</p>
             </div>
        @endif

    </div>
@endsection