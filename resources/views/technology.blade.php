@extends('layouts.app')

@section('title', 'Công Nghệ - Tinh Hoa Kỹ Thuật')

@section('styles')
<style>
    /* Styling riêng cho trang Công nghệ */
    .tech-header {
        background: var(--color-surface);
        padding: 120px 0 60px;
        border-bottom: 1px solid var(--color-border);
    }
    .tech-title {
        color: var(--color-mclaren-orange);
        font-weight: 900;
        font-size: 3rem;
        text-transform: uppercase;
    }
    .tech-subtitle {
        color: var(--color-text-secondary);
        font-size: 1.25rem;
    }
    .tech-section-content {
        padding: 60px 0;
    }
    .tech-feature-card {
        background-color: var(--color-surface-light);
        border-radius: 12px;
        padding: 30px;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid var(--color-border);
    }
    .tech-feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(228, 0, 43, 0.2);
    }
    .tech-feature-card h4 {
        color: var(--color-mclaren-orange);
        font-weight: 800;
        margin-top: 15px;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .tech-feature-card p {
        color: var(--color-text-secondary);
    }
    .tech-image {
        border-radius: 8px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.4);
    }
</style>
@endsection

@section('content')

    <section class="tech-header text-center">
        <div class="container">
            <h1 class="tech-title">TINH HOA KỸ THUẬT MCLAREN</h1>
            <p class="tech-subtitle mt-3">
                Sự kết hợp hoàn hảo giữa công nghệ đua xe F1 và đổi mới vật liệu.
            </p>
        </div>
    </section>

    <section class="tech-section-content">
        <div class="container">
            <div class="row mb-5 pb-5 border-bottom border-secondary-subtle">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img 
                        src="https://placehold.co/800x500/1C1C1C/E4002B?text=Monocell+Chassis" 
                        class="img-fluid tech-image" 
                        alt="Khung gầm Monocell bằng sợi carbon"
                    >
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h2 style="color: var(--color-mclaren-orange);">01. KHUNG GẦM MONOCELL & MONOCAGE</h2>
                    <h3 class="display-6 fw-bold mb-4">Carbon Fibre: Trái tim nhẹ và cứng cáp.</h3>
                    <p class="text-secondary fs-5">
                        Mọi chiếc xe McLaren đều thừa hưởng di sản từ F1 với khung gầm liền khối bằng sợi carbon. Công nghệ Monocell và Monocage (dành cho các mẫu xe mui trần/Ultimate) là nền tảng của triết lý kỹ thuật McLaren: đạt độ cứng xoắn cực đại để xử lý chính xác và an toàn tuyệt đối, trong khi giữ trọng lượng ở mức tối thiểu.
                    </p>
                    <p class="text-secondary">
                        Độ cứng vững này cho phép các kỹ sư tinh chỉnh hệ thống treo một cách hoàn hảo, mang lại cảm giác lái chân thật và khả năng phản hồi tức thì mà không chiếc xe nào khác có được.
                    </p>
                </div>
            </div>

            <div class="row mb-5 pb-5 border-bottom border-secondary-subtle flex-row-reverse">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img 
                        src="https://placehold.co/800x500/1C1C1C/E4002B?text=McLaren+V8+Engine" 
                        class="img-fluid tech-image" 
                        alt="Động cơ V8 Twin-Turbo"
                    >
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center pe-lg-5">
                    <h2 style="color: var(--color-mclaren-orange);">02. ĐỘNG CƠ CÔNG SUẤT CAO</h2>
                    <h3 class="display-6 fw-bold mb-4">Sức mạnh V8 Twin-Turbo & Hệ thống Hybrid E-Motor.</h3>
                    <p class="text-secondary fs-5">
                        Động cơ M840T V8 Twin-Turbo 4.0L là biểu tượng của sức mạnh McLaren, cung cấp công suất tức thì và mô-men xoắn khổng lồ ở mọi dải vòng tua. 
                    </p>
                    <p class="text-secondary">
                        Với sự ra đời của dòng Artura, McLaren đã tiên phong với hệ thống High-Performance Hybrid (HPH), kết hợp động cơ V6 nhỏ gọn hơn với động cơ điện E-Motor, mang lại hiệu suất bùng nổ mà vẫn giữ được tính thực dụng và hiệu quả nhiên liệu. Công nghệ điện khí hóa này không chỉ là tương lai mà còn là cách để tối ưu hóa hiệu suất truyền thống.
                    </p>
                </div>
            </div>

            <h2 class="text-center section-heading my-5" style="color: var(--color-text-primary);">CÁC TRỤ CỘT KỸ THUẬT KHÁC</h2>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="tech-feature-card">
                        <i class="fas fa-wind fa-3x" style="color: var(--color-mclaren-orange);"></i>
                        <h4>Khí Động Học Chủ Động</h4>
                        <p>Các cánh gió chủ động (Active Aero), phanh gió và ống dẫn khí được thiết kế để điều chỉnh lực ép (downforce) và lực cản (drag) theo thời gian thực, đảm bảo sự cân bằng hoàn hảo giữa tốc độ và độ bám đường ở mọi dải tốc độ.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tech-feature-card">
                        <i class="fas fa-cogs fa-3x" style="color: var(--color-mclaren-orange);"></i>
                        <h4>Proactive Chassis Control (PCC)</h4>
                        <p>Hệ thống treo thông minh PCC loại bỏ thanh chống lật truyền thống, thay vào đó sử dụng hệ thống thủy lực phức tạp để kiểm soát độ nghiêng thân xe. Điều này mang lại sự thoải mái tuyệt vời trên đường thường nhưng vẫn giữ được độ cứng cáp tuyệt đối khi vào cua tốc độ cao.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tech-feature-card">
                        <i class="fas fa-tachometer-alt fa-3x" style="color: var(--color-mclaren-orange);"></i>
                        <h4>Phanh Carbon Ceramic</h4>
                        <p>Sử dụng vật liệu gốm carbon cao cấp nhất, hệ thống phanh McLaren đảm bảo khả năng dừng xe mạnh mẽ, ổn định ngay cả khi hoạt động ở nhiệt độ cực cao trên đường đua, đồng thời giảm trọng lượng không cần thiết.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
