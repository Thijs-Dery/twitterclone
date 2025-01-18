<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Clone</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto mt-5">
        <h1 class="text-xl font-bold mb-5">Twitter Clone</h1>

        @auth
        <!-- Tweet formulier -->
        <form action="{{ route('tweets.store') }}" method="POST" class="mb-5">
            @csrf
            <textarea name="content" rows="3" class="w-full p-3 border rounded" placeholder="What's happening?"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Tweet</button>
        </form>
        @endauth

        <!-- Tweets weergeven -->
        <div>
            @foreach ($tweets as $tweet)
                <div class="bg-white p-4 rounded shadow mb-3">
                    <p class="font-bold">{{ $tweet->user->name }}</p>
                    <p>{{ $tweet->content }}</p>
                    <p class="text-sm text-gray-500">{{ $tweet->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
