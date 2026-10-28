<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Job_model extends Model
{
    public static function jobCategoryAdd($data)
    {
        return DB::table('categories')->insert($data);
    }

    public static function getJobCategory()
    {
        $result = DB::table('categories')
            ->where('status', 1)
            ->get();

        return $result;
    }

    public static function getJobCategoryById($id)
    {
        $result = DB::table('categories')
            ->where('id', $id)
            ->first();

        return $result;
    }

    public static function updateEditJobsCategory($data, $id)
    {
        return DB::table('categories')
            ->where('id', $id)
            ->update($data);
    }

    public static function setjobsCategoryStatus($id, $status)
    {
        return DB::table('categories')
            ->where('id', $id)
            ->update([
                'status' => $status,
            ]);
    }

    public static function jobEmployerAdd($data)
    {
        return DB::table('admin_jobs_employer')->insert($data);
    }

    public static function getJobEmployerById($id)
    {
        $result = DB::table('admin_jobs_employer')
            ->where('id', $id)
            ->first();

        return $result;
    }

    public static function updateEditJobsEmployer($data, $id)
    {
        return DB::table('admin_jobs_employer')
            ->where('id', $id)
            ->update($data);
    }

    public static function setjobsEmployerStatus($id, $status)
    {
        return DB::table('admin_jobs_employer')
            ->where('id', $id)
            ->update([
                'status' => $status,
            ]);
    }

    public static function getEmployer()
    {
        $result = DB::table('admin_jobs_employer')
            ->where('status', 1)
            ->get();

        return $result;
    }

    public static function jobAdd($data)
    {
        return DB::table('project_jobs')->insertGetId($data);
    }

    // 

    public static function search_skills($term)
    {
        return DB::table('skills')
            ->select('id', 'name')
            ->where('name', 'like', "%{$term}%")
            ->limit(10)
            ->get();
    }

    public static function find_or_create_skill($skillName)
    {
        $skillName = trim($skillName);

        $skill = DB::table('skills')->where('name', $skillName)->first();

        if ($skill) {
            return $skill->id;
        }

        return DB::table('skills')->insertGetId([
            'name'       => $skillName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public static function sync_job_skills($jobId, $skillNames)
    {
        // Purane records hata do (edit case ke liye clean sync)
        DB::table('job_skills')->where('job_id', $jobId)->delete();

        $rows = [];

        foreach ($skillNames as $skillName) {
            if (trim($skillName) === '') {
                continue;
            }

            $skillId = self::find_or_create_skill($skillName);

            $rows[] = [
                'job_id'     => $jobId,
                'skill_id'   => $skillId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($rows)) {
            DB::table('job_skills')->insert($rows);
        }
    }

    public static function get_job_skills($jobId)
    {
        return DB::table('job_skills')
            ->select('skills.id', 'skills.name')
            ->leftJoin('skills', 'job_skills.skill_id', '=', 'skills.id')
            ->where('job_skills.job_id', $jobId)
            ->get();
    }

    public static function get_user_details($id, $fields)
    {
        return DB::table('users')
            ->select(DB::raw($fields))
            ->leftJoin('freelancer_profiles', 'users.id', '=', 'freelancer_profiles.user_id')
            ->leftJoin('wallets', 'users.id', '=', 'wallets.user_id')
            ->leftJoin('states', 'states.id', '=', 'freelancer_profiles.state')
            ->leftJoin('countries', 'countries.id', '=', 'freelancer_profiles.country')
            ->where('users.id', $id)
            ->first();
    }

    public static function get_user_skills($id, $fields)
    {
        return DB::table('user_skills')
            ->select(DB::raw($fields))
            ->leftJoin('skills', 'user_skills.skill_id', '=', 'skills.id')
            ->where('user_skills.user_id', $id)
            ->get();
    }

    public static function get_user_experiences($id, $fields)
    {
        return DB::table('user_experiences')
            ->select(DB::raw($fields))
            ->where('user_id', $id)
            ->orderByDesc('id')
            ->get();
    }

}
