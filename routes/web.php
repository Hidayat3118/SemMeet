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

// Route::get('/tes', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
    // , 'verified'
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/extended', [ProfileController::class, 'editExtended'])->name('profile.editExtended');   // Form untuk profil tambahan
    Route::patch('/profile/extended', [ProfileController::class, 'updateExtended'])->name('profile.update.extended'); // Update profil tambahan
});


Route::get('/', function () {
    return view('home');
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

Route::get('/riwayat-seminar', function (){
    return view('page.riwayat-seminar');
})->name('riwayat-seminar');

Route::get('/riwayat-pendaftaran', function (){
    return view('page.riwayat-pendaftaran');
})->name('riwayat-pendaftaran');

Route::get('/riwayat-transaksi', function (){
    return view('page.riwayat-transaksi');
})->name('riwayat-transaksi');

// ku tambahi
Route::get('/riwayat-tiket', function (){
    return view('page.riwayat-tiket');
})->name('riwayat-tiket');

Route::get('/sertifikat', function (){
    return view('page.sertifikat');
})->name('sertifikat');

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
Route::get('/bayar/{id}', [PaymentController::class, 'bayar'])->name('pembayaran.bayar');

// Redirect setelah sukses bayar (sementara pakai ini, nanti akan disempurnakan dengan webhook)
Route::get('/pembayaran/sukses/{id}', [PaymentController::class, 'sukses'])->name('pembayaran.sukses');

// Redirect jika gagal atau dibatalkan
Route::get('/pembayaran/gagal/{id}', [PaymentController::class, 'gagal'])->name('pembayaran.gagal');

// Generate tiket setelah bayar
Route::get('/generate-tiket/{pendaftaran_id}', [KarcisController::class, 'generate'])->name('karcis.generate');

// Scan QR oleh panitia
Route::post('/scan-qr', [KarcisController::class, 'scan'])->name('karcis.scan');

//Show tiket
Route::get('/tiket/{karcis_id}', [KarcisController::class, 'show'])->name('karcis.show');

//Unduh tiket
// Route::get('/tiket/{id}/download-pdf', [KarcisController::class, 'downloadPDF'])->name('karcis.downloadPDF');

//Riwayat Pendaftaran Peserta
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-pendaftaran', [PesertaController::class, 'riwayatPendaftaran'])->name('riwayat-pendaftaran');
});





require __DIR__ . '/auth.php';
