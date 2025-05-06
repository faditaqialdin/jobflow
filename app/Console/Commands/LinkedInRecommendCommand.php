<?php

namespace App\Console\Commands;

use App\LinkedIn\LinkedInRecommendService;
use App\LinkedIn\Query\JobListQueryBuilder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LinkedInRecommendCommand extends Command
{
    protected $signature = 'app:linkedin-recommend';

    protected $description = 'Recommend jobs from LinkedIn';

    public function handle(LinkedInRecommendService $linkedInService): void
    {
        Log::info('LinkedInRecommendCommand started');
        foreach (User::all() as $user) {
            $linkedInService->recommend(
                $user,
                JobListQueryBuilder::new()
                    ->setKeywords($user->recommend_job_keywords)
                    ->setAvoids($user->recommend_job_avoids)
                    ->setLocations($user->recommend_job_locations)
                    ->setDateSincePosted('24hr')
                    ->setSortBy('relevant')
                    ->build()
            );
        }
        Log::info('LinkedInRecommendCommand finished');
    }
}
