<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'LMS') }}</title> --}}
        <title>LMS</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            #guestBg {
                background-image: url("/img/Sierra.jpg");
                background-size: cover;
                background-position: center;
                width: 100%;
                height: 100vh;
                filter: brightness(70%);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased relative">
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
        <div class="absolute right-0 mt-2 mr-2 sm:mt-5 sm:mr-5">
            <x-theme-toggle-btn />
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div> --}}
            {{-- <div id="guestBg"></div> --}}
            {{-- <img class="w-screen h-screen object-cover" src="/img/Sierra.jpg" alt=""> --}}
            
            <div>
                <a href="/" class="flex flex-col items-center">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    <p class="ml-2 text-2xl font-bold text-gray-600 dark:text-gray-200">LMS</p>
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
