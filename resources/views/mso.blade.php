@extends('layouts.app')

@section('title', 'MSO - The Art of the Impossible')

@push('styles')
<style>
    body { background-color: #000; color: #fff; }
    
    /* Fullscreen Section Style */
    .mso-full-section {
        position: relative; width: 100%; min-height: 90vh;
        display: flex; align-items: center; justify-content: flex-start; /* Mặc định căn trái */
        overflow: hidden; border-bottom: 1px solid #222;
    }
    
    /* Background Image Absolute */
    .mso-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover; z-index: 0; transition: transform 10s ease; opacity: 0.6;
    }
    /* Hiệu ứng zoom nền nhẹ */
    .mso-full-section:hover .mso-bg { transform: scale(1.05); }
    
    /* Content Box */
    .mso-box {
        position: relative; z-index: 10; width: 40%; margin-left: 10%;
        padding: 60px; background: rgba(0,0,0,0.85); /* Nền đen mờ để chữ luôn nổi */
        border-left: 4px solid #E4002B; backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.8);
    }
    
    /* Right Aligned Variation */
    .align-right { justify-content: flex-end; }
    .align-right .mso-box { margin-left: 0; margin-right: 10%; border-left: none; border-right: 4px solid #FF7E00; }

    .mso-label { color: #aaa; letter-spacing: 3px; font-size: 0.8rem; font-weight: 700; margin-bottom: 15px; display: block; text-transform: uppercase; }
    .mso-head { font-size: 3.5rem; font-weight: 800; line-height: 1; margin-bottom: 30px; text-transform: uppercase; }
    .mso-head span { color: transparent; -webkit-text-stroke: 1px #fff; display: block; opacity: 0.5; }
    .mso-text { font-size: 1.1rem; line-height: 1.7; color: #ddd; margin-bottom: 40px; }
    
    .btn-mso-outline {
        padding: 15px 40px; border: 1px solid rgba(255,255,255,0.5); color: #fff;
        text-decoration: none; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem;
        transition: 0.3s; display: inline-block;
    }
    .btn-mso-outline:hover { background: #fff; color: #000; border-color: #fff; }

    /* RESPONSIVE */
    @media(max-width: 992px) {
        .mso-full-section { min-height: auto; flex-direction: column; }
        .mso-bg { position: relative; height: 50vh; opacity: 1; }
        .mso-box, .align-right .mso-box { width: 100%; margin: 0; border: none; padding: 40px 20px; background: #0a0a0a; }
        .mso-head { font-size: 2.5rem; }
    }
</style>
@endpush

@section('content')
    {{-- SECTION 1: INTRODUCTION --}}
    <div class="mso-full-section">
        <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-765LT-MSO-01:crop-16x9?wid=1920&hei=1080" class="mso-bg" alt="MSO Intro">
        <div class="mso-box">
            <span class="mso-label">McLaren Special Operations</span>
            <h1 class="mso-head">Art of <br><span>Impossible</span></h1>
            <p class="mso-text">
                MSO sinh ra để hiện thực hóa những giấc mơ hoang đường nhất. Chúng tôi không chỉ sơn màu xe, chúng tôi tạo ra những tác phẩm nghệ thuật độc bản phản chiếu linh hồn của chủ nhân.
            </p>
            <a href="#bespoke" class="btn-mso-outline">Khám Phá Các Hạng Mục</a>
        </div>
    </div>

    {{-- SECTION 2: MSO DEFINED (Right Align) --}}
    <div class="mso-full-section align-right">
        <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-Elva-MSO-Theme-01:crop-16x9?wid=1920&hei=1080" class="mso-bg" alt="MSO Defined">
        <div class="mso-box">
            <span class="mso-label">Level 1</span>
            <h2 class="mso-head">MSO <br><span style="-webkit-text-stroke: 1px #FF7E00;">DEFINED</span></h2>
            <p class="mso-text">
                Bộ sưu tập các tùy chọn nâng cao được thiết kế sẵn. Carbon Fiber màu, vè bánh xe khí động học, nội thất Alcantara phối màu đặc biệt. Những chi tiết nhỏ nhưng tạo nên sự khác biệt lớn về thẩm mỹ và hiệu suất.
            </p>
        </div>
    </div>

    {{-- SECTION 3: MSO BESPOKE (Left Align) --}}
    <div class="mso-full-section" id="bespoke">
        <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-Speedtail-Albert-01:crop-16x9?wid=1920&hei=1080" class="mso-bg" alt="MSO Bespoke">
        <div class="mso-box">
            <span class="mso-label">Level 2 - Unlimited</span>
            <h2 class="mso-head">MSO <br><span style="-webkit-text-stroke: 1px #E4002B;">BESPOKE</span></h2>
            <p class="mso-text">
                Đỉnh cao của sự tùy biến. Chúng tôi bắt đầu với một tờ giấy trắng. Một màu sơn pha trộn từ bụi kim cương? Da nội thất cùng màu với túi xách Hermes của bạn? Mọi yêu cầu đều có thể thực hiện được.
            </p>
            <a href="{{ route('contact') }}" class="btn-mso-outline" style="border-color: #E4002B; color: #E4002B;">Liên Hệ Đội Ngũ MSO</a>
        </div>
    </div>

    {{-- SECTION 4: MSO HERITAGE (Right Align) --}}
    <div class="mso-full-section align-right">
        <img src="https://mclaren.scene7.com/is/image/mclaren/F1-Service-2:crop-16x9?wid=1920&hei=1080" class="mso-bg" alt="MSO Heritage">
        <div class="mso-box">
            <span class="mso-label">Guardian of Legends</span>
            <h2 class="mso-head">MSO <br><span>HERITAGE</span></h2>
            <p class="mso-text">
                Dịch vụ bảo dưỡng và phục chế dành riêng cho những siêu phẩm lịch sử như McLaren F1 hay P1. Chúng tôi đảm bảo di sản của bạn luôn vận hành hoàn hảo như ngày đầu xuất xưởng.
            </p>
        </div>
    </div>
@endsection