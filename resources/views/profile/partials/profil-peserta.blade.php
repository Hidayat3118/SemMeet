<div class=" mx-auto mt-10 bg-white  rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-2">Profil Pengguna</h2>
    <p class="text-gray-600 mb-6 text-sm">Edit Profil Anda sesuai dengan yang anda inginkan</p>

    <form action="#" method="POST" class="space-y-6">


        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Intansi</label>
            <input type="password" id="current_password" name="current_password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman</label>
            <input type="password" id="new_password" name="new_password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Linkend</label>
            <input type="password" id="confirm_password" name="confirm_password"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea id="bio" name="bio" rows="4"
                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        {{-- save --}}
        <div>
            <button type="submit"
                class="px-5 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 focus:outline-none text-xs font-semibold ">SAVE</button>
        </div>
    </form>
</div>
