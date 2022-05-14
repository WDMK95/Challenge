<?php

namespace App\Http\Livewire;

use App\Models\Retweet;
use App\Models\Tweet;
use Livewire\Component;

class ShowTweets extends Component
{
    public $body;
    public $tweets;
    public $retweets;

    protected $rules = [
        'body' => ['required', 'min:281'],
    ];

    public function updated($body)
    {
        $this->validateOnly($body);
        
    }

    public function mount()
    {
        $this->tweets = Tweet::with('retweets.user', 'retweets.tweet')->latest()->get();
        foreach ($this->tweets as $tweet) {
            if ($tweet->retweets) {
                foreach ($tweet->retweets as $retweet) {
                    $retweet->tweet->retweeted_by = $retweet->user->name;
                    $this->tweets->push($retweet->tweet);
                }
            }
        }
    }

    public function toggleRetweet($id)
    {
        if (Retweet::where('user_id', auth()->user()->id)->where('tweet_id', $id)->exists()) {
            Retweet::where('user_id', auth()->user()->id)->where('tweet_id', $id)->delete();
        } else {
            Retweet::create(['user_id' => auth()->user()->id, 'tweet_id' => $id]);
        }

        $this->tweets = Tweet::with('retweets.user', 'retweets.tweet')->latest()->get();
        foreach ($this->tweets as $tweet) {
            if ($tweet->retweets) {
                foreach ($tweet->retweets as $retweet) {
                    $retweet->tweet->retweeted_by = $retweet->user->name;
                    $this->tweets->push($retweet->tweet);
                }
            }
        }
    }

    public function saveTweet()
    {
        $validatedData = $this->validate();
        $validatedData['user_id'] = auth()->user()->id;

        Tweet::create($validatedData);
        $this->body = '';
        $this->tweets = Tweet::latest()->get();
        session()->flash('success_message', 'Tweet was added');
    }


    public function render()
    {
        return view('livewire.show-tweets', [
            'tweets' => $this->tweets
        ]);
    }
}
