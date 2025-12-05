<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // --- KHÁCH HÀNG ---
    public function create(Car $car) {
        // Chỉ cho phép user đã đăng nhập đặt cọc
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Bạn cần đăng nhập để tiến hành đặt cọc.');
        }
        return view('orders.checkout', compact('car'));
    }

    public function store(Request $request) {
        // 1. Validation
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'phone' => 'required|string|max:20', 
            'payment_method' => 'required|in:bank_transfer,visa'
        ]);
        
        // 2. Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'car_id' => $request->car_id,
            'order_code' => 'MCL-' . strtoupper(Str::random(8)),
            'amount' => 50000000, 
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'user_phone' => $request->phone,
        ]);
        
        // 3. Gửi email xác nhận
        try {
            // Lấy người dùng hiện tại
            $user = Auth::user(); 
            // Gửi email, truyền đối tượng $order vào Mailable
            Mail::to($user->email)->send(new OrderConfirmationMail($order));

        } catch (\Exception $e) {
            // Log lỗi nếu gửi mail thất bại, nhưng không chặn người dùng
             Log::error('Mail sending failed for Order ' . $order->id . ': ' . $e->getMessage());
        }

        // 4. Redirect
        return redirect()->route('dashboard')->with('success', 'Yêu cầu đặt cọc đã gửi! Vui lòng kiểm tra email của bạn để xem hướng dẫn chuyển khoản.');
    }

    // --- ADMIN ---
    public function index() {
        $orders = Order::with(['user', 'car'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function approve(Order $order) {
        $order->update(['status' => 'approved']);
        
        // Có thể thêm logic gửi mail thông báo đã xác nhận cọc
        return back()->with('success', 'Đã xác nhận thanh toán cọc!');
    }

    public function cancel(Order $order) {
        $order->update(['status' => 'cancelled']);
        return back()->with('error', 'Đã hủy đơn cọc.');
    }
}