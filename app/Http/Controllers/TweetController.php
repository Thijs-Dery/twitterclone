<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    // Methode om alle tweets weer te geven
    public function index()
    {
        $tweets = Tweet::latest()->get(); // Haal tweets op, gesorteerd op nieuwste eerst
        return view('tweets.index', compact('tweets'));
    }

    // Methode om een nieuwe tweet op te slaan
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:280', // Valideer de inhoud van de tweet
        ]);

        Tweet::create([
            'content' => $request->content,
            'user_id' => auth()->id(), // Koppel tweet aan de ingelogde gebruiker
        ]);
        

        return redirect()->route('tweets.index');
    }
}
