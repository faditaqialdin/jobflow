<?php

namespace App\Gmail;

use App\Gemini\GeminiJobDetectorService;
use App\Gmail\Service\GmailMessageFormatter;
use App\Gmail\Service\GmailServiceFactory;
use App\Models\User;
use App\Repositories\OpportunityRepository;
use Throwable;

readonly class GmailSyncService
{
    public function __construct(
        private GmailServiceFactory      $gmailServiceFactory,
        private GmailMessageFormatter    $gmailMessageFormatter,
        private GeminiJobDetectorService $geminiJobDetectorService,
        private OpportunityRepository    $opportunityRepository
    )
    {
    }

    public function sync(User $user): void
    {
        try {
            $token = $user->googleToken;
            if (!$token) {
                return;
            }

            $gmailService = $this->gmailServiceFactory->make($token);

            $after = $user->synced_at ?? now()->subDay();
            $messages = $gmailService->getMessages("after:{$after->format('Y-m-d')}");

            foreach ($messages as $message) {
                try {
                    $text = $this->gmailMessageFormatter->format($user, $message);
                    $result = $this->geminiJobDetectorService->getJob($text);
                    if ($result) {
                        $this->opportunityRepository->createOrUpdate($user, $result);
                    }
                } catch (Throwable $throwable) {
                    report($throwable);
                }
            }

            $user->update(['synced_at' => now()]);
        } catch (Throwable $throwable) {
            report($throwable);
        }
    }
}

