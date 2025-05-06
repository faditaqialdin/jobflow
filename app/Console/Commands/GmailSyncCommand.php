<?php

namespace App\Console\Commands;

use App\Gmail\GmailSyncService;
use App\Models\User;

class GmailSyncCommand extends AppCommand
{
    protected $signature = 'app:gmail-sync';

    protected $description = 'Sync with Gmail';

    public function __construct(private readonly GmailSyncService $gmailSyncService)
    {
        parent::__construct();
    }

    public function command(): void
    {
        foreach (User::all() as $user) {
            $this->gmailSyncService->sync($user);
        }
    }
}
