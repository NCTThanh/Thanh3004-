<x-guest-layout>
    <div class="mb-4 text-sm text-gray-400">
        {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác minh địa chỉ email của bạn bằng cách nhấp vào liên kết chúng tôi vừa gửi đến email của bạn. Nếu bạn không nhận được email, chúng tôi sẵn sàng gửi lại.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-[#FF7E00]">
            {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp khi đăng ký.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button type="submit" class="py-2 px-4 bg-[#FF7E00] hover:bg-[#d96b00] text-white font-bold uppercase text-xs tracking-wider rounded-sm transition">
                    {{ __('Gửi lại Email xác minh') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-500 hover:text-white rounded-md focus:outline-none transition">
                {{ __('Đăng Xuất') }}
            </button>
        </form>
    </div>
</x-guest-layout>