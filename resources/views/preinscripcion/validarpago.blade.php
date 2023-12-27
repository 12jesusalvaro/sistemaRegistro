<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Validar Pago')}}
        </h2>
    </x-slot>
<br>

    <div class="max-w-full mx-auto sm:px-6 lg:px-8 w-3/4 ">
        @if (session('success'))
            <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:text-green-500" role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
            @else
            <form id="miFormulario" method="POST" action="{{ route('validarPago') }}" class="inline formulario-guardar" enctype="multipart/form-data">
                @csrf
                @if ($errors->any() || session('error'))
                <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:text-red-500" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach

                        @if (session('error'))
                            <li>
                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                {{ session('error') }}
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        @endif

        <div class="px-4 py-5 bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-md">
            <h2 class="text-lg font-semibold mb-2 text-center bg-white dark:bg-zinc-800 dark:text-white">Registrar pago</h2>
            <p class="text-gray-600 mb-4 text-center bg-white dark:bg-zinc-800 dark:text-white">Ingresa los detalles del pago:</p>

                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha_pago" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300 ">Fecha:</label>
                        <input type="date" id="fecha_pago" name="fecha_pago" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="numero_operacion" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300 ">Número de Operación:</label>
                        <input type="text" id="numero_operacion" name="numero_operacion" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="monto" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300 ">Monto:</label>
                        <input type="number" step="0.01" id="monto" name="monto" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="monto" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300 ">Foto:</label>
                        <input type="file" class="mt-2 px-4 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-xl " >

                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <button type="button" onclick="window.location.href = '{{ route('preinscripcion.index') }}'" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-5 rounded">Cancelar</button>
                    <button type="submit" id="boton-guardar" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Validar</button>
                </div>
        </div>
        </form>
    </div>

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /*$('.formulario-guardar').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
            text: "Una vez enviada la información no podrá volver a ingresarla!",
            icon: 'warning',
                showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, enviar!',
            cancelButtonText:   'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
                })
        });*/
        /*$('.formulario-guardar').submit(function (e) {
            e.preventDefault();
            var botonGuardar = $('#boton-guardar'); // Selecciona el botón de guardar por su ID

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Una vez enviada la información no podrá volver a ingresarla!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, enviar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Deshabilita el botón antes de enviar el formulario
                    botonGuardar.prop('disabled', true);

                    // Envía el formulario
                    this.submit();
                }
            });
        });*/
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var formulario = document.getElementById('miFormulario'); // Cambia 'miFormulario' al ID de tu formulario

            formulario.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Una vez enviada la información no podrá volver a ingresarla!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, enviar!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var botonGuardar = document.getElementById('boton-guardar'); // Cambia 'boton-guardar' al ID de tu botón

                        // Deshabilita el botón de "Validar" después de hacer clic en él
                        botonGuardar.disabled = true;

                        // Envía el formulario después de deshabilitar el botón
                        formulario.submit();
                    }
                });
            });
        });
    </script>

@endsection

</x-app-layout>
