<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home_model extends Model
{
    use HasFactory;

    public static function getTestimonials($fields)
    {
        return DB::table('testimonials')
            ->select($fields)
            ->where('status', 1)
            ->get();
    }
}
