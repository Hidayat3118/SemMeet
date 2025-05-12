<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Seminar;

class SeminarController extends Controller
{
    public function index()
    {
        $seminars = Seminar::latest()->get();

        $kategoris = Kategori::all();
        
        $seminars = Seminar::with('kategori')->latest()->get();

        return view('page.seminar', compact('seminars', 'kategoris'));
    }

    public function show($id)
    {
        $seminar = Seminar::with(['moderator', 'pembicara'])->where('id', $id)->firstOrFail();
        return view('page.detail-seminar', compact('seminar'));
    }

    public function byKategori($id)
    {
        // Mencari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Mengambil seminar yang terkait dengan kategori tersebut
        $seminars = $kategori->seminars()->latest()->get();

        // Mengambil semua kategori untuk filter tombol
        $kategoris = Kategori::all();

        return view('page.seminar', compact('seminars', 'kategoris', 'kategori'));
    }
}
