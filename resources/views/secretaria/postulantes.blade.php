<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Secretaria') }}
        </h2>

    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="grid grid-cols-8 gap-8">
                        <div class="col-span-6">
                            <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Lista de Postulantes') }}</h1>
                        </div>

                        <div class="col-span-2">
                            <select id="convocatorias" name="convocatorias" class="mt-1 block w-full py-1 px-2 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Seleccione una convocatoria</option>
                                @foreach ($convocatorias as $convocatoria)
                                    <option value="{{ $convocatoria->id }}">{{ $convocatoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>

                    <form id="search-form" class="grid grid-cols-8 gap-8">
                        <div class="col-span-8 sm:col-span-4 lg:col-span-6">
                            <input type="text" name="q" placeholder="Ingresa un nombre o correo de usuario" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ request('q') }}">
                        </div>
                        <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                            <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-4 rounded" value="Buscar">

                            <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1.5 px-4 rounded" href="{{ route('secretaria.index') }}"> Todos</a>

                            <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-1.5 px-4 rounded" href="{{route('secretaria.reporte')}}" >PDF</a>

                        </div>
                    </form>

                    <div id="tabla-container" class="mt-4" style="overflow-x: auto; max-height: 400px;">
                        <table id="tabla-postulantes" class="table-auto bg-white dark:bg-zinc-700 w-full text-center">
                            <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                <!-- ... encabezados de la tabla ... -->
                            </thead>
                            <tbody class="text-sm divide-y divide-gray-100 text-black dark:text-white">
                                <!-- Aquí se cargará la vista parcial -->

                                @if(request()->ajax()) <!-- Verifica si es una solicitud AJAX -->
                                    @include('partials.tabla-postulantes') <!-- Incluye el componente solo en solicitudes AJAX -->
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Captura el cambio en el menú desplegable de convocatorias
        $('#convocatorias').on('change', function() {
            var convocatoriaId = $(this).val();
            cargarPostulantes(convocatoriaId);
        });

        // Captura el envío del formulario de búsqueda
        $('#search-form').submit(function(event) {
            event.preventDefault(); // Evita que la página se recargue
            cargarResultadosDeBusqueda($(this).serialize());
        });

        // Función para cargar los postulantes por convocatoria
        function cargarPostulantes(convocatoriaId) {
            $.ajax({
                url: '/obtener-postulantes/' + convocatoriaId,
                type: 'GET',
                success: function(response) {
                    $('#tabla-postulantes').html(response);
                },
                error: function(error) {
                    console.error('Error al cargar los datos:', error);
                }
            });
        }

        // Función para cargar los resultados de búsqueda
        function cargarResultadosDeBusqueda(formData) {
            $.ajax({
                url: '{{ route("secretaria.search") }}',
                type: 'GET',
                data: formData,
                success: function(response) {
                    $('#tabla-postulantes').html(response);
                },
                error: function(error) {
                    console.error('Error en la búsqueda:', error);
                }
            });
        }


    });
</script>


@endsection


</x-app-layout>
