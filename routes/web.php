<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KarcisController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembicaraController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Auth\OtpController;

// bukti pendaftaran

Route::post('/pendaftaran/{id}/upload-foto', [PendaftaranController::class, 'uploadFoto'])->name('pendaftaran.upload');


// otp
Route::get('/otp/verifikasi', [OtpController::class, 'showForm'])->name('otp.verifikasi');
Route::post('/otp/verifikasi', [OtpController::class, 'verifikasiOtp'])->name('otp.submit');

// forgot password
use App\Http\Controllers\Auth\ForgotPasswordOtpController;

Route::get('/forgot-password', [ForgotPasswordOtpController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordOtpController::class, 'sendOtp'])->name('password.otp.send');

Route::get('/verify-otp', [ForgotPasswordOtpController::class, 'showVerifyOtpForm'])->name('password.otp.verify');
Route::post('/verify-otp', [ForgotPasswordOtpController::class, 'verifyOtp'])->name('password.otp.check');

Route::get('/reset-password-otp', [ForgotPasswordOtpController::class, 'showResetForm'])->name('password.reset.form');
Route::post('/reset-password-otp', [ForgotPasswordOtpController::class, 'resetPassword'])->name('password.reset.save');





Route::get('/dashboard', function () {
    return view('dashboard');
    // , 'verified'
})->middleware(['auth', 'otp.verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/extended', [ProfileController::class, 'editExtended'])->name('profile.editExtended');   // Form untuk profil tambahan
    Route::patch('/profile/extended', [ProfileController::class, 'updateExtended'])->name('profile.update.extended'); // Update profil tambahan
    // Form edit & simpan kategori
    // Route::get('/profile', [ProfileController::class, 'editKategori'])->name('profile.editKategori');
    // Route::patch('/profile/kategori', [ProfileController::class, 'updateKategori'])->name('profile.update.kategori');
     Route::get('/profile/kategori', [ProfileController::class, 'editKategori'])->name('profile.kategoriExtended');
    Route::patch('/profile/kategori', [ProfileController::class, 'updateKategori'])->name('profile.kategoriExtended');
});


Route::get('/', function () {
    return view('home');
});

Route::get('/testing', function () {
    return view('testing');
});

Route::get('/pembicara', function () {
    return view('page.pembicara');
});
Route::get('/moderator', function () {
    return view('page.moderator');
});
Route::get('/seminar', function () {
    return view('page.seminar');
});

// detail seminar
Route::get('/detail-seminar', function () {
    return view('page.detail-seminar');
});

// detail pembicara
Route::get('/detail-pembicara', function () {
    return view('page.detail-pembicara');
});

// detail moderator
Route::get('/detail-moderator', function () {
    return view('page.detail-moderator');
});

// detail pendaftaran
Route::get('/detail-pendaftaran', function () {
    return view('page.detail-pendaftaran');
});


// tiket
Route::get('/tiket', function () {
    return view('page.tiket');
});


// riwayat seminar

Route::get('/riwayat-seminar', function () {
    return view('page.riwayat-seminar');
})->name('riwayat-seminar');

Route::get('/riwayat-pendaftaran', function () {
    return view('page.riwayat-pendaftaran');
})->name('riwayat-pendaftaran');

Route::get('/riwayat-transaksi', function () {
    return view('page.riwayat-transaksi');
})->name('riwayat-transaksi');

// ku tambahi
Route::get('/riwayat-tiket', function () {
    return view('page.riwayat-tiket');
})->name('riwayat-tiket');

Route::get('/sertifikat', function () {
    return view('page.sertifikat');
})->name('sertifikat');

Route::get('/tanda-tangan', function () {
    return view('page.tanda-tangan');
})->name('tanda-tangan');

Route::get('/sqan', function () {
    return view('page.sqan');
})->name('sqan');


//home
Route::get('/', [HomeController::class, 'index'])->name('home');

//seminar
Route::get('/seminar', [SeminarController::class, 'index'])->name('seminar.index');

//detail-seminar
Route::get('/seminar/{id}', [SeminarController::class, 'show'])->name('seminar.show');

//kategori seminar
Route::get('/seminar/kategori/{id}', [SeminarController::class, 'byKategori'])->name('seminar.kategori');

//moderator
Route::get('/moderator', [ModeratorController::class, 'index'])->name('moderator.index');

//kategori moderator
Route::get('/moderator/kategori/{id}', [ModeratorController::class, 'byKategori'])->name('moderator.kategori');

//detail-moderator
Route::get('/moderator/{id}', [ModeratorController::class, 'show'])->name('moderator.show');

