<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sertifikat') }}
        </h2>
    </x-slot>

    <div class="w-full max-w-lg bg-white dark:bg-gray-800 p-8 rounded-xl shadow-xl border border-blue-100 mx-auto my-auto mt-32">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Upload Tanda Tangan</h2>

        <form id="uploadForm" class="space-y-6">
            <!-- Container Upload / Preview tanpa fixed height -->
            <div id="uploadContainer" class="flex flex-col items-center justify-center w-full p-4 border-2 border-dashed border-blue-400 rounded-lg cursor-pointer bg-blue-50 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600 transition duration-300 min-h-[12rem]">
                <label for="signature" class="flex flex-col items-center justify-center w-full cursor-pointer">
                    <i class="fas fa-signature text-5xl text-blue-600 mb-4" id="uploadIcon"></i>
                    <span class="text-gray-600 dark:text-gray-300" id="uploadText">Klik atau drag file ke sini</span>
                    <input type="file" id="signature" accept="image/*" class="hidden">
                </label>

                <!-- Preview image -->
                <img id="preview" src="#" alt="Preview" class="hidden max-w-full max-h-[300px] object-contain rounded-md mt-4">
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
                    // Sembunyikan icon dan teks upload
                    uploadIcon.style.display = 'none';
                    uploadText.style.display = 'none';

                    // Ubah styling container agar border jadi solid dan bg jadi transparan
                    uploadContainer.classList.remove('border-dashed', 'bg-blue-50', 'dark:bg-gray-700', 'hover:bg-blue-100', 'dark:hover:bg-gray-600');
                    uploadContainer.classList.add('border-solid', 'border-blue-400', 'bg-transparent', 'cursor-default');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Simulasi upload berhasil! (Tanpa backend)');
        });
    </script>

</x-app-layout>
