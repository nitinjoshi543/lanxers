<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\JobNotificationController;

class SendSkillMatchedJobs extends Command
{
    protected $signature = 'jobs:send-skill-notifications';

    protected $description = 'Send new job notifications to freelancers based on their skills';

    public function handle()
    {
        $this->info('Starting job skill notification process...');

        $controller = app(JobNotificationController::class);

        $response = $controller->sendSkillMatchedJobs();

        $data = $response->getData(true);

        $this->info(
            'Emails sent: ' . ($data['emails_sent'] ?? 0)
        );

        $this->info(
            'Already sent: ' . ($data['already_sent'] ?? 0)
        );

        $this->info('Process completed.');

        return Command::SUCCESS;
    }
}