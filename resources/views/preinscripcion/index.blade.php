
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pre-Inscripción') }}
        </h2>
    </x-slot>
<br>

<div class="container mx-auto px-4">
    @if (session('success'))
    <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:text-green-500" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        {{ session('success') }}
    </div>
    @else
      <form method="POST" action="{{ route('preinscripcion.index') }} " id="form">
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

    @php
                $user_id = Auth::user()->id;// DNI específico a verificar
                //$exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)->exists();
                $exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                   ->where('user_id', $user_id)
                                   ->exists();
            @endphp

    <div class="shadow-xl dark:shadow-zinc-900 overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white dark:bg-zinc-800	 sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-input-label for="tipo_documento" :value="__('Tipo de Documento')" />
                    <x-text-input exists="{{ $exists }}" id="tipo_documento" name="tipo_documento" type="text" class="mt-1 block w-full sm:text-sm " :value="old('tipo_documento', $datos['tipo_documento'])" required autofocus autocomplete="tipo_documento"/>
                </div>

              <div class="col-span-6 sm:col-span-3">
                <x-input-label for="numero_documento" :value="__('Número de Documento')" />
                <x-text-input exists="{{ $exists }}" id="numero_documento" name="numero_documento" type="text" class="mt-1 block w-full sm:text-sm " :value="old('numero_documento', $datos['numero_documento'])" required autofocus autocomplete="numero_documento"/>
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <x-input-label for="nombres" :value="__('Nombres')" />
                <x-text-input exists="{{ $exists }}" id="nombres" name="nombres" type="text" class="mt-1 block w-full sm:text-sm " :value="old('nombres', $datos['nombres'])" required autofocus autocomplete="nombres"/>
              </div>

              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
                <label for="apellido_paterno" class="block text-sm font-medium text-gray-700 dark:text-white"></label>
                <x-text-input exists="{{ $exists }}" id="apellido_paterno" name="apellido_paterno" type="text" class="mt-1 block w-full sm:text-sm " :value="old('apellido_paterno', $datos['apellido_paterno'])" required autofocus autocomplete="apellido_paterno"/>
              </div>

              @if ($datos['cant_apellidos'] == 2)
              <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
                <x-text-input exists="{{ $exists }}" id="apellido_materno" name="apellido_materno" type="text" class="mt-1 block w-full sm:text-sm " :value="old('apellido_materno', $datos['apellido_materno'])" required autofocus autocomplete="apellido_materno"/>
              </div>
              @endif

              <div class="col-span-6 sm:col-span-3">
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input exists="{{ $exists }}" id="email" name="email" type="text" class="mt-1 block w-full sm:text-sm " :value="old('email', $datos['email'])" required autofocus autocomplete="email"/>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <x-input-label for="numero_celular" :value="__('Número de Celular')" />
                <x-text-input exists="{{ $exists }}" id="numero_celular" name="numero_celular" type="text" class="mt-1 block w-full sm:text-sm " :value="old('numero_celular', $datos['numero_celular'])" required autofocus autocomplete="numero_celular"/>
              </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <x-input-label for="tipo_estudio_id" :value="__('Tipo de Estudio')" />
                    @if ($exists)
                    <x-text-input exists="{{ $exists }}" type="text" class="mt-1 block w-full sm:text-sm " value="{{ $tipo_programa_nombre }}" required autofocus autocomplete="tipo_estudio_id"/>
                    @else
                    <x-select name="tipo_estudio_id" id="tipo_estudio_id" exists="{{ $exists }}" class="mt-1 block w-full sm:text-sm ">
                        <option value="">Seleccione una opción</option>
                        @foreach ($tipoEstudios as $tipoEstudio)
                        <option value="{{ $tipoEstudio->id }}">{{ $tipoEstudio->nombre }}</option>
                        @endforeach
                    </x-select>
                    @endif
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <x-input-label for="programa_estudio_id" :value="__('Programa de Estudio')" />
                    @if ($exists)
                    <x-text-input exists="{{ $exists }}" type="text" class="mt-1 block w-full sm:text-sm " value="{{ $programa_nombre }}" required autofocus autocomplete="tipo_estudio_id"/>
                    @else
                    <x-select name="programa_estudio_id" id="programa_estudio_id"  exists="{{ $exists }}" class="mt-1 block w-full sm:text-sm ">
                        <option value="">Seleccione una opción</option>

                    </x-select>
                    @endif

                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                    <x-input-label for="mencion_id" :value="__('Mención')" />
                    @if ($exists)
                    <x-text-input exists="{{ $exists }}" type="text" class="mt-1 block w-full sm:text-sm " value="{{ $mencion_nombre }}" required autofocus autocomplete="tipo_estudio_id"/>
                    @else
                    <x-select name="mencion_id" id="mencion_id"  exists="{{ $exists }}" class="mt-1 block w-full sm:text-sm ">
                        <option value="">Seleccione una opción</option>

                    </x-select>
                    @endif

                </div>


              <!--
              <div class="col-span-6 sm:col-span-3">
                <select name="tipo_estudio_id" id="tipo_estudio_id"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un tipo de estudio</option>
                        {{--
                        @foreach ($tipoEstudios as $tipoEstudio)
                            <option value="{{ $tipoEstudio->id }}" data-programas-url="{{ route('obtener-programas', $tipoEstudio->id) }}">{{ $tipoEstudio->nombre }}</option>
                        @endforeach
                        --}}
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <select name="programa_estudio_id" id="programa_estudio_id" autocomplete="programa_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione un programa</option>
                    </select>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <select name="mencion_id" id="mencion_id" autocomplete="mencion" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Seleccione una mención</option>
                    </select>
                </div>
            -->



              <!--
              <div class="col-span-6 sm:col-span-3">
                <select name="programa_estudio_id" id="programa_estudio_id" autocomplete="programa_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Seleccione un programa</option>
                    {{--
                    @foreach ($programas as $programa)
                    <option value="{{ $programa->id }}" data-programa-url="{{ route('obtener-menciones', $programa->id) }}">{{ $programa->nombre }}</option>
                    @endforeach
                    --}}
                </select>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <select name="mencion_id" id="mencion_id" autocomplete="mencion" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Seleccione una mencion</option>
                </select>
              </div>
            -->


            @php
                $user_id = Auth::user()->id;// DNI específico a verificar
                //$exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)->exists();
                $exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                   ->where('user_id', $user_id)
                                   ->exists();
            @endphp
                {{-- section of code para bloquear el boton de preinscripcion en caso de que ya este preinscrito
                    y para mostrar el pdf --}}
                    @if($exists)
                    @php
                          $exists2 = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('pagoInscripcion', function ($query) {
                                $query->where('estado_pago', 1);
                            })
                            ->exists();
                      @endphp
                      <div class="py-4 col-span-6 flex justify-between">

                      @if (!$exists2)
                            <a id="botonPago" type="button"  href="{{route('preinscripcion.validarPago')}}"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                Validar Pago
                            </a>

                      @endif
                        <a id="botonPdf" type="button" href="{{route('preinscripcion.pdf')}}"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2 "  target="_blank">
                            Generar PDF
                        </a>
                      @else
                      <div class="py-4 col-span-6 flex justify-between">
                        <button id="saveButton" type="submit" class="col-span-6 flex inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2" >
                            Registrar Inscripción
                        </button>

                    @endif
                    </div>


              </div>

          </div>
        </div>
    </div>
  </form>


