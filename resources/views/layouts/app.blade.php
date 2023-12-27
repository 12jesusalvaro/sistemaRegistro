<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  x-data="{ isDarkMode:localStorage.getItem('dark') === 'true' }"
  x-init="$watch('isDarkMode', val => localStorage.setItem('dark',val))",
  x-bind:class="{ 'dark': isDarkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <body class="font-sans antialiased">
    @include('layouts.navigation')
        <div class="min-h-screen bg-gray-50 dark:bg-zinc-800 backdrop-opacity-10"">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-zinc-900 shadow">
                    <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    @yield('js')
    @include('sweetalert::alert')
    @include('layouts.footer')
</body>
</html>

