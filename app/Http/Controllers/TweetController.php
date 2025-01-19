<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::latest()->get();
        return view('tweets.index', compact('tweets'));
    }

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
