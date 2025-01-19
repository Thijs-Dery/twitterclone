<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h1 class="text-xl font-bold">Latest Tweets</h1>
                @auth
                    <form action="{{ route('tweets.store') }}" method="POST" class="mt-4 bg-white p-4 shadow rounded">
                        @csrf
                        <textarea name="content" rows="3" class="w-full p-2 border rounded" placeholder="What's happening?"></textarea>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Tweet</button>
                    </form>
                @endauth

                <div class="mt-6">
                    @foreach ($tweets as $tweet)
                        <div class="bg-white p-4 shadow rounded mb-4">
                            <p>{{ $tweet->content }}</p>
                            <small class="text-gray-500">
                                Posted by {{ $tweet->user->name }} at {{ $tweet->created_at }}
                            </small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