</div>

@section('js')
    <script src="{{ asset('js\doubleClick.js') }}"></script>
    <script>
    document.getElementById('tipo_estudio_id').addEventListener('change', function() {
        var tipoEstudioId = this.value;
        var programaSelect = document.getElementById('programa_estudio_id');
        var mencionSelect = document.getElementById('mencion_id');

        // Borra las opciones anteriores
        programaSelect.innerHTML = '<option value="">Seleccione un programa</option>';
        mencionSelect.innerHTML = '<option value="">Seleccione una mención</option>';

        // Realiza la solicitud para obtener los programas correspondientes al tipo de estudio seleccionado
        if (tipoEstudioId) {
            var url = '/obtener-programas/' + tipoEstudioId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de programas al campo de selección
                    data.forEach(programa => {
                        var option = document.createElement('option');
                        option.value = programa.id;
                        option.textContent = programa.nombre;
                        programaSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });

    document.getElementById('programa_estudio_id').addEventListener('change', function() {
        var programaEstudioId = this.value;
        var mencionSelect = document.getElementById('mencion_id');

        // Borra las opciones anteriores
        mencionSelect.innerHTML = '<option value="">Seleccione una mención</option>';

        // Realiza la solicitud para obtener las menciones correspondientes al programa seleccionado
        if (programaEstudioId) {
            var url = '/obtener-menciones/' + programaEstudioId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de menciones al campo de selección
                    data.forEach(mencion => {
                        var option = document.createElement('option');
                        option.value = mencion.id;
                        option.textContent = mencion.nombre;
                        mencionSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
    </script>
<!--
<script>
    document.getElementById('programa_estudio_id').addEventListener('change', function() {
        var programaEstudioId = this.value;
        var mencionSelect = document.getElementById('mencion_id');

        // Borra las opciones anteriores
        mencionSelect.innerHTML = '<option value="">Seleccione una mencion</option>';

        // Realiza la solicitud para obtener las menciones correspondientes al programa seleccionado
        if (programaEstudioId) {
            var url = document.querySelector('#programa_estudio_id option[value="' + programaEstudioId + '"]').getAttribute('data-programa-url');
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de menciones al campo de selección
                    data.forEach(mencion => {
                        var option = document.createElement('option');
                        option.value = mencion.id;
                        option.textContent = mencion.nombre;
                        mencionSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
-->
<!--
<script>
        var boton = document.getElementById('botonRegistrar');

        // Deshabilitar el botón al hacer clic
        boton.setAttribute('disabled', 'true');
</script>
-->
@endsection

</x-app-layout>
