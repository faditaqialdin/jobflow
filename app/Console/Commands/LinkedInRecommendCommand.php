<?php

namespace App\Console\Commands;

use App\Jobs\LinkedInRecommendJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LinkedInRecommendCommand extends Command
{
    protected $signature = 'app:linkedin-recommend';

    protected $description = 'Recommend jobs from LinkedIn';

    public function handle(): void
    {
        Log::info('LinkedInRecommendCommand started');
        foreach (User::all() as $user) {
            dispatch(new LinkedInRecommendJob($user));
        }
    }
}
