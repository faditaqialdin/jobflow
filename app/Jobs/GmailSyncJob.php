<?php

namespace App\Jobs;

use App\Gemini\GeminiJobDetectorService;
use App\Gmail\GmailMessageFormatter;
use App\Gmail\GmailServiceFactory;
use App\Models\User;
use App\Repositories\OpportunityRepository;
use Google\Service\Exception;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GmailSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    /**
     * @throws Exception
     * @throws \Google\Exception
     */
    public function handle(
        GmailServiceFactory      $gmailServiceFactory,
        GmailMessageFormatter    $gmailMessageFormatter,
        GeminiJobDetectorService $geminiJobDetectorService,
        OpportunityRepository    $opportunityRepository
    ): void
    {
        $token = $this->user->googleToken;
        if (!$token) {
            return;
        }

        $gmailService = $gmailServiceFactory->make($token);

        $after = $this->user->synced_at ?? now()->subDay();
        $messages = $gmailService->getMessages("after:{$after->format('Y-m-d')}");

        foreach ($messages as $message) {
            try {
                $text = $gmailMessageFormatter->format($this->user, $message);
                $result = $geminiJobDetectorService->getJob($text);
                if ($result) {
                    $opportunityRepository->createOrUpdate($result);
                }
            } catch (\Exception $e) {
                report($e);
            }
        }

        $this->user->update(['synced_at' => now()]);
    }
}

