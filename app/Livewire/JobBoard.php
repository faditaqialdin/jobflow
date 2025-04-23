<?php

namespace App\Livewire;

use App\Models\Opportunity;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class JobBoard extends Component
{
    #[On('refreshJobBoard')]
    public function refreshJobBoard(): void
    {
        $this->dispatch('$refresh');
    }

    #[Computed]
    public function statuses(): array
    {
        return Opportunity::STATUSES;
    }

    #[Computed]
    public function count($status): int
    {
        /** @var User $user */
        $user = auth()->user();
        return $user->opportunities()->where('status', $status)->count();
    }
}
