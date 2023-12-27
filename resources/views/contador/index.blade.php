<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contador') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                        <div class="flex justify-between">
                            <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Tabla Postulantes') }}</h1>
                        </div>
                        <form action="{{ route('evaluador.index') }}" method="GET" div class="grid grid-cols-8 gap-8">
                        <div class="col-span-8 sm:col-span-4 lg:col-span-6 flex">
                            <input type="text" name="search" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa un nombre o correo de usuario"
                             value="{{ old('search') }}">
                        </div>
                        <div class="col-span-8 sm:col-span-4 lg:col-span-2 flex">
                            <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded" value="Buscar">
                            <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-5 rounded" href="{{ route('evaluador.index') }}"> Todos</a>
                            <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-2 px-5 rounded" href="{{route('evaluador.reporte')}}" target="_blank">PDF</a>

                        </div>
                        </form>

                        <div class="mt-4" style="overflow-x: auto; max-height: 400px;">
                            <table class="table-auto bg-white dark:bg-zinc-700 w-full text-center">
                                <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                    <tr>
                                        <!--<th class="px-4 py-2">{{ __('ID') }}</th>-->
                                        <th class="px-4 py-2">{{ __('Numero Doc') }}</th>
                                        <th class="px-4 py-2">{{ __('Name') }}</th>
                                        <th class="px-4 py-2">{{ __('Apellido Pat') }}</th>
                                        <th class="px-4 py-2">{{ __('Apellido Mat') }}</th>
                                        <!--<th class="px-4 py-2">{{ __('Celular') }}</th>-->
                                        <!--<th class="px-4 py-2">{{ __('Email') }}</th>-->
                                        <!--<th class="px-4 py-2">{{ __('Estado') }}</th>-->
                                        <th class="px-2 py-2">{{ __('Expediente') }}</th>
                                        <th class="px-4 py-2">{{ __('Nota Parcial') }}</th>
                                        <th class="px-2 py-2">{{ __('Entrevista') }}</th>
                                        <th class="px-4 py-2">{{ __('Nota Parcial') }}</th>
                                        <th class="px-4 py-2">{{ __('Nota Final') }}</th>

                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100 text-black dark:text-white">
                                    @forelse ($postulantes as $postulante)
                                        <tr>
                                            <td class="border px-3 py-2">{{ $postulante->numero_documento }}</td>
                                            <td class="border px-3 py-2">{{ $postulante->nombres }}</td>
                                            <td class="border px-3 py-2">{{ $postulante->primer_apellido}}</td>
                                            <td class="border px-3 py-2">{{ $postulante->segundo_apellido}}</td>
                                            <td class="border px-4 py-2"> </td>

                                            </td>
                                            <td class="border px-3 py-2">  </td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('evaluador.editEntrevista', $postulante) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded">{{ __('Calificar Entrevista') }}</a>
                                            </td>

                                            <td class="border px-3 py-2">
                                                @php
                                                $nota_parcial2 = null; // Valor predeterminado
                                                @endphp

                                                {{ $nota_parcial2 ?? 0 }} <!-- Mostramos $nota_parcial2 o 0 si es nulo -->
                                            </td>
                                            <td class="border px-3 py-2">



                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="bg-red-400 text-white text-center">
                                            <td colspan="8" class="border px-4 py-2">{{ __('No hay postulantes para mostrar') }}</td>
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
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
  $('.calificar-btn').click(function (e) {
    e.preventDefault();

    Swal.fire({
      title: 'Calificar',
      html: 'Ingresa la calificación (0 al 20):<br><input type="number" id="calificacion" min="0" max="20">',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí, calificar!',
      cancelButtonText: 'Cancelar',
      preConfirm: () => {
        // Obtener el valor de la calificación ingresada por el usuario
        const calificacion = parseInt(document.getElementById('calificacion').value);

        // Verificar si se ingresó una calificación válida (por ejemplo, del 0 al 20)
        if (calificacion >= 0 && calificacion <= 20) {
          // Aquí  guardar la calificacion

          // Aquí agregar la lógica para guardar la calificación en el servidor
          // hacer una solicitud AJAX para enviar la calificación al backend.

          return calificacion; // Devuelve la calificación ingresada para que SweetAlert2 lo maneje
        } else {
          // Mostrar un mensaje de error si la calificación no es válida
          Swal.showValidationMessage('Por favor, ingresa una calificación válida (0 al 20).');
          return false;
        }
      },
    }).then((result) => {
      if (result.isConfirmed) {
        const calificacion = result.value; // Obtener la calificación ingresada
        // para  hacer algo con la calificación ingresada si lo necesitas
        console.log('Calificación ingresada:', calificacion);
      }
    });
  });
</script>
@endsection
</x-app-layout>
