<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seminar;
use App\Models\Pembicara;
use App\Models\Moderator;

class HomeController extends Controller
{
    public function index()
    {
        $seminars = Seminar::latest()->take(5)->get(); // 3 seminar terbaru
        $pembicaras = Pembicara::with('user')->latest()->take(10)->get(); // 3 pembicara terbaru
        $moderators = Moderator::with('user')->latest()->take(10)->get(); // 3 pembicara terbaru

        return view('home', compact('seminars', 'pembicaras', 'moderators'));
    }
}
