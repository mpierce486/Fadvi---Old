<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use Fadvi\Discussion;
use Fadvi\User;
use Fadvi\Advisor;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('discussion.{discussionId}', function ($user, $discussionId) {
    
    $discussion = Discussion::where('id', $discussionId)->first();
        
	$user = User::where('id', $discussion->user_id)->first();

	$advisor = Advisor::where('id', $discussion->advisor_id)->first();

    if (Auth::user()->id === $user->id || Auth::user()->username === $advisor->username)
    {
    	return true;
    }
});

