@extends('layouts.app')

@section('title', 'Công Nghệ - Engineering the Impossible')

@push('styles')
<style>
    :root {
        --mclaren-orange: #FF7E00;
        --dark-bg: #050505;
        --card-surface: #121212;
        --border-light: rgba(255, 255, 255, 0.1);
        --text-muted: #888;
    }

    body {
        background-color: var(--dark-bg);
        color: #fff;
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
    }

    /* --- HERO SECTION: CINEMATIC --- */
    .tech-hero {
        height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, #1a1a1a 0%, #000000 100%);
        overflow: hidden;
    }

    .tech-hero-bg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover; opacity: 0.4;
        filter: grayscale(100%) contrast(1.2);
        animation: slowZoom 20s infinite alternate;
    }

    .tech-hero-content {
        z-index: 2; text-align: center; max-width: 900px; padding: 0 20px;
    }

    .tech-super-title {
        color: var(--mclaren-orange); font-size: 0.9rem; letter-spacing: 6px; 
        text-transform: uppercase; font-weight: 700; margin-bottom: 20px; display: block;
        opacity: 0; animation: fadeUp 1s forwards;
    }

    .tech-main-title {
        font-size: 5vw; font-weight: 900; letter-spacing: -2px; line-height: 1; margin-bottom: 30px;
        background: linear-gradient(to bottom, #fff, #666); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        opacity: 0; animation: fadeUp 1s forwards 0.3s;
    }

    .tech-hero-desc {
        font-size: 1.2rem; font-weight: 300; color: #ccc; line-height: 1.6; max-width: 700px; margin: 0 auto;
        opacity: 0; animation: fadeUp 1s forwards 0.6s;
    }

    @keyframes slowZoom { from { transform: scale(1); } to { transform: scale(1.1); } }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }

    /* --- SECTION STYLING --- */
    .tech-section { padding: 120px 0; position: relative; }
    
    /* Đường kẻ kỹ thuật trang trí */
    .tech-line {
        position: absolute; left: 50%; top: 0; width: 1px; height: 100%; 
        background: linear-gradient(to bottom, transparent, var(--border-light), transparent);
        z-index: 0;
    }

    .tech-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 0;
        align-items: center; min-height: 80vh;
        position: relative; z-index: 1;
    }

    .tech-visual {
        width: 100%; height: 100%; min-height: 600px; position: relative; overflow: hidden;
        border-right: 1px solid var(--border-light);
    }
    .tech-visual img {
        width: 100%; height: 100%; object-fit: cover; transition: transform 1s ease;
        filter: saturate(0); /* Ảnh đen trắng mặc định */
    }
    .tech-grid:hover .tech-visual img { transform: scale(1.05); filter: saturate(1); /* Có màu khi hover */ }

    .tech-info {
        padding: 80px; display: flex; flex-direction: column; justify-content: center;
    }

    .tech-num {
        font-size: 4rem; font-weight: 900; color: rgba(255, 255, 255, 0.114); 
        line-height: 1; margin-bottom: 0px; z-index: 2;


    }
    .tech-label {
        color: var(--mclaren-orange); font-size: 0.85rem; letter-spacing: 3px; text-transform: uppercase; font-weight: 700; margin-bottom: 20px;
    }
    .tech-head {
        font-size: 3rem; font-weight: 700; margin-bottom: 30px; line-height: 1.1;
    }
    .tech-p {
        font-size: 1.05rem; color: #aaa; line-height: 1.8; font-weight: 300; margin-bottom: 30px; text-align: justify;
    }

    /* Feature List Styling */
    .tech-specs {
        list-style: none; padding: 0; margin: 0;
        border-top: 1px solid var(--border-light);
    }
    .tech-specs li {
        padding: 20px 0; border-bottom: 1px solid var(--border-light);
        display: flex; justify-content: space-between; align-items: center;
        color: #fff; font-weight: 500;
    }
    .tech-specs li span { color: var(--text-muted); font-weight: 300; font-size: 0.9rem; text-transform: uppercase; }

    /* Reverse Layout */
    .tech-grid.reverse .tech-visual { order: 2; border-right: none; border-left: 1px solid var(--border-light); }
    .tech-grid.reverse .tech-info { order: 1; text-align: right; }
    .tech-grid.reverse .tech-p { text-align: right; }
    .tech-grid.reverse .tech-specs li { flex-direction: row-reverse; }

    /* --- INNOVATION CARDS (Bottom Section) --- */
    .innov-section { padding: 100px 0; background: #0a0a0a; border-top: 1px solid var(--border-light); }
    .innov-grid {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px;
    }
    .innov-card {
        background: rgba(255,255,255,0.02); border: 1px solid var(--border-light);
        padding: 40px; transition: 0.4s; position: relative; overflow: hidden;
    }
    .innov-card:hover { background: rgba(255,255,255,0.05); border-color: var(--mclaren-orange); transform: translateY(-10px); }
    
    .innov-icon { font-size: 2.5rem; color: var(--mclaren-orange); margin-bottom: 25px; }
    .innov-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 15px; color: #fff; }
    .innov-desc { font-size: 0.95rem; color: #888; line-height: 1.7; }

    /* --- RESPONSIVE --- */
    @media (max-width: 992px) {
        .tech-main-title { font-size: 3rem; }
        .tech-line { display: none; }
        .tech-grid, .tech-grid.reverse { grid-template-columns: 1fr; min-height: auto; }
        .tech-visual { height: 400px; width: 100%; order: 1 !important; border: none; }
        .tech-info { padding: 40px 20px; order: 2 !important; text-align: left !important; }
        .tech-p { text-align: left !important; }
        .tech-specs li { flex-direction: row !important; }
        .innov-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- 1. HERO SECTION --}}
    <section class="tech-hero">
        {{-- Background Image: Dùng hình ảnh Engineering/Blueprint hoặc Engine Close-up --}}
         
        {{-- Placeholder cho image tag ở trên, thực tế bạn chèn link ảnh vào src bên dưới --}}
        <img src="https://mclaren.scene7.com/is/image/mclaren/Artura-Engine-1:crop-16x9?wid=1920&hei=1080" class="tech-hero-bg" alt="Engineering Background">
        
        <div class="tech-hero-content">
            <span class="tech-super-title">McLaren Technology Centre</span>
            <h1 class="tech-main-title">ENGINEERING <br>THE IMPOSSIBLE</h1>
            <p class="tech-hero-desc">
                Tại McLaren, chúng tôi không tuân theo các quy tắc. Chúng tôi viết lại chúng. 
                Sự ám ảnh về việc giảm trọng lượng và tối ưu hóa khí động học là DNA của mọi chiếc xe chúng tôi tạo ra.
            </p>
        </div>
    </section>

    {{-- 2. MAIN TECH SECTIONS --}}
    <div class="container-fluid p-0 position-relative">
        <div class="tech-line"></div>

        {{-- SECTION 1: CARBON FIBRE (LIGHTNESS) --}}
        <div class="tech-grid">
            <div class="tech-visual">
                 
                <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-Artura-MCLA-01:crop-16x9?wid=1920&hei=1080" alt="MCLA Carbon Architecture">
            </div>
            <div class="tech-info">
                <div class="tech-num">01</div>
                <span class="tech-label">Lightweight Architecture</span>
                <h2 class="tech-head">MCLA & Monocage</h2>
                <p class="tech-p">
                    Sợi carbon là trái tim của mọi chiếc McLaren kể từ năm 1981. Kiến trúc trọng lượng nhẹ McLaren (MCLA) mới nhất không chỉ giảm trọng lượng đến mức tối thiểu mà còn tối ưu hóa cho hệ động lực Hybrid. Cấu trúc này cứng hơn thép nhưng nhẹ hơn nhôm, mang lại sự bảo vệ an toàn tuyệt đối và khả năng phản hồi lái chính xác từng milimet.
                </p>
                <ul class="tech-specs">
                    <li><span>Vật liệu</span> <strong>High-Grade Carbon Fibre</strong></li>
                    <li><span>Trọng lượng khung</span> <strong>< 82kg</strong></li>
                    <li><span>Độ cứng xoắn</span> <strong>Vượt trội chuẩn F1</strong></li>
                </ul>
            </div>
        </div>

        {{-- SECTION 2: AERODYNAMICS (AIR) --}}
        <div class="tech-grid reverse">
            <div class="tech-visual">
                 

[Image of McLaren 720S aerodynamics airflow]

                <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-765LT-Aero-01:crop-16x9?wid=1920&hei=1080" alt="Active Aerodynamics">
            </div>
            <div class="tech-info">
                <div class="tech-num">02</div>
                <span class="tech-label">Fluid Dynamics</span>
                <h2 class="tech-head">Điêu Khắc Dòng Khí</h2>
                <p class="tech-p">
                    Với McLaren, "Form Follows Function" (Hình thức tuân theo chức năng). Mọi đường cong trên thân xe đều có mục đích: dẫn luồng khí làm mát động cơ hoặc tạo lực ép xuống mặt đường (Downforce). Hệ thống cánh gió chủ động (Active Aero) tự động điều chỉnh góc độ để tối ưu hóa lực cản khi tăng tốc và hoạt động như một phanh khí động học khi giảm tốc.
                </p>
                <ul class="tech-specs">
                    <li><span>Công nghệ</span> <strong>DRS (Drag Reduction System)</strong></li>
                    <li><span>Tính năng</span> <strong>Phanh khí (Airbrake)</strong></li>
                    <li><span>Hiệu quả</span> <strong>Tăng 50% Downforce</strong></li>
                </ul>
            </div>
        </div>

        {{-- SECTION 3: POWERTRAIN (HEART) --}}
        <div class="tech-grid">
            <div class="tech-visual">
                
                <img src="https://mclaren.scene7.com/is/image/mclaren/McLaren-720S-Engine-01:crop-16x9?wid=1920&hei=1080" alt="Powertrain">
            </div>
            <div class="tech-info">
                <div class="tech-num">03</div>
                <span class="tech-label">Extreme Power</span>
                <h2 class="tech-head">Hybrid & V8 Twin-Turbo</h2>
                <p class="tech-p">
                    Từ động cơ V8 4.0L Twin-Turbo trứ danh đến kỷ nguyên mới của V6 120° Hybrid. Chúng tôi đặt động cơ thấp nhất có thể để hạ thấp trọng tâm xe. Việc kết hợp động cơ điện hướng trục (Axial Flux E-motor) giúp lấp đầy khoảng trễ Turbo, mang lại phản ứng ga tức thì và mô-men xoắn bùng nổ ngay từ vòng tua thấp.
                </p>
                <ul class="tech-specs">
                    <li><span>Động cơ V6</span> <strong>Góc mở 120 độ (Hot Ve)</strong></li>
                    <li><span>E-Motor</span> <strong>Phản hồi tức thì</strong></li>
                    <li><span>Vòng tua</span> <strong>Lên đến 8,500 rpm</strong></li>
                </ul>
            </div>
        </div>

    </div>

    {{-- 3. INNOVATION GRID --}}
    <section class="innov-section">
        <div class="container">
            <h2 class="text-center mb-5" style="font-weight: 900; font-size: 2.5rem; color: #fff;">CÔNG NGHỆ BỔ TRỢ</h2>
            
            <div class="innov-grid">
                {{-- Card 1 --}}
                <div class="innov-card">
                    <div class="innov-icon"><i class="fas fa-dharmachakra"></i></div>
                    <h4 class="innov-title">Trợ Lực Lái Thủy Lực</h4>
                    <p class="innov-desc">
                        Trong khi thế giới chuyển sang trợ lực điện, McLaren kiên định giữ lại trợ lực thủy lực điện tử. Tại sao? Vì đó là cách duy nhất để người lái cảm nhận được từng rãnh nhỏ trên mặt đường qua vô lăng. Cảm xúc là thứ không thể thỏa hiệp.
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="innov-card">
                    
                    <div class="innov-icon"><i class="fas fa-network-wired"></i></div>
                    <h4 class="innov-title">Proactive Chassis Control II</h4>
                    <p class="innov-desc">
                        Hệ thống treo tiên tiến nhất thế giới. Các cảm biến đọc mặt đường và điều chỉnh giảm xóc trong vài mili-giây. PCC II loại bỏ thanh chống lật cứng nhắc, giúp xe êm ái như sedan hạng sang nhưng cứng vững như xe đua F1 khi vào cua.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="innov-card">
                    <div class="innov-icon"><i class="fas fa-microchip"></i></div>
                    <h4 class="innov-title">McLaren Infotainment (MIS II)</h4>
                    <p class="innov-desc">
                        Hệ thống giao diện người-máy (HMI) tập trung hoàn toàn vào người lái. Màn hình cảm ứng độ phân giải cao, phản hồi nhanh nhạy, tích hợp Telemetry để ghi lại dữ liệu vòng đua, giúp bạn phân tích và cải thiện kỹ năng lái xe.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection