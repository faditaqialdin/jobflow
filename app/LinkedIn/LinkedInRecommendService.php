<?php

namespace App\LinkedIn;

use App\Gemini\GeminiJobRecommenderService;
use App\LinkedIn\Job\Job;
use App\LinkedIn\Job\JobFetcher;
use App\LinkedIn\JobList\JobListFetcher;
use App\LinkedIn\Query\JobListQuery;
use App\Mail\NewOpportunities;
use App\Models\User;
use App\Repositories\OpportunityRepository;
use Illuminate\Support\Facades\Mail;
use Throwable;

readonly class LinkedInRecommendService
{
    public function __construct(
        private JobListFetcher              $jobListFetcher,
        private JobFetcher                  $jobFetcher,
        private OpportunityRepository       $opportunityRepository,
        private GeminiJobRecommenderService $geminiJobRecommenderService,
    )
    {
    }

    public function recommend(User $user, JobListQuery $query): void
    {
        try {
            if (!$user->recommend_job) {
                return;
            }

            $jobs = $this->jobListFetcher->fetchAll($query);
            $recommendedJobs = collect();

            /** @var Job $job */
            foreach ($jobs as $job) {
                try {
                    sleep(random_int(4, 6));

                    $opportunity = $this->opportunityRepository->get($user, $job->getName(), $job->getCompany());
                    if ($opportunity) {
                        continue;
                    }

                    $jobDescription = $this->jobFetcher->fetchJobDescription($job);
                    $job->setDescription($jobDescription);

                    $isRecommended = $this->geminiJobRecommenderService->isRecommended($job, $query);

                    if ($isRecommended) {
                        $recommendedJobs->add($job);
                        $this->opportunityRepository->createRecommended($user, $job);
                    }
                } catch (Throwable $throwable) {
                    report($throwable);
                }
            }

            if ($recommendedJobs->isNotEmpty()) {
                Mail::to($user)->send(new NewOpportunities($recommendedJobs));
            }
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }
}
