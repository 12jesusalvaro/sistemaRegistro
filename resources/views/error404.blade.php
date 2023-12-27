<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('ERROR') }}
            </h2>

        </x-slot>

    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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


            <!--  Datatables  -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

            <!--  extension responsive  -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
        </head>

        <div class="py-12">
            <div class="max-w-7xl mx-auto  text-xl font-medium text-gray-700 dark:text-gray-300 ">
                <div class="flex items-center justify-center h-screen">
                    <div class="text-center h-2/3">
                        <h1 class="text-4xl font-bold mb-2">404 Not Found</h1>
                        <p>Lo siento, la página que estás buscando no existe.</p>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
