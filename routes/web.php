<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// detail pembicara
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



// Peserta
Route::get('/peserta', function () {
    return view('home');
})->middleware(['auth', 'verified', 'role:peserta'])->name('peserta');

// Pembicara
Route::get('/pembicaraTes', function () {
    return '<h1>Halo Pembicara</h1>';
})->middleware(['auth', 'verified', 'role:pembicara'])->name('pembicaraTes');

// Moderator
Route::get('/moderatorTes', function () {
    return '<h1>Hai Moderator</h1>';
})->middleware(['auth', 'verified', 'role:moderator'])->name('moderatorTes');

// // Panitia
// Route::get('/panitia', function(){
//     return '<h1>Halo Panitia</h1>';
// })->middleware(['auth', 'verified', 'role:panitia']);

// // Keuangan
// Route::get('/keuangan', function(){
//     return '<h1>Bagian Keuangan</h1>';
// })->middleware(['auth', 'verified', 'role:keuangan']);


require __DIR__ . '/auth.php';
