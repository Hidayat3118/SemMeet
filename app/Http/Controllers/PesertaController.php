<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Seminar;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function riwayatPendaftaran()
    {
        $user = Auth::user();
        $riwayat = Pendaftaran::with([
    'seminar',
    'payment' => function ($query) {
        $query->latest()->limit(1); // ambil satu payment terbaru
    }
])
                    ->where('peserta_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('page.riwayat-pendaftaran', compact('riwayat'));
    }

    public function riwayatTransaksi()
    {
        $user = Auth::user();
        $riwayat = Pendaftaran::with([
                            'seminar',
                            'payment' => function ($query) {
                            $query->latest()->limit(1); // ambil satu payment terbaru
                            }
                        ])
                    ->where('peserta_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('page.riwayat-transaksi', compact('riwayat'));
    }

    public function riwayatSeminar()
    {
        $user = Auth::user();
        $riwayat = Pendaftaran::with('seminar')
                    ->where('peserta_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('page.riwayat-seminar', compact('riwayat'));
    }

}
