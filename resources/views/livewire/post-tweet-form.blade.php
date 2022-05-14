<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form wire:submit.prevent="saveTweet">
        @csrf

        <textarea
            wire:model="body"
            class="w-full"
            placeholder="Tweet something?"
            required
            autofocus
        ></textarea>
        @error('body') <span class="error">{{ $message }}</span> @enderror


        <hr class="my-4">

        <footer class="flex justify-between items-center">
            <img
                src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}"
                alt="your avatar"
                class="rounded-full mr-2"
                width="50"
                height="50"
            >
            

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10"
            >
                Tweet
            </button>
        </footer>
    </form>

</div>
