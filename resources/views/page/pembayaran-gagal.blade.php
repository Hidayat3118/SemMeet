@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <h2>Pembayaran Gagal</h2>
            <p>Mohon maaf, pembayaran untuk seminar <strong>{{ $payment->pendaftaran->seminar->judul }}</strong> gagal
                diproses.
            </p>

            <p>Silakan coba lagi atau hubungi panitia jika masalah berlanjut.</p> --}}

        {{-- <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Halaman Utama</a>
            <a href="{{ route('pendaftaran.show', $payment->pendaftaran_id) }}" class="btn btn-primary">Coba Bayar Lagi</a>
        </div> --}}

        <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">
            <h2>Pembayaran Gagal</h2>
            <p>Mohon maaf, pembayaran untuk seminar <strong>{{ $payment->pendaftaran->seminar->judul }}</strong> gagal
                diproses.
            </p>
            <p>Silakan coba lagi atau hubungi panitia jika masalah berlanjut.</p>

            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Halaman Utama</a>

            {{-- Tombol untuk coba bayar lagi --}}
            <form method="POST" action="{{ route('pembayaran.hapusDanUlang', $payment->id) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary">Coba Bayar Lagi</button>
            </form>
        </div>
        <x-footer></x-footer>
    </main>
@endsection
