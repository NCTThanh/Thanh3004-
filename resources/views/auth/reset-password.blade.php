<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-black text-white uppercase tracking-wider">Tạo Mật Khẩu Mới</h2>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] py-3" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu mới')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />
            <x-text-input id="password" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] py-3" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] py-3"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full py-3 bg-[#FF7E00] hover:bg-[#d96b00] text-white font-black uppercase tracking-[2px] text-sm transition duration-300">
                {{ __('Đặt Lại Mật Khẩu') }}
            </button>
        </div>
    </form>
</x-guest-layout>