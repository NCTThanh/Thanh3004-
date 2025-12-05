@extends('admin.layouts.app')

@section('title', 'Chỉnh Sửa Xe: ' . $car->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Chỉnh sửa thông tin xe: <span class="text-primary">{{ $car->name }}</span></h4>
        <button type="button" class="btn btn-warning" onclick="fillCarData('{{ $car->model_key }}')">
            ⚡️ Điền Mẫu Nhanh
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            
            <form action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- CỘT BÊN TRÁI --}}
                    <div class="col-md-6">
                        {{-- 💡 BỔ SUNG: KHÔI PHỤC DỮ LIỆU CƠ BẢN --}}
                        <div class="mb-3"><label for="name" class="form-label">Tên Xe</label><input type="text" class="form-control" id="name" name="name" value="{{ old('name', $car->name) }}" required></div>
                        <div class="mb-3"><label for="series" class="form-label">Series</label><input type="text" class="form-control" id="series" name="series" value="{{ old('series', $car->series) }}" required></div>
                        <div class="mb-3"><label for="slogan" class="form-label">Slogan</label><input type="text" class="form-control" id="slogan" name="slogan" value="{{ old('slogan', $car->slogan) }}" required></div>
                        <div class="mb-3"><label for="tagline" class="form-label">Tagline</label><input type="text" class="form-control" id="tagline" name="tagline" value="{{ old('tagline', $car->tagline) }}"></div>
                        <div class="mb-3"><label for="description" class="form-label">Mô tả Chi tiết</label><textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $car->description) }}</textarea></div>
                        
                        {{-- 💡 Trường ảnh Hero, Model 3D... --}}
                        <div class="mb-3">
                            <label for="image_file" class="form-label">Ảnh Hero (Cập nhật)</label>
                            @if($car->image_url)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $car->image_url) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                                    <span class="text-muted small ms-2">Ảnh hiện tại</span>
                                </div>
                            @endif
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                        </div>
                        
                        <div class="mb-3">
                            <label for="model_3d_url" class="form-label">URL Model 3D</label>
                            <input type="text" class="form-control" id="model_3d_url" name="model_3d_url" value="{{ old('model_3d_url', $car->model_3d_url) }}">
                        </div>
                    </div>
                    
                    {{-- CỘT BÊN PHẢI: DỮ LIỆU JSON & GALLERY --}}
                    <div class="col-md-6">
                        <h5 class="text-danger">Dữ liệu Thông số (JSON)</h5>

                        <div class="mb-3">
                            <label for="stats_data" class="form-label">Stats (Công suất, 0-100km/h)</label>
                            {{-- 💡 SỬA LỖI ĐỌC THÔ: Lấy giá trị thô từ DB, sau đó định dạng lại cho textarea --}}
                            @php
                                $rawStats = $car->getRawOriginal('stats');
                                $statsValue = ($rawStats && $rawStats !== '[]' && $rawStats !== '{}') ? json_encode(json_decode($rawStats), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '[]';
                            @endphp
                            <textarea class="form-control @error('stats_data') is-invalid @enderror" id="stats_data" name="stats_data" rows="6" required>{{ old('stats_data', $statsValue) }}</textarea>
                            @error('stats_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="specs_data" class="form-label">Specs (Động cơ, Trọng lượng)</label>
                            {{-- 💡 SỬA LỖI ĐỌC THÔ: Lấy giá trị thô từ DB, sau đó định dạng lại cho textarea --}}
                            @php
                                $rawSpecs = $car->getRawOriginal('specs');
                                $specsValue = ($rawSpecs && $rawSpecs !== '[]' && $rawSpecs !== '{}') ? json_encode(json_decode($rawSpecs), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '{}';
                            @endphp
                            <textarea class="form-control @error('specs_data') is-invalid @enderror" id="specs_data" name="specs_data" rows="6" required>{{ old('specs_data', $specsValue) }}</textarea>
                            @error('specs_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        {{-- UPLOAD ẢNH GALLERY MỚI --}}
                        <div class="mb-3">
                            <label for="gallery_files" class="form-label">Thêm ảnh Gallery mới (Sẽ được gộp)</label>
                            <input type="file" class="form-control @error('gallery_files') is-invalid @enderror" id="gallery_files" name="gallery_files[]" accept="image/*" multiple>
                        </div>
                        
                        {{-- HIỂN THỊ ẢNH GALLERY HIỆN TẠI --}}
                        @if($car->gallery_images && is_array($car->gallery_images))
                            <label class="form-label mt-2">Ảnh Gallery Đã Lưu</label>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                @foreach($car->gallery_images as $img)
                                    <img src="{{ asset('storage/' . $img) }}" alt="Gallery Image" class="img-thumbnail" style="max-height: 80px; object-fit: cover;">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-lg btn-mc">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    
    window.fillCarData = function(modelKey) {
        let stats, specs, name, series, slogan, tagline, description, model3d;
        
        switch (modelKey.toLowerCase()) {
            case 'w1':
                name = 'W1'; series = 'Ultimate'; slogan = 'KẾ THỪA HUYỀN THOẠI'; tagline = 'Hậu duệ của F1 và P1.'; description = 'Chiếc xe đường phố mạnh mẽ nhất lịch sử McLaren. Động cơ V8 Hybrid hoàn toàn mới.'; model3d = null;
                stats = `[{"l":"Công suất (PS)","v":1275},{"l":"0-200 km/h (s)","v":5.8,"d":true},{"l":"Tốc độ tối đa (km/h)","v":391}]`;
                specs = `{"Động cơ":"V8 Hybrid MHP-8","Trọng lượng":"1,399 kg","Giới hạn":"399 chiếc"}`;
                break;
            case 'p1':
                name = 'P1™'; series = 'Ultimate'; slogan = 'HUYỀN THOẠI.'; tagline = 'Hypercar Hybrid đầu tiên.'; description = 'Biểu tượng công nghệ, đặt nền móng cho kỷ nguyên điện khí hóa.'; model3d = null;
                stats = `[{"l":"Công suất (PS)","v":916},{"l":"0-100 km/h (s)","v":2.8,"d":true},{"l":"Tốc độ tối đa (km/h)","v":350}]`;
                specs = `{"Động cơ":"V8 + E-Motor","Giới hạn":"375 chiếc","Công nghệ":"IPAS/DRS"}`;
                break;
            // Thêm logic cho các xe khác (F1, Senna, Elva, v.v.)
            default:
                alert('Không tìm thấy dữ liệu mẫu cho xe này. Vui lòng điền thủ công.');
                return;
        }

        document.getElementById('name').value = name;
        document.getElementById('series').value = series;
        document.getElementById('slogan').value = slogan;
        document.getElementById('tagline').value = tagline;
        document.getElementById('description').value = description;
        document.getElementById('model_3d_url').value = model3d || '';

        document.getElementById('stats_data').value = stats.trim();
        document.getElementById('specs_data').value = specs.trim();
        
        alert('Đã điền thông số kỹ thuật và mô tả. Vui lòng UPLOAD LẠI ẢNH Hero và Gallery.');
    }
</script>
@endpush