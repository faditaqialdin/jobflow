<?php

namespace App\LinkedIn\Job;

class Job
{
    private string $description = '';

    public function __construct(
        private readonly string $name,
        private readonly string $company,
        private readonly string $companyLogo,
        private readonly string $url,
        private readonly string $date,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getCompanyLogo(): string
    {
        return $this->companyLogo;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
