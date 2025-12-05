<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 

// CÁC MODELS CẦN THIẾT
use App\Models\Car; 
use App\Models\Retailer; 
use App\Models\Timeline; 
use App\Models\Event; 
use App\Models\ContactSubmission; 

// CÁC MAILABLES
use App\Mail\ContactMail; 
use App\Mail\ContactConfirmationMail; 

class SiteController extends Controller
{
    /**
     * TRANG CHỦ
     */
    public function index()
    {
        
        $featuredCars = Car::latest()->take(3)->get();
        
       
        $heroCar = Car::where('model_key', '750s')->first();

        return view('index', compact('featuredCars', 'heroCar'));
    }

    /**
     * TRANG DANH SÁCH XE
     */
    public function cars()
    {
        $cars = Car::all(); 
        return view('cars', compact('cars'));
    }

    /**
     * TRANG CHI TIẾT XE
     */
    public function carDetails($modelKey)
    {
        $car = Car::where('model_key', $modelKey)->firstOrFail();
        return view('car-details', compact('car'));
    }

    /**
     * TRANG NHÀ BÁN LẺ (DYNAMIC)
     */
    public function retailers()
    {
        
        $retailers = Retailer::all();
        $mapApiKey = env('GOOGLE_MAPS_API_KEY', '');
        

        return view('retailers', compact('retailers', 'mapApiKey'));
    }

    /**
     * TRANG DI SẢN (HERITAGE - DYNAMIC)
     */
    public function heritage()
    {
        
        $timelines = Timeline::orderBy('year', 'asc')->get();
        
    
        return view('heritage', compact('timelines'));
    }
    

    /**
     * TRANG TRẢI NGHIỆM (EXPERIENCE - DYNAMIC)
     */
    public function experience()
    {
        // Lấy toàn bộ sự kiện từ Database
        $events = Event::all();
        
        // Truyền biến $events vào View
        return view('experience', compact('events'));
    }

    /**
     * CÁC TRANG TĨNH KHÁC
     */
    public function contact() { return view('contact'); }
    public function technology() { return view('technology'); }
    public function mso() { return view('mso'); }

    /**
     * XỬ LÝ FORM LIÊN HỆ - CHỈ DÀNH CHO USER ĐÃ ĐĂNG NHẬP
     * Đổi tên từ submitContact thành send.
     */
    public function send(Request $request)
    {
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để gửi yêu cầu liên hệ.');
        }

       
        $user = Auth::user();

        
        $validatedData = $request->validate([
        
            'phone'   => 'required|max:20', 
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

      
        $submissionData = array_merge($validatedData, [
            'user_id' => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
        ]);

        $adminEmail = env('MAIL_TO_ADDRESS', 'thanhdayroi3004@gmail.com');

        try {
            
            $submission = ContactSubmission::create($submissionData); 

           
            try {
                Mail::to($adminEmail)->send(new ContactMail($submission));
            } catch (\Exception $e) {
                Log::error('Mail Admin Error: ' . $e->getMessage());
            }

           
            try {
                Mail::to($submission->email)->send(new ContactConfirmationMail($submission));
            } catch (\Exception $e) {
                Log::error('Mail Client Error: ' . $e->getMessage());
            }

            return redirect()->back()
                ->with('success', 'Cảm ơn bạn! Tin nhắn đã gửi thành công. Chúng tôi sẽ liên hệ lại sớm nhất.');

        } catch (\Exception $e) {
            Log::error('LỖI KHI GỬI FORM LIÊN HỆ: ' . $e->getMessage(), [
                'form_data' => $submissionData
            ]);

            return redirect()->back()
                ->withInput($request->except(['_token']))
                ->with('error', 'Thất bại! Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }
}