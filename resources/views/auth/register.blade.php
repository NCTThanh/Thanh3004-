<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-black text-white uppercase tracking-wider">Đăng Ký Mới</h2>
        <p class="text-sm text-gray-400 mt-2">Trở thành thành viên của cộng đồng McLaren</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Họ và Tên')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="name" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nguyễn Văn A" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@domain.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />

            <x-text-input id="password" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Nhập lại mật khẩu')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="underline text-sm text-gray-500 hover:text-white transition" href="{{ route('login') }}">
                {{ __('Đã có tài khoản?') }}
            </a>

            <button type="submit" class="py-3 px-6 bg-[#FF7E00] hover:bg-[#d96b00] text-white font-black uppercase tracking-[2px] text-sm transition duration-300 transform hover:-translate-y-1 shadow-lg shadow-orange-900/20">
                {{ __('Đăng Ký') }}
            </button>
        </div>
        
        <!-- Social Login Separator for Register -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-[#333]"></div></div>
            <div class="relative flex justify-center text-sm"><span class="px-3 bg-[#141414] text-gray-500 text-xs">Hoặc đăng ký nhanh</span></div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
             <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center py-2 border border-[#333] rounded hover:border-gray-500 transition duration-300">
                <i class="fab fa-google text-red-500 mr-2"></i> <span class="text-gray-400 text-sm">Google</span>
            </a>
            <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center py-2 border border-[#333] rounded hover:border-gray-500 transition duration-300">
                <i class="fab fa-facebook-f text-blue-500 mr-2"></i> <span class="text-gray-400 text-sm">Facebook</span>
            </a>
        </div>
    </form>
</x-guest-layout>