<?php

namespace App\Http\Controllers;

use App\Models\Pembicara;
use Illuminate\Http\Request;

class PembicaraController extends Controller
{
    public function index()
    {
        $pembicaras = Pembicara::latest()->get();
        return view('page.pembicara', compact('pembicaras'));
    }
}
