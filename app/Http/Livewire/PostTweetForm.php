<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class PostTweetForm extends Component
{

    // public $body;
 
    // protected $rules = [
    //     'body' => 'required|min:3',
    // ];
 
    // public function updated($body)
    // {
    //     $this->validateOnly($body);
    // }
 
    // public function saveTweet()
    // {
    //     $validatedData = $this->validate();
    //     // dd($validatedData);
    //     $validatedData['user_id'] = auth()->user()->id;
 
    //     Tweet::create($validatedData);
    // }


    public function render()
    {
        // dd('tojj', request()->all());
        // return redirect()->to('/dashboard');
        // return redirect()->back();

        return view('livewire.post-tweet-form');
    }
}
