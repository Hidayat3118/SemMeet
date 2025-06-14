<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Verifikasi OTP</h2>

        @if (session('status'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 border border-green-300 rounded-md text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.submit') }}">
            @csrf

            <input type="hidden" name="email" value="{{ session('email') }}">
            {{-- <p class="text-sm text-red-600">Session email: {{ session('email') }}</p> --}}

            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Masukkan Kode OTP</label>
                <input id="otp" type="text" name="otp"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Contoh: 123456" required>
                @error('otp')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md transition duration-200">
                    Verifikasi OTP
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
