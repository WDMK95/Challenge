<div>
    <div class="flex mt-4">
        <div class="w-1/4 flex justify-center">
            <livewire:left-menu />
        </div>
        <div class="flex-1">
            <header class="mb-6 relative">
                <div class="flex justify-between items-center mb-6">
                    <div style="max-width: 270px">
                        <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                        <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex">


                        @auth
                        @unless (auth()->user()->is($user))
                        <form wire:submit.prevent="toggleFollow">
                            @csrf

                            <button type="submit" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs">
                                {{ auth()->user()->following($user) ? 'Unfollow Me' : 'Follow Me' }}
                            </button>
                        </form>
                        @endunless
                        @endauth

                    </div>
                </div>

            </header>

            
            @if (auth()->user()->role === 'admin')
            <h3 class="font-bold text-2xl mb-4">Post a tweet as {{ $user->name }}</h3>

            <div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
                <form wire:submit.prevent="saveFakeTweet({{$user->id}})">
                    @csrf

                    <textarea wire:model="body" class="w-full" placeholder="Post a tweet" required
                        autofocus></textarea>
                    @error('body') <span class="error">{{ $message }}</span> @enderror


                    <hr class="my-4">

                    <footer class="flex justify-between items-center">
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            alt="your avatar" class="rounded-full mr-2" width="50" height="50">


                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded-full">
                            Fake Tweet
                        </button>
                    </footer>
                </form>
            </div>

            </a>
            @endif

            <h3 class="font-bold text-2xl mb-4">User Tweets</h3>

            <div class="border border-gray-300 rounded-lg">
                @forelse ($tweets->sortByDesc('created_at') as $tweet)
                <div class="flex p-6 {{ $loop->last ? '' : 'border-b border-b-gray-400' }}">
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
                            </a>
                        </h5>

                        <p class="text-sm mb-3">
                            {{ $tweet->body }}
                        </p>

                        @auth
                        {{-- <x-like-buttons :tweet="$tweet" /> --}}



                        @endauth
                    </div>
                </div>

                @empty
                <p class="p-4">No tweets yet.</p>
                @endforelse

                {{-- {{ $tweets->links() }} --}}
            </div>

        </div>
        <div class="w-1/4 ml-4">
            <livewire:following-side-bar :user="$user" />
        </div>
    </div>
</div>
