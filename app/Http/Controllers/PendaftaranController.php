<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Seminar;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{


    // functio upload gambar

   public function uploadFoto(Request $request, $id)
{
    $request->validate([
        'foto_validasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $pendaftaran = Pendaftaran::where('id', $id)
        ->whereHas('peserta', function ($query) {
            $query->where('user_id', Auth::id());
        })->firstOrFail();

    // Hapus foto lama jika ada
    if ($pendaftaran->foto_validasi) {
        Storage::disk('public')->delete($pendaftaran->foto_validasi);
    }

    // Simpan foto baru
    $file = $request->file('foto_validasi');

    // Nama file dengan folder-nya
    $namaFile = 'foto_pendaftaran/user_' . Auth::id() . '_pendaftaran_' . $pendaftaran->id . '.' . $file->getClientOriginalExtension();

    // Simpan ke folder public/foto_pendaftaran
    $file->storeAs('public/foto_pendaftaran', basename($namaFile));

    // Simpan nama file (dengan folder) ke DB
    $pendaftaran->foto_validasi = $namaFile;
    $pendaftaran->save();

    return back()->with('success', 'Bukti pendaftaran berhasil diupload!');
}



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
