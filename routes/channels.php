<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('warnings.sent', function () {
    return true;
});
