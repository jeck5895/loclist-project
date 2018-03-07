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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('client-channel', function ($user) {
    // return (int) $user->id === (int) $id;
    return !empty($user) ? true : false;
});
/**
 * For broadcasting authentication, who can listen to a channel
 * NOTE: for {clientId} it must be the same variable from the controller
 *      otherwise this will broadcast even with different client id
 */
Broadcast::channel('client-call-channel-{clientId}', function ($user, $clientId) {
    // return (int) $user->id === (int) $id;
    return !empty($user) ? true : false;
});

Broadcast::channel('client-saturation-channel-{clientId}', function ($user, $clientId) {
    // return (int) $user->id === (int) $id;
    return !empty($user) ? true : false;
});

Broadcast::channel('client-presentation-channel-{clientId}', function ($user, $clientId) {
    // return (int) $user->id === (int) $id;
    return !empty($user) ? true : false;
});

Broadcast::channel('user-channel', function ($user) {
    // return (int) $user->id === (int) $id;
    return !empty($user) ? true : false;
});

Broadcast::channel('maintenance-channel', function ($user) {
    return true;
});