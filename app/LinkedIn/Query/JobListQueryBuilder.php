<?php

namespace App\LinkedIn\Query;

class JobListQueryBuilder
{
    private array $query = [];

    public static function new(): JobListQueryBuilder
    {
        return new self();
    }

    public function setKeywords(string $keywords): JobListQueryBuilder
    {
        $this->query['keywords'] = $this->replaceSpaces($keywords);
        return $this;
    }

    private function replaceSpaces(string $value): string
    {
        return str_replace(' ', '+', trim($value));
    }

    public function setAvoids(string $avoids): JobListQueryBuilder
    {
        $this->query['avoids'] = $this->replaceSpaces($avoids);
        return $this;
    }

    public function setLocations(string $locations): JobListQueryBuilder
    {
        $this->query['locations'] = $this->replaceSpaces($locations);
        return $this;
    }

    public function setDateSincePosted(string $dateSincePosted): JobListQueryBuilder
    {
        $this->query['dateSincePosted'] = match (strtolower($dateSincePosted)) {
            'past month' => 'r2592000',
            'past week' => 'r604800',
            '24hr' => 'r86400',
            default => '',
        };
        return $this;
    }

    public function setSortBy(string $sortBy): JobListQueryBuilder
    {
        $this->query['sortBy'] = match (strtolower($sortBy)) {
            'recent' => 'DD',
            'relevant' => 'R',
            default => ''
        };
        return $this;
    }

    public function build(): JobListQuery
    {
        return new JobListQuery($this->query);
    }
}
