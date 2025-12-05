<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Tìm user qua provider_id HOẶC email
            $user = User::where('provider_id', $socialUser->getId())
                        ->orWhere('email', $socialUser->getEmail())
                        ->first();

            if (!$user) {
                // Tạo user mới nếu chưa có
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'password' => Hash::make(Str::random(16)), // Random pass
                    'email_verified_at' => now(),
                ]);
            } else {
                // Cập nhật thông tin nếu đã có
                if (!$user->provider_id) {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]);
                }
            }

            Auth::login($user);
            if ($user->isAdmin()) {
    return redirect()->intended('/admin');
}
            return redirect()->intended(route('home')); 
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Lỗi đăng nhập qua ' . $provider);
        }
    }
}