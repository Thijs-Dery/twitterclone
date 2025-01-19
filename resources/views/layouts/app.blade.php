<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Twitter Clone') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 p-4 text-white flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="{{ route('tweets.index') }}" class="hover:text-blue-400">Latest Tweets</a>
            @auth
                <button id="postTweetButton" class="hover:text-blue-400">Post a Tweet</button>
            @endauth
        </div>
        <div class="relative">
            @auth
                <div class="flex items-center space-x-2">
                    <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-full w-8 h-8">
                    <a href="{{ route('profile.edit') }}" class="hover:text-blue-400">{{ Auth::user()->name }}</a>
                </div>
            @else
                <button id="accountButton" class="hover:text-blue-400">Account</button>
                <div id="accountDropdown" class="hidden absolute bg-white text-black p-4 shadow-lg right-0">
                    <a href="{{ route('login') }}" class="block hover:text-blue-400">Login</a>
                    <a href="{{ route('register') }}" class="block hover:text-blue-400">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-6 p-4">
        @yield('content')
    </div>

    <script>
        document.getElementById('postTweetButton')?.addEventListener('click', () => {
            const tweetForm = document.getElementById('tweetForm');
            tweetForm.classList.toggle('hidden');
        });

        document.getElementById('accountButton')?.addEventListener('click', () => {
            const dropdown = document.getElementById('accountDropdown');
            dropdown.classList.toggle('hidden');
        });
    </script>
</body>
</html>
