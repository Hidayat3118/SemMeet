<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pembicara;
use Illuminate\Http\Request;

class PembicaraController extends Controller
{
    public function index()
    {
        $pembicaras = Pembicara::latest()->get();

        $kategoris = Kategori::all();
        
        $pembicaras = Pembicara::with('kategori')->latest()->get();

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
        $pembicaras = $kategori->pembicaras()->latest()->get();

        // Mengambil semua kategori untuk filter tombol
        $kategoris = Kategori::all();

        return view('page.pembicara', compact('pembicaras', 'kategoris', 'kategori'));
    }
    
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
