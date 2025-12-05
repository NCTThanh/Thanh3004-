@extends('layouts.app')

@section('title', 'Liên hệ & Đặt lịch - McLaren Việt Nam')

@section('content')

    <style>
        .form-control::placeholder { color: #888 !important; }
        .mclaren-input {
            background-color: #2b2b2b !important;
            border: 1px solid #444 !important;
            color: #fff !important;
            border-radius: 0 !important;
        }
        .mclaren-input:focus {
            background-color: #333 !important;
            border-color: #FF7E00 !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 126, 0, 0.25) !important;
        }
        .bg-mclaren-black { background-color: #121212; }
        
        /* Style cho nút Đăng nhập/Đăng ký */
        .btn-auth-action {
            border: 1px solid #FF7E00;
            color: #FF7E00;
            background: transparent;
            text-transform: uppercase;
            font-weight: bold;
            padding: 15px 30px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }
        .btn-auth-action:hover {
            background: #FF7E00;
            color: white;
        }
        /* Style cho tabs */
        .nav-link.mclaren-tab {
            color: #aaa;
            border: none;
            border-bottom: 2px solid transparent;
            font-weight: bold;
            text-transform: uppercase;
            padding-bottom: 0.75rem;
        }
        .nav-link.mclaren-tab.active {
            color: #FF7E00 !important;
            background-color: transparent !important;
            border-color: #FF7E00 !important;
        }
        /* Thêm style cho phần thanh toán */
        .payment-info {
            background: #222;
            padding: 20px;
            border-left: 3px solid #FF7E00;
        }
    </style>

    <section class="container-fluid pt-5 pb-5 bg-mclaren-black" style="min-height: 100vh;">
        <div class="container">
            <h1 class="text-center section-heading text-uppercase fw-bold mb-4 text-white">Liên Hệ McLaren Việt Nam</h1>
            
            {{-- Thông báo thành công/lỗi --}}
            @if (session('success'))
                <div class="alert alert-success bg-dark text-white border-success mb-4"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
            @endif
            @if (session('info'))
                <div class="alert alert-info bg-dark text-white border-info mb-4"><i class="fas fa-info-circle me-2"></i> {{ session('info') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger bg-dark text-white border-danger mb-4"><i class="fas fa-times-circle me-2"></i> {{ session('error') }}</div>
            @endif

            <div class="row g-5">
                {{-- Cột Thông tin (Bên trái) - Luôn hiển thị --}}
                <div class="col-md-5">
                    <div class="contact-info h-100 p-4" style="background: #1a1a1a; border-left: 4px solid #FF7E00;">
                        <h3 class="text-white mb-4 text-uppercase fw-bold">Showroom & Dịch vụ</h3>
                        <div class="mb-4">
                            <h6 class="text-warning text-uppercase ls-1 fw-bold">Showroom Chính hãng</h6>
                            <p class="text-light mb-1">Deutsches Haus, 33 Lê Duẩn, Quận 1, TP. HCM</p>
                            <p class="text-white mb-1"><i class="fas fa-phone-alt me-2 text-warning"></i> Hotline: <span class="fw-bold text-warning">+84 858 970 088</span></p>
                            <p class="text-white mb-1"><i class="fas fa-envelope me-2 text-warning"></i> Email: <span class="fw-bold text-warning">info@mclaren.vn</span></p>
                        </div>
                    </div>
                </div>

                {{-- Cột Form (Bên phải) --}}
                <div class="col-md-7">
                    <div class="contact-form h-100 p-5 shadow-sm" style="background-color: #1a1a1a;">
                        
                        {{-- TRƯỜNG HỢP 1: CHƯA ĐĂNG NHẬP --}}
                        @guest
                            <div class="text-center py-5">
                                <i class="fas fa-user-lock text-warning mb-4" style="font-size: 4rem;"></i>
                                <h3 class="text-white text-uppercase fw-bold mb-3">Vui lòng đăng nhập</h3>
                                <p class="text-secondary mb-5">
                                    Để gửi yêu cầu hỗ trợ, đặt lịch lái thử, hoặc kiểm tra lịch sử đặt cọc, Quý khách vui lòng đăng nhập tài khoản thành viên McLaren.
                                </p>
                                
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('login') }}" class="btn-auth-action">
                                        <i class="fas fa-sign-in-alt me-2"></i> Đăng nhập
                                    </a>
                                    <a href="{{ route('register') }}" class="btn-auth-action" style="border-color: #fff; color: #fff;">
                                        <i class="fas fa-user-plus me-2"></i> Đăng ký
                                    </a>
                                </div>
                            </div>
                        @endguest

                        {{-- TRƯỜNG HỢP 2: ĐÃ ĐĂNG NHẬP (Sử dụng Tabs) --}}
                        @auth
                            <h3 class="text-white text-uppercase fw-bold mb-4">Xin chào, <span class="text-warning fw-bold">{{ Auth::user()->name }}</span>!</h3>
                            
                            {{-- Tabs Navigation --}}
                            <ul class="nav nav-tabs mb-4" id="mclarenTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link mclaren-tab active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true">
                                        <i class="fas fa-headset me-2"></i> Gửi Yêu Cầu Hỗ Trợ
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link mclaren-tab" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">
                                        <i class="fas fa-history me-2"></i> Lịch sử Đặt cọc
                                    </button>
                                </li>
                            </ul>

                            {{-- Tabs Content --}}
                            <div class="tab-content" id="mclarenTabsContent">
                                
                                {{-- TAB 1: GỬI YÊU CẦU HỖ TRỢ --}}
                                <div class="tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                    <p class="text-secondary mb-4">Chọn loại yêu cầu của bạn. Nếu là đặt cọc, bạn sẽ được chuyển đến cổng thanh toán.</p>
                                    
                                    {{-- FORM BẮT ĐẦU --}}
                                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}"> 
                                        @csrf 
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label fw-bold small text-uppercase text-secondary">Họ và tên</label>
                                                <input type="text" class="form-control mclaren-input" name="name" value="{{ Auth::user()->name }}" readonly style="background: #222; color: #aaa;">
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label fw-bold small text-uppercase text-secondary">Số điện thoại</label>
                                                <input type="tel" class="form-control mclaren-input @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone ?? old('phone') }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold small text-uppercase text-secondary">Email liên hệ</label>
                                            <input type="email" class="form-control mclaren-input" name="email" value="{{ Auth::user()->email }}" readonly style="background: #222; color: #aaa;">
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold small text-uppercase text-secondary">Vấn đề cần hỗ trợ</label>
                                            <select class="form-select mclaren-input" name="subject" id="subjectSelect" required> 
                                                <option value="" class="text-muted">-- Chọn chủ đề --</option>
                                                <option value="tu_van_mua_xe" @if(old('subject') == 'tu_van_mua_xe') selected @endif style="color: black;">Tư vấn mua xe & Đặt cọc</option>
                                                <option value="lai_thu" @if(old('subject') == 'lai_thu') selected @endif style="color: black;">Đăng ký lái thử</option>
                                                <option value="dich_vu_ky_thuat" @if(old('subject') == 'dich_vu_ky_thuat') selected @endif style="color: black;">Dịch vụ & Bảo dưỡng</option>
                                                <option value="khac" @if(old('subject') == 'khac') selected @endif style="color: black;">Khác</option>
                                            </select>
                                        </div>

                                        {{-- THÔNG TIN THANH TOÁN MỚI (Tích hợp API) --}}
                                        <div id="paymentInfo" class="mb-4" style="display: none;">
                                            <div class="payment-info text-center">
                                                <h5 class="text-warning fw-bold mb-3"><i class="fas fa-money-check-alt me-2"></i> Xác nhận Đặt cọc Xe</h5>
                                                
                                                <p class="text-light mb-4">Bạn đang đăng ký đặt cọc. Vui lòng **điền nội dung yêu cầu chi tiết** và nhấn nút dưới đây để chuyển đến cổng thanh toán.</p>
                                                
                                                {{-- NÚT THANH TOÁN SẼ GỌI API --}}
                                                <button type="button" id="initiatePaymentButton" class="btn btn-lg px-5 py-3 text-uppercase fw-bold" 
                                                    style="background-color: #007bff; color: white; border-radius: 0; border: none;">
                                                    Thanh Toán Đặt Cọc (50,000,000 VNĐ) <i class="fas fa-arrow-right ms-2"></i>
                                                </button>
                                                
                                                <p class="text-secondary small mt-3">Sử dụng Cổng Thanh Toán An Toàn. Giao dịch sẽ được xử lý qua Back-end.</p>
                                            </div>
                                        </div>
                                        {{-- KẾT THÚC THÔNG TIN THANH TOÁN MỚI --}}

                                        <div class="mb-4">
                                            <label class="form-label fw-bold small text-uppercase text-secondary">Nội dung chi tiết</label>
                                            <textarea class="form-control mclaren-input @error('message') is-invalid @enderror" name="message" id="messageTextarea" rows="4" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="text-end" id="submitContactDiv">
                                            {{-- Nút Gửi Yêu Cầu THÔNG THƯỜNG (Dịch vụ/Lái thử/Khác) --}}
                                            <button type="submit" id="submitContactButton" class="btn btn-lg px-5 py-3 text-uppercase fw-bold" 
                                                style="background-color: #FF7E00; color: white; border-radius: 0; border: none;">
                                                Gửi Yêu Cầu <i class="fas fa-paper-plane ms-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                    {{-- FORM KẾT THÚC --}}
                                </div>

                                {{-- TAB 2: LỊCH SỬ ĐẶT CỌC (Giữ nguyên) --}}
                                <div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">
                                    <p class="text-secondary mb-4">Theo dõi trạng thái các đơn đặt cọc xe của bạn.</p>
                                    
                                    @php
                                        // Giả định: Bạn đã có mối quan hệ orders() trong User Model
                                        $userOrders = Auth::user()->orders()->with('car')->latest()->get();
                                    @endphp
                                    
                                    @if($userOrders->isEmpty())
                                        <div class="text-center py-5">
                                            <i class="fas fa-car-side text-secondary mb-3" style="font-size: 3rem;"></i>
                                            <p class="text-secondary">Bạn chưa có đơn đặt cọc xe nào.</p>
                                            <a href="{{ route('cars') }}" class="btn btn-outline-warning btn-sm mt-3">Khám phá các dòng xe</a>
                                        </div>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-dark table-striped table-hover align-middle">
                                                <thead class="text-warning">
                                                    <tr>
                                                        <th>Mã Đơn</th>
                                                        <th>Xe</th>
                                                        <th>Số tiền cọc</th>
                                                        <th>Trạng thái</th>
                                                        <th>Ngày đặt</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($userOrders as $order)
                                                        <tr>
                                                            <td class="fw-bold">{{ $order->order_code }}</td>
                                                            <td>{{ $order->car->name ?? 'Xe đã bị xóa' }}</td>
                                                            <td>{{ number_format($order->amount, 0, ',', '.') }} VNĐ</td>
                                                            <td>
                                                                @if ($order->status == 'pending')
                                                                    <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                                                @elseif ($order->status == 'approved')
                                                                    <span class="badge bg-success">Đã xác nhận</span>
                                                                @elseif ($order->status == 'cancelled')
                                                                    <span class="badge bg-danger">Đã hủy</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <p class="text-info small mt-3">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Nếu trạng thái là "Chờ xác nhận", vui lòng kiểm tra email để xem hướng dẫn chuyển khoản.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Kích hoạt Bootstrap Tabs (Giữ nguyên)
            var triggerTabList = [].slice.call(document.querySelectorAll('#mclarenTabs button'))
            triggerTabList.forEach(function (triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', function (event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            });

            // LOGIC ẨN/HIỆN NÚT VÀ XỬ LÝ THANH TOÁN
            const subjectSelect = document.getElementById('subjectSelect');
            const paymentInfoDiv = document.getElementById('paymentInfo');
            const submitContactDiv = document.getElementById('submitContactDiv');
            const initiatePaymentButton = document.getElementById('initiatePaymentButton');
            const contactForm = document.getElementById('contactForm');
            const messageTextarea = document.getElementById('messageTextarea');
            const phoneInput = contactForm.querySelector('input[name="phone"]');
            
            // Ẩn/Hiện nút và div
            function togglePaymentInfo() {
                // Chỉ chạy khi đã đăng nhập
                if (!subjectSelect || !paymentInfoDiv || !submitContactDiv) return;

                const isCarDeposit = subjectSelect.value === 'tu_van_mua_xe';
                
                if (isCarDeposit) {
                    // Nếu là đặt cọc xe: hiện thông tin thanh toán & ẩn nút gửi yêu cầu thông thường
                    paymentInfoDiv.style.display = 'block';
                    submitContactDiv.style.display = 'none'; 
                    // Quan trọng: Thiết lập action sang route thanh toán cho nút API
                    contactForm.action = "{{ route('payment.initiate') }}"; 
                } else {
                    // Nếu là yêu cầu khác: ẩn thông tin thanh toán & hiện nút gửi yêu cầu thông thường
                    paymentInfoDiv.style.display = 'none';
                    submitContactDiv.style.display = 'block';
                    // Thiết lập lại action form về route gửi yêu cầu hỗ trợ chung
                    contactForm.action = "{{ route('contact.send') }}"; 
                }
            }

            // Lắng nghe sự kiện thay đổi chủ đề
            if (subjectSelect) {
                subjectSelect.addEventListener('change', togglePaymentInfo);
            }
            
            // Chạy lần đầu
            togglePaymentInfo(); 

            // XỬ LÝ SỰ KIỆN KHI NGƯỜI DÙNG NHẤN NÚT THANH TOÁN
            if (initiatePaymentButton) {
                initiatePaymentButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // 1. Kiểm tra Validation cơ bản (Nên làm validation mạnh hơn ở Back-end)
                    if (phoneInput.value === '' || messageTextarea.value === '') {
                        alert('Vui lòng điền đầy đủ Số điện thoại và Nội dung chi tiết trước khi thanh toán.');
                        // Tăng cường: Thêm class is-invalid nếu cần
                        return;
                    }
                    
                    // 2. Gửi Form (Action đã được đặt thành route('payment.initiate') trong togglePaymentInfo)
                    contactForm.submit();
                });
            }
        });
    </script>
@endsection