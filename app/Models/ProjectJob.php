<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectJob extends Model
{
    use HasFactory;

    protected $table = 'project_jobs';

    protected $fillable = [
        'employer_id',
        'opportunity_type',
        'assigned_freelancer_id',
        'category_id',
        'sub_category_id',
        'title',
        'slug',
        'description',
        'experience',
        'job_type',
        'budget_type',
        'budget_min',
        'budget_max',
        'location_type',
        'job_location',
        'total_proposals',
        'duration',
        'views',
        'status',
        'expires_at',
    ];
}