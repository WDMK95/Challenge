<?php

namespace App\Http\Livewire\Profiles;

use App\Models\Tweet;
use App\Models\User;
use Livewire\Component;

class ShowProfile extends Component
{
    public $user;
    public $body;
    public $tweets;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->tweets = $user->tweets->sortByDesc('created_at');
    }

    public function toggleFollow()
    {
        auth()->user()->toggleFollow($this->user);
    }

    public function saveFakeTweet($id)
    {
        // dd($this->tweets);
        $tweet = Tweet::create(['user_id' => $id, 'body' => $this->body]);
        $this->tweets->push($tweet)->sortByDesc('created_at');
        $this->body = '';
        // dd($id, $this->body);
        // dd($this->user->tweets);
        // $this->user->tweets = $this->user->tweets()->fresh()->get();
    }


    public function render()
    {
        return view('livewire.profiles.show-profile', [
            'tweets' => $this->user->tweets
        ]);
    }
}
