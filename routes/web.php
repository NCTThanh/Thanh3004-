<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController; // BẮT BUỘC: Import SiteController

// =======================================================
// PHẦN 1: ROUTES CHUNG CỦA TRANG WEB MCLAREN (Sử dụng Controller)
// =======================================================

// 1. TRANG CHỦ (Home)
// Route gọi phương thức index() trong SiteController
Route::get('/', [SiteController::class, 'index'])->name('home');

// 2. MODELS/CARS (Danh sách xe)
Route::get('/cars', [SiteController::class, 'cars'])->name('cars');
// 2.1 technology (công nghệ mclaren)
Route::get('/technology', [SiteController::class, 'technology'])->name('technology');

// 3. CAR DETAILS (Chi tiết xe)
// Route gọi phương thức carDetails($modelKey) trong SiteController
Route::get('/models/{modelKey}', [SiteController::class, 'carDetails'])->name('car.details');


// 4. TÌM NHÀ BÁN LẺ (Retailers)
Route::get('/retailers', [SiteController::class, 'retailers'])->name('retailers');

// 5. LIÊN HỆ (Contact - GET: Hiển thị form)
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');

// 6. XỬ LÝ GỬI FORM (Contact - POST: Xử lý logic gửi email)
// Route này sẽ gọi hàm submitContact() trong SiteController
Route::post('/contact/send', [SiteController::class, 'submitContact'])->name('contact.send');

// =======================================================
// PHẦN 2: ROUTES CỦA LARAVEL BREEZE/JETSTREAM (Giữ nguyên)
// =======================================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
