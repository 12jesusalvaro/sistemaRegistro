
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  dark:text-gray-200 leading-tight">
            {{ __('Convocatorias') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Tabla de Convocatorias') }}</h1>
                        <a href="{{ route('admin.convocatoria.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear convocatoria</a>
                    </div>
                     <br>
                    <form action="{{ route('admin.convocatoria.index') }}" method="GET" div class="grid grid-cols-8 gap-8">
                        <div class="col-span-8 md:col-span-6 sm:col-span-4 flex">
                            <input type="text" name="search" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa un nombre o año"
                             value="{{ old('search') }}">
                        </div>
                        <div class="col-span-8 md:col-span-2 sm:col-span-4 flex">
                            <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-1.5 px-5 rounded" value="Buscar">

                            <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1.5 px-5 rounded" href="{{ route('admin.convocatoria.index') }}"> Todos</a>

                            <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-1.5 px-5 rounded" href="{{route('admin.convocatoria.pdf')}}" >PDF</a>

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
                            <tbody class="text-sm text-center divide-y divide-gray-100 text-black dark:text-white">
                                @forelse ($convocatorias as $convocatoria)
                                    <tr>
                                        <td class="border px-3 py-2">{{ $convocatoria->id }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->nombre }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->anio }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->numero }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->fecha_inicio }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->fecha_final }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->fecha_inicio_carga}}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->fecha_fin_carga }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->tipo_programa_id }}</td>
                                        <td class="border px-3 py-2">{{ $convocatoria->proceso_admision_id }}</td>
                                        <td class="border px-3 py-4" >
                                        <button onclick="window.location.href = '{{ route('admin.convocatoria.edit', $convocatoria) }}'" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded"><i class="fas fa-edit"></i></button>                                            
                                        <form action="{{ route('admin.convocatoria.destroy', $convocatoria) }}" method="POST" class="inline formulario-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-red-400 text-white text-center">
                                        <td colspan="3" class="border px-4 py-2">{{ __('No hay convocatorias para mostrar') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($convocatorias->hasPages())
                                <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="border px-4 py-2">
                                            {{ $convocatorias->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
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
