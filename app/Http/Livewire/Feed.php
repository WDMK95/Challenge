<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class Feed extends Component
{
    public $tweets;


    public function mount() {
        $this->tweets = Tweet::latest()->get();
    }

    public function render()
    {
        return view('livewire.feed', [
            'tweets' => $this->tweets
        ]);
    }
}
