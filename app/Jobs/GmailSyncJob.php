<?php

namespace App\Jobs;

use App\Gmail\GmailSyncService;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GmailSyncJob implements ShouldQueue, ShouldBeUnique, ShouldBeEncrypted
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function handle(GmailSyncService $gmailSyncService): void
    {
        Log::info('GmailSyncJob started', [
            'user_id' => $this->user->id,
        ]);
        $gmailSyncService->sync($this->user);
    }

    public function uniqueId(): string
    {
        return $this->user->id;
    }
}

