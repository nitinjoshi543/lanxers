<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUpdated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $userId;
    public $count;

    public function __construct($userId, $count)
    {
        $this->userId = $userId;
        $this->count = $count;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'notification.updated';
    }

    public function broadcastWith()
    {
        return [
            'count' => $this->count,
        ];
    }
}