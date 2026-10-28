<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendJobSkillNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $jobData;
    public $userData;
    public $matchedSkills;

    public function __construct($jobData, $userData, $matchedSkills)
    {
        $this->jobData = $jobData;
        $this->userData = $userData;
        $this->matchedSkills = $matchedSkills;
    }

    public function handle()
    {
        $message = view('mails.new-job-matched', [
            'user' => $this->userData,
            'job' => $this->jobData,
            'matchedSkills' => $this->matchedSkills,
        ])->render();

        send_mail(
            // $this->userData->email,
            'soloviper543@gmail.com',
            'New Job Matching Your Skills',
            $message
        );
    }
}