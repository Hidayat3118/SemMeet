<?php

namespace App\Http\Controllers;

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

     $moderators = Moderator::with('user')
        ->when($query, function ($qBuilder) use ($query) {
            $qBuilder->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            });
        })
        ->latest()
        ->get();

    return view('page.moderator', compact('moderators'));
}
    
     public function show($id)
    {
        // $moderator = Moderator::findOrFail($id);
        $moderator = Moderator::with('seminar')->findOrFail($id);

        return view('page.detail-moderator', compact('moderator'));
    }

}
