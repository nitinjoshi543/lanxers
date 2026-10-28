<?php

namespace App\Services;

use Exception;
use OpenAI\Laravel\Facades\OpenAI;

class InterviewAIService
{
    protected string $model;

    public function __construct()
    {
        $this->model = config('services.openai.model', 'gpt-4.1-mini');
    }

    public function generateJobQuestions($job, $jobSkills): array
    {
        $prompt = $this->generateJobPrompt($job, $jobSkills);
        return $this->askForQuestions($prompt);
    }

    public function generateProfileQuestions($profile, $skills): array
    {
        $prompt = $this->generateProfilePrompt($profile, $skills);
        return $this->askForQuestions($prompt);
    }

    public function evaluateInterview(array $questionsAnswers): array
    {
        $prompt = $this->generateEvaluationPrompt($questionsAnswers);
        return $this->askForEvaluation($prompt);
    }

    protected function askForQuestions(string $prompt): array
    {
        $maxAttempts = 3;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {

            try {

                $response = OpenAI::chat()->create([
                    'model' => $this->model,
                    'temperature' => 0.2,
                    'max_completion_tokens' => 2500,
                    'response_format' => [
                        'type' => 'json_object',
                    ],

                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an expert technical interviewer. Return ONLY valid JSON.'
                        ],

                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ]

                ]);

                $content = trim($response->choices[0]->message->content);

                $json = json_decode($content, true);

                if (
                    json_last_error() !== JSON_ERROR_NONE ||
                    !isset($json['questions']) ||
                    !is_array($json['questions'])
                ) {
                    throw new Exception('Invalid JSON returned by AI.');
                }

                if (count($json['questions']) !== 10) {
                    throw new Exception('AI must return exactly 10 questions.');
                }

                foreach ($json['questions'] as &$question) {

                    if (
                        empty($question['question']) ||
                        empty($question['expected_skill'])
                    ) {
                        throw new Exception('Question format is invalid.');
                    }

                    $question['question'] = trim($question['question']);
                    $question['expected_skill'] = trim($question['expected_skill']);
                }

                return $json;
            } catch (\Throwable $e) {

                report($e);

                if ($attempt == $maxAttempts) {
                    throw new Exception(
                        'Unable to generate interview questions. Please try again later.'
                    );
                }

                sleep(1);
            }
        }

        throw new Exception('Unable to generate interview questions.');
    }

    protected function askForEvaluation(string $prompt): array
    {
        $response = OpenAI::chat()->create([
            'model' => $this->model,
            'response_format' => [
                'type' => 'json_object',
            ],

            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a Senior HR interviewer and Technical Lead.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ]
        ]);

        $content = $response->choices[0]->message->content;

        $json = json_decode($content, true);

        if (!is_array($json)) {
            throw new Exception('Invalid AI Evaluation');
        }
        return $json;
    }

    protected function generateJobPrompt($job, $jobSkills): string
    {
        $skills = '';

        foreach ($jobSkills as $skill) {
            $skills .= "- {$skill->name}\n";
        }

        return "

            You are a Senior Technical Interviewer.

            Generate exactly 10 interview questions.

            Job Details

            Job Title:
            {$job->title}

            Experience Required:
            {$job->experience}

            Required Skills:
            {$skills}

            Job Description:
            {$job->description}

            Rules

            1. Generate questions ONLY from the required skills.

            2. Difficulty should match the required experience.

            3. Question distribution:

            - 2 HR questions
            - 5 Technical questions
            - 2 Scenario based questions
            - 1 Behavioural question

            4. Technical questions should directly test the required skills.

            5. Return ONLY valid JSON.

            {
                \"questions\": [
                    {
                        \"question\": \"\",
                        \"expected_skill\": \"\"
                    }
                ]
            }

            ";
    }

    protected function generateProfilePrompt($profile, $skills): string
    {
        $skillText = "";

        foreach ($skills as $skill) {

            $skillText .= "- {$skill->name} "
                . "(Experience: {$skill->experience} years, "
                . "Proficiency: {$skill->proficiency}/10)\n";
        }

        return "

            You are a Senior Technical Interviewer.

            Generate exactly 10 interview questions.

            Candidate Profile

            Job Title:
            {$profile->job_title}

            Professional Summary:
            {$profile->bio}

            Skills

            {$skillText}

            Education

            {$profile->education}

            Portfolio

            {$profile->portfolio}

            Rules

            1. Generate questions based ONLY on these skills.

            2. Difficulty should match the candidate's experience.

            3. Distribution:

            - 2 HR
            - 5 Technical
            - 2 Scenario
            - 1 Behavioural

            4. Ask practical questions.

            5. Return ONLY JSON.

            {
                \"questions\": [
                    {
                        \"question\":\"\",
                        \"expected_skill\":\"\"
                    }

                ]

            }

            ";
    }

    protected function generateEvaluationPrompt(array $qa): string
    {
        $text = "";
        foreach ($qa as $index => $row) {
            $no = $index + 1;
            $text .= "
            Question {$no}
            {$row['question']}

            Answer
            {$row['answer']}
            ";
        }
        return "
            You are an experienced Technical Interviewer.

            Evaluate the candidate.
            {$text}

            Evaluate:
            Communication

            Technical Knowledge
            Problem Solving
            Confidence
            Professionalism

            Return ONLY JSON.
            {
            \"overall_score\":95,
            \"overall_rating\":4.8,
            \"recommendation\":\"Highly Recommended\",
            \"level\":\"Expert\",
            \"communication\":95,
            \"technical\":94,
            \"problem_solving\":93,
            \"confidence\":90,
            \"professionalism\":94,
            \"strengths\":[
            \"...\",
            \"...\"
            ],

            \"weaknesses\":[
            \"...\"
            ],

            \"feedback\":\"...\"
            }
            ";
    }
}
