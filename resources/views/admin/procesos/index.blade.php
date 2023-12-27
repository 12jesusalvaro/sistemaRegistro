
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  dark:text-gray-200 leading-tight">
            {{ __('Procesos de Admisión') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Tabla de Procesos de Admisión') }}</h1>
                        <a href="{{ route('admin.procesos.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear proceso de admisión </a>
                    </div>
                     <br>
                    <form action="{{ route('admin.procesos.index') }}" method="GET" div class="grid grid-cols-8 gap-8">
                        <div class="col-span-8 md:col-span-6 sm:col-span-4 flex">
                            <input type="text" name="search" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa un nombre o año"
                             value="{{ old('search') }}">
                        </div>
                        <div class="col-span-8 md:col-span-2 sm:col-span-4 flex">
                            <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-5 rounded" value="Buscar">

                            <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1.5 px-5 rounded" href="{{ route('admin.procesos.index') }}"> Todos</a>

                            <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-1.5 px-5 rounded" href="{{route('admin.procesos.pdf')}}" >PDF</a>

                        </div>
                    </form>

                    <div class="mt-4" style="overflow-x: auto; max-height: 400px;">
                        <table class="table-autobg-white dark:bg-zinc-700 w-full">
                            <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                <tr>
                                    <th class="px-4 py-2">{{ __('ID') }}</th>
                                    <th class="px-4 py-2">{{ __('Name') }}</th>
                                    <th class="px-4 py-2">{{ __('Año') }}</th>
                                    <th class="px-4 py-2">{{ __('Numero') }}</th>
                                    <th class="px-4 py-2">{{ __('Fecha de inicio') }}</th>
                                    <th class="px-4 py-2">{{ __('Fecha de fin') }}</th>
                                    <th class="px-4 py-2">{{ __('Fecha de inicio carga') }}</th>
                                    <th class="px-4 py-2">{{ __('Fecha de fin carga') }}</th>
                                    <th class="px-4 py-2">{{ __('Tipo de programa') }}</th>
                                    <th class="px-4 py-2">{{ __('Proceso de admision') }}</th>
                                    <th class="px-4 py-4">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'La Convocatoria se eliminó con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta convocatoria se eliminará definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText:   'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })
        });

    </script>

@endsection
</x-app-layout>
