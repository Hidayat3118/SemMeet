<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Moderator;

class ModeratorController extends Controller
{
    // public function index()
    // {
    //     $moderators = Moderator::latest()->get();
    //     return view('page.moderator', compact('moderators'));
    // }

    public function index(Request $request)
{
    $query = $request->input('q'); // Ambil input dari form pencarian
    $kategoris = Kategori::all();

     $moderators = Moderator::with(['user', 'kategoris'])
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            });
        })
        ->latest()
        ->get();
        

    return view('page.moderator', compact('moderators', 'kategoris'));
}
    
     public function show($id)
    {
        // $moderator = Moderator::findOrFail($id);
        $moderator = Moderator::with('seminar')->findOrFail($id);

        return view('page.detail-moderator', compact('moderator'));
    }

     public function byKategori($id)
    {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Mengambil seminar yang terkait dengan kategori tersebut
        // $pembicaras = $kategori->pembicaras()->latest()->get();
        $moderators = Moderator::whereHas('kategoris', function ($query) use ($id) {
        $query->where('kategori_id', $id);
        })->latest()->get();

        // Mengambil semua kategori untuk filter tombol
        $kategoris = Kategori::all();

        return view('page.moderator', compact('moderators', 'kategoris', 'kategori'));
    }

}
