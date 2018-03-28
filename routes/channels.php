<?php

use App\User;
use App\Stream;

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

Broadcast::channel('stream.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('StreamPresence.{id}', function($user, $id) {
	if(isset($user)) {
		return ['id' => $user->id, 'name' => $user->name];
	} else {
		return ['id' => '0', 'name' => 'guest'];
	}
});