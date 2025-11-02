@extends('layouts.app')

@section('title', 'Hệ Thống Đại Lý Chính Thức')

{{-- Thêm CSS riêng cho trang Đại lý --}}
@section('styles')
{{-- (Giữ nguyên phần CSS của bạn) --}}
<style>
.retailers-section {
    padding-top: 50px;
    padding-bottom: 50px;
}

/* Container cho bản đồ */
.map-container {
    height: 500px;
    width: 100%;
    margin: 30px 0;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    border: 2px solid var(--color-mclaren-orange); /* Nổi bật bản đồ */
}

.retailer-list {
    margin-top: 40px;
}

.retailer-list h3 {
    font-size: 1.8rem;
    color: var(--color-mclaren-orange);
    margin-bottom: 20px;
    border-bottom: 2px solid var(--color-border);
    padding-bottom: 10px;
    text-transform: uppercase;
}

/* Card thông tin Đại lý */
.retailer-card {
    background-color: var(--color-surface-dark);
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border-left: 5px solid var(--color-mclaren-orange);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s;
}

.retailer-card:hover {
    transform: translateY(-3px);
}

.retailer-card h4 {
    color: var(--color-text-light);
    font-weight: 700;
    margin-bottom: 10px;
}

.retailer-card p {
    color: var(--color-text-faded);
    margin-bottom: 5px;
}
</style>
@endsection

@section('content')

<section class="content-section retailers-section">
    <h2 class="section-title">Tìm Đại Lý McLaren Gần Nhất</h2>
    <p class="subtitle">Đến và trải nghiệm thế giới McLaren tại các showroom chính hãng của chúng tôi.</p>

    <div id="map" class="map-container"></div>
    
    <div class="retailer-list row">
        <div class="col-12">
              <h3>Các Địa Điểm Chính Thức</h3>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="retailer-card" data-lat="10.7769" data-lng="106.7009" data-name="McLaren Sài Gòn">
                <h4>McLaren Sài Gòn (Flagship)</h4>
                <p><strong>Địa chỉ:</strong> Deutsches Haus, 33 Lê Duẩn, Quận 1, TP. Hồ Chí Minh</p>
                <p><strong>Hotline:</strong> (028) 38XX.XXXX</p>
                <p><strong>Giờ làm việc:</strong> 9:00 - 18:00 (Thứ Hai - Thứ Bảy)</p>
                <a href="{{ route('contact') }}?subject=Yêu cầu ghé thăm đại lý Sài Gòn" class="btn-link" style="color: var(--color-mclaren-orange);">Yêu cầu ghé thăm</a>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="retailer-card" data-lat="21.0285" data-lng="105.8542" data-name="McLaren Hà Nội">
                <h4>McLaren Hà Nội</h4>
                <p><strong>Địa chỉ:</strong> Quận Hoàn Kiếm, Hà Nội (Địa điểm tạm thời)</p>
                <p><strong>Hotline:</strong> (024) 37XX.XXXX</p>
                <p><strong>Giờ làm việc:</strong> 9:00 - 17:30 (Thứ Hai - Thứ Sáu)</p>
                <a href="{{ route('contact') }}?subject=Yêu cầu ghé thăm đại lý Hà Nội" class="btn-link" style="color: var(--color-mclaren-orange);">Yêu cầu ghé thăm</a>
            </div>
        </div>
    </div>
</section>

@endsection

{{-- Script Google Maps --}}
@section('scripts')
<script>
    // Dữ liệu vị trí Đại lý
    const retailers = [
        { lat: 10.7769, lng: 106.7009, name: "McLaren Sài Gòn", style: "Flagship" },
        { lat: 21.0285, lng: 105.8542, name: "McLaren Hà Nội", style: "Showroom" }
    ];

    function initMap() {
        // Thiết lập vị trí trung tâm (giữa Sài Gòn và Hà Nội)
        const center = { lat: 15.0, lng: 107.5 };

        // Tạo bản đồ
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 6, // Zoom ban đầu
            center: center,
            minZoom: 6,
            // Thiết lập style bản đồ Tối (Dark)
            styles: [
                { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
                { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
                { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                {
                    featureType: "administrative.locality",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#d59563" }],
                },
                {
                    featureType: "poi",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#d59563" }],
                },
                {
                    featureType: "poi.park",
                    elementType: "geometry",
                    stylers: [{ color: "#263c3f" }],
                },
                {
                    featureType: "poi.park",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#6b9a76" }],
                },
                {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{ color: "#38414e" }],
                },
                {
                    featureType: "road",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#212a37" }],
                },
                {
                    featureType: "road",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#9ca5b3" }],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{ color: "#746855" }],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{ color: "#1f2835" }],
                },
                {
                    featureType: "road.highway",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#f3d19c" }],
                },
                {
                    featureType: "transit",
                    elementType: "geometry",
                    stylers: [{ color: "#2f3948" }],
                },
                {
                    featureType: "transit.station",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#d59563" }],
                },
                {
                    featureType: "water",
                    elementType: "geometry",
                    stylers: [{ color: "#17263c" }],
                },
                {
                    featureType: "water",
                    elementType: "labels.text.fill",
                    stylers: [{ color: "#515c6d" }],
                },
                {
                    featureType: "water",
                    elementType: "labels.text.stroke",
                    stylers: [{ color: "#17263c" }],
                },
            ],
        });

        // Thêm marker cho từng đại lý
        retailers.forEach(({ lat, lng, name, style }) => {
            const marker = new google.maps.Marker({
                position: { lat, lng },
                map: map,
                title: name,
                // Thay đổi icon thành màu cam (hoặc đỏ McLaren)
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path fill="#E4002B" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>',
                    scaledSize: new google.maps.Size(30, 30)
                }
            });

            // Thêm cửa sổ thông tin khi click vào marker
            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="color: #000;"><h3>${name}</h3><p><strong>${style}</strong></p></div>`,
            });

            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        });
    }

    // Gắn hàm initMap vào window để được gọi khi Google Maps API tải xong
    window.initMap = initMap;
</script>

{{-- Tải Google Maps API. Vấn đề nằm ở cấu hình Key API, không phải code này. --}}
<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUrpCSFcnx_ulYV9SMU_cgF3e0YlRO8Sg&callback=initMap&v=weekly"
    defer
></script>

@endsection