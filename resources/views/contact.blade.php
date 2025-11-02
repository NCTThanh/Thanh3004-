@extends('layouts.app')

@section('title', 'Liên hệ với McLaren Việt Nam')

@section('content')

    <section class="container pt-5 pb-5">
        <h1 class="text-center section-heading">Liên Hệ Với McLaren Việt Nam</h1>
        <p class="lead text-center" style="color: var(--color-text-faded); ">Chúng tôi rất sẵn lòng hỗ trợ bạn. Vui lòng điền vào biểu mẫu dưới đây hoặc liên hệ trực tiếp với chúng tôi theo thông tin sau:</p>

        {{-- HIỂN THỊ THÔNG BÁO TỪ CONTROLLER --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thành công!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Thất bại!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- HIỂN THỊ LỖI VALIDATION TỪ LARAVEL --}}
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Lỗi nhập liệu:</strong> Vui lòng kiểm tra lại thông tin bạn đã nhập.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <div class="contact-info h-100 p-4">
                    <h3>Thông tin liên hệ</h3>
                    <p><strong>Địa chỉ Showroom:</strong> Deutsches Haus, 33 Lê Duẩn, Quận 1, TP. Hồ Chí Minh</p>
                    <p><strong>Địa chỉ Dịch vụ:</strong> 20 Cộng Hòa, Quận Tân Bình, TP. Hồ Chí Minh</p>
                    <p><strong>Điện thoại:</strong> +84 858 970 088 </p>
                    <p><strong>Email:</strong> <a href="mailto:mclarenvn@gmail.com" style="color: var(--color-mclaren-orange);">mclarenvn@gmail.com</a></p>
                    <p><strong>Giờ làm việc (Sales):</strong> 9h00 - 18h00</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-form h-100 p-4">
                    <h3>Gửi tin nhắn cho chúng tôi</h3>
                    {{-- Form này gửi trực tiếp bằng POST và xử lý validation/redirect trong Controller --}}
                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}"> 
                        @csrf 
                        <div class="form-group mb-3">
                            <label for="name">Tên của bạn:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Địa chỉ email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại:</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="subject">Vấn đề hỗ trợ:</label>
                            <select class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required> 
                                <option value="">-- Vui lòng chọn một vấn đề --</option>
                                <optgroup label="Thông tin sản phẩm">
                                    <option value="gia_ca_va_khuyen_mai" {{ old('subject') == 'gia_ca_va_khuyen_mai' ? 'selected' : '' }}>Giá cả và chương trình khuyến mãi</option>
                                    <option value="thong_so_ky_thuat" {{ old('subject') == 'thong_so_ky_thuat' ? 'selected' : '' }}>Thông số kỹ thuật của xe</option>
                                </optgroup>
                                <optgroup label="Bảo hành và sửa chữa">
                                    <option value="dich_vu_bao_duong" {{ old('subject') == 'dich_vu_bao_duong' ? 'selected' : '' }}>Dịch vụ bảo dưỡng định kỳ</option>
                                    <option value="dat_lich_hen_dich_vu" {{ old('subject') == 'dat_lich_hen_dich_vu' ? 'selected' : '' }}>Đặt lịch hẹn dịch vụ</option>
                                </optgroup>
                                <option value="khac" {{ old('subject') == 'khac' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Nội dung tin nhắn:</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-contact btn-lg">Gửi tin nhắn</button>
                        </div>
                    </form>
                    <div id="formMessage"></div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
