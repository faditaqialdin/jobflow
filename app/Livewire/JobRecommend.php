<?php

namespace App\Livewire;

use Livewire\Component;

class JobRecommend extends Component
{
    private const SEPARATOR = ',';
    public bool $recommendJob = false;
    public array $locations = [];
    public array $keywords = [];
    public array $avoids = [];

    public function mount(): void
    {
        $this->recommendJob = user()?->recommend_job;
        $this->keywords = $this->getValues(user()?->recommend_job_keywords);
        $this->avoids = $this->getValues(user()?->recommend_job_avoids);
        $this->locations = $this->getValues(user()?->recommend_job_locations);
    }

    private function getValues(string $string): array
    {
        $returnValues = [];
        $values = $string ? explode(self::SEPARATOR, $string) : [];
        foreach ($values as $value) {
            $returnValues[$value] = $value;
        }
        return $returnValues;
    }

    public function addLocation(string $location): void
    {
        $this->locations[$location] = $location;
        $this->updateData();
    }

    public function updateData(): void
    {
        user()?->update([
            'recommend_job' => $this->recommendJob,
            'recommend_job_keywords' => implode(self::SEPARATOR, $this->keywords),
            'recommend_job_avoids' => implode(self::SEPARATOR, $this->avoids),
            'recommend_job_locations' => implode(self::SEPARATOR, $this->locations),
        ]);
    }

    public function removeLocation(string $location): void
    {
        if (!$location) {
            array_pop($this->locations);
        } else {
            unset($this->locations[$location]);
        }
        $this->updateData();
    }

    public function addKeyword(string $keyword): void
    {
        $this->keywords[$keyword] = $keyword;
        $this->updateData();
    }

    public function removeKeyword(string $keyword): void
    {
        if (!$keyword) {
            array_pop($this->keywords);
        } else {
            unset($this->keywords[$keyword]);
        }
        $this->updateData();
    }

    public function addAvoid(string $avoid): void
    {
        $this->avoids[$avoid] = $avoid;
        $this->updateData();
    }

    public function removeAvoid(string $avoid): void
    {
        if (!$avoid) {
            array_pop($this->avoids);
        } else {
            unset($this->avoids[$avoid]);
        }
        $this->updateData();
    }
}
