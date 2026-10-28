<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ConversationUpdated;
use App\Events\NotificationUpdated;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        DB::table('notifications')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->update([
                'is_read' => 1,
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => true
        ]);
    }
}
