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

    public static function getSkills($fields)
    {
        return DB::table('skills')
            ->select($fields)
            ->where('status', 1)
            ->get();
    }

    public static function getJobs($fields)
    {
        return DB::table('project_jobs')
            ->leftJoin('employer_profiles', 'employer_profiles.user_id', '=', 'project_jobs.employer_id')
            ->select($fields)
            ->where('project_jobs.status', 'open')
            ->orderByDesc('project_jobs.created_at')
            ->get();
    }
}
