<?php

namespace App\Repositories;

use App\LinkedIn\Job\Job;
use App\Models\Opportunity;
use App\Models\User;
use Carbon\Carbon;
use InvalidArgumentException;

class OpportunityRepository
{
    public function get(User $user, string $position, string $company): ?Opportunity
    {
        return Opportunity::withTrashed()
            ->where('user_id', $user->id)
            ->whereLike('name', "%{$position}%")
            ->whereLike('company', "%{$company}%")
            ->first();
    }

    public function createRecommended(User $user, Job $job): Opportunity
    {
        return Opportunity::query()->create([
            'user_id' => $user->id,
            'name' => $job->getName(),
            'company' => $job->getCompany(),
            'companyLogo' => $job->getCompanyLogo(),
            'url' => $job->getUrl(),
            'description' => $job->getDescription(),
            'date' => $job->getDate(),
            'status' => 'recommended',
        ]);
    }

    public function createOrUpdate(array $data): Opportunity
    {
        if (!isset($data['company'], $data['name'], $data['status']) || !$data['company'] || !$data['name'] || !$data['status']) {
            throw new InvalidArgumentException('Missing required opportunity fields.');
        }

        $query = Opportunity::query()
            ->where('user_id', $data['user_id'])
            ->whereLike('company', "%{$data['company']}%")
            ->whereLike('name', "%{$data['name']}%");
        /** @var Opportunity $opportunity */
        $opportunity = $query->firstOrNew();
        $opportunity->fill([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'company' => $data['company'],
            'companyLogo' => $opportunity->companyLogo ?? $data['companyLogo'] ?? '',
            'url' => $opportunity->url ?? $data['url'] ?? '',
            'description' => $opportunity->description ?? $data['description'] ?? '',
            'date' => $opportunity->date ?? (isset($data['date']) ? Carbon::parse($data['date']) : now()),
            'status' => $data['status'],
        ]);
        $opportunity->save();
        return $opportunity;
    }
}
