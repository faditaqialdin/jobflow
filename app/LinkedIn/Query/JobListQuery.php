<?php

namespace App\LinkedIn\Query;

readonly class JobListQuery
{
    public function __construct(private array $query)
    {
    }

    public function getAvoids(): string
    {
        return $this->query['avoids'] ?? '';
    }

    public function get(): string
    {
        return http_build_query([
            'location' => $this->getLocations(),
            'keywords' => $this->getKeywords(),
            'f_TPR' => $this->getDateSincePosted(),
            'sortBy' => $this->getSortBy(),
        ]);
    }

    public function getLocations(): string
    {
        return $this->query['locations'] ?? '';
    }

    public function getKeywords(): string
    {
        return $this->query['keywords'] ?? '';
    }

    public function getDateSincePosted(): string
    {
        return $this->query['dateSincePosted'] ?? '';
    }

    public function getSortBy(): string
    {
        return $this->query['sortBy'] ?? '';
    }
}
