@extends('admin.layouts.app')

@section('title', 'Thêm Xe Mới')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Thêm mẫu xe mới vào bộ sưu tập</h4>
        
        <button type="button" class="btn btn-warning" onclick="fillAllFields()">
            ⚡️ Điền Mẫu Nhanh (Dành cho thử nghiệm)
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    {{-- CỘT BÊN TRÁI: THÔNG TIN CƠ BẢN --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Xe (Ví dụ: 750S)</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- THÊM LỰA CHỌN TỰ ĐỘNG (SERIES) --}}
                        <div class="mb-3">
                            <label for="series" class="form-label">Series (Ví dụ: Super Series, Hybrid)</label>
                            <select class="form-control @error('series') is-invalid @enderror" id="series" name="series" required>
                                <option value="" disabled {{ old('series') ? '' : 'selected' }}>Chọn Series...</option>
                                <option value="Super Series" {{ old('series') == 'Super Series' ? 'selected' : '' }}>Super Series</option>
                                <option value="Ultimate Series" {{ old('series') == 'Ultimate Series' ? 'selected' : '' }}>Ultimate Series</option>
                                <option value="Sports Series" {{ old('series') == 'Sports Series' ? 'selected' : '' }}>Sports Series</option>
                                <option value="Hybrid Series" {{ old('series') == 'Hybrid Series' ? 'selected' : '' }}>Hybrid Series</option>
                            </select>
                            @error('series') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slogan" class="form-label">Slogan (Ví dụ: HIỆU SUẤT THUẦN KHIẾT.)</label>
                            <input type="text" class="form-control @error('slogan') is-invalid @enderror" id="slogan" name="slogan" value="{{ old('slogan') }}" required>
                            @error('slogan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="tagline" class="form-label">Tagline (Ví dụ: Nhẹ nhất. Mạnh nhất.)</label>
                            <input type="text" class="form-control" id="tagline" name="tagline" value="{{ old('tagline') }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả Chi tiết</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- PHẦN UPLOAD VÀ XEM TRƯỚC ẢNH --}}
                        <div class="mb-3">
                            <label for="image_file" class="form-label">Ảnh Hero (Yêu cầu)</label>
                            <input type="file" class="form-control @error('image_file') is-invalid @enderror" id="image_file" name="image_file" accept="image/*" required>
                            @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="mt-2" id="image_preview_container" style="display: none;">
                                <p class="small text-muted mb-1">Xem trước:</p>
                                <img id="image_preview" src="#" alt="Ảnh Hero Preview" style="max-width: 100%; height: auto; max-height: 200px; border-radius: 5px;">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="model_3d_url" class="form-label">URL Model 3D (Tùy chọn, vd: models/600lt.glb)</label>
                            <input type="text" class="form-control" id="model_3d_url" name="model_3d_url" value="{{ old('model_3d_url') }}">
                        </div>
                    </div>
                    
                    {{-- CỘT BÊN PHẢI: DỮ LIỆU JSON (THÔNG SỐ) --}}
                    <div class="col-md-6">
                        <h5 class="text-danger">Dữ liệu Thông số (JSON)</h5>
                        <p class="small text-muted">Sử dụng định dạng JSON cho các mảng phức tạp.</p>

                        <div class="mb-3">
                            <label for="stats_data" class="form-label">Stats (Công suất, 0-100km/h)</label>
                            <button type="button" class="btn btn-sm btn-outline-info float-end" onclick="fillStatsJson()">Điền mẫu Stats</button>
                            <textarea class="form-control @error('stats_data') is-invalid @enderror" id="stats_data" name="stats_data" rows="6" required>{{ old('stats_data') }}</textarea>
                            @error('stats_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="specs_data" class="form-label">Specs (Động cơ, Trọng lượng)</label>
                            <button type="button" class="btn btn-sm btn-outline-info float-end" onclick="fillSpecsJson()">Điền mẫu Specs</button>
                            <textarea class="form-control @error('specs_data') is-invalid @enderror" id="specs_data" name="specs_data" rows="6" required>{{ old('specs_data') }}</textarea>
                            @error('specs_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- 💡 UPLOAD ẢNH GALLERY MỚI --}}
                        <div class="mb-3">
                            <label for="gallery_files" class="form-label">Ảnh Gallery (Chọn nhiều file)</label>
                            <div class="alert alert-info py-2 small">
                                Sau khi upload, đường dẫn sẽ được lưu tự động.
                            </div>
                            <input type="file" class="form-control @error('gallery_files') is-invalid @enderror" id="gallery_files" name="gallery_files[]" accept="image/*" multiple>
                            @error('gallery_files') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            @error('gallery_files.*') <div class="text-danger small mt-1">Lỗi file: {{ $message }}</div> @enderror
                        </div>
                        
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-lg btn-mc">Lưu Mẫu Xe</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // 1. CHỨC NĂNG XEM TRƯỚC ẢNH HERO
    document.getElementById('image_file').addEventListener('change', function(event) {
        const preview = document.getElementById('image_preview');
        const container = document.getElementById('image_preview_container');
        const file = event.target.files[0];
        
        if (file) {
            preview.src = URL.createObjectURL(file);
            container.style.display = 'block';
        } else {
            preview.src = '#';
            container.style.display = 'none';
        }
    });

    // 2. CHỨC NĂNG ĐIỀN MẪU JSON RIÊNG LẺ
    
    const STATS_TEMPLATE = `[
    {
        "l": "Công suất (PS)",
        "v": 750
    },
    {
        "l": "0-100 km/h (s)",
        "v": 2.8,
        "d": true
    },
    {
        "l": "Tốc độ tối đa (km/h)",
        "v": 330
    }
]`;
    const SPECS_TEMPLATE = `{
    "Động cơ": "4.0L V8 Twin-Turbo",
    "Trọng lượng khô": "1,277 kg",
    "Hộp số": "7 cấp SSG",
    "Năm sản xuất": 2024
}`;

    function fillStatsJson() {
        document.getElementById('stats_data').value = STATS_TEMPLATE.trim();
    }

    function fillSpecsJson() {
        document.getElementById('specs_data').value = SPECS_TEMPLATE.trim();
    }
    
    // 💡 CHỨC NĂNG ĐIỀN MẪU TỔNG HỢP
    function fillAllFields() {
        // Điền các trường thông tin cơ bản
        document.getElementById('name').value = '750S';
        document.getElementById('slogan').value = 'HIỆU SUẤT THUẦN KHIẾT.';
        document.getElementById('tagline').value = 'Nhẹ nhất. Mạnh nhất.';
        document.getElementById('description').value = 'Mẫu xe kế thừa tinh hoa của Super Series, kết hợp trọng lượng siêu nhẹ và sức mạnh vượt trội.';
        document.getElementById('model_3d_url').value = 'models/750s.glb';

        // Chọn Series (Super Series)
        document.getElementById('series').value = 'Super Series';
        
        // Điền dữ liệu JSON
        document.getElementById('stats_data').value = STATS_TEMPLATE.trim();
        document.getElementById('specs_data').value = SPECS_TEMPLATE.trim();
        
        // Gợi ý cho người dùng cần thêm file ảnh
        alert('Đã điền thông tin và JSON mẫu. Vui lòng chọn FILE ẢNH Hero (image_file) và Gallery (gallery_files) trước khi lưu!');
    }
</script>
@endpush