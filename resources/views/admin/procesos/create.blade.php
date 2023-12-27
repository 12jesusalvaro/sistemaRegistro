
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200  leading-tight">
            {{ 'Crear Proceso de Admisión' }}
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow sm:rounded-lg">
                <div class="shadow p-6 bg-gray-50 dark:bg-zinc-800 border-gray-200">
                    @if ($errors->any())
                            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:text-red-500" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                {!! Form::open(array('route' => 'admin.procesos.store','method'=>'POST')) !!}
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3 ">
                        <label for="nombre" class="font-bold text-gray-700 dark:text-white">{{'Nombre'}}</label>
                        {!! Form::text('nombre', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="modalidad_estudio_id" class="font-bold text-gray-700 dark:text-white">{{'Modalidad de Estudio'}}</label>
                        {{-- {!! Form::select('modalidad_estudio_id', $modalidad_estudio->pluck('nombre', 'id'), null, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!} --}}
                    </div>                  

                    <div class="col-span-6 sm:col-span-3">
                        <label for="filial" class="font-bold text-gray-700 dark:text-white">{{'Filial'}}</label>
                        {!! Form::text('filial', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>
                    
                    <div class="col-span-6 sm:col-span-3">
                        <label for="modalidad_admision_id" class="font-bold text-gray-700 dark:text-white">{{'Modalidad de Admision'}}</label>
                        {{-- {!! Form::select('modalidad_admision_id', $modalidad_admision->pluck('nombre', 'id'), null, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}--}}
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="proceso_admision_id" class="font-bold text-gray-700 dark:text-white">{{'Tipo de Proceso'}}</label>
                        {!! Form::select('proceso_admision_id', $proceso_admision->pluck('nombre', 'id'), null, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                    </div>
                    
                    <div class="py-4 col-span-6 flex justify-between">
                        <button type="button" onclick="window.location.href = '{{ route('admin.convocatoria.index') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Guardar</button>
                    </div>

                </div>

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
