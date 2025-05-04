<?php

namespace App\Jobs;

use App\LinkedIn\LinkedInRecommendService;
use App\LinkedIn\Query\JobListQueryBuilder;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LinkedInRecommendJob implements ShouldQueue, ShouldBeUnique, ShouldBeEncrypted
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(LinkedInRecommendService $linkedInService): void
    {
        Log::info('LinkedInRecommendJob started', [
            'user_id' => $this->user->id,
        ]);
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

    public function uniqueId(): string
    {
        return $this->user->id;
    }
}

