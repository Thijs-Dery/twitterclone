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

        <!-- Tweet formulier -->
        @auth
        <form action="{{ route('tweets.store') }}" method="POST" class="mb-5">
            @csrf
            <textarea name="content" rows="3" class="w-full p-3 border rounded" placeholder="What's happening?"></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Tweet</button>
        </form>
        @endauth

        <!-- Tweets weergeven -->
        <div>
    @foreach ($tweets as $tweet)
        <div>
            <h3>{{ $tweet->user->name }}</h3>
            <p>{{ $tweet->content }}</p>
        </div>
    @endforeach
</div>

    </div>
</body>
</html>
