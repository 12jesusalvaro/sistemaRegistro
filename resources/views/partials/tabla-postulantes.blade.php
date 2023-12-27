@if($postulantes->count() > 0)

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
            @php
                $contador = 0;
            @endphp
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
                    $contador++;
                    @endphp
                <tr>
                    <td class="border px-3 py-2">{{ $contador }}</td>
                    <td class="border px-3 py-2">{{ $postulante->nombres }}</td>
                    <td class="border px-3 py-2">{{ $postulante->primer_apellido}}</td>
                    <td class="border px-3 py-2">{{ $postulante->segundo_apellido}}</td>
                    <td class="border px-3 py-2">{{ $postulante->numero_documento}}</td>
                    <td class="border px-3 py-2">{{ $postulante->celular}}</td>
                    <td class="border px-3 py-2">{{ $postulante->email}}</td>
                    <td class="border px-3 py-2">{{$currentStep}}</td>
                    <td class="border px-4 py-4" >
                        <a href="{{ route('secretaria.edit', $postulante) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('secretaria.validar', $postulante) }}" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-1 px-2 rounded"><i class="fas fa-eye"></i></a>
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
@else
    <p>No se encontraron resultados.</p>
@endif
