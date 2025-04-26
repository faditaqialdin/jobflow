<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class GmailSync extends Component
{
    public string $startDate;

    public function __construct()
    {
        $this->startDate = now()->subMonth()->format('Y-m-d');
        $this->updated();
    }

    public function updated(): void
    {
        user()?->update(['synced_at' => $this->startDate]);
    }

    #[Computed]
    public function isGoogleConnected(): bool
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->googleToken !== null;
    }
}
