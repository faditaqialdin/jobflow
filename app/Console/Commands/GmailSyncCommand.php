<?php

namespace App\Console\Commands;

use App\Jobs\GmailSyncJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GmailSyncCommand extends Command
{
    protected $signature = 'app:gmail-sync';

    protected $description = 'Sync with Gmail';

    public function handle(): void
    {
        Log::info('GmailSyncCommand started');
        foreach (User::all() as $user) {
            dispatch(new GmailSyncJob($user));
        }
    }
}
