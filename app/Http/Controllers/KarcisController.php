<?php

namespace App\Http\Controllers;

use App\Models\Karcis;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class KarcisController extends Controller
{
    // Buat tiket setelah pembayaran selesai
    // public function generate($pendaftaran_id)
    // {
    //     $pendaftaran = Pendaftaran::findOrFail($pendaftaran_id);

    //     // Cek jika tiket sudah ada
    //     if ($pendaftaran->karcis) {
    //         return redirect()->back()->with('info', 'Tiket sudah tersedia.');
    //     }

    //     // Buat QR unik
    //     $uuid = Str::uuid();
    //     $qrCode = base64_encode(QrCode::format('png')->size(300)->generate($uuid));

    //     Karcis::create([
    //         'pendaftaran_id' => $pendaftaran->id,
    //         'qr_code' => $qrCode,
    //         'status' => 'active',
    //     ]);

    //     return redirect()->back()->with('success', 'Tiket berhasil dibuat!');
    // }

    public function riwayatTiket()
{
    $user = Auth::user();

    // Ambil semua tiket milik peserta yang sedang login
    $karcis = Karcis::with('pendaftaran.seminar.moderator', 'pendaftaran.seminar.pembicara')
        ->whereHas('pendaftaran', function ($query) use ($user) {
            $query->where('peserta_id', $user->id);
        })
        ->latest()
        ->get();

    return view('page.riwayat-tiket', compact('karcis'));
}

    public function show($id)
{
    $karcis = Karcis::with('pendaftaran.seminar', 'pendaftaran.peserta.user')->findOrFail($id);
    $pendaftaran = $karcis->pendaftaran;

    return view('page.tiket', compact('karcis', 'pendaftaran'));
}

// public function downloadPDF($id)
// {
//     $karcis = Karcis::with('pendaftaran.seminar', 'pendaftaran.peserta.user')->findOrFail($id);
//     $pendaftaran = $karcis->pendaftaran;

//     $pdf = Pdf::loadView('tiket.pdf', compact('karcis', 'pendaftaran'))
//               ->setPaper('A4', 'portrait'); // Atau 'landscape'

//     return $pdf->download('tiket-seminar-'.$karcis->id.'.pdf');
// }

    // // Panitia scan QR untuk tandai kehadiran
    // public function scan(Request $request)
    // {

    //      $request->validate([
    //     'qr_code' => 'required|string',
    //     ]);

    //     $karcis = Karcis::where('token', $request->qr_code)->first();

    //     if (!$karcis) {
    //         return response()->json(['message' => 'QR tidak ditemukan'], 404);
    //     }

    //     if ($karcis->status === 'used') {
    //         return response()->json(['message' => 'QR sudah digunakan sebelumnya'], 409);
    //     }

    //     $karcis->status = 'used';
    //     $karcis->waktu_sqan = now();
    //     $karcis->save();

    //     // Buat sertifikat jika belum dibuat
    //     if (!$karcis->pendaftaran->sertifikat) {
    //         Sertifikat::create([
    //             'pendaftaran_id' => $karcis->pendaftaran_id,
    //             'nama_peserta' => $karcis->pendaftaran->user->nama,
    //             'judul_seminar' => $karcis->pendaftaran->seminar->judul,
    //         ]);
    //     }

    //     return response()->json(['message' => 'Peserta ditandai hadir dan sertifikat dibuat.']);
    // }

//     public function scan(Request $request)
// {
//     $request->validate([
//         'qr_code' => 'required|string',
//     ]);

//     $karcis = Karcis::with('pendaftaran.user', 'pendaftaran.seminar')
//                     ->where('token', $request->qr_code)
//                     ->first();

//     if (!$karcis) {
//         return response()->json(['message' => 'QR tidak ditemukan'], 404);
//     }

//     if ($karcis->status === 'used') {
//         return response()->json(['message' => 'QR sudah digunakan sebelumnya'], 409);
//     }

//     $karcis->status = 'used';
//     $karcis->waktu_sqan = now();
//     $karcis->save();

//     // Buat sertifikat jika belum dibuat
//     if (!$karcis->pendaftaran->sertifikat) {
//         Sertifikat::create([
//             'pendaftaran_id' => $karcis->pendaftaran_id,
//         ]);
//     }

//     return response()->json(['message' => 'Peserta ditandai hadir dan sertifikat dibuat.',
//                             'data' => [
//                                         'nama_peserta' => $karcis->pendaftaran->user->nama,
//                                         'judul_seminar' => $karcis->pendaftaran->seminar->judul,
//                                         'waktu_sqan' => $karcis->waktu_sqan->format('d-m-Y H:i:s'),
//                             ]
//                         ]);
// }

//  public function scan(Request $request)
//     {
//         try {
//             $request->validate([
//                 'qr_code' => 'required|string',
//             ]);

//             $karcis = Karcis::with('pendaftaran.peserta.user', 'pendaftaran.seminar')
//                             ->where('token', $request->qr_code)
//                             ->first();

//             if (!$karcis) {
//                 return response()->json(['message' => 'QR tidak ditemukan'], 404);
//             }

//             if ($karcis->status === 'used') {
//                 return response()->json(['message' => 'QR sudah digunakan sebelumnya'], 409);
//             }

//             $karcis->status = 'used';
//             $karcis->waktu_sqan = now();
//             $karcis->save();

//             // Buat sertifikat jika belum ada
//             if (!$karcis->pendaftaran->sertifikat) {
//                 Sertifikat::create([
//                     'pendaftaran_id' => $karcis->pendaftaran_id,
//                 ]);
//             }

//             return response()->json([
//                 'message' => 'Peserta ditandai hadir dan sertifikat dibuat.']);
//         } catch (\Exception $e) {
//             Log::error('Scan error: ' . $e->getMessage());
//             return response()->json(['message' => 'Terjadi kesalahan pada server.'], 500);
//         }
//     }

public function scan(Request $request)
{
    try {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $karcis = Karcis::with(['pendaftaran.sertifikat', 'pendaftaran.peserta.user', 'pendaftaran.seminar'])
                        ->where('token', $request->qr_code)
                        ->first();

        if (!$karcis) {
            return response()->json(['message' => 'QR tidak ditemukan'], 404);
        }

        if ($karcis->status === 'used') {
            return response()->json([
                'message' => 'QR sudah digunakan sebelumnya',
                'waktu_sqan' => $karcis->waktu_sqan,
                'nama' => optional($karcis->pendaftaran->peserta->user)->name,
            ], 409);
        }

        $karcis->update([
            'status' => 'used',
            'waktu_sqan' => now(),
        ]);

        // Buat sertifikat jika belum ada
        if (!$karcis->pendaftaran->sertifikat) {
            Sertifikat::create([
                'pendaftaran_id' => $karcis->pendaftaran_id,
            ]);
        }

        return response()->json([
            'message' => 'Peserta ditandai hadir dan sertifikat dibuat.',
            'nama' => optional($karcis->pendaftaran->peserta->user)->name,
            'seminar' => optional($karcis->pendaftaran->seminar)->judul,
        ]);
    } catch (\Exception $e) {
        Log::error('Scan error: ' . $e->getMessage());
        return response()->json(['message' => 'Terjadi kesalahan pada server.'], 500);
    }
}



}
