<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <div class="p-6 bg-blue-50 shadow rounded-xl flex items-center gap-4 border border-slate-700">
            <div class="text-4xl text-blue-600">
                <i class="fas fa-chalkboard"></i>
            </div>
            <div class="">
                <h2 class="text-sm text-gray-600 font-semibold uppercase">Total Seminar</h2>
                <p class="text-3xl font-bold text-blue-700">{{ \App\Models\Seminar::count() }}</p>
            </div>
        </div>

        <div class="p-6 bg-green-50 shadow rounded-xl flex items-center gap-4 border border-slate-700">
            <div class="text-4xl text-green-600">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 font-semibold uppercase">Tiket Terjual</h2>
                <p class="text-3xl font-bold text-green-700">{{ \App\Models\Karcis::count() }}</p>
            </div>
        </div>

        <div class="p-6 bg-yellow-50 shadow rounded-xl flex items-center gap-4 border border-slate-700">
            <div class="text-4xl text-yellow-600">
                <i class="fas fa-gift"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 font-semibold uppercase">Total Voucher</h2>
                <p class="text-3xl font-bold text-yellow-700">{{ \App\Models\Voucher::count() }}</p>
            </div>
        </div>

        <div class="p-6 bg-purple-50 shadow rounded-xl flex items-center gap-4 border border-slate-700">
            <div class="text-4xl text-purple-600">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div>
                <h2 class="text-sm text-gray-600 font-semibold uppercase">Total Pendaftaran</h2>
                <p class="text-3xl font-bold text-purple-700">{{ \App\Models\Pendaftaran::count() }}</p>
            </div>
        </div>

       
    </div>
</x-filament::page>
