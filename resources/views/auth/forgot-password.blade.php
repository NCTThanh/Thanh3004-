<x-guest-layout>
    <div class="text-center mb-6">
         <h2 class="text-2xl font-black text-white uppercase tracking-wider mb-2">Quên Mật Khẩu?</h2>
        <div class="text-sm text-gray-400">
            {{ __('Không vấn đề gì. Hãy nhập email của bạn và chúng tôi sẽ gửi liên kết để đặt lại mật khẩu mới.') }}
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email đăng ký')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] placeholder-gray-600 py-3" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
             <button type="submit" class="w-full py-3 bg-white hover:bg-gray-200 text-black font-black uppercase tracking-[2px] text-sm transition duration-300">
                {{ __('Gửi Liên Kết Reset') }}
            </button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-[#FF7E00] hover:text-white transition">Quay lại Đăng nhập</a>
        </div>
    </form>
</x-guest-layout>