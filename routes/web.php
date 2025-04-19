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


Route::get('/', function (){
    return view('home');
});
Route::get('/pembicara', function (){
    return view('page.pembicara');
});
Route::get('/moderator', function (){
    return view('page.moderator');
});
Route::get('/seminar', function (){
    return view('page.seminar');
});

// detail
Route::get('/detail-seminar', function(){
return view('page.detail-seminar');
});

// Peserta
Route::get('/peserta', function(){
    return '<h1>Selamat Datang Peserta</h1>';
})->middleware(['auth', 'verified', 'role:peserta'])->name('peserta');

// Pembicara
Route::get('/pembicara', function(){
    return '<h1>Halo Pembicara</h1>';
})->middleware(['auth', 'verified', 'role:pembicara'])->name('pembicara');

// Moderator
Route::get('/moderator', function(){
    return '<h1>Hai Moderator</h1>';
})->middleware(['auth', 'verified', 'role:moderator'])->name('moderator');

// Panitia
Route::get('/panitia', function(){
    return '<h1>Halo Panitia</h1>';
})->middleware(['auth', 'verified', 'role:panitia']);

// Keuangan
Route::get('/keuangan', function(){
    return '<h1>Bagian Keuangan</h1>';
})->middleware(['auth', 'verified', 'role:keuangan']);


require __DIR__.'/auth.php';
