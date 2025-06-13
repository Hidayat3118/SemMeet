<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pembicara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembicaraController extends Controller
{
    // public function index()
    // {
    //     $pembicaras = Pembicara::latest()->get();

    //     $kategoris = Kategori::all();
        
    //     $pembicaras = Pembicara::with('kategori')->latest()->get();

    //     return view('page.pembicara', compact('pembicaras', 'kategoris'));

    // }

    public function index(Request $request)
{
    $query = $request->input('q'); // Ambil input dari form pencarian

    $kategoris = Kategori::all();

     $pembicaras = Pembicara::with(['user', 'kategoris'])
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            });
        })
        ->latest()
        ->get();

    return view('page.pembicara', compact('pembicaras', 'kategoris'));
}

     public function show($id)
    {
        // $pembicara = Pembicara::findOrFail($id);
        $pembicara = Pembicara::with('seminar')->findOrFail($id);
        return view('page.detail-pembicara', compact('pembicara'));
    }

     public function byKategori($id)
    {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Mengambil seminar yang terkait dengan kategori tersebut
        // $pembicaras = $kategori->pembicaras()->latest()->get();
        $pembicaras = Pembicara::whereHas('kategoris', function ($query) use ($id) {
        $query->where('kategori_id', $id);
        })->latest()->get();

        // Mengambil semua kategori untuk filter tombol
        $kategoris = Kategori::all();

        return view('page.pembicara', compact('pembicaras', 'kategoris', 'kategori'));
    }

    public function uploadTandaTangan(Request $request)
{
    $request->validate([
        'tanda_tangan' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    ]);

    $pembicara = Pembicara::where('user_id', Auth::id())->first();
    if (!$pembicara) {
        return back()->withErrors(['message' => 'Pembicara tidak ditemukan.']);
    }

    if ($request->hasFile('tanda_tangan')) {
        // Hapus tanda tangan lama jika ada
        if ($pembicara->tanda_tangan && Storage::disk('public')->exists($pembicara->tanda_tangan)) {
            Storage::disk('public')->delete($pembicara->tanda_tangan);
        }

        // Simpan tanda tangan baru
        $file = $request->file('tanda_tangan');
        $path = $file->store('tanda_tangan', 'public');

        // Update kolom di database
        $pembicara->update([
            'tanda_tangan' => $path
        ]);

        return redirect()->back()->with('success', 'Tanda tangan berhasil diupload!');
    }

    return back()->withErrors(['message' => 'Gagal mengunggah file.']);
}

    //     public function uploadTandaTangan(Request $request)
    // {
    //     $request->validate([
    //         'tanda_tangan' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    //     ]);

    //     $pembicara = Pembicara::where('user_id', Auth::id())->first();
    //     if (!$pembicara) {
    //         return back()->withErrors(['message' => 'Pembicara tidak ditemukan.']);
    //     }

    //     $file = $request->file('signature');
    //     $path = $file->store('tanda_tangan', 'public');

    //     $pembicara->update([
    //         'tanda_tangan' => $path
    //     ]);

    //     return redirect()->back()->with('success', 'Tanda tangan berhasil diupload!');
    // }
    
    // public function byKategori($id)
    // {
    //     // Mencari kategori berdasarkan ID
    //     $kategori = Kategori::findOrFail($id);

    //     // Mengambil pembicara yang terkait dengan kategori tersebut
    //     $pembicaras = $kategori->pembicaras()->latest()->get();

    //     // Mengambil semua kategori untuk filter tombol
    //     $kategoris = Kategori::all();

    //     return view('page.pembicara', compact('pembicaras', 'kategoris', 'kategori'));
    // }

}
