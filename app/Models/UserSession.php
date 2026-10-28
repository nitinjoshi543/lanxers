<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'session_id',
        'ip_address',
        'user_agent',
        'last_activity',
    ];
}
