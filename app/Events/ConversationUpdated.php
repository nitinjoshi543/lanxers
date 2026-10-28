<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConversationUpdated implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public $conversationId;
    public $employerId;
    public $freelancerId;

    public function __construct($conversationId, $employerId, $freelancerId)
    {
        $this->conversationId = $conversationId;
        $this->employerId = $employerId;
        $this->freelancerId = $freelancerId;
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('user.' . $this->employerId),
            new PrivateChannel('user.' . $this->freelancerId),
        ];
    }

    public function broadcastAs()
    {
        return 'conversation.updated';
    }

    public function broadcastWith()
    {
        return [
            'conversation_id' => $this->conversationId,
        ];
    }
}