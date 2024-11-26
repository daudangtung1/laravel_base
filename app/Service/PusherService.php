<?php

namespace App\Service;

use Pusher\Pusher;

class PusherService
{
    public function sendNotification($data, $channel, $event): void
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );

        $pusher->trigger($channel, $event, $data);
    }
}
