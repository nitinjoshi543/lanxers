<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AtsAiService
{

    public function analyzeResume($resumeText, $jobDescription)
    {

        $response = Http::timeout(60)
            ->post('http://127.0.0.1:8000/analyze', [
                'resume' => $resumeText,
                'job_description' => $jobDescription
            ]);

        if (!$response->successful()) {

            throw new \Exception(
                'FastAPI Error (' . $response->status() . '): ' . $response->body()
            );
        }

        return $response->json();
    }
}
