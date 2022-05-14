<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FollowingSideBar extends Component
{
    public $user;

    public function render()
    {

        return view('livewire.following-side-bar', [
            'user' => $this->user
        ]);
    }
}
