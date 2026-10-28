<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendJobSkillNotification;

class JobNotificationController extends Controller
{
    public function sendSkillMatchedJobs()
    {
        $sentCount = 0;
        $skippedCount = 0;

        /*
        |--------------------------------------------------------------------------
        | Get open jobs
        |--------------------------------------------------------------------------
        */

        $jobs = DB::table('project_jobs as pj')
            ->where('pj.status', 'open')
            ->select(
                'pj.id',
                'pj.title',
                'pj.slug',
                'pj.description',
                'pj.budget_min',
                'pj.budget_max',
                'pj.duration',
                'pj.created_at'
            )
            ->get();

        foreach ($jobs as $job) {

            /*
            |--------------------------------------------------------------------------
            | Find freelancers who have at least one skill required by this job
            |--------------------------------------------------------------------------
            */

            $users = DB::table('users as u')
                ->join('user_skills as us', 'us.user_id', '=', 'u.id')
                ->join('job_skills as js', 'js.skill_id', '=', 'us.skill_id')
                ->join('skills as s', 's.id', '=', 'js.skill_id')
                ->where('js.project_job_id', $job->id)
                ->where('u.role', 'freelancer')
                ->select(
                    'u.id as user_id',
                    'u.name',
                    'u.email',
                    DB::raw("GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR ', ') as matched_skills")
                )
                ->groupBy(
                    'u.id',
                    'u.name',
                    'u.email'
                )
                ->get();

            foreach ($users as $user) {
                
                $notification = DB::table('job_skill_notifications')
                    ->where('project_job_id', $job->id)
                    ->where('user_id', $user->user_id)
                    ->first();
                    
                if (
                    $notification &&
                    $notification->sent_at >= now()->subHours(24)
                ) {
                    $skippedCount++;
                    continue;
                }
                
                if ($notification) {

                    DB::table('job_skill_notifications')
                        ->where('id', $notification->id)
                        ->update([
                            'sent_at' => now(),
                            'updated_at' => now(),
                        ]);

                } else {

                    DB::table('job_skill_notifications')->insert([
                        'project_job_id' => $job->id,
                        'user_id' => $user->user_id,
                        'sent_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
                
                SendJobSkillNotification::dispatch(
                    $job,
                    $user,
                    $user->matched_skills
                );

                $sentCount++;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job skill notification process completed.',
            'emails_sent' => $sentCount,
            'already_sent' => $skippedCount,
        ]);
    }
}