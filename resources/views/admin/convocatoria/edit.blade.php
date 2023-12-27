<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200  leading-tight">
            {{ 'Editar Convocatoria' }}
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

    <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow sm:rounded-lg">
            <div class="container mx-auto p-6">
                <form action="{{ route('admin.convocatoria.update', $convocatoria->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-8 gap-8 shadow-sm p-4">
                        <div class="col-span-8 sm:col-span-8 lg:col-span-4">
                            <label for="nombre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Nombre' }}</label>
                            <input type="text" name="nombre" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ $info['nombre']}}">
                        </div>

                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="anio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Año' }}</label>
                            <input type="text" name="anio" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ $info['anio']}}">
                        </div>
                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="numero" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Número' }}</label>
                            <input type="text" name="numero" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ $info['numero']}}">
                        </div>

                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="fecha_inicio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Fecha de Inicio' }}</label>
                            <input type="date" name="fecha_inicio" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ \Carbon\Carbon::parse($info['fecha_inicio'])->toDateString() }}">
                        </div>
                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="fecha_final" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Fechad de Fin' }}</label>
                            <input type="date" name="fecha_final" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ \Carbon\Carbon::parse($info['fecha_final'])->toDateString() }}">
                        </div>

                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="fecha_inicio_carga" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Fecha de Inicio Carga' }}</label>
                            <input type="date" name="fecha_inicio_carga" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ \Carbon\Carbon::parse($info['fecha_inicio_carga'])->toDateString() }}">
                        </div>
                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <label for="fecha_fin_carga" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{ 'Fecha de Fin Carga' }}</label>
                            <input type="date" name="fecha_fin_carga" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                            required value="{{ \Carbon\Carbon::parse($info['fecha_fin_carga'])->toDateString() }}">
                        </div>
                    </div>
                </div>
                    <div class=" mx-auto text-gray-700 dark:text-gray-300 shadow-xl">
                    <h2  class=" px-6 font-semibold block text-gray-700 dark:text-gray-300 px-6">Seleccionar Tipos de Estudio, Programas y Menciones</h2><br>
                        @foreach($tipo_estudios as $tipo_estudio)
                            <div class="px-12 encabezado-tipo-estudio font-medium text-md mb-2">
                                <span>Tipos de Estudio: </span>
                                <span id="nombre_tipo_estudio" class="inline"><h2 class="font-bold inline">{{ $tipo_estudio->nombre }}</h2></span>
                                <a href="#" class="toggleButton font-medium text-xs border py-1 px-4 rounded">
                                    <i class="iconToggle fas fa-chevron-down"></i>
                                </a>
                            </div>
                            <div class=" px-12 " style="overflow-x: auto; max-height: 400px;">
                                <table class="m-auto w-full font-medium text-sm border-collapse  elementToToggle hidden ">
                                        <thead>
                                            <tr>
                                                <th class="border border-gray-300 dark:border-zinc-500 text-center p-5 w-24">Tipo de programa</th>
                                                <th class="border border-gray-300 dark:border-zinc-500 text-center p-5 w-96">Menciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tipo_programas as $programa)
                                            <tr>
                                                @if($tipo_estudio->id == $programa->tipo_programa_id)
                                                <td class="border border-gray-300 dark:border-zinc-500 text-center w-24">
                                                    <div>
                                                        <!--<input type="checkbox" name="programa_ids[]" value="{{ $programa->active }}" class="mr-2 programa-checkbox" {{ $programa->active == 1 ? 'checked' : '' }}>-->
                                                        <span>{{ $programa->nombre }}</span>
                                                    </div>
                                                </td>
                                                <td id="listas-menciones-{{ $tipo_estudio->id }}" class="border border-gray-300 dark:border-zinc-500 p-5 w-96">
                                                    <div class="flex justify-between">
                                                        <span class="mr-6" > </span>
                                                        <span class="max-w-full text-center font-semibold" >Nombre</span>
                                                        <span class="w-24 ml-auto font-semibold">Nº Vacantes</span>
                                                        <span class="w-24 font-semibold">Monto</span>
                                                    </div>
                                                    @foreach($menciones as $mencion)
                                                    @if($mencion->programa_id == $programa->id)
                                                    <div class="flex justify-between items-center">
                                                        <input type="checkbox" name="mencion_ids[]" value="{{ $mencion->id }}" class="mr-2 mencion-checkbox" {{ $mencion->active ? 'checked' : '' }}>
                                                        <input type="hidden" name="mencion_id[]" value="{{ $mencion->id }}">
                                                        <span class="w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">{{ $mencion->nombre }}</span>
                                                        <input type="text" name="mencion_vacantes[]" value="{{ $mencion->vacantes }}" class="w-24 ml-auto py-1 text-center  border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                                                        <input type="text" name="mencion_montos[]" value="{{ $mencion->monto }}" class="w-24 text-center py-1 border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md">
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <br>
                                </div>

                        @endforeach
                    </div>

                    <div class="py-4 col-span-6 flex justify-between">
                        <a href="{{ route('admin.convocatoria.index') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Selección</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtns = document.querySelectorAll('.toggle-table-btn');

        toggleBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const table = this.closest('div').nextElementSibling; // Obtener la tabla más cercana al botón
                table.style.display = table.style.display === 'none' ? 'table' : 'none'; // Alternar entre mostrar y ocultar
            });
        });
    });
</script>

<script>
    // Obtén todos los elementos con la clase toggleButton y elementToToggle
    var toggleButtons = document.querySelectorAll('.toggleButton');
    var elementsToToggle = document.querySelectorAll('.elementToToggle');

    // Itera sobre todos los botones y añade un evento a cada uno
    toggleButtons.forEach(function(button, index) {
        button.addEventListener('click', function() {
            // Obtén el elemento que corresponde al botón actual
            var element = elementsToToggle[index];
            var icon = button.querySelector('.iconToggle');

            // Alternar la clase 'hidden' del elemento
            element.classList.toggle('hidden');

            // Cambiar el ícono basado en la visibilidad actual del elemento
            if (element.classList.contains('hidden')) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            } else {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            }
        });
    });
</script>
@endsection
</x-app-layout>
