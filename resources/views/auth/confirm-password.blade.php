<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('Đây là khu vực bảo mật của hệ thống. Vui lòng xác nhận mật khẩu của bạn trước khi tiếp tục.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Mật khẩu')" class="text-gray-400 uppercase text-xs tracking-widest font-bold mb-2" />

            <x-text-input id="password" class="block mt-1 w-full bg-[#0a0a0a] border-[#333] text-white focus:border-[#FF7E00] focus:ring-[#FF7E00] py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="w-full py-3 bg-[#FF7E00] hover:bg-[#d96b00] text-white font-black uppercase tracking-[2px] text-sm transition duration-300">
                {{ __('Xác Nhận') }}
            </button>
        </div>
    </form>
</x-guest-layout>