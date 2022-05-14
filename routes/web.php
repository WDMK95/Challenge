<?php

use App\Http\Livewire\Feed;
use App\Http\Livewire\ShowTweets;
use App\Http\Livewire\PostTweetForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Livewire\Profiles\ShowProfile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/feed');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/feed', Feed::class)->name('feed');

    Route::post('/tweets', ShowTweets::class)->name('tweets');

    Route::get('/profiles/{user}', ShowProfile::class)->name('profiles');
    
    Route::post('/clean', [TweetController::class, 'cleanTweet'])->name('clean');
});
