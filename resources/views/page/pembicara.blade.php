@extends('layouts.layout')

@section('konten')
<main>
    {{-- Header --}}
    <x-header />

    {{-- Container Utama dengan padding responsif --}}
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 md:mt-24 py-16  lg:py-20">
        {{-- Container Section --}}
        <section>
            <div class="my-6 sm:my-8 text-center">
                <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-blue-400 leading-tight">
                    Pembicara Terbaru
                </h1>
                <p class="text-gray-600 text-sm sm:text-base lg:text-lg mt-2 sm:mt-3 max-w-3xl mx-auto px-2">
                    Dapatkan wawasan eksklusif dari para ahli dan tokoh inspiratif di bidangnya
                </p>
            </div>

            {{-- Filter dan Pencarian dengan layout responsif --}}
            <div class="flex flex-col gap-4 sm:gap-6 mb-8 sm:mb-10 lg:flex-row lg:justify-between lg:items-start">
                
                {{-- Tombol Kategori dengan scrolling horizontal di mobile --}}
                <div class="w-full lg:w-auto lg:flex-1">
                    <div class="flex overflow-x-auto gap-2 sm:gap-3 p-2 sm:p-4 
                        lg:flex-wrap lg:justify-start lg:overflow-visible">
                        {{-- Tombol All --}}
                        <a href="{{ route('pembicara.index') }}" class="flex-shrink-0">
                            <button class="px-3 sm:px-4 py-2 rounded-full border shadow-sm text-xs sm:text-sm
                                whitespace-nowrap transition-all duration-200 hover:shadow-md
                                {{ request()->routeIs('pembicara.index') 
                                    ? 'bg-blue-500 text-white border-blue-500' 
                                    : 'bg-gray-100 text-gray-700 border-gray-300 hover:border-blue-300 hover:bg-gray-50' }}">
                                All
                            </button>
                        </a>

                        {{-- Tombol per Kategori --}}
                        @foreach ($kategoris as $kategori)
                            <a href="{{ route('pembicara.kategori', $kategori->id) }}" class="flex-shrink-0">
                                <button class="px-3 sm:px-4 py-2 rounded-full border shadow-sm text-xs sm:text-sm
                                    whitespace-nowrap transition-all duration-200 hover:shadow-md
                                    {{ request()->is('pembicara/kategori/' . $kategori->id) 
                                        ? 'bg-blue-500 text-white border-blue-500' 
                                        : 'bg-gray-100 text-gray-700 border-gray-300 hover:border-blue-300 hover:bg-gray-50' }}">
                                    {{ $kategori->nama }}
                                </button>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Form Pencarian dengan layout yang lebih baik --}}
                <div class="w-full lg:w-auto lg:flex-shrink-0 px-2 sm:px-4 lg:px-0 pt-4">
                    <form action="{{ route('pembicara.index') }}" method="GET" 
                        class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-stretch sm:items-center">
                        
                        {{-- Input Pencarian --}}
                        <div class="relative w-full sm:w-64 lg:w-72">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fas fa-search text-sm"></i>
                            </span>
                            <input type="text" name="q" value="{{ request('q') }}" 
                                placeholder="Cari Pembicara..."
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-full shadow-sm 
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                text-sm text-gray-700 placeholder-gray-400 transition-all duration-200" />
                        </div>

                        {{-- Tombol Cari (optional untuk mobile) --}}
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-500 text-white rounded-full hover:bg-blue-600 
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                            transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md
                            sm:hidden flex items-center justify-center gap-2">
                            <i class="fas fa-search"></i>
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card Pembicara dengan grid responsif yang lebih baik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 xl:gap-10 my-6 sm:my-8">
                @forelse ($pembicaras as $pembicara)
                    <div class="w-full">
                        <x-card-pembicara :pembicara="$pembicara" />
                    </div>
                @empty
                    <div class="col-span-full flex justify-center items-center py-16 sm:py-20 px-4">
                        <div class="text-center text-gray-500 space-y-4 max-w-md">
                            <i class="fas fa-user-times text-3xl sm:text-4xl md:text-5xl text-gray-400"></i>
                            <div class="space-y-2">
                                <p class="text-base sm:text-lg font-medium">Belum ada Pembicara</p>
                                <p class="text-sm text-gray-400">Coba ubah filter atau kata kunci pencarian Anda</p>
                            </div>
                            <div class="pt-4">
                                <a href="{{ route('pembicara.index') }}" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm 
                                    rounded-full hover:bg-blue-600 transition-colors duration-200">
                                    <i class="fas fa-refresh mr-2"></i>
                                    Tampilkan Semua
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination jika ada --}}
            @if(method_exists($pembicaras, 'links'))
                <div class="mt-8 sm:mt-12 flex justify-center">
                    <div class="w-full max-w-md">
                        {{ $pembicaras->links() }}
                    </div>
                </div>
            @endif

            {{-- Statistics atau Info tambahan --}}
            @if(count($pembicaras) > 0)
                <div class="mt-8 sm:mt-12 text-center">
                    <p class="text-sm text-gray-500">
                        Menampilkan {{ count($pembicaras) }} pembicara
                        @if(request('q'))
                            untuk pencarian "<span class="font-medium text-gray-700">{{ request('q') }}</span>"
                        @endif
                    </p>
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

    /* Hover effect untuk cards */
    .card-pembicara {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .card-pembicara:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
</style>

{{-- JavaScript untuk UX yang lebih baik --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form dengan delay untuk pencarian
    const searchInput = document.querySelector('input[name="q"]');
    let searchTimeout;
    
    if (searchInput) {
        // Auto-submit saat user berhenti mengetik (desktop)
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            if (window.innerWidth >= 640) { // Hanya untuk desktop/tablet
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 2 || this.value.length === 0) {
                        this.form.submit();
                    }
                }, 800);
            }
        });

        // Submit on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    }
    
    // Loading state untuk form
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            this.classList.add('form-loading');
            
            // Show loading indicator
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencari...';
                
                // Restore after timeout (fallback)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                }, 5000);
            }
        });
    });

    // Smooth scroll untuk kategori buttons
    const categoryContainer = document.querySelector('.overflow-x-auto');
    if (categoryContainer) {
        const activeButton = categoryContainer.querySelector('.bg-blue-500');
        if (activeButton) {
            activeButton.scrollIntoView({ behavior: 'smooth', inline: 'center' });
        }
    }
});
</script>
@endsection