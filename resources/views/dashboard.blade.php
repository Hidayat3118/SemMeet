<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div> --}}
        <section class="max-w-7xl mx-auto">
            <div class='flex justify-between max-w-xl font-semibold md:text-lg  mx-auto'>
                <div class="cursor-pointer hover:text-blue-400">Riwayat Event</div>
                <div class="cursor-pointer hover:text-blue-400">Riwayat Transaksi</div>
                <div class="cursor-pointer hover:text-blue-400">Sertifikat</div>
               
            </div>
        </section>
    </main>
</x-app-layout>
