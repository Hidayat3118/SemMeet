<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Verifikasi OTP</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.otp.check') }}">
            @csrf

            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">Kode OTP</label>
                <input type="text" id="otp" name="otp" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('otp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">
                Verifikasi
            </button>
        </form>
    </div>
</x-guest-layout>
