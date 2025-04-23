<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobFlow – Track Your Job Hunt</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-[#1b1b18] dark:text-gray-100">

<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 mx-auto pt-6 px-4 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>

<section class="min-h-[80vh] flex items-center justify-center text-center px-6">
    <div class="max-w-3xl">
        <h1 class="text-5xl font-extrabold leading-tight mb-6 text-gray-900 dark:text-white">
            Gain Full Control Over Your Job Hunt
        </h1>
        <p class="text-xl mb-8 text-gray-700 dark:text-gray-300">
            Track job board opportunities, get smart recommendations, and sync Gmail — all in one dashboard.
        </p>
        <a href="{{ route('register') }}"
           class="bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow hover:bg-blue-800 transition">
            Start Free
        </a>
    </div>
</section>

<section class="py-20 px-6 bg-gray-50 dark:bg-[#272722]">
    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 text-center">
        <div class="p-6 bg-white dark:bg-[#1f1f1a] rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-2xl font-bold mb-4 dark:text-white">Smart Recommendations</h3>
            <p class="text-gray-700 dark:text-gray-400">
                Receive tailored job suggestions based on your criteria.
            </p>
        </div>
        <div class="p-6 bg-white dark:bg-[#1f1f1a] rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-2xl font-bold mb-4 dark:text-white">Gmail Sync</h3>
            <p class="text-gray-700 dark:text-gray-400">
                Automatically extract job-related emails with key details.
            </p>
        </div>
        <div class="p-6 bg-white dark:bg-[#1f1f1a] rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-2xl font-bold mb-4 dark:text-white">Job Board Tracker</h3>
            <p class="text-gray-700 dark:text-gray-400">
                Organize and monitor applications in one view.
            </p>
        </div>
    </div>
</section>

<section class="py-20 px-6">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-bold mb-10">How It Works</h2>
        <div class="grid md:grid-cols-3 gap-8 text-left">
            <div>
                <h4 class="font-semibold text-xl mb-2">1. Connect Gmail</h4>
                <p>Securely log in and allow access to job-related messages.</p>
            </div>
            <div>
                <h4 class="font-semibold text-xl mb-2">2. Set Preferences</h4>
                <p>Define your role and location preferences.</p>
            </div>
            <div>
                <h4 class="font-semibold text-xl mb-2">3. Track & Apply</h4>
                <p>Let the system track and recommend intelligently.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 px-6 bg-blue-700 text-white text-center">
    <h2 class="text-4xl font-extrabold mb-6">Ready to Take Charge?</h2>
    <p class="mb-8 text-lg">Get started with powerful job tracking — no clutter, just clarity.</p>
    <a href="{{ route('register') }}"
       class="bg-white text-blue-700 px-6 py-3 font-semibold rounded-full shadow hover:bg-gray-100 transition">
        Start Now
    </a>
</section>

<footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-[#1b1b18]">
    © {{ date('Y') }} JobFlow. All rights reserved.
</footer>

@livewireScripts
</body>
</html>
