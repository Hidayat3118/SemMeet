@extends('layouts.layout')

@section('konten')
<main>
    {{-- Header --}}
    <x-header />

    {{-- Container Utama dengan padding responsif --}}
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 md:mt-24 py-16 lg:py-20">
        {{-- Judul Section --}}
        <section>
            <div class="my-6 sm:my-8 text-center">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-blue-500 leading-tight">
                    Seminar Terbaru
                </h1>
                <p class="text-gray-600 text-sm sm:text-base lg:text-lg mt-2 sm:mt-3 max-w-2xl mx-auto px-2">
                    Kami menghadirkan seminar menarik yang memberikan wawasan dan inspirasi terbaik untuk Anda.
                </p>
            </div>

            {{-- Filter dan Pencarian dengan layout responsif --}}
            <div class="flex flex-col gap-4 sm:gap-6 mb-8 sm:mb-10 lg:flex-row lg:justify-between lg:items-start ">
                
                {{-- Tombol Kategori dengan scrolling horizontal di mobile --}}
                <div class="w-full lg:w-auto ">
                    <div class="flex overflow-x-auto scrollbar-hide gap-2 sm:gap-3 p-2 sm:p-4   
                        lg:flex-wrap lg:justify-start lg:overflow-visible ">
                        {{-- Tombol All --}}
                        <a href="{{ route('seminar.index') }}" class="flex-shrink-0">
                            <button class="px-3 sm:px-4 py-2 rounded-full border shadow-sm text-xs sm:text-sm
                                whitespace-nowrap transition-all duration-200 hover:shadow-md
                                {{ request()->routeIs('seminar.index') 
                                    ? 'bg-blue-500 text-white border-blue-500' 
                                    : 'bg-white text-gray-700 border-gray-300 hover:border-blue-300' }}">
                                All
                            </button>
                        </a>

                        {{-- Tombol per Kategori --}}
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('seminar.kategori', $kategori->id) }}" class="flex-shrink-0">
                                <button class="px-3 sm:px-4 py-2 rounded-full border shadow-sm text-xs sm:text-sm
                                    whitespace-nowrap transition-all duration-200 hover:shadow-md
                                    {{ request()->is('seminar/kategori/' . $kategori->id) 
                                        ? 'bg-blue-500 text-white border-blue-500' 
                                        : 'bg-white text-gray-700 border-gray-300 hover:border-blue-300' }}">
                                    {{ $kategori->nama }}
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Form Pencarian dengan layout yang lebih baik --}}
                <form method="GET" action="{{ route('seminar.index') }}"
                    class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-stretch sm:items-center 
                    justify-center px-2 sm:px-4 lg:px-0 w-full lg:w-auto lg:flex-shrink-0 pt-4">
                    
                    {{-- Input Pencarian --}}
                    <div class="relative w-full sm:w-48 lg:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <i class="fas fa-search text-sm"></i>
                        </span>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari seminar..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-full shadow-sm 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                            text-sm transition-all duration-200" />
                    </div>

                    {{-- Dropdown Mode --}}
                    <select name="mode" onchange="this.form.submit()"
                        class="px-6 py-2.5 border border-gray-300 bg-white rounded-full shadow-sm text-gray-700 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                        text-sm transition-all duration-200 w-full sm:w-auto">
                        <option value="">Semua Mode</option>
                        <option value="online" {{ request('mode') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="offline" {{ request('mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                    </select>

                    {{-- Tombol Cari --}}
                    <button type="submit"
                        class="px-6 py-2.5 bg-blue-500 text-white rounded-full hover:bg-blue-600 
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                        transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md
                        w-full sm:w-auto flex-shrink-0">
                        <i class="fas fa-search mr-2 sm:hidden"></i>
                        Cari
                    </button>
                </form>
            </div>

            {{-- Kartu Seminar dengan grid responsif yang lebih baik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 min-h-[300px]">
                @forelse ($seminars as $seminar)
                    <div class="w-full">
                        <x-card-seminar :seminar="$seminar" />
                    </div>
                @empty
                    <div class="col-span-full flex justify-center items-center py-16 sm:py-20 px-4">
                        <div class="text-center text-gray-500 space-y-4 max-w-md">
                            <i class="fas fa-calendar-times text-3xl sm:text-4xl md:text-5xl text-gray-400"></i>
                            <div class="space-y-2">
                                <p class="text-base sm:text-lg font-medium">Belum ada data seminar</p>
                                <p class="text-sm text-gray-400">Coba ubah filter atau kata kunci pencarian Anda</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination jika ada --}}
            @if(method_exists($seminars, 'links'))
                <div class="mt-8 sm:mt-12 flex justify-center">
                    {{ $seminars->links() }}
                </div>
            @endif
        </section>
    </div>

    {{-- Footer --}}
    <x-footer />
</main>

{{-- Custom CSS untuk scrollbar dan animasi --}}
<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    /* Smooth scroll untuk kategori horizontal */
    @media (max-width: 1023px) {
        .overflow-x-auto {
            scroll-behavior: smooth;
        }
    }
    
    /* Loading state untuk form */
    .form-loading {
        opacity: 0.7;
        pointer-events: none;
    }

   
</style>

{{-- JavaScript untuk UX yang lebih baik --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form dengan delay untuk pencarian
    const searchInput = document.querySelector('input[name="q"]');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Optional: auto-submit setelah user berhenti mengetik
                // this.form.submit();
            }, 500);
        });
    }
    
    // Loading state untuk form
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            this.classList.add('form-loading');
        });
    }
});
</script>
@endsection