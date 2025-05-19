<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{

//     public function daftar($id)
// {
   
//     $user = Auth::user();
//     $seminar = Seminar::findOrFail($id);

//     // Cek apakah user sudah mendaftar sebelumnya
//     $sudahDaftar = Pendaftaran::where('peserta_id', $user->id)
//                     ->where('seminar_id', $seminar->id)
//                     ->exists();

//     if ($sudahDaftar) {
//         return redirect()->route('pendaftaran.detail', ['id' => $seminar->id])
//                          ->with('info', 'Kamu sudah mendaftar seminar ini.');
//     }

//     $pendaftaran = new Pendaftaran();
//     $pendaftaran->peserta_id = $user->id;
//     $pendaftaran->seminar_id = $seminar->id;
//     $pendaftaran->save();

//     return redirect()->route('pendaftaran.detail', ['id' => $pendaftaran->id]);
// }

public function daftar(Seminar $seminar)
{
    $user = Auth::user();

    // Cek apakah user sudah pernah mendaftar seminar ini
    $existing = Pendaftaran::where('peserta_id', $user->id)
        ->where('seminar_id', $seminar->id)
        ->first();

    if ($existing) {
        return redirect()->route('pendaftaran.show')->with('info', 'Kamu sudah mendaftar seminar ini.');
    }

    // Simpan pendaftaran baru
     $pendaftaran = new Pendaftaran();
     $pendaftaran->peserta_id = $user->id;
     $pendaftaran->seminar_id = $seminar->id;
     $pendaftaran->save();

    return redirect()->route('pendaftaran.show')->with('success', 'Pendaftaran berhasil.');
}


public function show()
{
    $user = Auth::user();

    $pendaftaran = Pendaftaran::with(['peserta.user', 'seminar'])
        ->where('peserta_id', $user->id)
        ->latest()
        ->first();

    if (!$pendaftaran) {
        return redirect('/')->with('error', 'Data pendaftaran tidak ditemukan.');
    }

    return view('page.detail-pendaftaran', ['peserta' => $pendaftaran]);
}


//     public function daftar($seminarId)
// {
//     $seminar = Seminar::findOrFail($seminarId);

//     // Cek apakah sudah pernah daftar
//     $userId = Auth::id();
//     $existing = Pendaftaran::where('user_id', $userId)
//         ->where('seminar_id', $seminar->id)
//         ->first();

//     if ($existing) {
//         return redirect()->route('pendaftaran.detail', $existing->id);
//     }

//     // Simpan pendaftaran
//     $pendaftaran = Pendaftaran::create([
//         'user_id' => $userId,
//         'seminar_id' => $seminar->id,
//         'status' => 'pending',
//     ]);

//     return redirect()->route('pendaftaran.detail', $pendaftaran->id);
// }

    public function showPendaftaran()
{
    //  $user = Auth::user();

    // // Ambil relasi peserta dari user
    // $peserta = $user->peserta;

    // if (!$peserta) {
    //     return redirect('/')->with('error', 'Data peserta tidak ditemukan.');
    // }

    // // Ambil data pendaftaran terbaru berdasarkan peserta_id
    // $pendaftaran = Pendaftaran::with(['seminar', 'peserta.user'])
    //     ->where('peserta_id', $peserta->id)
    //     ->latest()
    //     ->first();

    // if (!$pendaftaran) {
    //     return redirect('/')->with('error', 'Data pendaftaran tidak ditemukan.');
    // }

    // return view('page.detail-pendaftaran', compact('pendaftaran'));
    
    $user = Auth::user();

    // Cari data peserta berdasarkan user_id
    $peserta = Peserta::where('user_id', $user->id)->with('user')->first();

    if (!$peserta) {
        return redirect('/')->with('error', 'Data peserta tidak ditemukan.');
    }

    return view('page.detail-pendaftaran', compact('peserta'));
}

}
