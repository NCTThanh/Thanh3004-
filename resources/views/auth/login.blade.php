<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Welcome Back</h2>
        <p class="text-sm text-gray-400 mt-2">Truy cập vào bộ sưu tập McLaren của bạn</p>
    </div>

    <!-- Social Login Buttons -->
    <div class="grid grid-cols-2 gap-4 mb-8">
        <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center py-2.5 px-4 border border-[#333] rounded hover:border-[#FF7E00] hover:bg-[#FF7E00] hover:bg-opacity-10 transition duration-300 group">
            <i class="fab fa-google text-red-500 group-hover:text-white mr-2 transition"></i> 
            <span class="text-gray-300 group-hover:text-white text-sm font-medium transition">Google</span>
        </a>
        <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center py-2.5 px-4 border border-[#333] rounded hover:border-[#FF7E00] hover:bg-[#FF7E00] hover:bg-opacity-10 transition duration-300 group">
            <i class="fab fa-facebook-f text-blue-500 group-hover:text-white mr-2 transition"></i> 
            <span class="text-gray-300 group-hover:text-white text-sm font-medium transition">Facebook</span>
        </a>
    </div>

    <div class="relative mb-8">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-[#333]"></div></div>
        <div class="relative flex justify-center text-sm"><span class="px-3 bg-[#141414] text-gray-500 uppercase text-xs tracking-widest">Hoặc đăng nhập bằng Email</span></div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Mật khẩu')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />

            <x-text-input id="password" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-[#0a0a0a] border-[#333] text-[#FF7E00] shadow-sm focus:ring-[#FF7E00]" name="remember">
                <span class="ms-2 text-sm text-gray-400 hover:text-white transition">Ghi nhớ đăng nhập</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#FF7E00] hover:text-white transition duration-300" href="{{ route('password.request') }}">
                    Quên mật khẩu?
                </a>
            @endif
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full py-3 bg-[#FF7E00] hover:bg-[#d96b00] text-white font-black uppercase tracking-[2px] text-sm transition duration-300 transform hover:-translate-y-1 shadow-lg shadow-orange-900/20">
                Đăng Nhập
            </button>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            Chưa có tài khoản? <a href="{{ route('register') }}" class="text-white hover:text-[#FF7E00] font-bold ml-1 transition">Đăng ký ngay</a>
        </div>
    </form>
</x-guest-layout>