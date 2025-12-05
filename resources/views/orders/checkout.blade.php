@extends('layouts.app')
@section('title', 'Xác nhận Đặt cọc - ' . $car->name)

@section('content')
<div class="py-12 bg-black min-h-screen text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h4 class="text-[#FF7E00] uppercase tracking-[4px] text-sm font-bold mb-2">Booking Confirmation</h4>
                <h1 class="text-4xl font-black uppercase mb-6">Xác nhận đặt cọc</h1>
                
                <div class="bg-[#111] border border-[#333] p-6 rounded-sm">
                    <img src="{{ asset($car->image_url) }}" class="w-full h-64 object-cover mb-6 rounded-sm" alt="{{ $car->name }}">
                    <h2 class="text-2xl font-bold uppercase mb-2">{{ $car->name }}</h2>
                    <p class="text-gray-400 text-sm mb-4">{{ $car->series }} Series</p>
                    
                    <div class="border-t border-[#333] my-4 pt-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Phí đặt cọc giữ chỗ (Deposit)</span>
                            <span class="text-xl font-bold text-white">50,000,000 VNĐ</span>
                        </div>
                        <p class="text-xs text-gray-500 italic">* Số tiền này sẽ được khấu trừ vào giá xe chính thức hoặc hoàn lại theo chính sách hủy đặt cọc trong vòng 7 ngày.</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-[#111] p-8 border-t-4 border-[#FF7E00] shadow-2xl">
                    <h3 class="text-xl font-bold uppercase mb-6">Thông tin khách hàng</h3>
                    
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        
                        <div class="space-y-4 mb-6">
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Họ và tên</label>
                                <input type="text" value="{{ Auth::user()->name }}" class="w-full bg-[#222] border-none text-white p-3 focus:ring-1 focus:ring-[#FF7E00]" readonly>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Email liên hệ</label>
                                <input type="email" value="{{ Auth::user()->email }}" class="w-full bg-[#222] border-none text-white p-3 focus:ring-1 focus:ring-[#FF7E00]" readonly>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-400 mb-1">Số điện thoại (Bắt buộc)</label>
                                <input type="text" name="phone" required class="w-full bg-[#000] border border-[#444] text-white p-3 focus:border-[#FF7E00] focus:ring-0 outline-none placeholder-gray-600" placeholder="Nhập số điện thoại của bạn...">
                            </div>
                        </div>

                        <h3 class="text-xl font-bold uppercase mb-4 mt-8">Phương thức thanh toán cọc</h3>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-[#333] bg-[#0a0a0a] cursor-pointer hover:border-[#FF7E00] transition group">
                                <input type="radio" name="payment_method" value="bank_transfer" checked class="text-[#FF7E00] focus:ring-[#FF7E00] bg-black border-gray-600">
                                <div class="ml-4 flex-1">
                                    <span class="block font-bold group-hover:text-[#FF7E00] transition">Chuyển khoản Ngân hàng (QR Code)</span>
                                    <span class="block text-sm text-gray-500">Chúng tôi sẽ gửi email xác nhận kèm mã QR thanh toán ngay sau khi bạn gửi yêu cầu.</span>
                                </div>
                                <i class="fas fa-university text-2xl text-gray-600"></i>
                            </label>

                            <label class="flex items-center p-4 border border-[#333] bg-[#0a0a0a] cursor-pointer hover:border-[#FF7E00] transition group">
                                <input type="radio" name="payment_method" value="visa" class="text-[#FF7E00] focus:ring-[#FF7E00] bg-black border-gray-600">
                                <div class="ml-4 flex-1">
                                    <span class="block font-bold group-hover:text-[#FF7E00] transition">Thẻ tín dụng Quốc tế</span>
                                    <span class="block text-sm text-gray-500">Visa, Mastercard, Amex (Đang bảo trì)</span>
                                </div>
                                <i class="fab fa-cc-visa text-2xl text-gray-600"></i>
                            </label>
                        </div>

                        <button type="submit" class="w-full mt-8 py-4 bg-[#FF7E00] hover:bg-[#D46900] text-white font-black uppercase tracking-widest text-lg transition duration-300">
                            Xác nhận Đặt cọc
                        </button>
                        <p class="text-center text-xs text-gray-500 mt-4">Bằng việc nhấn xác nhận, đại lý McLaren sẽ liên hệ với bạn trong vòng 24h làm việc.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection