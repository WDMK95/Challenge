<div>

    <div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
        <form wire:submit.prevent="saveTweet">
            @csrf

            <textarea wire:model="body" class="w-full" placeholder="Post a tweet" required autofocus></textarea>
            @error('body') <span class="error">{{ $message }}</span> @enderror


            <hr class="my-4">

            <footer class="flex justify-between items-center">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                    alt="your avatar" class="rounded-full mr-2" width="50"
                    height="50">


                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded-full">
                    Tweet
                </button>
            </footer>
        </form>
    </div>

    <div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
        <form method="POST" action="/clean">
            @csrf
            <textarea name="text" class="w-full" placeholder="Post a sanitized tweet" required autofocus></textarea>
            @error('body') <span class="error">{{ $message }}</span> @enderror


            <hr class="my-4">

            <footer class="flex justify-between items-center">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                    alt="your avatar" class="rounded-full mr-2" width="50"
                    height="50">


                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded-full">
                    Sanitized Tweet
                </button>
            </footer>
        </form>
    </div>

    <div class="border border-gray-300 rounded-lg">
        @forelse ($tweets as $tweet)
        <div
            class="flex p-6 {{ $loop->last ? '' : 'border-b border-b-gray-400' }} {{ isset($tweet->retweeted_by) ? 'bg-gray-200' : ''}}">
            <div class="mr-2 flex-shrink-0">
                <a href="{{ $tweet->user->path() }}">
                    <img src="{{ $tweet->user->profile_photo_url }}" alt="" class="rounded-full mr-2" width="50"
                        height="50">
                </a>
            </div>

            <div>
                <h5 class="font-bold mb-2">
                    <a href="{{ $tweet->user->path() }}">
                        {{ $tweet->user->name }}
                        {{ isset($tweet->retweeted_by) ? " retweeted by {$tweet->retweeted_by}" : ''}}
                    </a>
                </h5>

                <p class="text-sm mb-3">
                    {{ $tweet->body }}
                </p>

                @if ($tweet->user_id !== auth()->user()->id)

                <form wire:submit.prevent="toggleRetweet({{ $tweet->id }})">

                    <div class="flex items-center">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mt-2 rounded-full text-xs">
                            {{ $tweet->alreadyRetweeted() ? 'Remove Retweet' : 'Retweet' }}
                        </button>
                    </div>
                </form>
                @endif

                <div>Retweets: {{ $tweet->retweets->count() }}</div>
            </div>
        </div>

        @empty
        <p class="p-4">No tweets yet.</p>
        @endforelse
    </div>

</div>
