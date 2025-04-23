<?php

namespace App\LinkedIn\Job;

use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

readonly class JobFetcher
{
    public function __construct(
        private GuzzleHttp\Client $client,
        private JobParser         $parser,
    )
    {
    }

    /**
     * @throws GuzzleException
     */
    public function fetchJobDescription(Job $job): string
    {
        $response = $this->client->get($job->getUrl());

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException('Failed to fetch job');
        }

        return $this->parser->parseJobDescription($response->getBody()->getContents());
    }
}
