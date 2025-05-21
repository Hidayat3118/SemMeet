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
//     public function daftar(Seminar $seminar)
// {
//     $user = Auth::user();

//     $peserta = Peserta::where('user_id', $user->id)->first();
//     if (!$peserta) {
//         return redirect('/')->with('error', 'Data peserta tidak ditemukan.');
//     }

//     // Cek apakah sudah mendaftar seminar ini
//     $existing = Pendaftaran::where('peserta_id', $peserta->id)
//         ->where('seminar_id', $seminar->id)
//         ->first();

//     if ($existing) {
//         return redirect()->route('pendaftaran.show', ['id' => $existing->id])
//                          ->with('info', 'Kamu sudah mendaftar seminar ini.');
//     }

//     // Simpan pendaftaran baru
//     $pendaftaran = Pendaftaran::create([
//         'peserta_id' => $peserta->id,
//         'seminar_id' => $seminar->id,
//         'status' => 'pending'
//     ]);

//     return redirect()->route('pendaftaran.show', ['id' => $pendaftaran->id])
//                      ->with('success', 'Pendaftaran berhasil.');
// }

// public function show($id)
// {
//     $user = Auth::user();

//     $pendaftaran = Pendaftaran::with(['seminar', 'peserta.user'])
//         ->where('id', $id)
//         ->whereHas('peserta', function ($query) use ($user) {
//                 $query->where('user_id', $user->id);
//             })
//         ->first();

//     if (!$pendaftaran) {
//         return redirect('/')->with('error', 'Data pendaftaran tidak ditemukan.');
//     }

//     return view('page.detail-pendaftaran', ['pendaftaran' => $pendaftaran]);
// }

public function daftar(Seminar $seminar)
{
    $user = Auth::user();

    $peserta = Peserta::where('user_id', $user->id)->first();
    if (!$peserta) {
        return redirect('/')->with('error', 'Data peserta tidak ditemukan.');
    }

    $existing = Pendaftaran::where('peserta_id', $peserta->id)
        ->where('seminar_id', $seminar->id)
        ->first();

    if ($existing) {
        return redirect()->route('pendaftaran.show', ['id' => $existing->id])
                         ->with('info', 'Kamu sudah mendaftar seminar ini.');
    }

    $pendaftaran = new Pendaftaran();
    $pendaftaran->peserta_id = $peserta->id;
    $pendaftaran->seminar_id = $seminar->id;
    $pendaftaran->status = 'pending'; // bisa disesuaikan jika pakai status
    $pendaftaran->save();

    return redirect()->route('pendaftaran.show', ['id' => $pendaftaran->id])
                     ->with('success', 'Pendaftaran berhasil.');
}

public function show($id)
{
    $user = Auth::user();

    $pendaftaran = Pendaftaran::with(['seminar', 'peserta.user', 'payment']) // tambah relasi payment
        ->where('id', $id)
        ->whereHas('peserta', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->first();

    if (!$pendaftaran) {
        return redirect('/')->with('error', 'Data pendaftaran tidak ditemukan.');
    }

    return view('page.detail-pendaftaran', ['pendaftaran' => $pendaftaran]);
}

}
