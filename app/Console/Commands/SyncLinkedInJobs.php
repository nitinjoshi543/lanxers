<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SyncLinkedInJobs extends Command
{
    protected $signature = 'jobs:sync-linkedin {--timeframe=24h : API time_frame param, e.g. 24h, 7d}';
    protected $description = 'Fetch LinkedIn jobs and store/update in external_jobs table';

    public function handle()
    {
        $timeFrame = $this->option('timeframe');
        $offset = 0;
        $limit = 50;
        $totalSynced = 0;
        $maxPages = 15; // 15 x 50 = 750 jobs cap per run

        for ($page = 0; $page < $maxPages; $page++) {
            $response = getLinkedInJobs($offset, $limit, $timeFrame);

            if (!$response) {
                Log::error("LinkedIn sync ({$timeFrame}): API call failed at offset {$offset}");
                break;
            }

            $jobs = json_decode($response);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->warn("Page {$page}: JSON decode error at offset {$offset}.");
                Log::warning("LinkedIn sync: JSON decode failed. Raw: " . substr($response, 0, 300));
                break;
            }

            if (!is_array($jobs)) {
                $this->warn("Page {$page}: Non-array response at offset {$offset}. Raw: " . substr($response, 0, 300));
                Log::warning("LinkedIn sync: non-array response at offset {$offset}. Raw: " . substr($response, 0, 300));
                break;
            }

            if (empty($jobs)) {
                $this->info("No more jobs at offset {$offset}. Stopping.");
                break;
            }

            $rows = [];

            foreach ($jobs as $job) {
                // extra safety: skip if individual item isn't an object
                if (!is_object($job)) {
                    continue;
                }

                $validThrough = $job->date_valid_through ?? null;
                $isActive = $validThrough ? Carbon::parse($validThrough)->isFuture() : true;

                $safe = function ($value) {
                    if (is_object($value) || is_array($value)) {
                        return json_encode($value);
                    }
                    return $value;
                };

                $rows[] = [
                    'source'                          => 'linkedin',
                    'source_job_id'                    => $safe($job->id ?? null),
                    'source_domain'                    => $safe($job->source_domain ?? null),
                    'title'                             => $safe($job->title ?? null),
                    'organization'                      => $safe($job->organization ?? null),
                    'organization_url'                  => $safe($job->organization_url ?? null),
                    'organization_logo'                 => $safe($job->organization_logo ?? null),
                    'locations'                          => $safe($job->locations_derived[0] ?? null),
                    'address_locality'                  => $safe($job->locations[0]->address->addressLocality ?? null),
                    'salary'                             => $safe($job->salary ?? null),
                    'employment_type'                   => $safe($job->employment_type[0] ?? null),
                    'seniority'                          => $safe($job->seniority ?? null),
                    'url'                                => $safe($job->url ?? null),
                    'org_linkedin_website'               => $safe($job->org_linkedin_website ?? null),
                    'org_linkedin_size'                  => $safe($job->org_linkedin_size ?? null),
                    'org_linkedin_slogan'                => $safe($job->org_linkedin_slogan ?? null),
                    'org_linkedin_industry'              => $safe($job->org_linkedin_industry ?? null),
                    'org_linkedin_description'           => $safe($job->org_linkedin_description ?? null),
                    'ai_experience_level'                => $safe($job->ai_experience_level ?? null),
                    'ai_work_arrangement'                => $safe($job->ai_work_arrangement ?? null),
                    'ai_work_arrangement_office_days'    => $safe($job->ai_work_arrangement_office_days ?? null),
                    'ai_key_skills'                       => json_encode($job->ai_key_skills ?? []),
                    'description_text'                   => $safe($job->description_text ?? null),
                    'date_posted'                         => $safe($job->date_posted ?? null),
                    'date_valid_through'                 => $safe($validThrough),
                    'is_active'                           => $isActive,
                    'updated_at'                          => now(),
                    'created_at'                          => now(),
                ];
            }

            if (!empty($rows)) {
                DB::table('external_jobs')->upsert(
                    $rows,
                    ['source_job_id'],
                    [
                        'title', 'organization', 'organization_url', 'organization_logo',
                        'locations', 'address_locality', 'salary', 'employment_type', 'seniority',
                        'url', 'org_linkedin_website', 'org_linkedin_size', 'org_linkedin_slogan',
                        'org_linkedin_industry', 'org_linkedin_description', 'ai_experience_level',
                        'ai_work_arrangement', 'ai_work_arrangement_office_days', 'ai_key_skills',
                        'description_text', 'date_posted', 'date_valid_through', 'is_active', 'updated_at',
                    ]
                );
                $totalSynced += count($rows);
                $this->info("Page {$page}: synced " . count($rows) . " jobs (offset {$offset}).");
            }

            if (count($jobs) < $limit) break;
            $offset += $limit;
        }

        DB::table('external_jobs')
            ->where('is_active', true)
            ->where('date_valid_through', '<', now())
            ->update(['is_active' => false]);

        $this->info("✅ Total synced: {$totalSynced} jobs (timeframe: {$timeFrame}).");
        Log::info("LinkedIn job sync completed: {$totalSynced} jobs (timeframe: {$timeFrame}).");
    }
}