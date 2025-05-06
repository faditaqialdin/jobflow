<?php

namespace App\Console\Commands;

use App\LinkedIn\LinkedInRecommendService;
use App\LinkedIn\Query\JobListQueryBuilder;
use App\Models\User;

class LinkedInRecommendCommand extends AppCommand
{
    protected $signature = 'app:linkedin-recommend';

    protected $description = 'Recommend jobs from LinkedIn';

    public function __construct(private readonly LinkedInRecommendService $linkedInService)
    {
        parent::__construct();
    }

    public function command(): void
    {
        foreach (User::all() as $user) {
            $this->linkedInService->recommend(
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
    }
}
