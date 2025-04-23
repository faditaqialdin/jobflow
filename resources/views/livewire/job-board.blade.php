<div class="overflow-x-scroll -m-6 p-6" wire:poll.1s>
    <div class="grid auto-rows-min gap-4 md:grid-cols-5">
        @foreach ($this->statuses as $status)
            <div class="rounded-lg bg-zinc-400/5 dark:bg-zinc-900">
                <div class="px-4 py-4 flex flex-col items-center text-center">
                    <flux:heading class="flex items-center gap-2">
                        <flux:icon name="{{ $status['icon'] }}" variant="solid"
                                   class="text-{{ $status['color'] }}-500 dark:text-{{ $status['color'] }}-300"/>
                        {{ strtoupper($status['name']) }}
                        <flux:badge size="sm"
                                    color="{{ $status['color'] }}">{{ $this->count($status['name']) }}</flux:badge>
                    </flux:heading>
                </div>
                <livewire:job-list status="{{ $status['name'] }}" wire:key="{{ $status['name'] }}"/>
            </div>
        @endforeach
    </div>
</div>
