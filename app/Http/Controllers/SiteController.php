<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session; // Đảm bảo sử dụng Session
use App\Mail\ContactMail;                 // Mailable gửi admin
use App\Mail\ContactConfirmationMail;     // Mailable gửi khách
use App\Models\ContactSubmission;

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
    public function technology()
    {
        return view('technology');
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

        $adminEmail = env('MAIL_TO_ADDRESS', 'thanhdayroi3004@gmail.com');

        try {
            // BƯỚC 2: LƯU VÀO DATABASE ĐẦU TIÊN
            $submission = ContactSubmission::create($validatedData); // <--- THÊM DÒNG NÀY

            // Gửi mail cho Admin (dùng $submission an toàn hơn)
            Mail::to($adminEmail)->send(new ContactMail($submission));

            // Gửi mail xác nhận cho Khách hàng
            Mail::to($submission->email)->send(new ContactConfirmationMail($submission));

            // Trả về thông báo thành công
            return redirect()->back()
                ->with('success', 'Cảm ơn bạn! Tin nhắn đã gửi thành công. Một bản xác nhận đã được gửi tới email của bạn.');

        } catch (\Exception $e) {
            // Ghi log lỗi
            Log::error('LỖI KHI GỬI FORM LIÊN HỆ: ' . $e->getMessage(), [
                'form_data' => $validatedData
            ]);

            // Trả về thông báo lỗi
            return redirect()->back()
                ->withInput($request->except(['_token']))
                ->with('error', 'Thất bại! Không thể gửi tin nhắn. Vui lòng thử lại sau.');
        }
    }
}
