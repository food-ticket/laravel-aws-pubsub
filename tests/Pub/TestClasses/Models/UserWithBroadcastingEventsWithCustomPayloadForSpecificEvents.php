<?php

namespace PodPoint\AwsPubSub\Tests\Pub\TestClasses\Models;

use PodPoint\AwsPubSub\Pub\Database\Eloquent\BroadcastsEvents;

class UserWithBroadcastingEventsWithCustomPayloadForSpecificEvents extends User
{
    use BroadcastsEvents;

    public function broadcastOn($event)
    {
        switch ($event) {
            case 'created':
            case 'trashed':
            case 'restored':
            case 'deleted':
                return [];
            case 'updated':
                return ['users'];
        }
    }

    public function broadcastWith($event)
    {
        return [
            'action' => $event,
            'data' => [
                'user' => $this,
                'foo' => 'baz',
            ],
        ];
    }
}
