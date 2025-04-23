@push('styles')
    <style>
        .flatpickr-calendar.inline {
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@endpush

<div class="max-w-xl mx-auto space-y-6 p-6 bg-gray-50 dark:bg-zinc-900 rounded-lg shadow">
    <div class="space-y-3">
        <h2 class="text-xl font-semibold text-zinc-800 dark:text-white">
            Sync opportunities from your Gmail
        </h2>
        <p class="text-sm text-zinc-600 dark:text-zinc-300">
            Sign in now so we can fetch your emails and, with help from Gemini, classify job-related messages and
            extract opportunity data.
            We’ll track the status of each opportunity from application to interview, offer, or rejection.
        </p>
        <p class="text-xs text-zinc-500 dark:text-zinc-400">
            We do not store your data. Gemini will process it without persisting. You can review how we handle
            everything in our
            <a href="https://github.com/fadi-taqialdin/jobflow" target="_blank" class="underline hover:text-blue-600">GitHub
                repository</a>.
        </p>
    </div>

    @if ($this->isGoogleConnected)
        <div class="text-green-700 dark:text-green-400 mb-4">
            We’re currently retrieving your emails and monitoring new messages for opportunities. This happens in the
            background automatically.
        </div>
        <a href="{{ route('google.logout') }}"
           class="cursor-pointer w-full inline-flex items-center justify-center gap-2 bg-zinc-800 hover:bg-zinc-600 text-white font-medium py-2 px-4 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 48 48">
                <path fill="#FFC107"
                      d="M43.6 20.5H42V20H24v8h11.3C34.2 32.7 29.6 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l6-6C34.5 5.6 29.6 3 24 3 12.9 3 4 11.9 4 23s8.9 20 20 20c11 0 19.8-8.5 19.8-20 0-1.3-.1-2.2-.2-2.5z"/>
                <path fill="#FF3D00"
                      d="M6.3 14.5 13.1 20C14.7 15.8 18.9 13 24 13c3.1 0 5.9 1.2 8 3.1l6-6C34.5 5.6 29.6 3 24 3c-6.6 0-12.2 3.3-15.7 8.5z"/>
                <path fill="#4CAF50"
                      d="M24 43c5.4 0 10.3-2.1 14-5.5l-6.5-5.5C29.8 34.4 27 36 24 36c-5.6 0-10.2-3.4-11.9-8.2l-6.2 4.8C8.1 39.2 15.5 43 24 43z"/>
                <path fill="#1976D2"
                      d="M43.6 20.5H42V20H24v8h11.3c-1.3 3.4-4.6 6-8.3 6-2.9 0-5.5-1.3-7.2-3.3l-6.5 5C17.1 40.9 20.3 43 24 43c11 0 19.8-8.5 19.8-20 0-1.3-.1-2.2-.2-2.5z"/>
            </svg>
            Logout from Google
        </a>
    @else
        <div class="space-y-2">
            <label for="datepicker" class="text-sm font-medium text-zinc-700 dark:text-zinc-200">Start from this
                date</label>
            <div wire:ignore>
                <input id="datepicker" type="text"
                       class="w-full px-3 py-2 border rounded-md dark:bg-zinc-800 dark:text-white"
                       placeholder="Select date range">
            </div>
        </div>

        <a href="{{ route('google.redirect') }}"
           class="cursor-pointer w-full inline-flex items-center justify-center gap-2 bg-zinc-800 hover:bg-zinc-600 text-white font-medium py-2 px-4 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 48 48">
                <path fill="#FFC107"
                      d="M43.6 20.5H42V20H24v8h11.3C34.2 32.7 29.6 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l6-6C34.5 5.6 29.6 3 24 3 12.9 3 4 11.9 4 23s8.9 20 20 20c11 0 19.8-8.5 19.8-20 0-1.3-.1-2.2-.2-2.5z"/>
                <path fill="#FF3D00"
                      d="M6.3 14.5 13.1 20C14.7 15.8 18.9 13 24 13c3.1 0 5.9 1.2 8 3.1l6-6C34.5 5.6 29.6 3 24 3c-6.6 0-12.2 3.3-15.7 8.5z"/>
                <path fill="#4CAF50"
                      d="M24 43c5.4 0 10.3-2.1 14-5.5l-6.5-5.5C29.8 34.4 27 36 24 36c-5.6 0-10.2-3.4-11.9-8.2l-6.2 4.8C8.1 39.2 15.5 43 24 43z"/>
                <path fill="#1976D2"
                      d="M43.6 20.5H42V20H24v8h11.3c-1.3 3.4-4.6 6-8.3 6-2.9 0-5.5-1.3-7.2-3.3l-6.5 5C17.1 40.9 20.3 43 24 43c11 0 19.8-8.5 19.8-20 0-1.3-.1-2.2-.2-2.5z"/>
            </svg>
            Sign in with Google
        </a>
    @endif
</div>

@push('scripts')
    <script>
        flatpickr("#datepicker", {
            inline: true,
            dateFormat: "Y-m-d",
            maxDate: '{{ date("Y-m-d") }}',
            defaultDate: "{{ $this->startDate }}",
            onChange: function (selectedDates, dateStr, instance) {
            @this.set('startDate', dateStr)

            },
        });
    </script>
@endpush
