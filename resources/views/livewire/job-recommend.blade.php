<div class="max-w-xl mx-auto space-y-6 p-6 bg-gray-50 dark:bg-zinc-900 text-zinc-800 dark:text-white rounded-lg shadow">
    <div class="rounded-xl mb-4">
        <h2 class="text-xl font-semibold mb-2">Tailor Your Job Search Experience</h2>
        <p class="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed">
            Fine-tune your job discovery with precision. Toggle the recommendation engine to receive
            <span class="text-indigo-400 font-medium">AI-curated opportunities</span>. Specify the
            <span class="text-blue-400 font-medium">locations</span> you're targeting, highlight
            <span class="text-green-400 font-medium">key skills or keywords</span> to prioritize, and define
            <span class="text-red-400 font-medium">terms to exclude</span> from your search. This intelligent filter
            panel empowers you to cut through the noise and zero in on the roles that truly matter to you.
        </p>
    </div>

    <div class="text-xl font-semibold space-y-6">
        <label class="inline-flex items-center cursor-pointer">
            <input wire:model="recommendJob" type="checkbox" class="sr-only peer">
            <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
            <h2 class="ms-3">Enable Recommendation</h2>
        </label>

        <label class="block mb-1">Locations</label>
        <div class="border rounded-xl px-2 py-0.5 space-x-2 break-words">
            @foreach($locations as $item)
                <span class="rounded-full px-1.5 py-0.5 text-sm bg-blue-600 text-indigo-100">
                        <span>{{ $item }}</span>
                        <span wire:click="removeLocation('{{ $item }}')"
                              class="font-semibold cursor-pointer">&times;</span>
                    </span>
            @endforeach
            <input x-data
                   x-on:keydown.enter.prevent="$wire.addLocation($event.target.value); $event.target.value='';"
                   x-on:keydown.backspace="$wire.removeLocation($event.target.value);"
                   type="text"
                   class="px-2 py-1 focus:outline-none text-gray-500 text-sm"
                   placeholder="Add Locations..."/>
        </div>

        <label class="block mb-1">Include Keywords</label>
        <div class="border rounded-xl px-2 py-0.5 space-x-2 break-words">
            @foreach($keywords as $item)
                <span class="rounded-full px-1.5 py-0.5 text-sm bg-blue-600 text-indigo-100">
                        <span>{{ $item }}</span>
                        <span wire:click="removeKeyword('{{ $item }}')"
                              class="font-semibold cursor-pointer">&times;</span>
                    </span>
            @endforeach
            <input x-data
                   x-on:keydown.enter.prevent="$wire.addKeyword($event.target.value); $event.target.value='';"
                   x-on:keydown.backspace="$wire.removeKeyword($event.target.value);"
                   type="text"
                   class="px-2 py-1 focus:outline-none text-gray-500 text-sm"
                   placeholder="Add Keywords..."/>
        </div>

        <label class="block mb-1">Exclude Keywords</label>
        <div class="border rounded-xl px-2 py-0.5 space-x-2 break-words">
            @foreach($avoids as $item)
                <span class="rounded-full px-1.5 py-0.5 text-sm bg-blue-600 text-indigo-100">
                        <span>{{ $item }}</span>
                        <span wire:click="removeAvoid('{{ $item }}')"
                              class="font-semibold cursor-pointer">&times;</span>
                    </span>
            @endforeach
            <input x-data
                   x-on:keydown.enter.prevent="$wire.addAvoid($event.target.value); $event.target.value='';"
                   x-on:keydown.backspace="$wire.removeAvoid($event.target.value);"
                   type="text"
                   class="px-2 py-1 focus:outline-none text-gray-500 text-sm"
                   placeholder="Add Avoids..."/>
        </div>
    </div>
</div>
