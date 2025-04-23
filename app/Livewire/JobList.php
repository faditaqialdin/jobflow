<?php

namespace App\Livewire;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class JobList extends Component
{
    public string $status;

    #[On('refreshJobBoard')]
    public function refreshJobBoard(): void
    {
        $this->dispatch('$refresh');
    }

    #[Computed]
    public function opportunities(): Collection
    {
        return $this->query()->latest()->get();
    }

    protected function query($withStatus = true): HasMany
    {
        /** @var User $user */
        $user = auth()->user();
        $query = $user->opportunities();
        if ($withStatus) {
            $query->where('status', $this->status);
        }
        return $query;
    }

    public function remove($id): void
    {
        $this->query()->findOrFail($id)?->delete();
        $this->dispatch('refreshJobBoard');
    }

    public function sort($item, $position): void
    {
        /** @var Opportunity $model */
        $model = $this->query(false)->findOrFail($item);
        if ($model->status !== $this->status) {
            $model->displace();
            $model->status = $this->status;
            $model->save();
        }
        $model->move($position);
        $this->dispatch('refreshJobBoard');
    }
}
