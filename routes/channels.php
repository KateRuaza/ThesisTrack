<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('warnings.sent.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
