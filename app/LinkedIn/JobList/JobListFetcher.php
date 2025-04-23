<?php

namespace App\LinkedIn\JobList;

use App\LinkedIn\Query\JobListQuery;
use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use RuntimeException;
use Throwable;

class JobListFetcher
{
    private const BATCH_SIZE = 10;

    public function __construct(
        private readonly GuzzleHttp\Client $client,
        private readonly JobListParser     $parser,
    )
    {
    }

    public function fetchAll(JobListQuery $query): Collection
    {
        $page = 0;
        $consecutiveErrors = 0;

        $allJobs = collect();
        $jobs = collect();
        do {
            try {
                sleep(random_int(2, 3));
                $jobs = $this->fetchPage($page++, $query);
                $consecutiveErrors = 0;
                $allJobs = $allJobs->concat($jobs->toArray());
            } catch (Throwable $throwable) {
                if (++$consecutiveErrors > 3) {
                    report($throwable);
                    break;
                }
                sleep(2 ** $consecutiveErrors);
            }
        } while (!$jobs->isEmpty());

        return $allJobs;
    }

    /**
     * @throws GuzzleException
     */
    private function fetchPage(int $page, JobListQuery $query): Collection
    {
        $response = $this->client->get(
            $this->getUrl($page, $query),
            [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0',
                    'Accept' => 'application/json, text/javascript, */*; q=0.01',
                    'Referer' => 'https://www.linkedin.com/jobs',
                    'X-Requested-With' => 'XMLHttpRequest'
                ]
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Failed to fetch jobs');
        }

        return $this->parser->parseJobList($response->getBody()->getContents());
    }

    private function getUrl(int $page, JobListQuery $query): string
    {
        $url = "https://www.linkedin.com/jobs-guest/jobs/api/seeMoreJobPostings/search?";
        $start = $page * self::BATCH_SIZE;
        return $url . "start=$start&{$query->get()}";
    }
}
