<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS */
                @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
            </style>
        @endif
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative min-h-screen flex flex-col items-center justify-center py-12 sm:px-6 lg:px-8">
            <!-- Background Graphics -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 opacity-75"></div>
            <div class="absolute inset-0 bg-no-repeat bg-center" style="background-image: url('https://www.transparenttextures.com/patterns/diagmonds-light.png');"></div>

            <div class="relative z-10 max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-10 rounded-lg shadow-lg">
                <div class="text-center">
                    <img class="mx-auto h-20 w-auto" src="img/Logo-RTM-Hitam.png" alt="Laravel">
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                        Welcome to Program Beasiswa 2025
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Silahkaan klik tombol di bawah ini untuk melanjutkan
                    </p>
                </div>
                <div class="mt-8 space-y-6">
                    @if (Route::has('login'))
                        <div class="flex justify-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
