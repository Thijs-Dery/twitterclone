<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    // Toon alle tweets
    public function index()
    {
        $tweets = Tweet::with('user')->latest()->get();
        return view('tweets.index', compact('tweets'));
    }

    // Sla een nieuwe tweet op
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->route('tweets.index');
    }
}
