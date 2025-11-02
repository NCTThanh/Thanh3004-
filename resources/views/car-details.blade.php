@extends('layouts.app')

@section('title', 'Chi Tiết Xe McLaren - [Tên Xe]')

{{-- CUSTOM STYLES CHO TRANG CHI TIẾT XE --}}
@section('styles')
<style>
    :root {
        /* Màu chủ đạo của McLaren */
        --color-mclaren-orange: #ff7f00; 
        --color-dark-bg: #111111;
        --color-card-bg: #1f1f1f; /* Màu nền cho card Facts */
        --color-light-gray: #f5f5f5; 
        --color-text-light: #e0e0e0;
        --color-separator: #444444;
    }
    .car-detail-page {
        background-color: var(--color-dark-bg);
        color: var(--color-text-light);
        padding: 0;
    }
    .car-detail-container h1, .car-detail-container h2, .car-detail-container h3, .section-heading {
        color: var(--color-text-light);
        font-weight: 700;
        line-height: 1.2;
    }

    /* === 1. HERO SECTION (ẢNH ĐẦU TRANG) === */
    .car-hero-section {
        position: relative;
        height: 80vh;
        overflow: hidden;
        margin-bottom: 50px;
        display: flex;
        align-items: flex-end;
    }
    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
        transition: opacity 0.5s;
    }
    .hero-content {
        position: relative;
        z-index: 10;
        padding: 4rem 15px;
        background: linear-gradient(to top, rgba(17, 17, 17, 0.9) 0%, rgba(17, 17, 17, 0.5) 40%, transparent 100%);
        width: 100%;
    }
    .hero-title {
        font-size: 4rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
    }
    .hero-series {
        color: var(--color-mclaren-orange) !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    
    /* === 2. FACTS & FIGURES & DOWNLOADS === */
    .facts-figures-container {
        padding: 4rem 0;
    }
    .facts-figures-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .facts-figures-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }
    .facts-card {
        background: var(--color-card-bg);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        min-height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
        transition: transform 0.3s;
    }
    .facts-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255, 127, 0, 0.2);
    }
    .fact-number {
        font-size: 4rem;
        font-weight: 900;
        color: var(--color-mclaren-orange);
        line-height: 1;
        position: relative;
        overflow: hidden; 
    }
    .fact-number span {
        display: block;
        transform: translateY(100%);
        transition: transform 1.5s ease-out;
    }
    .facts-card.counted .fact-number span {
        transform: translateY(0);
    }
    .fact-title {
        color: var(--color-text-light);
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 10px;
    }
    .fact-icon {
        color: #555;
        font-size: 1.5rem;
    }
    .download-card {
        background: #333;
        padding: 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        transition: background 0.3s;
    }
    .download-card:hover {
        background: #444;
    }
    .download-card a {
        color: var(--color-mclaren-orange);
        font-weight: 600;
    }
    .download-card i {
        color: var(--color-mclaren-orange);
    }


    /* === 3. 3D MODEL & VIDEO SECTION (NEW/UPDATED) === */
    .model-3d-section {
        background: var(--color-dark-bg);
        padding: 6rem 0;
    }
    .model-wrapper {
        position: relative;
        min-height: 500px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8);
        background-color: transparent; /* Đảm bảo wrapper trong suốt */
        height: 70vh; 
    }
    .video-wrapper {
        padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
        height: 0;
    }
    .video-asset {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        background-color: black;
    }
    /* Model Viewer Styles */
    model-viewer {
        width: 100%;
        height: 100%;
        --exposure: 1.2; 
        --shadow-color: rgba(0, 0, 0, 0.5);
        --progress-bar-color: var(--color-mclaren-orange);
        /* QUAN TRỌNG: Đặt màu nền của model-viewer trùng với màu nền section */
        --background-color: var(--color-dark-bg); 
    }
    /* Hotspot Styles */
    .Hotspot {
        display: block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid var(--color-mclaren-orange);
        background-color: rgba(255, 127, 0, 0.5);
        transition: transform 0.2s, background-color 0.2s;
        cursor: pointer;
        user-select: none;
        z-index: 100;
    }
    .Hotspot:hover {
        transform: scale(1.2);
        background-color: var(--color-mclaren-orange);
    }
    .HotspotAnimate {
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(255, 127, 0, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(255, 127, 0, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 127, 0, 0); }
    }
    /* Đã xóa CSS cho HotspotCard */

    /* === 4. DETAILED SECTIONS === */
    .detail-section-title {
        border-left: 5px solid var(--color-mclaren-orange);
        padding-left: 15px;
        margin-bottom: 2rem;
    }
    .car-specs li, .car-features li {
        padding: 15px 0;
        border-bottom: 1px solid var(--color-separator);
    }
    .car-specs li span {
        color: var(--color-mclaren-orange);
        font-weight: 700;
    }
    .car-specs li i {
        color: var(--color-mclaren-orange);
        margin-right: 10px;
    }
    .car-features li div i {
        color: var(--color-mclaren-orange);
        margin-right: 10px;
    }
    
    /* === 5. STICKY BAR FIXES === */
    @media (max-width: 991px) {
        .hero-title {
            font-size: 3rem;
        }
        .overview-slogan {
            font-size: 2rem;
        }
        .sticky-action-bar {
            z-index: 9999; 
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(17, 17, 17, 0.95);
            padding: 15px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        .car-detail-page {
            padding-bottom: 100px; 
        }
    }
</style>
@endsection

@section('content')

    {{-- HERO SECTION --}}
    <section class="car-hero-section" id="car-hero-section">
        <img id="hero-car-image" src="https://placehold.co/1920x1080/000/FFF?text=Loading+Car+Image" alt="McLaren Car Hero" class="hero-image">
        <div class="container hero-content">
            <p id="car-series-hero" class="hero-series">Đang tải...</p>
            <h1 id="car-name-hero" class="hero-title">Đang tải tên xe...</h1>
            <p id="car-tagline-hero" class="lead"></p>
            <a id="hero-contact-btn" href="{{ route('contact') }}?subject=Yêu cầu báo giá xe" class="btn btn-mclaren btn-lg mt-3">Yêu Cầu Báo Giá Ngay</a>
        </div>
    </section>

    {{-- OVERVIEW SECTION --}}
    <section class="overview-section">
        <div class="container overview-content">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 class="overview-slogan" id="car-slogan-dynamic">Sức Mạnh Tuyệt Đối, Kiểm Soát Hoàn Hảo.</h2>
                    {{-- Thư viện ảnh Thumbnail --}}
                    <div class="thumbnail-gallery mt-4" id="thumbnail-gallery">
                        {{-- Thumbnails sẽ được JS điền vào đây --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="detail-section-title"><i class="fas fa-info-circle"></i> Giới thiệu chung</h3>
                    <div id="car-description-long" class="car-description text-secondary">
                        <p>Đang tải thông tin chi tiết về xe...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FACTS & FIGURES & DOWNLOADS (DYNAMIC COUNTER) --}}
    <section class="performance-highlights facts-figures-container" id="performance-highlights">
        <div class="container">
            <div class="facts-figures-header">
                <h2 class="section-heading">THÔNG SỐ & DỮ LIỆU CỐT LÕI</h2>
                <a href="#full-specs" class="btn btn-mclaren-outline d-none d-lg-block">XEM TẤT CẢ THÔNG SỐ</a>
            </div>
            
            <div class="row g-4">
                {{-- Cột Facts & Figures (3/4) --}}
                <div class="col-lg-9">
                    <div class="facts-figures-grid" id="facts-figures-grid">
                        </div>
                </div>
                
                {{-- Cột Downloads (1/4) --}}
                <div class="col-lg-3">
                    <h3 class="text-white mb-3">TẢI XUỐNG</h3>
                    <div class="download-card">
                        <div>
                            <p class="text-white mb-0">Tài liệu Giới thiệu Xe</p>
                            <small class="text-muted">750S Product Brochure</small>
                        </div>
                        <a href="#download-link" class="download-link"><i class="fas fa-download"></i> TẢI XUỐNG</a>
                    </div>
                    <div class="download-card">
                        <div>
                            <p class="text-white mb-0">Bảng giá chính thức</p>
                            <small class="text-muted">Price List</small>
                        </div>
                        <a href="#download-link" class="download-link"><i class="fas fa-download"></i> TẢI XUỐNG</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- INTERACTIVE 3D MODEL SECTION (Thay thế hoàn toàn Video Section cũ) --}}
    <section class="model-3d-section">
        <div class="container">
            <h2 class="section-heading mb-4 text-center" id="media-section-title">Khám phá: Mô hình 3D Tương tác</h2>
            <div class="model-wrapper" id="model-wrapper">
                {{-- model-viewer sẽ được JS thêm src động --}}
                <model-viewer id="car-3d-model" 
                                src="" 
                                alt="McLaren 3D Model"
                                shadow-intensity="1" 
                                camera-controls 
                                auto-rotate 
                                ar
                                loading="eager"
                                data-poster="https://placehold.co/1200x675/111/FFF?text=Loading+3D+Model">
                    </model-viewer>

                {{-- Fallback (Hiển thị video nếu không có 3D asset) --}}
                <div id="video-fallback" class="video-wrapper d-none">
                    <video id="car-video-asset" class="video-asset" controls 
                        poster="https://placehold.co/1200x675/111/FFF?text=Loading+Video+Poster">
                        <source id="car-video-source" src="" type="video/mp4">
                        <p class="text-danger p-4">Trình duyệt của bạn không hỗ trợ thẻ video HTML5.</p>
                    </video>
                </div>
            </div>
        </div>
    </section>

    {{-- DETAILED SPECS AND FEATURES --}}
    <section class="detailed-specs py-5" id="full-specs">
        <div class="container">
            <h2 class="section-heading mb-5">ĐẶC TÍNH KỸ THUẬT & CÔNG NGHỆ</h2>
            <div class="row g-5">
                {{-- Cột Thông số Kỹ thuật Chi tiết --}}
                <div class="col-lg-6">
                    <h3 class="detail-section-title"><i class="fas fa-list-ul"></i> Thông số Kỹ thuật Chi tiết</h3>
                    <ul id="car-specs" class="car-specs">
                        {{-- Specs sẽ được JS điền vào đây --}}
                    </ul>
                </div>
                
                {{-- Cột Tính năng và Công nghệ --}}
                <div class="col-lg-6">
                    <h3 class="detail-section-title"><i class="fas fa-cogs"></i> Công nghệ & Tính năng Chính</h3>
                    <ul id="car-features-list" class="car-features">
                        {{-- Features sẽ được JS điền vào đây --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- CONTACT CTA (Desktop Only) --}}
    <div class="container pb-5 d-none d-lg-block">
        <div class="text-center pt-5">
            <a id="desktop-contact-btn" href="{{ route('contact') }}?subject=Yêu cầu báo giá xe" class="btn btn-mclaren btn-lg">YÊU CẦU BÁO GIÁ & TƯ VẤN</a>
        </div>
    </div>
    
