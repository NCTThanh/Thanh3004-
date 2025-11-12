@extends('layouts.app')

@section('title', 'Xe McLaren')

@push('styles')
<style>
    .cars-page-header {
        height: 50vh;
        background: url('{{ asset('images/cars-header-bg.jpg') }}') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
    }
    .cars-page-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
    }
    .cars-page-header h1 {
        z-index: 1;
        color: #fff;
        font-size: 4rem;
        font-weight: 800;
    }

    .filter-bar {
        background-color: var(--color-surface);
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 3rem;
        position: sticky;
        top: 80px; /* Dưới navbar */
        z-index: 100;
        border: 1px solid var(--color-border);
    }
    .filter-bar .nav-pills .nav-link {
        color: var(--color-text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }
    .filter-bar .nav-pills .nav-link.active,
    .filter-bar .nav-pills .nav-link:hover {
        color: #fff;
        background-color: var(--color-mclaren-orange);
    }

    .car-listing-card {
        background-color: var(--color-surface);
        border: 1px solid var(--color-border);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .car-listing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        border-color: var(--color-mclaren-orange);
    }
    .car-listing-image {
        width: 100%;
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    .car-listing-image .car-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background-color: var(--color-mclaren-orange);
        color: #fff;
        padding: 5px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 50px;
        text-transform: uppercase;
    }
    .car-listing-content {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .car-listing-content h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .car-listing-content .car-description {
        color: var(--color-text-secondary);
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }
    .car-specs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }
    .car-spec-item {
        font-size: 0.9rem;
    }
    .car-spec-item strong {
        display: block;
        font-size: 1.2rem;
        color: var(--color-text-primary);
        font-weight: 700;
    }
    .car-spec-item span {
        color: var(--color-text-secondary);
        text-transform: uppercase;
        font-size: 0.7rem;
    }
    .car-listing-footer {
        border-top: 1px solid var(--color-border);
        padding-top: 1.5rem;
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .car-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-mclaren-orange);
    }
    .car-price span {
        font-size: 0.9rem;
        color: var(--color-text-secondary);
        font-weight: 400;
    }
</style>
@endpush

