@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold">Latest Tweets</h1>
    @auth
        <div id="tweetForm" class="hidden bg-white p-4 mt-4 shadow rounded max-w-xl mx-auto">
            <form action="{{ route('tweets.store') }}" method="POST">
                @csrf
                <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="What's happening?"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Tweet</button>
            </form>
        </div>
    @endauth
@endsection
