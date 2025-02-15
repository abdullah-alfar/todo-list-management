<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('notifications.{userId}', function ($user, $userId) {
    // logger()->info('Channel authorization check', [
    //     'user_id' => $user->id,
    //     'requested_user_id' => $userId,
    // ]);
    return (int) $user->id === (int) $userId;
});
