<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Secretaria') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class="flex justify-between grid grid-cols-8 gap-8">

                    <div class="flex justify-end col-span-8 sm:col-span-4">
                        <select id="convocatorias" name="convocatorias" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una convocatoria</option>
                            @foreach ($convocatorias as $convocatoria)
                                <option value="{{ $convocatoria->id }}">{{ $convocatoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Table Users') }}</h1>
                </div>
                <form action="{{ route('secretaria.index') }}" method="GET" div class="grid grid-cols-8 gap-8">
                    <div class="col-span-8 sm:col-span-4">
                        <input type="text" name="search" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa un nombre o correo de usuario"
                         value="{{ old('search') }}">
                    </div>
                    <div class="col-span-8 sm:col-span-4">
                        <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded" value="Buscar">

                        <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded" href="{{ route('secretaria.index') }}"> Todos</a>

                        <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-2 px-3 rounded" href="{{route('secretaria.reporte')}}" >PDF</a>

                    </div>
                </form>

                        <div class="mt-4" style="overflow-x: auto; max-height: 400px;">
                            <table class="table-auto bg-white dark:bg-zinc-700 w-full text-center">
                                <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                    <tr>
                                        <th class="px-4 py-2">{{ __('N°') }}</th>
                                        <th class="px-4 py-2">{{ __('Name') }}</th>
                                        <th class="px-4 py-2">{{ __('Apellido Pat') }}</th>
                                        <th class="px-4 py-2">{{ __('Apellido Mat') }}</th>
                                        <th class="px-4 py-2">{{ __('DNI') }}</th>
                                        <th class="px-4 py-2">{{ __('Celular') }}</th>
                                        <th class="px-4 py-2">{{ __('Email') }}</th>
                                        <th class="px-4 py-2">{{ __('Estado') }}</th>
                                        <th class="px-4 py-2">{{ __('Acciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100 text-black dark:text-white">
                                    @forelse ($postulantes as $postulante)
                                        @php
                                            if ($preinscripcion = App\Models\Preinscripcion::where('user_id', $postulante->id)->latest()->first() != NULL)
                                            {// Consulta para obtener la última preinscripción del usuario
                                                $preinscripcion = App\Models\Preinscripcion::where('user_id', $postulante->id)->latest()->first();

                                                // Consulta para obtener el último postulante relacionado con la preinscripción
                                                $postulantee = App\Models\Postulante::where('preinscripcion_id', $preinscripcion->id)->latest()->first();

                                                // Obtener el valor de la variable 'currentStep' del postulante
                                                $currentStep = $postulantee->current_step;
                                            }else{
                                                $currentStep = 0;
                                            }

                                            @endphp
                                        <tr>
                                            <td class="border px-3 py-2">{{ $postulante->id }}</td>
                                            <td class="border px-3 py-2">{{ $postulante->nombres }}</td>
                                            <td class="border px-3 py-2">{{ $postulante->primer_apellido}}</td>
                                            <td class="border px-3 py-2">{{ $postulante->segundo_apellido}}</td>
                                            <td class="border px-3 py-2">{{ $postulante->numero_documento}}</td>
                                            <td class="border px-3 py-2">{{ $postulante->celular}}</td>
                                            <td class="border px-3 py-2">{{ $postulante->email}}</td>
                                            <td class="border px-3 py-2">{{$currentStep}}</td>
                                            <td class="border px-4 py-2" style="width: 270px">
                                                <a href="{{ route('secretaria.edit', $postulante) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr class="bg-red-400 text-white text-center">
                                            <td colspan="3" class="border px-4 py-2">{{ __('No hay postulantes para mostrar') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if ($postulantes->hasPages())
                                    <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <td colspan="3" class="border px-4 py-2">
                                                {{ $postulantes->links() }}
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
</x-app-layout>
