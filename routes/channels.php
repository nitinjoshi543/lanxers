<?php
use Illuminate\Support\Facades\DB;

Broadcast::channel('conversation.{conversation}', function ($user, $conversation) {
    return DB::table('conversations')
        ->where('id',$conversation)
        ->where(function($q) use($user){
            $q->where('employer_id',$user->id)
              ->orWhere('freelancer_id',$user->id);
        })
        ->exists();
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('notifications.{userId}', function ($user, $userId) {
    return (int)$user->id === (int)$userId;
});