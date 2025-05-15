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
