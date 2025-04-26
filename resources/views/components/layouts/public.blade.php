<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="antialiased bg-white text-gray-900 dark:bg-[#1b1b18] dark:text-gray-100">

<header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 mx-auto pt-6 px-4 not-has-[nav]:hidden">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ route('dashboard') }}"
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

{{ $slot }}

<footer class="py-6 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-[#1b1b18]">
    © {{ date('Y') }} JobFlow. All rights reserved.
    <p>
        <a class="text-xs inline-link" href="{{ route('privacy-policy') }}">Privacy Policy</a>
        .
        <a class="text-xs inline-link" href="{{ route('terms-of-use') }}">Terms of Use</a>
    </p>
</footer>
@include('partials.foot')
</body>
</html>
