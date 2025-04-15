<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/tes', function () {
    return view('welcome');
});

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


require __DIR__.'/auth.php';
