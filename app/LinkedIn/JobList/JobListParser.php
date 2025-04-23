<?php

namespace App\LinkedIn\JobList;

use App\LinkedIn\Job\Job;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;
use Throwable;

class JobListParser
{
    public function parseJobList(string $html): Collection
    {
        $crawler = new Crawler($html);
        $jobs = [];

        $crawler->filter('li')->each(function (Crawler $node) use (&$jobs) {
            try {
                $name = trim($node->filter('.base-search-card__title')->text(''));
                $company = trim($node->filter('.base-search-card__subtitle')->text(''));
                $companyLogo = $node->filter('.artdeco-entity-image')->attr('data-delayed-url') ?? '';
                $companyLogo = str_replace('&amp;', '&', $companyLogo);
                $url = preg_replace('/\?.*/i', '', $node->filter('.base-card__full-link')->attr('href')) ?? '';
                $date = $node->filter('time')->attr('datetime') ?? '';

                if ($name && $company) {
                    $jobs[] = new Job($name, $company, $companyLogo, $url, $date);
                }
            } catch (Throwable $throwable) {
                report($throwable);
            }
        });

        return collect($jobs);
    }
}
