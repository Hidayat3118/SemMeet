<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Pendaftaran;
use App\Models\Seminar;
use Illuminate\Support\Facades\Auth;


class SeminarController extends Controller
{
    // public function index()
    // {
    //     $seminars = Seminar::latest()->get();

    //     $kategoris = Kategori::all();
        
    //     $seminars = Seminar::with('kategori')->latest()->get();

    //     return view('page.seminar', compact('seminars', 'kategoris'));
    // }

    public function index(Request $request)
{
    $query = $request->input('q'); // Ambil input dari form pencarian
    $mode = $request->input('mode'); //Filter mode

    $kategoris = Kategori::all();

    // $seminars = Seminar::with(['kategoris', 'pembicara.user', 'moderator.user'])
    //     ->where('status', 'aktif')
    //     ->when($query, function ($qBuilder) use ($query) {
    //         $qBuilder->where('judul', 'like', '%' . $query . '%')
    //                  ->orWhere('deskripsi', 'like', '%' . $query . '%')
    //                  ->orWhereHas('pembicara.user', function ($q) use ($query) {
    //                      $q->where('name', 'like', '%' . $query . '%');
    //                  })
    //                  ->orWhereHas('moderator.user', function ($q) use ($query) {
    //                      $q->where('name', 'like', '%' . $query . '%');
    //                  });
                     
    //     })
    //     ->latest()
    //     ->get();

       $seminars = Seminar::with(['kategoris', 'pembicara.user', 'moderator.user'])
        ->where('status', 'aktif')
        ->when($mode, function ($q) use ($mode) {
            $q->where('mode', $mode);
        })
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->where(function ($subQuery) use ($query) {
                $subQuery->where('judul', 'like', '%' . $query . '%')
                    ->orWhere('deskripsi', 'like', '%' . $query . '%')
                    ->orWhereHas('pembicara.user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })
                    ->orWhereHas('moderator.user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    });
            });
        })
        ->latest()
        ->get();

    return view('page.seminar', compact('seminars', 'kategoris'));
}


    public function show($id)
    {
        $seminar = Seminar::with(['moderator', 'pembicara', 'pendaftaran.payment'])->where('id', $id)->firstOrFail();
         // Hitung jumlah pendaftar yang sudah bayar sukses
        $jumlahTerisi = 0;
        foreach ($seminar->pendaftaran as $pendaftaran) {
            $latestPayment = $pendaftaran->payment->sortByDesc('created_at')->first();
            if ($latestPayment && $latestPayment->status_pembayaran === 'completed') {
                $jumlahTerisi++;
            }
        }

        $sisa_kouta = $seminar->kouta - $jumlahTerisi;
        return view('page.detail-seminar', compact('seminar', 'sisa_kouta'));
    }

    public function byKategori($id)
    {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Mengambil seminar yang terkait dengan kategori tersebut
        // $seminars = $kategori->seminars()->latest()->get();

        $seminars = Seminar::whereHas('kategoris', function ($query) use ($id) {
        $query->where('kategori_id', $id);
        })->latest()->get();

        // Mengambil semua kategori untuk filter tombol
        $kategoris = Kategori::all();

        return view('page.seminar', compact('seminars', 'kategoris', 'kategori'));
    }

public function riwayat()
{
    $user = Auth::user();

    // Cek apakah user adalah peserta
    if ($user->peserta) {
        $seminars = Pendaftaran::with('seminar.moderator.user', 'seminar.pembicara.user')
            ->where('peserta_id', $user->peserta->id)
            ->get()
            ->pluck('seminar');
    }
    // Jika user adalah pembicara
    elseif ($user->pembicara) {
        $seminars = Seminar::with('moderator.user', 'pembicara.user')
            ->whereHas('pembicara', function ($q) use ($user) {
                $q->where('id', $user->pembicara->id);
            })
            ->get();
    }
    // Jika user adalah moderator
    elseif ($user->moderator) {
        $seminars = Seminar::with('moderator.user', 'pembicara.user')
            ->whereHas('moderator', function ($q) use ($user) {
                $q->where('id', $user->moderator->id);
            })
            ->get();
    }
    else {
        $seminars = collect();
    }

    return view('page.riwayat-seminar', compact('seminars'));
}

}
