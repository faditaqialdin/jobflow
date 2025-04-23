<?php

namespace App\Gemini;

use App\LinkedIn\Job\Job;
use App\LinkedIn\Query\JobListQuery;
use Gemini\Enums\ModelType;
use Gemini\Laravel\Facades\Gemini;

readonly class GeminiJobRecommenderService
{
    public function __construct(private string $prompt)
    {
    }

    public function isRecommended(Job $job, JobListQuery $query): bool
    {
        $result = Gemini::generativeModel(ModelType::GEMINI_FLASH)
            ->generateContent(
                sprintf(
                    $this->prompt,
                    $query->getKeywords(),
                    $query->getAvoids(),
                    $job->getDescription(),
                )
            )->text();
        return trim($result) === 'true';
    }
}
