<?php

namespace App\Jobs;

use App\LinkedIn\LinkedInRecommendService;
use App\LinkedIn\Query\JobListQueryBuilder;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;

class LinkedInRecommendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(LinkedInRecommendService $linkedInService): void
    {
        $linkedInService->recommend(
            $this->user,
            JobListQueryBuilder::new()
                ->setKeywords($this->user->recommend_job_keywords)
                ->setAvoids($this->user->recommend_job_avoids)
                ->setLocations($this->user->recommend_job_locations)
                ->setDateSincePosted('24hr')
                ->setSortBy('relevant')
                ->build()
        );
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping()];
    }
}

