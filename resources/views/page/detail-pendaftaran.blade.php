@extends('layouts.layout')

@section('konten')
    <main>
        <x-header></x-header>
        {{-- hero section --}}
        <div class="max-w-2xl lg:max-w-7xl mx-auto md:mt-24 py-20 px-4 my-8">

            <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-xl border border-slate-200 shadow-lg shadow-blue-200">
                <div class="max-w-lg flex justify-center flex-col mx-auto">
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-400 text-center mb-2">Pendaftaran Kamu</h2>
                    <p class="text-center text-gray-500 mb-8 md:mb-12 text-lg md:text-xl md:mt-4 mt-2">Berikut adalah
                        informasi pembayaran
                        yang telah terdaftar atas nama
                        Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-10 max-w-3xl mx-auto md:px-16 ">

                    <!-- Nama -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-user text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Nama</p>
                            <p>{{ $pendaftaran->peserta->user->name }}</p>
                        </div>
                    </div>

                    <!-- Judul Seminar -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-chalkboard text-xl text-gray-700 mr-3"></i>
                        <div class=" w-full">
                            <p class="text-blue-400 font-semibold">Judul Seminar</p>
                            <p>{{ $pendaftaran->seminar->judul }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-envelope text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Email</p>
                            <p>{{ $pendaftaran->peserta->user->email }}</p>
                        </div>
                    </div>

                    <!-- Status Pendaftaran -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-clock-rotate-left text-xl text-gray-700 mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Status Pendaftaran</p>
                            @php
                                $status = $pendaftaran->status;
                                $statusClass =
                                    [
                                        'pending' => 'bg-yellow-200 text-yellow-800',
                                        'paid' => 'bg-green-200 text-green-800',
                                        'attended' => 'bg-blue-200 text-blue-800',
                                    ][$status] ?? 'bg-gray-200 text-gray-800';
                            @endphp

                            <span
                                class="inline-block px-4 py-1 mt-1 text-sm font-medium rounded shadow {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>
                    </div>

                    @if ($pendaftaran->status === 'paid' && $pendaftaran->seminar->mode === 'online')
                        <!-- Metode Pembayaran -->
                        <div class="flex items-start">
                            <i class="fa-regular fa-credit-card text-xl text-gray-700 mr-3"></i>
                            <div>
                                <p class="text-blue-400 font-semibold">Link Meeting</p>
                                <p>{{ $pendaftaran->seminar->metting_link }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Jumlah Biaya -->
                    <div class="flex items-start">
                        <i class="fa-solid fa-dollar-sign text-xl text-gray-700 mr-3"></i>
                        <div>

                            <p class="text-blue-400 font-semibold">Jumlah Biaya</p>
                            <p id="harga-asli" class="line-through text-gray-400 hidden">
                                Rp.{{ number_format($pendaftaran->seminar->harga, 0, ',', '.') }}
                            </p>
                            <p id="harga-akhir">
                                Rp.{{ number_format($pendaftaran->seminar->harga, 0, ',', '.') }}
                            </p>
                            <small id="voucher_error" class="text-red-500 font-medium"></small>

                            {{-- <p class="text-blue-400 font-semibold">Jumlah Biaya</p>
                            <p id="harga-akhir">Rp.{{ number_format($pendaftaran->seminar->harga, 0, ',', '.') }}</p>
                            <small id="voucher_error" class="text-red-500 font-medium"></small> --}}

                            {{-- <p>Rp.{{ number_format($pendaftaran->seminar->harga, 0, ',', '.') }}</p> --}}
                        </div>
                    </div>

                    <!-- Waktu Pendaftaran -->
                    <div class="flex items-start">
                        <i class="fa-regular fa-clock  text-gray-700 text-xl mr-3"></i>
                        <div>
                            <p class="text-blue-400 font-semibold">Waktu Pendaftaran</p>
                            <p>{{ \Carbon\Carbon::parse($pendaftaran->created_at)->translatedFormat('d F Y H.i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between md:px-24 pt-4">
                    <!-- Tombol Kembali -->
                    <div class="mt-10 flex justify-start font-bold">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition">
                            <i class="fa-solid fa-arrow-left mr-2 "></i> Kembali
                        </a>
                    </div>


                    @if ($pendaftaran->status === 'pending')
                        <!-- Form Voucher & Tombol Bayar -->
                        <form action="{{ route('pembayaran.bayar', $pendaftaran->id) }}" method="POST"
                            class="flex flex-col md:flex-row items-center gap-4 w-full md:w-auto">
                            @csrf
                            <div class="w-full md:w-auto">
                                <label for="code_voucher" class="text-blue-400 font-semibold">Kode Voucher</label>
                                <input type="text" id="code_voucher" name="code_voucher"
                                    value="{{ old('code_voucher') }}" placeholder="Kode Voucher (opsional)"
                                    class="form-input mt-1 w-full md:w-64 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" />
                            </div>
                            <input type="hidden" name="harga_akhir" id="input-harga-akhir"
                                value="{{ $pendaftaran->seminar->harga }}">
                            <button type="submit"
                                class="flex items-center justify-center bg-blue-500 py-2 px-5 rounded-full text-white font-bold hover:bg-blue-600 transition">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span class="pl-2">Bayar</span>
                            </button>
                        </form>

                        {{-- // Tanpa Voucher
                        <button type="button" id="btn-bayar" class="btn btn-primary">Bayar Sekarang</button> --}}


                        {{-- <a href="{{ route('pembayaran.bayar', $pendaftaran->id) }}"
                            class="mt-10 flex items-center justify-center bg-blue-500 py-2 px-4 rounded-full text-white font-bold w-32  cursor-pointer hover:bg-blue-600">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="pl-2">Bayar</span>
                        </a> --}}
                    @elseif ($pendaftaran->status === 'paid')
                        <div class="mt-10 text-green-600 font-semibold text-lg">
                            <i class="fa-solid fa-circle-check"></i><span class="pl-2">Sudah dibayar</span>
                        </div>
                    @elseif ($pendaftaran->status === 'attended')
                        <div class="mt-10 text-blue-600 font-semibold text-lg">
                            <i class="fa-solid fa-user-check"></i><span class="pl-2">Sudah hadir & lunas</span>
                        </div>
                    @endif
                    {{-- <a href="{{ route('pembayaran.bayar', $pendaftaran->id) }}">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="pl-2">Daftar</span>
                        </a> --}}


                </div>
            </div>




        </div>
        <x-footer></x-footer>
    </main>
    <!-- AJAX untuk cek voucher -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            const hargaAwal = {{ $pendaftaran->seminar->harga }};

            $('#code_voucher').on('input', function() {
                let kode = $(this).val();

                if (kode.length === 0) {
                    $('#harga-asli').addClass('hidden');
                    $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                    $('#voucher_error').text('');
                    return;
                }

                $.ajax({
                    url: "{{ route('voucher.cek') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        voucher_code: kode,
                        seminar_id: {{ $pendaftaran->seminar_id }}
                    },
                    success: function(res) {
                        if (res.success) {
                            let diskon = parseInt(res.diskon);
                            let hargaBaru = hargaAwal - diskon;
                            $('#harga-asli').removeClass('hidden');
                            $('#harga-akhir').text('Rp.' + hargaBaru.toLocaleString('id-ID'));
                            $('#voucher_error').text('');
                        } else {
                            $('#harga-asli').addClass('hidden');
                            $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                            $('#voucher_error').text(res.message);
                        }
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON;
                        let message = res?.message ?? 'Gagal mengecek voucher.';
                        $('#harga-asli').addClass('hidden');
                        $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                        $('#voucher_error').text(message);
                    }
                });
            });

            $('form').on('submit', function(e) {
                if ($('#voucher_error').text().trim() !== '') {
                    e.preventDefault();
                    alert($('#voucher_error').text().trim());
                }
            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            const hargaAwal = {{ $pendaftaran->seminar->harga }};

            $('#code_voucher').on('input', function() {
                let kode = $(this).val();

                if (kode.length === 0) {
                    $('#harga-asli').addClass('hidden');
                    $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                    $('#voucher_error').text('');
                    $('#input-harga-akhir').val(hargaAwal); // reset ke harga awal
                    return;
                }

                $.ajax({
                    url: "{{ route('voucher.cek') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        voucher_code: kode,
                        seminar_id: {{ $pendaftaran->seminar_id }}
                    },
                    success: function(res) {
                        if (res.success) {
                            let diskon = parseInt(res.diskon);
                            let hargaBaru = hargaAwal - diskon;

                            $('#harga-asli').removeClass('hidden');
                            $('#harga-akhir').text('Rp.' + hargaBaru.toLocaleString('id-ID'));
                            $('#voucher_error').text('');

                            // Kirim harga diskon ke input hidden
                            $('#input-harga-akhir').val(hargaBaru);
                        } else {
                            $('#harga-asli').addClass('hidden');
                            $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                            $('#voucher_error').text(res.message);
                            $('#input-harga-akhir').val(hargaAwal); // fallback
                        }
                    },
                    error: function(xhr) {
                        let res = xhr.responseJSON;
                        let message = res?.message ?? 'Gagal mengecek voucher.';
                        $('#harga-asli').addClass('hidden');
                        $('#harga-akhir').text('Rp.' + hargaAwal.toLocaleString('id-ID'));
                        $('#voucher_error').text(message);
                        $('#input-harga-akhir').val(hargaAwal); // fallback
                    }
                });
            });

            $('form').on('submit', function(e) {
                if ($('#voucher_error').text().trim() !== '') {
                    e.preventDefault();
                    alert($('#voucher_error').text().trim());
                }
            });
        });
    </script> --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-RD3KKeI97G7BJInj"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();

                const kode = $('#code_voucher').val();

                $.ajax({
                    url: "{{ route('pembayaran.bayar', $pendaftaran->id) }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code_voucher: kode
                    },
                    success: function(res) {
                        if (res.redirect) {
                            window.location.href = res.redirect;
                        } else if (res.snap_token) {
                            window.snap.pay(res.snap_token, {
                                onSuccess: function(result) {
                                    window.location.href =
                                        '/pembayaran/sukses/' + result.order_id
                                        .replace('SEM-', '');
                                },
                                onPending: function(result) {
                                    alert("Menunggu pembayaran selesai.");
                                },
                                onError: function(result) {
                                    const id = result.order_id?.replace('SEM-', '');
                                    if (id) {
                                        window.location.href =
                                            '/pembayaran/gagal/' + id;
                                    } else {
                                        alert("Terjadi kesalahan saat pembayaran.");
                                    }
                                },
                                onClose: function() {
                                    alert(
                                        "Kamu menutup tanpa menyelesaikan pembayaran."
                                    );
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        if (res?.error) {
                            $('#voucher_error').text(res.error);
                        }
                    }
                });
            });
        });
    </script>
    // Tanpa Voucher
    {{-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    $(document).ready(function () {
        $('#btn-bayar').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('pembayaran.bayar', $pendaftaran->id) }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {
                    if (res.redirect) {
                        window.location.href = res.redirect;
                    } else if (res.snap_token) {
                        window.snap.pay(res.snap_token, {
                            onSuccess: function (result) {
                                window.location.href = "{{ route('pembayaran.sukses', '') }}/{{ $pendaftaran->id }}";
                            },
                            onPending: function (result) {
                                alert("Menunggu pembayaran selesai.");
                            },
                            onError: function (result) {
                                alert("Terjadi kesalahan saat memproses pembayaran.");
                            },
                            onClose: function () {
                                alert("Kamu menutup tanpa menyelesaikan pembayaran.");
                            }
                        });
                    }
                },
                error: function (xhr) {
                    const res = xhr.responseJSON;
                    if (res?.error) {
                        alert(res.error);
                    }
                }
            });
        });
    });
</script> --}}
@endsection
