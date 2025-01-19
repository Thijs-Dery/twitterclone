<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get(); // Laadt ook de gerelateerde gebruikers
        return view('dashboard', compact('tweets'));
    }
    

    public function store(Request $request)
    {
        // Valideer de tweet-invoer
        $request->validate([
            'content' => 'required|max:280',
        ]);

        // Maak een nieuwe tweet aan
        Tweet::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard');
    }
}
