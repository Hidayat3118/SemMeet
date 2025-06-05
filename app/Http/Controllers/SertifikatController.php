<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SertifikatController extends Controller
{
    public function index()
{
    $user = Auth::user();

     // Ambil sertifikat milik user login melalui peserta → pendaftaran → sertifikat
    $sertifikats = Sertifikat::with(['pendaftaran.seminar', 'pendaftaran.peserta.user'])
        ->whereHas('pendaftaran.peserta.user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->get();

    return view('page.sertifikat', compact('sertifikats'));
}

 // Menampilkan detail tampilan sertifikat
    public function show($id)
    {
        $sertifikat = Sertifikat::with('pendaftaran.seminar', 'pendaftaran.peserta.user')->findOrFail($id);

        // Cek kepemilikan akses
        if ($sertifikat->pendaftaran->peserta->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('sertifikat.template', compact('sertifikat'));
    }

    // Unduh sertifikat dalam format PDF
    public function view($id)
    {
        $sertifikat = Sertifikat::with('pendaftaran.seminar.pembicara', 'pendaftaran.peserta.user')->findOrFail($id);

        // Validasi akses
        if ($sertifikat->pendaftaran->peserta->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // Ambil pembicara
        $pembicara = $sertifikat->pendaftaran->seminar->pembicara;

        $pdf = Pdf::loadView('sertifikat.pdf', compact('sertifikat', 'pembicara'))
            ->setPaper('a4', 'landscape'); ;

        return $pdf->stream('sertifikat_' . Str::slug($sertifikat->pendaftaran->peserta->user->name) . '.pdf');
    }

    // Unduh sertifikat dalam format PDF
    public function download($id)
    {
        $sertifikat = Sertifikat::with('pendaftaran.seminar', 'pendaftaran.peserta.user')->findOrFail($id);

        // Validasi akses
        if ($sertifikat->pendaftaran->peserta->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        $pdf = Pdf::loadView('sertifikat.pdf', compact('sertifikat'))
            ->setPaper('a4', 'landscape'); ;

        return $pdf->download('sertifikat_' . Str::slug($sertifikat->pendaftaran->peserta->user->name) . '.pdf');
    }


//     public function view($id)
// {
//     $sertifikat = Sertifikat::with('pendaftaran.seminar')->findOrFail($id);
//     $data = [
//         'nama' => $sertifikat->pendaftaran->nama,
//         'judul' => $sertifikat->pendaftaran->seminar->judul,
//         'tanggal' => $sertifikat->pendaftaran->seminar->tanggal,
//     ];

//     $pdf = Pdf::loadView('sertifikat.template', $data);
//     return $pdf->stream('sertifikat.pdf');
// }
}
