<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function riwayatPendaftaran()
{
    $user = Auth::user();
    $riwayat = Pendaftaran::with('seminar')
                ->where('peserta_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

    return view('page.riwayat-pendaftaran', compact('riwayat'));
}
}
