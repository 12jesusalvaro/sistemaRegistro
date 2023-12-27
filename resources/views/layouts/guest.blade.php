<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
x-data="{ isDarkMode:localStorage.getItem('dark') === 'true' }"
  x-init="$watch('isDarkMode', val => localStorage.setItem('dark',val))",
  x-bind:class="{ 'dark': isDarkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50  dark:bg-zinc-800">

            <div class=" w-full sm:max-w-md mt-6 px-6 py-4 bg-red-900 shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <a href="/">
                        <x-application-logo class="w-30 h-20  fill-current text-gray-500" />
                    </a>
                    <!--Botón para controlar el modo oscuro-modo claro -->
                    <button type="button" @click="isDarkMode =! isDarkMode">
                                    <span x-show="isDarkMode">
                                        <img width="20" height="20" src="https://img.icons8.com/ios/50/sun--v1.png" alt="Modo claro" style="filter: invert(100%);"/>
                                    </span>
                                    <span x-show="!isDarkMode">
                                        <img width="20" height="20" src="https://img.icons8.com/fluency-systems-filled/48/000000/crescent-moon.png" alt="Modo ocuro" style="filter: invert(100%);"/>
                                    </span>
                    </button>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 dark:bg-zinc-800 shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
