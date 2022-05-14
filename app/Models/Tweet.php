<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tweet extends Model
{
    // use Likable;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retweets()
    {
        return $this->hasMany(Retweet::class);
    }

    public function alreadyRetweeted()
    {
        return $this->retweets()->pluck('user_id')->contains(auth()->user()->id);
    }

    //     /**
    //  * Interact with the user's first name.
    //  *
    //  * @param  string  $value
    //  * @return \Illuminate\Database\Eloquent\Casts\Attribute
    //  */
    // protected function retweetedBy(): Attribute
    // {
    //     return Attribute::make(
    //         function($value) { $value; },
    //         function($value) { $value; },
    //     );
    // }
}