//pembicara
Route::get('/pembicara', [PembicaraController::class, 'index'])->name('pembicara.index');

//kategori pembicara
Route::get('/pembicara/kategori/{id}', [PembicaraController::class, 'byKategori'])->name('pembicara.kategori');

//detail-pembicara
Route::get('/pembicara/{id}', [PembicaraController::class, 'show'])->name('pembicara.show');

// // Proses mendaftar seminar
// Route::post('/seminar/{id}/daftar', [PendaftaranController::class, 'daftar'])->name('pendaftaran.daftar');

// // Menampilkan halaman detail pendaftaran
// Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.detail');

Route::middleware(['auth'])->group(function () {
    // POST daftar seminar
    Route::post('/daftar/{seminar}', [PendaftaranController::class, 'daftar'])->name('pendaftaran.daftar');

    // GET detail pendaftaran user
    Route::get('/detail-pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
});

// Route::get('/bayar/{id}', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');
// Route::get('/bayar/sukses/{id}', [PaymentController::class, 'sukses'])->name('pembayaran.sukses');
// Route::get('/pembayaran/bayar/{id}', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');
// Route::get('/pembayaran/sukses/{id}', [PaymentController::class, 'sukses'])->name('pembayaran.sukses');
// Route::get('/pembayaran/gagal/{id}', [PaymentController::class, 'gagal'])->name('pembayaran.gagal');
// Halaman untuk mulai bayar (setelah daftar)
// Route::post('/bayar/{id}', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');

// Route::get('/pembayaran/{id}/bayar', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');


// Redirect setelah sukses bayar (sementara pakai ini, nanti akan disempurnakan dengan webhook)
Route::get('/pembayaran/sukses/{id}', [PaymentController::class, 'sukses'])->name('pembayaran.sukses');

// Redirect jika gagal atau dibatalkan
Route::get('/pembayaran/gagal/{id}', [PaymentController::class, 'gagal'])->name('pembayaran.gagal');

// Cek Voucher
Route::post('/voucher/cek', [VoucherController::class, 'cek'])->name('voucher.cek');



// Generate tiket setelah bayar
Route::get('/generate-tiket/{pendaftaran_id}', [KarcisController::class, 'generate'])->name('karcis.generate');

// Scan QR oleh panitia
Route::post('/sqan', [KarcisController::class, 'scan'])->name('karcis.scan');

//Show tiket
Route::get('/tiket/{karcis_id}', [KarcisController::class, 'show'])->name('karcis.show');

//Unduh tiket
// Route::get('/tiket/{id}/download-pdf', [KarcisController::class, 'downloadPDF'])->name('karcis.downloadPDF');

//Riwayat Pendaftaran Peserta
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-pendaftaran', [PesertaController::class, 'riwayatPendaftaran'])->name('riwayat-pendaftaran');
});

//Riwayat Transaksi Peserta
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-transaksi', [PesertaController::class, 'riwayatTransaksi'])->name('riwayat-transaksi');
});

//Riwayat Seminar Peserta
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-seminar', [PesertaController::class, 'riwayatSeminar'])->name('riwayat-seminar');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-seminar', [SeminarController::class, 'riwayat'])->name('riwayat-seminar');
});


// //Sertifikat
// Route::get('/sertifikat/{id}/view', [SertifikatController::class, 'view'])->name('sertifikat.view');

Route::middleware(['auth'])->group(function () {
    Route::get('/sertifikat', [SertifikatController::class, 'index'])->name('sertifikat.index');
    Route::get('/sertifikat/{id}', [SertifikatController::class, 'view'])->name('sertifikat.view');
    Route::get('/sertifikat/{id}/download', [SertifikatController::class, 'download'])->name('sertifikat.download');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-tiket', [KarcisController::class, 'riwayatTiket'])->name('riwayat-tiket');
});

Route::middleware(['auth'])->group(function () {
    //upload ttd
    Route::post('/tanda-tangan', [PembicaraController::class, 'uploadTandaTangan'])->name('tanda-tangan');
});

//midtrans
// Route::post('/midtrans/get-snap-token/{id}', [PaymentController::class, 'bayar'])->name('midtrans.getSnapToken');

Route::post('/bayar/{id}', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');

// Route::get('/test-midtrans', [\App\Http\Controllers\TestController::class, 'testMidtrans']);

Route::delete('/pembayaran/hapus/{id}', [PaymentController::class, 'hapusDanUlang'])
    ->name('pembayaran.hapusDanUlang');



require __DIR__ . '/auth.php';
