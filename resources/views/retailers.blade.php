@extends('layouts.app')
@section('title', 'Hệ Thống Đại Lý Chính Thức')

@section('styles')
<style>
.retailers-section { padding: 50px 0; }
.map-container { height: 500px; width: 100%; margin: 30px 0; border-radius: 12px; border: 2px solid var(--mclaren-orange); }
.retailer-list h3 { color: var(--mclaren-orange); border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 30px; }
.retailer-card { background: #111; padding: 20px; margin-bottom: 20px; border-left: 5px solid var(--mclaren-orange); cursor: pointer; transition: 0.3s; }
.retailer-card:hover { transform: translateX(10px); background: #1a1a1a; }
.retailer-card h4 { color: #fff; font-weight: 700; }
.retailer-card p { color: #888; margin-bottom: 5px; }
</style>
@endsection

@section('content')
<section class="container retailers-section">
    <h2 class="text-white display-5 fw-bold text-center">TÌM ĐẠI LÝ GẦN NHẤT</h2>
    <div id="map" class="map-container"></div> 
    
    <div class="retailer-list row">
        <div class="col-12"><h3>ĐỊA ĐIỂM CHÍNH THỨC</h3></div>
        @foreach($retailers as $shop)
        <div class="col-lg-6">
            {{-- Thêm sự kiện click để zoom map tới đại lý --}}
            <div class="retailer-card" onclick="focusMap({{ $shop->lat }}, {{ $shop->lng }})">
                <h4>{{ $shop->name }}</h4>
                <p><strong>Địa chỉ:</strong> {{ $shop->address }}</p>
                <p><strong>Hotline:</strong> {{ $shop->phone }}</p>
                <p class="text-warning small text-uppercase">{{ $shop->type }}</p>
                <a href="{{ route('contact') }}?subject=Hẹn gặp tại {{ $shop->name }}" class="text-danger text-decoration-none fw-bold">Đặt lịch hẹn <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Nhận dữ liệu từ Laravel Controller
    const retailers = @json($retailers);
    let map;

    function initMap() {
        const center = { lat: 16.0, lng: 106.0 }; // Center Vietnam
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5, center: center,
            styles: [ { elementType: "geometry", stylers: [{ color: "#242f3e" }] }, { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] } ] // Dark mode map
        });

        retailers.forEach(shop => {
            const marker = new google.maps.Marker({
                position: { lat: parseFloat(shop.lat), lng: parseFloat(shop.lng) },
                map: map, title: shop.name
            });
            
            const infoWindow = new google.maps.InfoWindow({
                content: `<div style="color:#000"><b>${shop.name}</b><br>${shop.address}</div>`
            });

            marker.addListener("click", () => infoWindow.open(map, marker));
        });
    }

    // Hàm gọi từ thẻ HTML
    window.focusMap = function(lat, lng) {
        map.setCenter({ lat: parseFloat(lat), lng: parseFloat(lng) });
        map.setZoom(15);
    }
    
    window.initMap = initMap;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ $mapApiKey }}&callback=initMap&v=weekly" defer></script>
@endsection