@endsection

{{-- Vị trí cố định cho nút Báo Giá (Chỉ hiển thị trên mobile) --}}
<div class="sticky-action-bar d-lg-none">
    <a id="sticky-contact-btn" href="{{ route('contact') }}?subject=Yêu cầu báo giá xe" class="btn btn-mclaren btn-block">Yêu Cầu Báo Giá Ngay</a>
</div>


@section('scripts')
{{-- Thư viện Model Viewer của Google --}}
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
    // Dữ liệu mẫu cho các xe
    const carData = {
        // --- MẪU 600LT (MẪU CÓ MÔ HÌNH 3D CỦA BẠN) ---
        "600lt": {
            name: "600LT",
            series: "Sports Series",
            slogan: "SIÊU XE DƯỚI DẠNG LONGTAIL. TRẢI NGHIỆM ĐƯỜNG ĐUA.",
            tagline: "Chiếc Longtail thứ tư của McLaren, tập trung vào hiệu suất đường đua và cảm giác lái thuần khiết.",
            mainImage: "{{ asset('images/600lt-main.jpg') }}", // Thay bằng ảnh 600LT thực tế
            thumbnails: [
                "{{ asset('images/600lt-main.jpg') }}",
                "{{ asset('images/600lt-2.jpg') }}",
                "{{ asset('images/600lt-3.jpg') }}"
            ],
            description: "600LT là phiên bản Longtail của Sports Series, nổi bật với ống xả đặt trên đỉnh, trọng lượng giảm đáng kể và sức mạnh tăng cường. Nó mang lại cảm giác lái trên đường đua thuần khiết nhất trong phân khúc của mình.",
            descriptionLong: "McLaren 600LT là một tuyệt tác kỹ thuật, thừa hưởng di sản 'Longtail' của F1 GTR. Với ống xả Top-Exit độc đáo, nó không chỉ tạo ra âm thanh uy lực mà còn giúp giảm trọng lượng và tạo ra downforce hiệu quả. Giảm 96kg so với 570S Coupe, 600LT là siêu xe đường phố hợp pháp nhưng được sinh ra để thống trị đường đua.",
            specs: {
                "Động cơ": "3.8L Twin-Turbo V8",
                "Hộp số": "7 cấp SSG",
                "Công suất": "592 mã lực (600 PS)",
                "Mô-men xoắn": "620 Nm (457 lb ft)",
                "Trọng lượng khô": "1,247 kg",
                "Loại nhiên liệu": "Xăng không chì"
            },
            stats: [
                { title: "Tốc độ tối đa", value: 328, unit: "km/h", subUnit: "204 MPH", icon: "fas fa-tachometer-alt", isDecimal: false },
                { title: "Mô-men xoắn", value: 620, unit: "Nm", subUnit: "457 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Công suất", value: 600, unit: "PS", subUnit: "592 hp", icon: "fas fa-horse-head", isDecimal: false },
                { title: "0-100 km/h", value: 2.9, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true }
            ],
            features: [
                "Ống xả Top-Exit (đặt trên đỉnh) độc đáo.",
                "Khí động học Longtail tạo downforce cao hơn.",
                "Hệ thống phanh carbon-ceramic hiệu suất cao.",
                "Ghế đua carbon siêu nhẹ lấy từ P1.",
                "Khung gầm MonoCell II cứng cáp."
            ],
            videoAsset: "{{ asset('videos/mclaren-600lt.mp4') }}", // Giả định có video 600LT
            // DỮ LIỆU 3D VÀ HOTSPOT
            model3DAsset: "{{ asset('models/2019_mclaren_600lt.glb') }}", 
            hotspots: [
                { id: 'engine', position: "0.0 0.8 -0.9", normal: "0 0 1", title: "Động cơ Twin-Turbo V8", description: "Động cơ 3.8L V8 tăng áp kép được tinh chỉnh để đạt 600PS và 620Nm mô-men xoắn. Đây là trái tim của Longtail." },
                { id: 'wheel', position: "0.8 0.35 -0.6", normal: "1 0 0", title: "Phanh Carbon-Ceramic", description: "Phanh hiệu suất cao giúp giảm tốc tối đa, không bị phai nhiệt (fading). Thiết kế vành xe siêu nhẹ." },
                { id: 'aero', position: "-0.7 0.4 1.8", normal: "0 0 -1", title: "Bộ Chia Gió (Splitter) Carbon", description: "Tối ưu hóa luồng khí ở phần đầu, tăng lực ép xuống (downforce) để cải thiện độ bám đường ở tốc độ cao." },
                { id: 'exhaust', position: "0.0 1.2 -1.7", normal: "0 1 0", title: "Ống xả Top-Exit", description: "Thiết kế ống xả độc đáo đặt trên đỉnh, giúp giảm trọng lượng và rút ngắn đường ống xả, tăng âm thanh và hiệu suất." },
            ]
        },
        // --- CÁC MẪU XE KHÁC (GIỮ NGUYÊN) ---
        "720s": {
            name: "720S",
            series: "Super Series",
            slogan: "SỨC MẠNH VƯỢT TRỘI. THIẾT KẾ KHÍ ĐỘNG HỌC.",
            tagline: "Siêu xe định nghĩa lại phân khúc Super Series với sự kết hợp hoàn hảo giữa hiệu suất và sự tinh tế.",
            mainImage: "{{ asset('images/720s-1.webp') }}",
            thumbnails: [
                "{{ asset('images/720s-1.webp') }}",
                "{{ asset('images/720s-3.jpg') }}",
                "{{ asset('images/hinh2.webp') }}", 
                "{{ asset('images/hinh4.webp') }}" 
            ],
            description: "McLaren 720S là một siêu xe thể thao hiệu suất cao, thuộc Super Series của McLaren Automotive. Với động cơ V8 tăng áp kép 4.0 lít, sản sinh công suất 710 mã lực, 720S có thể tăng tốc từ 0 lên 100 km/h chỉ trong 2.9 giây. Thiết kế khí động học tiên tiến, khung gầm carbon nguyên khối MonoCage II, và nội thất tập trung vào người lái mang lại trải nghiệm lái xe đỉnh cao cả trên đường phố lẫn đường đua.",
            descriptionLong: "720S là hiện thân của triết lý 'Không có gì là không thể' của McLaren. Nó là sự kết hợp giữa sức mạnh 710 mã lực và khả năng kiểm soát tuyệt vời nhờ Hệ thống Kiểm soát Chủ động (PCC II). Phần đầu xe lấy cảm hứng từ cá mập trắng, mang lại vẻ ngoài mạnh mẽ và hiệu quả khí động học tối đa. Đây là siêu xe định nghĩa lại Super Series. Mỗi chi tiết đều phục vụ cho mục đích duy nhất: Tối ưu hóa hiệu suất và trải nghiệm lái.",
            specs: {
                "Động cơ": "4.0L Twin-Turbo V8",
                "Hộp số": "7 cấp SSG",
                "Công suất": "710 mã lực (720 PS)",
                "Mô-men xoắn": "770 Nm (568 lb ft)",
                "Trọng lượng khô": "1,283 kg",
                "Loại nhiên liệu": "Xăng không chì"
            },
            stats: [
                { title: "Tốc độ tối đa", value: 341, unit: "km/h", subUnit: "212 MPH", icon: "fas fa-tachometer-alt", isDecimal: false },
                { title: "Mô-men xoắn", value: 770, unit: "Nm", subUnit: "568 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Công suất", value: 720, unit: "PS", subUnit: "710 hp", icon: "fas fa-horse-head", isDecimal: false },
                { title: "0-100 km/h", value: 2.9, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true }
            ],
            features: [
                "Hệ thống kiểm soát chủ động (Proactive Chassis Control II) thế hệ thứ hai.",
                "Thiết kế khí động học chủ động với cánh gió sau tùy chỉnh.",
                "Khung gầm carbon nguyên khối MonoCage II nhẹ và cứng cáp.",
                "Ghế thể thao nhẹ, bọc da Alcantara và tùy chọn sợi carbon.",
                "Hệ thống phanh carbon-ceramic hiệu suất cao."
            ],
            videoAsset: "{{ asset('video/video.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        },
        "senna": {
            name: "Senna",
            series: "Ultimate Series",
            slogan: "THUẦN KHIẾT. KHÔNG THỎA HIỆP. TỐI THƯỢNG.",
            tagline: "Siêu xe được tạo ra chỉ với một mục đích: mang lại cảm giác lái trên đường đua thuần khiết nhất.",
            mainImage: "{{ asset('images/senna-1.jpg') }}", 
            thumbnails: [
                "{{ asset('images/senna-1.jpg') }}",
                "{{ asset('images/senna-2.jpg') }}",
                "{{ asset('images/senna-3.jpg') }}"
            ],
            description: "McLaren Senna là một siêu xe siêu hiếm, được đặt tên theo tay đua huyền thoại Ayrton Senna. Đây là một chiếc xe tập trung hoàn toàn vào hiệu suất trên đường đua, với trọng lượng siêu nhẹ, lực ép xuống mặt đường cực lớn và động cơ mạnh mẽ nhất của McLaren từng sản xuất.",
            descriptionLong: "Senna được sinh ra để trở thành chiếc xe đường phố tập trung vào đường đua tối thượng của McLaren. Mọi chi tiết, từ thiết kế cánh gió kép lớn cho đến vật liệu carbon MonoCage III siêu nhẹ, đều được tối ưu hóa để tạo ra lực ép xuống mặt đường (downforce) khổng lồ, lên đến 800 kg. Đây là di sản của Ayrton Senna, là cỗ máy tốc độ không khoan nhượng. Sản xuất giới hạn 500 chiếc.",
            specs: {
                "Động cơ": "4.0L Twin-Turbo V8",
                "Hộp số": "7 cấp SSG",
                "Công suất": "789 mã lực (800 PS)",
                "Mô-men xoắn": "800 Nm (590 lb ft)",
                "Trọng lượng khô": "1,198 kg",
                "Lực ép xuống tối đa": "800 kg"
            },
            stats: [
                { title: "Tốc độ tối đa", value: 340, unit: "km/h", subUnit: "211 MPH", icon: "fas fa-tachometer-alt", isDecimal: false },
                { title: "Mô-men xoắn", value: 800, unit: "Nm", subUnit: "590 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Công suất", value: 800, unit: "PS", subUnit: "789 hp", icon: "fas fa-horse-head", isDecimal: false },
                { title: "0-100 km/h", value: 2.8, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true }
            ],
            features: [
                "Khung gầm MonoCage III siêu nhẹ và cứng cáp.",
                "Hệ thống khí động học chủ động với cánh gió sau lớn tạo 800kg downforce.",
                "Hệ thống treo RaceActive Chassis Control II (RCC II).",
                "Lốp Pirelli P Zero Trofeo R đặc biệt tối ưu cho đường đua.",
                "Phanh carbon-ceramic hiệu suất cao với sáu piston."
            ],
            videoAsset: "{{ asset('videos/mclaren-senna.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        },
        "artura": {
            name: "Artura",
            series: "High-Performance Hybrid",
            slogan: "ĐIỆN KHÍ HÓA. TÁI ĐỊNH NGHĨA HIỆU SUẤT.",
            tagline: "Chiếc High-Performance Hybrid (HPH) đầu tiên của McLaren, đánh dấu một kỷ nguyên mới về công nghệ.",
            mainImage: "{{ asset('images/artura-2.jpg') }}",
            thumbnails: [
                "{{ asset('images/artura-2.jpg') }}", 
                "{{ asset('images/artura_1.webp') }}",
                "{{ asset('images/artura_3.jpg') }}"
            ],
            description: "McLaren Artura là chiếc High-Performance Hybrid (HPH) đầu tiên của McLaren, đánh dấu một kỷ nguyên mới về công nghệ và hiệu suất. Với động cơ V6 Twin-Turbo hoàn toàn mới kết hợp với một động cơ điện, Artura mang lại hiệu suất vượt trội cùng khả năng di chuyển hoàn toàn bằng điện trong một phạm vi nhất định.",
            descriptionLong: "Artura sử dụng kiến trúc Carbon Lightweight Architecture (MCLA) hoàn toàn mới, được thiết kế chuyên biệt cho hệ thống truyền động hybrid. Động cơ V6 nhẹ hơn V8 và tích hợp động cơ điện E-motor cho khả năng phản hồi tức thời. Artura là bước tiến quan trọng, mang lại sự phấn khích của siêu xe mà vẫn thân thiện với môi trường hơn. Đây là mẫu xe mở đường cho tương lai điện khí hóa của hãng.",
            specs: {
                "Động cơ": "2.9L Twin-Turbo V6 HPH",
                "Hộp số": "8 cấp SSG",
                "Tổng công suất": "671 mã lực (680 PS)",
                "Tổng mô-men xoắn": "720 Nm (531 lb ft)",
                "Phạm vi điện thuần": "30 km",
                "Trọng lượng khô": "1,395 kg"
            },
            stats: [
                { title: "Phạm vi EV", value: 30, unit: "km", subUnit: "20 Miles", icon: "fas fa-battery-half", isDecimal: false },
                { title: "Tổng Mô-men xoắn", value: 720, unit: "Nm", subUnit: "531 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Tổng Công suất", value: 680, unit: "PS", subUnit: "671 hp", icon: "fas fa-charging-station", isDecimal: false },
                { title: "Tốc độ tối đa", value: 330, unit: "km/h", subUnit: "205 MPH", icon: "fas fa-tachometer-alt", isDecimal: false }
            ],
            features: [
                "Hệ thống truyền động hybrid hiệu suất cao (HPH) với động cơ V6 mới.",
                "Khung gầm McLaren Carbon Lightweight Architecture (MCLA) thế hệ mới.",
                "Hộp số 8 cấp SSG loại bỏ bánh răng số lùi.",
                "Hệ thống thông tin giải trí MIS II với Apple CarPlay/Android Auto.",
                "Chế độ E-Mode cho phép di chuyển hoàn toàn bằng điện."
            ],
            videoAsset: "{{ asset('videos/mclaren-artura.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        },
        "gt": {
            name: "GT",
            series: "Grand Tourer",
            slogan: "HIỆU SUẤT SIÊU XE. TIỆN NGHI HOÀN HẢO.",
            tagline: "Chiếc Grand Tourer của McLaren, kết hợp tốc độ kinh ngạc với sự thoải mái vượt trội cho hành trình dài.",
            mainImage: "{{ asset('images/gt-4.jpg') }}",
            thumbnails: [
                "{{ asset('images/gt-4.jpg') }}",
                "{{ asset('images/gt_1.jpg') }}",
                "{{ asset('images/gt_2.jpg') }}",
                "{{ asset('images/gt-3.webp') }}"
            ],
            description: "McLaren GT định nghĩa lại khái niệm Grand Tourer với sự kết hợp độc đáo giữa hiệu suất siêu xe và sự tiện nghi cho những chuyến đi dài. Với động cơ V8 mạnh mẽ, không gian chứa đồ rộng rãi và nội thất sang trọng, GT mang đến trải nghiệm lái xe linh hoạt, mạnh mẽ và thoải mái.",
            descriptionLong: "GT là sự kết hợp độc đáo giữa khả năng vận hành của siêu xe và sự tiện nghi của Grand Tourer. Với khoang hành lý lớn hơn (lên đến 570 lít tổng cộng) và nội thất được bọc da Nappa cao cấp, GT là lựa chọn hoàn hảo cho những hành trình xuyên lục địa mà vẫn giữ được cảm giác lái phấn khích đặc trưng của McLaren. Thiết kế thanh lịch và ít góc cạnh hơn so với các mẫu Super Series, nhấn mạnh vào tính đa dụng.",
            specs: {
                "Động cơ": "4.0L Twin-Turbo V8",
                "Hộp số": "7 cấp SSG",
                "Công suất": "612 mã lực (620 PS)",
                "Mô-men xoắn": "630 Nm (465 lb ft)",
                "Trọng lượng khô": "1,530 kg",
                "Dung tích hành lý": "570 lít"
            },
            stats: [
                { title: "0-100 km/h", value: 3.2, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true },
                { title: "Mô-men xoắn", value: 630, unit: "Nm", subUnit: "465 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Công suất", value: 620, unit: "PS", subUnit: "612 hp", icon: "fas fa-horse-head", isDecimal: false },
                { title: "Dung tích hành lý", value: 570, unit: "Lít", subUnit: "Tổng cộng", icon: "fas fa-suitcase", isDecimal: false }
            ],
            features: [
                "Khoang hành lý rộng rãi với 420 lít phía sau và 150 lít phía trước.",
                "Nội thất sang trọng với vật liệu cao cấp, tùy chọn len cashmere.",
                "Hệ thống treo Proactive Damping Control (PDC) tối ưu cho đường trường.",
                "Ghế sưởi và thông gió mang lại sự thoải mái tối đa.",
                "Hệ thống thông tin giải trí tiên tiến và trực quan."
            ],
            videoAsset: "{{ asset('videos/mclaren-gt.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        },
        "elva": {
            name: "Elva",
            series: "Ultimate Series",
            slogan: "LÁI XE THUẦN KHIẾT. KẾT NỐI TỐI ĐA.",
            tagline: "Siêu xe không kính chắn gió, dành cho trải nghiệm lái xe kết nối trực tiếp với môi trường, sản xuất giới hạn.",
            mainImage: "{{ asset('images/mclaren-elva-1.jpg') }}",
            thumbnails: [
                "{{ asset('images/mclaren-elva-1.jpg') }}",
                "{{ asset('images/elva_1.jpg') }}",
                "{{ asset('images/elva_2.jpg') }}",
                "{{ asset('images/elva_3.jpg') }}"
            ],
            description: "McLaren Elva là một siêu xe Ultimate Series độc đáo, không có kính chắn gió và mui xe, mang lại trải nghiệm lái xe kết nối trực tiếp với môi trường. Được thiết kế để tối ưu hóa khí động học và trọng lượng nhẹ, Elva là biểu tượng của sự thuần khiết trong lái xe và là một tác phẩm nghệ thuật kỹ thuật.",
            descriptionLong: "Elva là sự tôn vinh chiếc xe đua M1A và là một phần của Ultimate Series. Điểm độc đáo nhất là Hệ thống Quản lý Không khí Chủ động (AAMS) tạo ra một 'bóng khí' ảo bảo vệ người ngồi trong xe mà không cần kính chắn gió truyền thống (trừ tùy chọn). Với trọng lượng dưới 1,300 kg và 804 mã lực, Elva mang đến hiệu suất lái xe không thể so sánh được. Đây là siêu xe dành cho những người tìm kiếm cảm giác lái nguyên bản nhất.",
            specs: {
                "Động cơ": "4.0L Twin-Turbo V8",
                "Hộp số": "7 cấp SSG",
                "Công suất": "804 mã lực (815 PS)",
                "Mô-men xoắn": "800 Nm (590 lb ft)",
                "Trọng lượng khô": "<1,300 kg",
                "Sản xuất giới hạn": "149 chiếc"
            },
            stats: [
                { title: "0-100 km/h", value: 2.8, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true },
                { title: "Công suất", value: 815, unit: "PS", subUnit: "804 hp", icon: "fas fa-horse-head", isDecimal: false },
                { title: "Mô-men xoắn", value: 800, unit: "Nm", subUnit: "590 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Trọng lượng khô", value: 1299, unit: "kg", subUnit: "ước tính", icon: "fas fa-weight-hanging", isDecimal: false }
            ],
            features: [
                "Thiết kế không kính chắn gió (có tùy chọn lắp thêm kính chắn gió cố định).",
                "Công nghệ AAMS (Active Air Management System) tạo 'bóng khí' bảo vệ.",
                "Khung gầm carbon nguyên khối siêu nhẹ.",
                "Hệ thống khí động học tiên tiến và tối ưu.",
                "Sản xuất giới hạn (chỉ 149 chiếc) mang tính độc quyền cao."
            ],
            videoAsset: "{{ asset('videos/mclaren-elva.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        },
        "P1": {
            name: "P1",
            series: "Ultimate Series",
            slogan: "HUYỀN THOẠI. NỀN MÓNG CỦA TƯƠNG LAI.",
            tagline: "Siêu xe hybrid tiên phong, một biểu tượng kỹ thuật đã đặt nền móng cho thế hệ siêu xe hiệu suất cao hiện đại.",
            mainImage: "{{ asset('images/p1.webp') }}",
            thumbnails: [
                "{{ asset('images/p1.webp') }}",
                "{{ asset('images/p1-2.webp') }}",
                "{{ asset('images/p1-3.webp') }}",
                "{{ asset('images/p1-4.jpg') }}"
            ],
            description: "McLaren P1 là một trong ba siêu xe hybrid tiên phong của thập kỷ, cùng với Ferrari LaFerrari và Porsche 918 Spyder. Đây là một siêu xe hiệu suất cao kết hợp động cơ xăng V8 tăng áp kép với một động cơ điện, mang lại công suất tổng hợp đáng kinh ngạc và hiệu suất đường đua phi thường.",
            descriptionLong: "Là mẫu xe đầu tiên trong Ultimate Series hiện đại, P1 được thiết kế để trở thành chiếc xe lái tốt nhất thế giới, cả trên đường phố lẫn đường đua. Hệ thống hybrid IPAS (Instant Power Assist System) cung cấp thêm 176 mã lực tức thời, mang lại cú hích vượt trội. Khí động học chủ động với cánh gió sau lớn có khả năng điều chỉnh và Chế độ Race Mode biến P1 thành một chiếc xe đua thực thụ. Sản xuất giới hạn 375 chiếc.",
            specs: {
                "Động cơ": "3.8L Twin-Turbo V8 HPH",
                "Hộp số": "7 cấp SSG",
                "Tổng công suất": "903 mã lực (916 PS)",
                "Tổng mô-men xoắn": "900 Nm (664 lb ft)",
                "Trọng lượng khô": "1,395 kg",
                "Sản xuất giới hạn": "375 chiếc"
            },
            stats: [
                { title: "Tốc độ tối đa", value: 350, unit: "km/h", subUnit: "217 MPH", icon: "fas fa-tachometer-alt", isDecimal: false },
                { title: "Tổng Mô-men xoắn", value: 900, unit: "Nm", subUnit: "664 lb ft", icon: "fas fa-wrench", isDecimal: false },
                { title: "Tổng Công suất", value: 916, unit: "PS", subUnit: "903 hp", icon: "fas fa-charging-station", isDecimal: false },
                { title: "0-100 km/h", value: 2.8, unit: "giây", subUnit: "", icon: "fas fa-rocket", isDecimal: true }
            ],
            features: [
                "Hệ thống truyền động hybrid hiệu suất cao (HPH) và hệ thống IPAS (Instant Power Assist System).",
                "Khí động học chủ động với DRS (Drag Reduction System) lấy cảm hứng từ F1.",
                "Khung gầm carbon MonoCage cứng cáp.",
                "Hệ thống phanh carbon-ceramic hiệu suất cao.",
                "Chế độ Race Mode giảm chiều cao xe và tăng lực ép xuống mặt đường."
            ],
            videoAsset: "{{ asset('videos/mclaren-p1.mp4') }}",
            model3DAsset: null, 
            hotspots: []
        }
    };

    // Ánh xạ icon cho thông số
    const specIcons = {
        "Động cơ": "fas fa-engine",
        "Hộp số": "fas fa-gear",
        "Công suất": "fas fa-horse-head",
        "Mô-men xoắn": "fas fa-wrench",
        "Trọng lượng khô": "fas fa-weight-hanging",
        "Loại nhiên liệu": "fas fa-gas-pump",
        "Tổng công suất": "fas fa-charging-station",
        "Tổng mô-men xoắn": "fas fa-wrench",
        "Phạm vi điện thuần": "fas fa-battery-half",
        "Lực ép xuống tối đa": "fas fa-grip-lines",
        "Dung tích hành lý": "fas fa-suitcase",
        "Sản xuất giới hạn": "fas fa-times"
    };

    // === HÀM THỰC HIỆN HIỆU ỨNG ĐẾM SỐ ===
    function startCounter(target, endValue, duration = 1800, isDecimal = false) {
        let startTimestamp = null;
        const startValue = 0;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            let value;
            if (isDecimal) {
                value = (startValue + progress * (endValue - startValue)).toFixed(1);
            } else {
                value = Math.floor(startValue + progress * (endValue - startValue));
            }

            target.textContent = value;

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                target.textContent = isDecimal ? endValue.toFixed(1) : endValue;
            }
        };
        window.requestAnimationFrame(step);
    }

    // === CHỨC NĂNG TẠO HOTSPOT (Đã được RÚT GỌN) ===
    function createHotspots(modelViewer, car) {
        // Xóa hotspots cũ
        modelViewer.querySelectorAll('.Hotspot').forEach(h => h.remove());

        if (!car.hotspots || car.hotspots.length === 0) return;
        
        // Thêm Hotspots mới
        car.hotspots.forEach(hotspot => {
            const hotspotElement = document.createElement('button');
            // Đặt slot cho Hotspot. Tên slot phải là 'hotspot-X'
            hotspotElement.slot = 'hotspot-' + hotspot.id; 
            hotspotElement.classList.add('Hotspot', 'HotspotAnimate');
            hotspotElement.setAttribute('data-position', hotspot.position);
            hotspotElement.setAttribute('data-normal', hotspot.normal);
            
            // XỬ LÝ CLICK: Chỉ chuyển camera, KHÔNG HIỂN THỊ CARD
            hotspotElement.addEventListener('click', (e) => {
                e.stopPropagation();
                // Chuyển camera đến vị trí Hotspot đã click
                modelViewer.cameraTarget = hotspot.position;
                // Nếu muốn có tooltip đơn giản của trình duyệt:
                hotspotElement.title = hotspot.title + ': ' + hotspot.description;
            });
            
            modelViewer.appendChild(hotspotElement);
            
            // Đã xóa phần tạo và logic xử lý Hotspot Card.
        });
    }

    
    // === CHỨC NĂNG CHÍNH ===
    document.addEventListener('DOMContentLoaded', () => {
        // Lấy model từ URL. Nếu $model không được truyền (trong Laravel), sử dụng 600LT làm mặc định để show 3D
        const urlParams = new URLSearchParams(window.location.search);
        const modelKey = "{{ $model ?? '' }}" || urlParams.get('model') || "600lt"; 
        const car = carData[modelKey];
        const modelViewer = document.getElementById('car-3d-model');
        const modelWrapper = document.getElementById('model-wrapper');
        const videoFallback = document.getElementById('video-fallback');
        const mediaTitle = document.getElementById('media-section-title');
        const videoSource = document.getElementById('car-video-source');


        if (car) {
            // 1. Cập nhật Tiêu đề & Hero Section (Giữ nguyên)
            document.title = `Chi Tiết Xe McLaren - ${car.name}`;
            document.getElementById('car-name-hero').textContent = car.name;
            document.getElementById('car-series-hero').textContent = car.series;
            document.getElementById('car-tagline-hero').textContent = car.tagline;
            document.getElementById('hero-car-image').src = car.mainImage;
            document.getElementById('car-slogan-dynamic').textContent = car.slogan;

            // 2. Cập nhật nút báo giá (Giữ nguyên)
            const contactSubject = `Yêu cầu báo giá xe ${car.name}`;
            document.getElementById('sticky-contact-btn').href = `{{ route('contact') }}?subject=${contactSubject}`;
            document.getElementById('desktop-contact-btn').href = `{{ route('contact') }}?subject=${contactSubject}`;
            document.getElementById('hero-contact-btn').href = `{{ route('contact') }}?subject=${contactSubject}`;


            // 3. Tạo và điền ảnh thumbnail (Giữ nguyên)
            const gallery = document.getElementById('thumbnail-gallery');
            gallery.innerHTML = ''; 
            car.thumbnails.forEach((image, index) => {
                const img = document.createElement('img');
                img.src = image; 
                img.alt = `${car.name} Thumbnail ${index + 1}`;
                
                if (index === 0) {
                    img.classList.add('active-thumbnail');
                }

                img.addEventListener('click', () => {
                    document.getElementById('hero-car-image').classList.add('image-transition-active'); 
                    setTimeout(() => {
                        document.getElementById('hero-car-image').src = image; 
                        document.getElementById('hero-car-image').alt = `${car.name} - ${image.split('/').pop()}`;
                        document.getElementById('hero-car-image').classList.remove('image-transition-active');

                        gallery.querySelectorAll('img').forEach(i => i.classList.remove('active-thumbnail'));
                        img.classList.add('active-thumbnail');
                    }, 200); 
                });
                gallery.appendChild(img);
            });


            // 4. Điền Facts & Figures (Dynamic Counter) (Giữ nguyên)
            const factsGrid = document.getElementById('facts-figures-grid');
            factsGrid.innerHTML = '';
            const counterElements = [];
            car.stats.forEach(stat => { /* ... (logic tạo card và counter) ... */
                const card = document.createElement('div');
                card.classList.add('facts-card');
                const html = `
                    <div>
                        <div class="fact-number" data-value="${stat.value}" data-is-decimal="${stat.isDecimal || false}"><span>0</span></div>
                        <span class="text-muted">${stat.unit}</span>
                    </div>
                    <div>
                        <p class="fact-title">${stat.title}</p>
                        <small class="text-secondary">${stat.subUnit || ''}</small>
                        <i class="${stat.icon} fact-icon"></i>
                    </div>
                `;
                card.innerHTML = html;
                factsGrid.appendChild(card);
                counterElements.push({element: card, target: card.querySelector('.fact-number span'), endValue: stat.value, isDecimal: stat.isDecimal || false});
            });
            // Áp dụng Intersection Observer cho counter
            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const card = entry.target;
                        if (!card.classList.contains('counted')) {
                            card.classList.add('counted');
                            const stat = counterElements.find(e => e.element === card);
                            startCounter(stat.target, stat.endValue, 1800, stat.isDecimal);
                        }
                    }
                });
            }, { threshold: 0.5 }); 
            counterElements.forEach(item => { counterObserver.observe(item.element); });
            
            // 5. Cập nhật Media Section (Ưu tiên 3D)
            if (car.model3DAsset) {
                // Kích hoạt 3D Model
                modelViewer.src = car.model3DAsset;
                modelViewer.poster = car.mainImage;
                modelViewer.style.display = 'block';
                videoFallback.classList.add('d-none');
                modelWrapper.classList.remove('video-wrapper'); // Đảm bảo dùng CSS 3D
                modelWrapper.classList.add('model-wrapper'); 
                mediaTitle.textContent = "Khám phá: Mô hình 3D Tương tác";
                
                // Thêm Hotspots sau khi model được tải
                modelViewer.addEventListener('load', () => {
                    createHotspots(modelViewer, car);
                });

            } else if (car.videoAsset) {
                // Kích hoạt Video Fallback
                modelViewer.style.display = 'none';
                videoFallback.classList.remove('d-none');
                modelWrapper.classList.add('video-wrapper'); // Đảm bảo dùng CSS video
                modelWrapper.classList.remove('model-wrapper'); 

                // Cập nhật video source
                videoSource.src = car.videoAsset;
                const videoElement = document.getElementById('car-video-asset');
                videoElement.poster = car.mainImage;
                videoElement.load();
                mediaTitle.textContent = "Khám phá: Video chi tiết";
            } else {
                 // Không có cả 3D lẫn Video
                 modelWrapper.style.display = 'none';
                 mediaTitle.textContent = "Thư viện ảnh";
            }
            
            // 6. Điền Mô tả & Tính năng/Thông số (Giữ nguyên)
            document.getElementById('car-description-long').innerHTML = `<p>${car.descriptionLong || car.description}</p>`;

            // Điền thông số kỹ thuật (Cột Trái)
            const specsList = document.getElementById('car-specs');
            specsList.innerHTML = ''; 
            for (const key in car.specs) {
                if (car.specs.hasOwnProperty(key)) {
                    const li = document.createElement('li');
                    const iconClass = specIcons[key] || "fas fa-check-circle"; 
                    
                    li.innerHTML = `
                        <div><i class="${iconClass}"></i> <strong>${key}</strong></div> 
                        <span>${car.specs[key]}</span>
                    `;
                    specsList.appendChild(li);
                }
            }

            // Điền các tính năng (Cột Phải)
            const featuresList = document.getElementById('car-features-list');
            featuresList.innerHTML = ''; 
            car.features.forEach(feature => {
                const li = document.createElement('li');
                li.innerHTML = `<div><i class="fas fa-check-circle"></i> ${feature}</div>`;
                featuresList.appendChild(li);
            });

        } else {
            // Xử lý trường hợp không tìm thấy mẫu xe (Giữ nguyên)
            document.querySelector('.car-hero-section').remove();
            document.querySelector('.car-detail-page').innerHTML = `
                <section class="car-detail-section py-5">
                    <div class="container text-center">
                        <h2 class="text-white">Không tìm thấy thông tin về mẫu xe này.</h2>
                        <p class="text-muted">Vui lòng kiểm tra lại đường dẫn hoặc chọn một mẫu xe khác.</p>
                        <a href="{{ route('cars') }}" class="btn btn-mclaren mt-3">Quay lại trang Xe</a>
                    </div>
                </section>
            `;
            document.querySelector('.sticky-action-bar').remove();
            document.querySelector('.container.pb-5.d-none.d-lg-block').remove();
        }
    });
</script>
@endsection