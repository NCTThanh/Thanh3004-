<?php

use Illuminate\Support\Facades\Route;

// =======================================================
// IMPORT CONTROLLERS
// =======================================================
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\SocialAuthController; 
// TẠO VÀ SỬ DỤNG CONTROLLER CẤP ỨNG DỤNG CHO PAYMENT
use App\Http\Controllers\PaymentController; 

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ContactController as AdminContactController; // Đổi tên để tránh xung đột
use App\Http\Controllers\Admin\UserController; 
// use App\Http\Controllers\Admin\PaymentController; // KHÔNG DÙNG CONTROLLER ADMIN CHO CHỨC NĂNG USER

// =======================================================
// PUBLIC ROUTES
// =======================================================

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/technology', [SiteController::class, 'technology'])->name('technology');
Route::get('/mso', [SiteController::class, 'mso'])->name('mso');
Route::get('/experiences', [SiteController::class, 'experience'])->name('experience');
Route::get('/heritage', [SiteController::class, 'heritage'])->name('heritage');
Route::get('/retailers', [SiteController::class, 'retailers'])->name('retailers');

Route::get('/cars', [SiteController::class, 'cars'])->name('cars');

// Đã khôi phục Route chi tiết xe
Route::get('/models/{modelKey}', [SiteController::class, 'carDetails'])->name('car.details');


Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

// Route GỬI liên hệ (Dùng SiteController@submitContact cho cả hai trường hợp: Đặt cọc và Liên hệ thường)
Route::middleware(['auth'])->group(function () {
    // 1. Route Gửi Yêu Cầu Hỗ Trợ (cho các chủ đề KHÁC đặt cọc) - Vẫn sử dụng SiteController để xử lý form
    Route::post('/contact/send', [SiteController::class, 'submitContact'])->name('contact.send');
    
    // 2. Route Khởi Tạo Thanh Toán (cho chủ đề Đặt cọc)
    Route::post('/payment/initiate', [PaymentController::class, 'initiate'])->name('payment.initiate');
    
    // 3. (CẦN THIẾT) Route Nhận Kết Quả từ cổng thanh toán (Return URL)
    Route::get('/payment/return', [PaymentController::class, 'returnUrl'])->name('payment.return');
});

// =======================================================
// AUTHENTICATED USER ROUTES
// =======================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home'); 
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout/{car}', [OrderController::class, 'create'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
});

// =======================================================
// ADMIN ROUTES
// =======================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('cars', CarController::class); // <-- CUNG CẤP TÍNH NĂNG SỬA XE

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    
    Route::resource('users', UserController::class)->except(['create', 'store', 'show', 'destroy']);
    
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset_pass');
    Route::post('users/{user}/toggle-block', [UserController::class, 'toggleBlock'])->name('users.toggle_block');

    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::post('contacts/{id}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
});

// =======================================================
// LOAD AUTH ROUTES (QUAN TRỌNG)
// =======================================================
require __DIR__.'/auth.php';