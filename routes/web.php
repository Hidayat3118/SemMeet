<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminarController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\PembicaraController;

// Route::get('/tes', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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



// riwayat seminar

Route::get('/riwayat-seminar', function (){
    return view('page.riwayat-seminar');
})->name('riwayat-seminar');

Route::get('/riwayat-transaksi', function (){
    return view('page.riwayat-transaksi');
})->name('riwayat-transaksi');

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

//detail-pembicara
Route::get('/pembicara/{id}', [PembicaraController::class, 'show'])->name('pembicara.show');

require __DIR__ . '/auth.php';
