

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sertifikat') }}
        </h2>
    </x-slot>

    <div
        class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl border border-blue-100 mx-auto my-auto mt-32">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Upload Tanda Tangan</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-600 dark:text-red-300">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Preview tanda tangan lama jika ada --}}
        @php
            $pembicara = \App\Models\Pembicara::where('user_id', Auth::id())->first();
        @endphp

        @if ($pembicara && $pembicara->tanda_tangan)
            <div class="mb-6 text-center">
                <p class="text-gray-700 dark:text-gray-300 font-semibold mb-2">Tanda Tangan Saat Ini:</p>
                <img src="{{ asset('storage/' . $pembicara->tanda_tangan) }}" alt="Tanda Tangan"
                    class="max-h-40 mx-auto border rounded shadow">
            </div>
        @endif

        <form id="uploadForm" method="POST" action="{{ route('tanda-tangan') }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <div id="uploadContainer"
                class="flex flex-col items-center justify-center w-full p-4 border-2 border-dashed border-blue-400 rounded-lg cursor-pointer bg-blue-50 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600 transition duration-300 min-h-[12rem]">
                <label for="signature" class="flex flex-col items-center justify-center w-full cursor-pointer">
                    <i class="fas fa-signature text-5xl text-blue-600 mb-4" id="uploadIcon"></i>
                    <span class="text-gray-600 dark:text-gray-300" id="uploadText">Klik atau drag file ke sini</span>
                    <input type="file" id="signature" name="tanda_tangan" accept="image/*" class="hidden">
                </label>

                <!-- Preview image -->
                <img id="preview" src="#" alt="Preview"
                    class="hidden max-w-full max-h-[300px] object-contain rounded-md mt-4">
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 px-4 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Upload Sekarang
            </button>
        </form>
    </div>

    <script>
        const input = document.getElementById('signature');
        const preview = document.getElementById('preview');
        const uploadContainer = document.getElementById('uploadContainer');
        const uploadIcon = document.getElementById('uploadIcon');
        const uploadText = document.getElementById('uploadText');

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    uploadIcon.style.display = 'none';
                    uploadText.style.display = 'none';

                    uploadContainer.classList.remove('border-dashed', 'bg-blue-50', 'dark:bg-gray-700',
                        'hover:bg-blue-100', 'dark:hover:bg-gray-600');
                    uploadContainer.classList.add('border-solid', 'border-blue-400', 'bg-transparent',
                        'cursor-default');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
