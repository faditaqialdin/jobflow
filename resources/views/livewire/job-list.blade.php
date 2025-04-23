<div class="h-[calc(100vh-200px)] overflow-y-auto pt-2" wire:poll.1s>
    <x-sortable group="job-board" handler="sort" class="flex flex-col gap-2 px-2">
        @foreach ($this->opportunities as $opportunity)
            <x-sortable.item key="{{ $opportunity->id }}"
                             class="cursor-grab group flex items-center justify-between bg-white rounded-lg shadow-sm border border-zinc-200 dark:border-white/10 dark:bg-zinc-800 p-3 transition-transform duration-200 hover:scale-[1.04] hover:shadow-md">
                <div class="flex flex-col items-center text-center gap-2 overflow-hidden w-full">
                    <div class="w-10 h-10 overflow-hidden rounded-sm">
                        <flux:avatar src="{{ $opportunity->companyLogo }}"/>
                    </div>
                    <div class="text-sm text-zinc-500 dark:text-white/70 truncate w-full">
                        {{ $opportunity->company }}
                    </div>
                    <div class="text-base font-medium text-zinc-800 dark:text-white truncate w-full">
                        {{ $opportunity->name }}
                    </div>
                    <div class="flex items-center justify-center gap-1 text-green-600 dark:text-green-500 text-xs">
                        <flux:icon.calendar-days variant="micro" class="w-4 h-4 shrink-0"/>
                        <span>{{ $opportunity->date }}</span>
                    </div>
                    <div class="flex items-center justify-center gap-1">
                        <flux:button class="cursor-pointer" icon="trash" variant="danger" size="xs"
                                     wire:confirm="Delete opportunity: {{ $opportunity->name }}?"
                                     wire:click="remove({{ $opportunity->id }})"></flux:button>
                        <a href="{{ $opportunity->url }}" target="_blank" class="text-xs">
                            <flux:icon name="arrow-top-right-on-square" variant="solid"/>
                        </a>
                    </div>
                </div>
            </x-sortable.item>
        @endforeach
        @unless($this->opportunities->count())
            <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
                <div class="grid auto-rows-min gap-4 md:grid-cols-1">
                    <div
                        class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <x-placeholder-pattern
                            class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"></x-placeholder-pattern>
                    </div>
                </div>
            </div>
        @endunless
    </x-sortable>
</div>
