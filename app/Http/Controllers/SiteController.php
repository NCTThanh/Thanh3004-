<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session; // Đảm bảo sử dụng Session
use App\Mail\ContactMail;                 // Mailable gửi admin
use App\Mail\ContactConfirmationMail;     // Mailable gửi khách

class SiteController extends Controller
{
    /**
     * Hiển thị trang chủ
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Hiển thị danh sách xe
     */
    public function cars()
    {
        return view('cars');
    }

    /**
     * Hiển thị trang chi tiết xe
     */
    public function carDetails($model)
    {
        return view('car-details', ['modelKey' => $model]); 
    }

    /**
     * Hiển thị trang nhà bán lẻ
     */
    public function retailers()
    {
        $mapApiKey = env('GOOGLE_MAPS_API_KEY', '');
        return view('retailers', compact('mapApiKey'));
    }

    /**
     * Hiển thị form liên hệ
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Xử lý form liên hệ và gửi mail
     */
    public function submitContact(Request $request)
    {
        // 1. Validate dữ liệu
        $validatedData = $request->validate([
            'name'    => 'required|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|max:20',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        // 2. Thiết lập người nhận Admin
        $adminEmail = env('MAIL_TO_ADDRESS', 'thanhdayroi3004@gmail.com'); 

        try {
            // Gửi mail cho Admin
            Mail::to($adminEmail)->send(new ContactMail($validatedData));

            // Gửi mail xác nhận cho Khách hàng
            Mail::to($validatedData['email'])->send(new ContactConfirmationMail($validatedData));

            // Trả về thông báo thành công (Flash Session)
            return redirect()->back()
                ->with('success', 'Cảm ơn bạn! Tin nhắn đã gửi thành công. Một bản xác nhận đã được gửi tới email của bạn.');

        } catch (\Exception $e) {
            // Ghi log lỗi chi tiết (Fatal Error, SMTP Authentication)
            Log::error('LỖI SERVER GỬI EMAIL TỪ FORM LIÊN HỆ: ' . $e->getMessage(), [
                'form_data' => $validatedData
            ]);

            // Trả về thông báo lỗi, giữ lại input để người dùng không phải nhập lại
            return redirect()->back()
                ->withInput($request->except(['_token']))
                ->with('error', 'Thất bại! Gửi tin nhắn thất bại do lỗi máy chủ (Lỗi SMTP). Vui lòng kiểm tra lại.');
        }
    }
}