@section('content')

    <section class="cars-page-header">
        <h1>Các Dòng Xe McLaren</h1>
    </section>

    <div class="container py-5">

        <div class="filter-bar reveal">
            <ul class="nav nav-pills justify-content-center" id="carFilter">
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-filter="all">Tất Cả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-filter="supercar">Supercar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-filter="gt">GT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-filter="hybrid">Hybrid</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-filter="ultimate">Ultimate</a>
                </li>
            </ul>
        </div>

        <div class="car-listing-container">
            <div class="row">
                
                <div class="col-lg-6 car-item-card reveal" data-category="supercar">
                    <div class="car-listing-card">
                        <div class="car-listing-image" style="background-image: url('{{ asset('images/750s-card.jpg') }}');">
                            <span class="car-tag">Supercar</span>
                        </div>
                        <div class="car-listing-content">
                            <h2>McLaren 750S</h2>
                            <p class="car-description">Hiệu suất thuần khiết. 750S được tạo ra để mang lại trải nghiệm lái mãnh liệt nhất, với trọng lượng nhẹ và động cơ V8 mạnh mẽ.</p>
                            <div class="car-specs-grid">
                                <div class="car-spec-item"><strong>740 HP</strong><span>Công Suất</span></div>
                                <div class="car-spec-item"><strong>2.8 S</strong><span>0-100 km/h</span></div>
                                <div class="car-spec-item"><strong>332 km/h</strong><span>Tốc Độ Tối Đa</span></div>
                            </div>
                            <div class="car-listing-footer">
                                <div class="car-price"><span>Từ</span> $324,000</div>
                                {{-- SỬA LỖI: Thay 'model' bằng 'car' --}}
                                <a href="{{ route('car.details', ['modelKey' => '750s']) }}" class="btn btn-mclaren-outline">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 car-item-card reveal" data-category="hybrid">
                    <div class="car-listing-card">
                        <div class="car-listing-image" style="background-image: url('{{ asset('images/artura-card.jpg') }}');">
                            <span class="car-tag">Hybrid</span>
                        </div>
                        <div class="car-listing-content">
                            <h2>McLaren Artura</h2>
                            <p class="car-description">Cách mạng hybrid hiệu suất cao. Kết hợp động cơ V6 tăng áp kép hoàn toàn mới với mô-tơ điện E-motor cho phản ứng tức thì.</p>
                            <div class="car-specs-grid">
                                <div class="car-spec-item"><strong>671 HP</strong><span>Công Suất (Tổng)</span></div>
                                <div class="car-spec-item"><strong>3.0 S</strong><span>0-100 km/h</span></div>
                                <div class="car-spec-item"><strong>330 km/h</strong><span>Tốc Độ Tối Đa</span></div>
                            </div>
                            <div class="car-listing-footer">
                                <div class="car-price"><span>Từ</span> $237,500</div>
                                {{-- SỬA LỖI: Thay 'model' bằng 'car' --}}
                                <a href="{{ route('car.details', ['modelKey' => 'artura']) }}" class="btn btn-mclaren-outline">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 car-item-card reveal" data-category="gt">
                    <div class="car-listing-card">
                        <div class="car-listing-image" style="background-image: url('{{ asset('images/gts-card.jpg') }}');">
                            <span class="car-tag">GT</span>
                        </div>
                        <div class="car-listing-content">
                            <h2>McLaren GTS</h2>
                            <p class="car-description">Siêu xe cho mỗi ngày. Kết hợp sự sang trọng, không gian và tính linh hoạt của một chiếc Grand Tourer với hiệu suất của McLaren.</p>
                            <div class="car-specs-grid">
                                <div class="car-spec-item"><strong>626 HP</strong><span>Công Suất</span></div>
                                <div class="car-spec-item"><strong>3.2 S</strong><span>0-100 km/h</span></div>
                                <div class="car-spec-item"><strong>326 km/h</strong><span>Tốc Độ Tối Đa</span></div>
                            </div>
                            <div class="car-listing-footer">
                                <div class="car-price"><span>Từ</span> $220,000</div>
                                {{-- SỬA LỖI: Thay 'model' bằng 'car'. (Và dùng 'gt' để khớp với data trong car-details) --}}
                                <a href="{{ route('car.details', ['modelKey' => 'gt']) }}" class="btn btn-mclaren-outline">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 car-item-card reveal" data-category="ultimate">
                    <div class="car-listing-card">
                        <div class="car-listing-image" style="background-image: url('{{ asset('images/senna-card.jpg') }}');">
                            <span class="car-tag">Ultimate</span>
                        </div>
                        <div class="car-listing-content">
                            <h2>McLaren Senna</h2>
                            <p class="car-description">Cỗ máy đường đua tối thượng. Được thiết kế để trở thành chiếc xe hợp pháp trên đường phố nhanh nhất trên đường đua.</p>
                            <div class="car-specs-grid">
                                <div class="car-spec-item"><strong>789 HP</strong><span>Công Suất</span></div>
                                <div class="car-spec-item"><strong>2.8 S</strong><span>0-100 km/h</span></div>
                                <div class="car-spec-item"><strong>340 km/h</strong><span>Tốc Độ Tối Đa</span></div>
                            </div>
                            <div class="car-listing-footer">
                                <div class="car-price"><span>Từ</span> $1,000,000+</div>
                                {{-- SỬA LỖI: Thay 'model' bằng 'car' --}}
                                <a href="{{ route('car.details', ['modelKey' => 'senna']) }}" class="btn btn-mclaren-outline">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterLinks = document.querySelectorAll('#carFilter .nav-link');
        const carCards = document.querySelectorAll('.car-item-card');

        filterLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                
                // Cập nhật active class cho bộ lọc
                filterLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                const filter = this.getAttribute('data-filter');

                // Lọc danh sách xe
                carCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    if (filter === 'all' || filter === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>
@endpush