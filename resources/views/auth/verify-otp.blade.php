<x-guest-layout>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow">


        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.check') }}">
            @csrf

            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">Kode OTP</label>
                <input type="text" id="otp" name="otp"
                    class="w-full px-4 py-3 md:py-4 text-lg font-mono text-center tracking-widest border-2 border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-gray-50 focus:bg-white placeholder-gray-400"
                    placeholder="• • • • • •" maxlength="6">
                @error('otp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div
                    class="bg-blue-50 border border-blue-200 text-blue-700 text-sm rounded-lg p-4 flex gap-2 mt-2 md:mt-6">
                    <svg class="w-5 h-5 mt-0.5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z" />
                    </svg>
                    <div>
                        <p><strong>Kode OTP</strong> terdiri dari 6 digit angka</p>
                        <p>Periksa email Anda atau folder spam jika tidak menerima kode</p>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r bg-blue-500 text-white font-semibold py-3 md:py-4 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50 shadow-lg hover:shadow-xl">
                <span class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Verifikasi Sekarang</span>
                </span>
            </button>
        </form>
    </div>
</x-guest-layout>
