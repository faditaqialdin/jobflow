<?php

namespace App\Console\Commands;

use App\Gmail\GmailSyncService;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GmailSyncCommand extends Command
{
    protected $signature = 'app:gmail-sync';

    protected $description = 'Sync with Gmail';

    public function handle(GmailSyncService $gmailSyncService): void
    {
        Log::info('GmailSyncCommand started');
        foreach (User::all() as $user) {
            $gmailSyncService->sync($user);
        }
        Log::info('GmailSyncCommand finished');
    }
}
