<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moderator;

class ModeratorController extends Controller
{
    public function index()
    {
        $moderators = Moderator::latest()->get();
        return view('page.moderator', compact('moderators'));
    }
}
