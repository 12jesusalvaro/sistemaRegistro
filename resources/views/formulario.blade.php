<x-app-layout>
    <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Registro de Datos') }}
                </h2>

    </x-slot>
    <div id="progress-bar-container">
        <ul id="progress-bar">
            <li class="{{ $currentStep == 1 ? 'active' : '' }} "></li>
            <li class="{{ $currentStep == 2 ? 'active' : '' }}"></li>
            <li class="{{ $currentStep == 3 ? 'active' : '' }}"></li>
            <li class="{{ $currentStep == 4 ? 'active' : '' }}"></li>
            <li class="{{ $currentStep == 5 ? 'active' : '' }}"></li>
            <li class="{{ $currentStep == 6 ? 'active' : '' }}"></li>
            <li class="{{ $currentStep == 7 ? 'active' : '' }}"></li>
        </ul>
    </div>

    <br>
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 flex">
      <!-- Div izquierdo -->
      <div class="max-w-full mx-auto sm:px-6 lg:px-8 w-3/4 left-div">
            <!-- formulario.blade.php -->
          @if ($currentStep == 1)
              <!-- Sección de datos generales -->
              <form action="{{ route('formulario.guardar.datos_generales') }}" method="POST" class="inline formulario-guardar">
                  <!-- Campos de datos generales -->
                  @csrf
                  <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                      <h1 class="font-bold text-black dark:text-white">I. DATOS GENERALES: </h1>
                      <br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                            <h2 class="text-black dark:text-white">Datos personales</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <!-- Contenido del primer contenedor -->
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6 border dark:border-zinc-900 opacity-70">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="tipo_documento"class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Documento (*)</label>
                                                <input type="text" name="tipo_documento" id="tipo_documento" autocomplete="tipo_documento"
                                                class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                required value="{{ $datos['tipo_documento']}}" {{ $exists ? 'disabled' : '' }}>
                                                @error('tipo_documento')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="numero_documento" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Número de Documento (*)</label>
                                                <input type="text" name="numero_documento" id="numero_documento" autocomplete="numero_documento"
                                                class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                required value="{{ $datos['numero_documento']}}" {{ $exists ? 'disabled' : '' }}>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Nota: Si el tipo de documento es Documento Nacional de Identidad (DNI), el número de dígitos es 8.</span>
                                                @error('numero_documento')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="cant_apellidos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">¿Cuántos apellidos tiene? (*)</label>
                                                <select id="cant_apellidos" name="cant_apellidos" autocomplete="cant_apellidos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                 {{ $exists ? 'disabled' : '' }}>
                                                    @if (Auth::user()->cant_apellidos == 2)
                                                        <option value="2">Dos</option>
                                                        <option value="1">Uno</option>
                                                    @else
                                                        <option value="1">Uno</option>
                                                        <option value="2">Dos</option>
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="nombres" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nombres (*)</label>
                                                <input type="text" name="nombres" id="nombres" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                required value="{{ $datos['nombres']}}" {{ $exists ? 'disabled' : '' }}>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Completar sólo los "nombres" debe ir idéntico al documento de identidad.</span>
                                                @error('nombres')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="primer_apellido" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Primer Apellido(*)</label>
                                                <input type="text" name="primer_apellido" id="primer_apellido" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                required value="{{ $datos['primer_apellido']}}" {{ $exists ? 'disabled' : '' }}>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Debe ir idéntico al documento de identidad.</span>
                                                @error('primer_apellido')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            @if (Auth::user()->cant_apellidos == 2)
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2" >
                                                <label for="segundo_apellido" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Segundo Apellido (*)</label>
                                                <input type="text" name="segundo_apellido" id="segundo_apellido" autocomplete="postal-code" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                value="{{ $datos['segundo_apellido']}}" {{ $exists ? 'disabled' : '' }}>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Debe ir idéntico al documento de identidad.</span>
                                                @error('segundo_apellido')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6 border dark:border-zinc-900 opacity-70">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="correo_electronico" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300"> Correo Electrónico (*)</label>
                                                <input type="text" name="correo_electronico" id="correo_electronico" autocomplete="correo_electronico"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                value="{{ $datos['email']}}" {{ $exists ? 'disabled' : '' }}>
                                                @error('email')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="numero_celular" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Número de Celular(*)</label>
                                                <input type="tel" name="numero_celular" id="numero_celular" autocomplete="numero_celular" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                value="{{ $datos['numero_celular']}}" {{ $exists ? 'disabled' : '' }}>
                                                @error('numero_celular')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6 border dark:border-zinc-900">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="sexo" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Sexo (*)</label>
                                                <select id="sexo" name="sexo" autocomplete="sexo"
                                                class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione su sexo</option>
                                                    <option value="1">Masculino</option>
                                                    <option value="2">Femenino</option>
                                                </select>
                                                @error('sexo')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="estado_civil_id" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Estado Civil</label>
                                                <select id="estado_civil_id" name="estado_civil_id" autocomplete="estado_civil_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione su estado civil</option>
                                                        @foreach ($estadoCivils as $estadoCivil)
                                                            <option value="{{ $estadoCivil->id }}">{{ $estadoCivil->nombre }}</option>
                                                        @endforeach
                                                </select>
                                                @error('estado_civil_id')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-6 lg:col-span-2 hidden" id="a_casada">
                                                <label for="apellido_casada" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300 ">Apellido casada</label>
                                                <input type="text" name="apellido_casada" id="apellido_casada" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Opcional (Idéntico al documento de identidad).</span>
                                            </div>
                                            <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                                            <div class="modal-overlay absolute inset-0 bg-gray-500 opacity-50"></div>
                                                <div class="modal-container bg-white w-96 mx-auto rounded-lg shadow-lg z-50 p-4">
                                                    <h2 class="text-lg font-semibold mb-2 text-center">Atención!</h2>
                                                    <p class="text-gray-600 mb-4 text-center">Complete este campo, solo si aparece en su DNI.</p>
                                                    <div class="flex justify-center mt-4">
                                                        <button type="button" id="cancelar" class="bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-2 px-5 rounded">Entendido</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                const boton = document.getElementById('a_casada');
                                                const modal = document.getElementById('modal');
                                                const overlay = modal.querySelector('.modal-overlay');
                                                const cancelar = document.getElementById('cancelar');

                                                // Variable para rastrear si el modal ya se ha mostrado
                                                let modalMostrado = false;

                                                boton.addEventListener('click', () => {
                                                    if (!modalMostrado) {
                                                        modal.classList.remove('hidden');
                                                        modalMostrado = true;
                                                    }
                                                });

                                                overlay.addEventListener('click', () => {
                                                    modal.classList.add('hidden');
                                                });

                                                cancelar.addEventListener('click', () => {
                                                    modal.classList.add('hidden');
                                                });
                                            </script>
                                            <script>
                                                // Función para mostrar el campo apellido casada
                                                const selectSexo = document.getElementById('sexo');
                                                const selectEstadoCivil = document.getElementById('estado_civil_id');
                                                const campoApellidoCasada = document.getElementById('a_casada');

                                                function mostrarApellidoCasada() {
                                                    const sexoValue = selectSexo.value;
                                                    const estadoCivilValue = selectEstadoCivil.value;

                                                    if (sexoValue === '2' && estadoCivilValue === '2') {
                                                        campoApellidoCasada.style.display = 'block';
                                                    } else {
                                                        campoApellidoCasada.style.display = 'none';
                                                    }
                                                }

                                                // Llamar a la función al cargar la página
                                                mostrarApellidoCasada();

                                                // Escuchar cambios en el select de sexo y estado civil
                                                selectSexo.addEventListener('change', mostrarApellidoCasada);
                                                selectEstadoCivil.addEventListener('change', mostrarApellidoCasada);
                                            </script>


                                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                                <label for="fecha_nacimiento" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Fecha de Nacimiento (*)</label>
                                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Ingresar el día/mes/año.</span>
                                                @error('fecha_nacimiento')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="edad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Edad (*)</label>
                                                <input type="text" name="edad" id="edad" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('edad')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <script>
                                                const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
                                                const edadInput = document.getElementById('edad');

                                                fechaNacimientoInput.addEventListener('change', calcularEdad);

                                                function calcularEdad() {
                                                    const fechaNacimiento = new Date(fechaNacimientoInput.value);
                                                    const fechaActual = new Date();
                                                    let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

                                                    // Verificar si aún no ha cumplido años en este año
                                                    if (
                                                        fechaNacimiento.getMonth() > fechaActual.getMonth() ||
                                                        (fechaNacimiento.getMonth() === fechaActual.getMonth() &&
                                                            fechaNacimiento.getDate() > fechaActual.getDate())
                                                    ) {
                                                        edad--;
                                                    }

                                                    // Mostrar la edad calculada en el campo de entrada
                                                    edadInput.value = edad;
                                                }
                                            </script>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="discapacidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">¿Tiene alguna discapacidad? (*)</label>
                                                <select id="discapacidad" name="discapacidad" autocomplete="discapacidad" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="si">Si</option>
                                                    <option value="no">No</option>
                                                </select>
                                                @error('discapacidad')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2" id="discapacidad_si" style="display: none;">
                                                <label for="discapacidad_id" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de discapacidad (*)</label>
                                                <select id="discapacidad_id" name="discapacidad_id" autocomplete="discapacidad_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccionar...</option>
                                                    <option value="motora">Discapacidad motora</option>
                                                    <option value="visual">Discapacidad visual</option>
                                                    <option value="auditiva">Discapacidad auditiva</option>
                                                    <option value="cognitiva">Discapacidad cognitiva</option>
                                                </select>
                                                @error('discapacidad_id')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                            <h2 class="text-black dark:text-white">Datos de nacimiento</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="pais_nac_id" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Pais de nacimiento (*)</label>
                                                <select id="pais_nac_id" name="pais_nac_id" autocomplete="pais_nac_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione su pais de nacimiento</option>
                                                        @foreach ($paises as $pais)
                                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                                        @endforeach
                                                </select>
                                                @error('pais_nac_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="nacionalidad_id" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nacionalidad (*)</label>
                                                <select id="nacionalidad_id" name="nacionalidad_id" autocomplete="nacionalidad_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione su nacionalidad</option>
                                                        @foreach ($nacionalidades as $nacionalidad)
                                                            <option value="{{ $nacionalidad->id }}">{{ $nacionalidad->nombre }}</option>
                                                        @endforeach
                                                </select>
                                                @error('nacionalidad_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="ubigeo_nacimiento" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Ubigeo de Nacimiento (*)</label>
                                                <input type="text" name="ubigeo_nacimiento" id="ubigeo_nacimiento" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                >
                                                @error('ubigeo_nacimiento')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_nacimiento" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento de Nacimiento (*)</label>
                                                <select id="departamento_nacimiento" name="departamento_nacimiento" autocomplete="departamento_nacimiento" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Departamento01</option>
                                                    <option value="02">Departamento02</option>
                                                </select>
                                                @error('departamento_nacimiento')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provincia_nac" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provincia de Nacimiento (*)</label>
                                                <select id="provincia_nac" name="provincia_nac" autocomplete="provincia_nac" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Provincia01</option>
                                                    <option value="02">Provincia02</option>
                                                </select>
                                                @error('provincia_nac')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_nac" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito de Nacimiento (*)</label>
                                                <select id="distrito_nac" name="distrito_nac" autocomplete="distrito_nac" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Distrito01</option>
                                                    <option value="02">Distrito02</option>
                                                </select>
                                                @error('distrito_nac')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tercer contenedor -->
                            <div class="col-span-6">
                            <h2 class="text-black dark:text-white">Datos de domicilio</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del tercer contenedor -->
                                            <div class="col-span-6 sm:col-span-4">
                                                <label for="direccion_domiciliaria" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Direccion Domiciliaria (*)</label>
                                                <input type="text" name="direccion_domiciliaria" id="direccion_domiciliaria" autocomplete="direccion_domiciliaria" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('direccion_domiciliaria')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="ubigeo_domicilio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Ubigeo de Domicilio</label>
                                                <input type="text" name="ubigeo_domicilio" id="ubigeo_domicilio" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('ubigeo_domicilio')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_domicilio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento de Domicilio (*)</label>
                                                <select name="departamento_id" id="departamento_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('departamento_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provicia_domicilio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provicia de Domicilio (*)</label>
                                                <select name="provincia_id" id="provincia_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione una provincia</option>
                                                </select>
                                                @error('provincia_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_domicilio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito de Domicilio (*)</label>
                                                <select name="distrito_domic_id" id="distrito_domic_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione un distrito</option>
                                                </select>
                                                @error('distrito_domic_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatrio</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <script>
                    //Funcion para mostrar el campo de tipos de discapacidad
                    const selectDiscapacidad = document.getElementById('discapacidad');
                    const divDiscapacidadSi = document.getElementById('discapacidad_si');

                    selectDiscapacidad.addEventListener('change', function() {
                        if (selectDiscapacidad.value === 'si') {
                        divDiscapacidadSi.style.display = 'block';
                        } else {
                        divDiscapacidadSi.style.display = 'none';
                        }
                    });
                </script>

               </form>

            @elseif ($currentStep == 2 && $studyType == 1)
               <!-- Código para la vista de maestría -->
              <form action="{{ route('formulario.guardar.informacion_academica') }}" method="POST" class="inline formulario-guardar">
                  <!-- Campos de información académica -->
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                        <h1 class="font-bold text-black dark:text-white">II. INFORMACIÓN ACADEMICA:</h1><br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Infomración de la universidad donde realizó sus estudios de Pregrado</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="universidad_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Universidad </label>
                                                <input type="text" name="universidad_pre" id="universidad_pre" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('universidad_pre')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="tipo_universidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Universidad</label>
                                                <select id="tipo_universidad" name="tipo_universidad" autocomplete="tipo_universidad" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un tipo de universidad</option>
                                                    @foreach ($tipoUniversidades as $tipoUniversid)
                                                        <option value="{{ $tipoUniversid->id }}">{{ $tipoUniversid->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tipo_universidad')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_ingreso_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de ingrso</label>
                                                <input type="text" name="anio_ingreso_pre" id="anio_ingreso_pre" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('anio_ingreso_pre')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_egreso_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de egreso</label>
                                                <input type="text" name="anio_egreso_pre" id="anio_egreso_pre" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('anio_egreso_pre')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="pais_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Pais</label>
                                                <select id="pais_pre" name="pais_pre" autocomplete="pais_pre" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un</option>
                                                        @foreach ($paises as $pais)
                                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                                        @endforeach
                                                </select>
                                                @error('pais_pre')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento (*)</label>
                                                <select name="departamento_id" id="departamento_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione un departamento</option>
                                                    @foreach ($departamentos as $departamento)
                                                        <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('departamento_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provincia_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provincia (*)</label>
                                                <select name="provincia_id" id="provincia_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione una provincia</option>
                                                </select>
                                                @error('provincia_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_pre" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito (*)</label>
                                                <select name="distrito_domic_id" id="distrito_domic_id" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                    <option value="">Seleccione un distrito</option>
                                                </select>
                                                @error('distrito_domic_id')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="grado" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Grado obtenido:</label>
                                                <input type="text" name="grado" id="grado"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('grado')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="est_concluidos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Estudios concluidos en:</label>
                                                <input type="text" name="est_concluidos" id="est_concluidos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('est_concluidos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Información de otra Universidad/Instituto</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="otra_universidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Universidad dónde realizó sus estudios de Pregrado</label>
                                                <input type="text" name="otra_universidad" id="otra_universidad"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="tipo_universidad_otra" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Universidad</label>
                                                <select id="tipo_universidad_otra" name="tipo_universidad_otra" autocomplete="tipo_universidad_otra" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un tipo de universidad</option>
                                                    @foreach ($tipoUniversidades as $tipoUniversid)
                                                        <option value="{{ $tipoUniversid->id }}">{{ $tipoUniversid->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_ingreso_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de ingrsó a la universidad</label>
                                                <input type="text" name="anio_ingreso_otro" id="anio_ingreso_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_egreso_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de egreso de la universidad</label>
                                                <input type="text" name="anio_egreso_otro" id="anio_egreso_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="pais_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Pais dónde culminó sus estudios</label>
                                                <select id="pais_otro" name="pais_otro" autocomplete="pais_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un pais</option>
                                                        @foreach ($paises as $pais)
                                                            <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                                        @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento</label>
                                                <select id="departamento_otro" name="departamento_otro" autocomplete="departamento_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Departamento01</option>
                                                    <option value="02">Departamento02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provincia_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provincia</label>
                                                <select id="provincia_otro" name="provincia_otro" autocomplete="provincia_dom" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Provincia01</option>
                                                    <option value="02">Provincia02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito</label>
                                                <select id="distrito_otro" name="distrito_otro" autocomplete="distrito_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Distrito01</option>
                                                    <option value="02">Distrito02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="grado_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Grado obtenido:</label>
                                                <input type="text" name="grado_otro" id="grado_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="est_concluidos_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Estudios concluidos en:</label>
                                                <input type="text" name="est_concluidos_otro" id="est_concluidos_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-blue-900">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>

            @elseif ($currentStep == 2 && $studyType == 2)
          <!-- Código para la vista de doctorado -->
              <form action="{{ route('formulario.guardar.informacion_academica2') }}" method="POST" class="inline formulario-guardar">
                  <!-- Campos de información académica -->
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                        <h1 class="font-bold text-black dark:text-white">II. INFORMACIÓN ACADEMICA:</h1><br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Infomración de la universidad donde realizó sus estudios de Posgrado (Maestría)</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="universidad_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Universidad</label>
                                                <input type="text" name="universidad_pos" id="universidad_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('universidad_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="tipo_universidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Universidad</label>
                                                <select id="tipo_universidad" name="tipo_universidad" autocomplete="tipo_universidad" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="particular">Particular</option>
                                                    <option value="nacional">Nacional</option>
                                                </select>
                                                @error('tipo_universidad')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_ingreso_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de ingreso</label>
                                                <input type="text" name="anio_ingreso_pos" id="anio_ingreso_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('anio_ingreso_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_egreso_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de egreso</label>
                                                <input type="text" name="anio_egreso_pos" id="anio_egreso_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('anio_egreso_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="pais_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Pais</label>
                                                <select id="pais_pos" name="pais_pos" autocomplete="pais_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Pais01</option>
                                                    <option value="02">Pais02</option>
                                                </select>
                                                @error('pais_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento</label>
                                                <select id="departamento_pos" name="departamento_pos" autocomplete="departamento_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Departamento01</option>
                                                    <option value="02">Departamento02</option>
                                                </select>
                                                @error('departamento_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provincia_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provincia</label>
                                                <select id="departamento_pos" name="provincia_pos" autocomplete="provincia_dom" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Provincia01</option>
                                                    <option value="02">Provincia02</option>
                                                </select>
                                                @error('departamento_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_pos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito</label>
                                                <select id="distrito_pos" name="distrito_pos" autocomplete="distrito_pos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Distrito01</option>
                                                    <option value="02">Distrito02</option>
                                                </select>
                                                @error('distrito_pos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="grado" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Grado obtenido:</label>
                                                <input type="text" name="grado" id="grado" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('grado')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="est_concluidos" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Estudios concluidos en:</label>
                                                <input type="text" name="est_concluidos" id="est_concluidos" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('est_concluidos')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Otros Estudios:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="otra_universidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nombre de la Universidad</label>
                                                <input type="text" name="otra_universidad" id="otra_universidad"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="tipo_universidad_otra" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Tipo de Universidad</label>
                                                <select id="tipo_universidad_otra" name="tipo_universidad_otra" autocomplete="tipo_universidad_otra" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="particular">Particular</option>
                                                    <option value="nacional">Nacional</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_ingreso_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de ingreso a la universidad</label>
                                                <input type="text" name="anio_ingreso_otro" id="anio_ingreso_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="anio_egreso_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año de egreso de la universidad</label>
                                                <input type="text" name="anio_egreso_otro" id="anio_egreso_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="pais_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Pais dónde culminó sus estudios</label>
                                                <select id="pais_otro" name="pais_otro" autocomplete="pais_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Pais01</option>
                                                    <option value="02">Pais02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="departamento_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Departamento</label>
                                                <select id="departamento_otro" name="departamento_otro" autocomplete="departamento_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Departamento01</option>
                                                    <option value="02">Departamento02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="provincia_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Provincia</label>
                                                <select id="provincia_otro" name="provincia_otro" autocomplete="provincia_dom" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Provincia01</option>
                                                    <option value="02">Provincia02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="distrito_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Distrito</label>
                                                <select id="distrito_otro" name="distrito_otro" autocomplete="distrito_otro" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value=""></option>
                                                    <option value="01">Distrito01</option>
                                                    <option value="02">Distrito02</option>
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="posgrado" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Posgrado</label>
                                                <input type="text" name="posgrado" id="posgrado"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="seg_especialidad" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Segunda Especialidad:</label>
                                                <input type="text" name="seg_especialidad" id="seg_especialidad"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="grado_otro" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Grado obtenido:</label>
                                                <input type="text" name="grado_otro" id="grado_otro"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>
        <!--Hasta aquí termina lo de Doctorado-->
          @elseif ($currentStep == 3)
              <!-- Sección de experiencia profecioonal -->
              <form action="{{ route('formulario.guardar.experiencia_profecional') }}" method="POST" class="inline formulario-guardar">
                  <!-- Campos de información académica -->
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                        <h1 class="font-bold text-black dark:text-white">III. EXPERIENCIA PROFECIONAL:</h1><br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">xxxxxxx</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="inst_procedencia" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Registre la institución de procedencia</label>
                                                <input type="text" name="inst_procedencia" id="inst_procedencia" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="carg_actual" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Cargo actual en la institución</label>
                                                <input type="text" name="carg_actual" id="carg_actual" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="fecha_inicio" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Fecha de inicio en su institución</label>
                                                <input type="date" name="fecha_inicio" id="fecha_inicio"class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="otros" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Otros</label>
                                                <input type="text" name="otros" id="otros" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Información del programa al que postula</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="programa" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">El programa al que postula:</label>
                                                <input type="text" name="programa" id="programa" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                value="{{ $datos['programa']}}">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="mencion" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">La mención/especialidadal que postula:</label>
                                                <input type="text" name="mencion" id="mencion" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm"
                                                value="{{ $datos['mencion']}}">
                                            </div>


                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="codigo_otro_inscripcion" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Código de preinscripción</label>
                                                <input type="text" name="codigo_otro_inscripcion" id="codigo_otro_inscripcion" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="cod_orcid" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Código ORCID</label>
                                                <input type="text" name="cod_orcid" id="cod_orcid" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Si no cuenta con el código puede registrarse y obtener en el siguiete enlace: <a class="text-blue-500" href="https://orcid.org/register">https://orcid.org/register</a></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>

          @elseif ($currentStep == 4)
              <!-- Sección de producción científica -->
              <form action="{{ route('formulario.guardar.produccion_cientifica') }}" method="POST" class="inline formulario-guardar">
              @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                        <h1 class="font-bold text-black dark:text-white">IV. PRODUCCIÓN CIENTÍFICA:</h1><br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su Trabajo 01</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="trabajo_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Titulo de trabajo 01:</label>
                                                <input type="text" name="trabajo_01" id="trabajo_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('trabajo_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="revista_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nombre de la revista o publicación 01:</label>
                                                <input type="text" name="revista_01" id="revista_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('revista_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="año_pub_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año (publicación 01):</label>
                                                <input type="text" name="año_pub_01" id="año_pub_01"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('año_pub_01')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="numero_pub_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Número (publicación 01):</label>
                                                <input type="text" name="numero_pub_01" id="numero_pub_01"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('numero_pub_01')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="volumen_pub_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Volumen (publicación 01):</label>
                                                <input type="text" name="volumen_pub_01" id="volumen_pub_01"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('volumen_pub_01')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="paginas_pub_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Páginas de (publicación 01):</label>
                                                <input type="text" name="paginas_pub_01" id="paginas_pub_01"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('paginas_pub_01')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="a_pub_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">A (publicación 01):</label>
                                                <input type="text" name="a_pub_01" id="a_pub_01"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                                @error('a_pub_01')
                                                    <span class="block text-xs font-medium text-red-600">Este campo es obligatorio</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su Trabajo 02</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="trabajo_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Titulo de trabajo 02:</label>
                                                <input type="text" name="trabajo_02" id="trabajo_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="revista_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nombre de la revista o publicación 02:</label>
                                                <input type="text" name="revista_02" id="revista_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="año_pub_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año (publicación 02):</label>
                                                <input type="text" name="año_pub_02" id="año_pub_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="numero_pub_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Número (publicación 02):</label>
                                                <input type="text" name="numero_pub_02" id="numero_pub_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="volumen_pub_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Volumen (publicación 02):</label>
                                                <input type="text" name="volumen_pub_02" id="volumen_pub_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="paginas_pub_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Páginas de (publicación 02):</label>
                                                <input type="text" name="paginas_pub_02" id="paginas_pub_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="a_pub_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">A (publicación 02):</label>
                                                <input type="text" name="a_pub_02" id="a_pub_02"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tercer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su Trabajo 03</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="trabajo_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Titulo de trabajo 03:</label>
                                                <input type="text" name="trabajo_03" id="trabajo_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="revista_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Nombre de la revista o publicación 03:</label>
                                                <input type="text" name="revista_03" id="revista_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="año_pub_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Año (publicación 03):</label>
                                                <input type="text" name="año_pub_03" id="año_pub_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="numero_pub_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Número (publicación 03):</label>
                                                <input type="text" name="numero_pub_03" id="numero_pub_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="volumen_pub_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Volumen (publicación 03):</label>
                                                <input type="text" name="volumen_pub_03" id="volumen_pub_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="paginas_pub_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Páginas de (publicación 03):</label>
                                                <input type="text" name="paginas_pub_03" id="paginas_pub_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                <label for="a_pub_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">A (publicación 03):</label>
                                                <input type="text" name="a_pub_03" id="a_pub_03"                 class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>

              @elseif ($currentStep == 5)

              <!-- Sección de Idiomas Extrangeros y Nativos-->
              <form action="{{ route('formulario.guardar.idiomas') }}" method="POST" class="inline formulario-guardar">
              @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                        <h1 class="font-bold text-black dark:text-white">V. IDIOMAS EXTRANJEROS Y NATIVOS</h1><br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su primer Idioma</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="idioma_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Idioma01:</label>
                                                <select id="idioma_01" name="idioma_01" autocomplete="idioma_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un Idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('idioma_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="habla_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Habla 01:</label>
                                                <select id="habla_01" name="habla_01" autocomplete="habla_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('habla_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="lee_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Lee 01:</label>
                                                <select id="lee_01" name="lee_01" autocomplete="lee_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('lee_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="escribe_01" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Escribe 01:</label>
                                                <select id="escribe_01" name="escribe_01" autocomplete="escribe_01" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                                @error('escribe_01')
                                                    <span class="block text-xs font-medium text-red-600">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su segundo Idioma</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="idioma_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Idioma02:</label>
                                                <select id="idioma_02" name="idioma_02" autocomplete="idioma_02" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un Idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="habla_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Habla 02:</label>
                                                <select id="habla_02" name="habla_02" autocomplete="habla_02" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="lee_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Lee 02:</label>
                                                <select id="lee_02" name="lee_02" autocomplete="lee_02" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="escribe_02" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Escribe 02:</label>
                                                <select id="escribe_02" name="escribe_02" autocomplete="escribe_02" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tercer contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Sobre su tercer Idioma</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del tercer contenedor -->
                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="idioma_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Idioma03:</label>
                                                <select id="idioma_03" name="idioma_03" autocomplete="idioma_03" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione un Idioma</option>
                                                    @foreach ($idiomas as $idioma)
                                                        <option value="{{ $idioma->id }}">{{ $idioma->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="habla_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Habla 03:</label>
                                                <select id="habla_03" name="habla_03" autocomplete="habla_03" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="lee_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Lee 03:</label>
                                                <select id="lee_03" name="lee_03" autocomplete="lee_03" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                            <label for="escribe_03" class="block text-sm font-medium text-sm text-gray-700 dark:text-gray-300">Escribe 03:</label>
                                                <select id="escribe_03" name="escribe_03" autocomplete="escribe_03" class="mt-1 block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm">>
                                                    <option value="">Seleccione una escala</option>
                                                    @foreach ($escalaValorativas as $escala)
                                                        <option value="{{ $escala->id }}">{{ $escala->nonbre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-blue-900">
                            Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
              </form>

              @elseif ($currentStep == 6)
               <!-- Sección de Subir Archivos-->
               <form id="miFormulario" action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
               @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                    <h1 class="font-bold text-black dark:text-white">VI. SUBIR ARCHIVOS</h1>
                    <br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                            <h2  class="text-black dark:text-white">Genere y firme sus archivos, luego seleccione para poder enviarlos:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file1" class="block text-md font-medium text-gray-700 dark:text-gray-300">Solicitud de Postulación</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <div style="display: flex; align-items: center;">
                                                    <a type="button" href="{{ route('solicitudpdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                        Generar PDF
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file1" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file2" class="block text-md font-medium text-gray-700 dark:text-gray-300">Ficha de Inscripción</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <div style="display: flex; align-items: center;">
                                                    <a type="button" href="{{ route('preinscripcion.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                        Generar PDF
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file2" accept=".pdf,.png" class="mt-2 px-1 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Tercer contenedor -->
                            <div class="col-span-6">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file3" class="block text-md font-medium text-gray-700 dark:text-gray-300">Carta de Compromiso</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <a type="button" href="{{ route('carta.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                    Generar PDF
                                                </a>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file3" accept=".pdf,.png" class="mt-2 px-1 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cuarto contenedor -->
                            <div class="col-span-6">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file4" class="block text-md font-medium text-gray-700 dark:text-gray-300">Declaración Jurada</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del tercer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <a type="button" href="{{ route('declaracion.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                    Generar PDF
                                                </a>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                            <input type="file" name="files[]" id="file4" accept=".pdf,.png" class="mt-2 px-1 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quinto contenedor -->
                            <div class="col-span-6">
                               <h2  class="text-black dark:text-white">Seleccione y cargue sus archivos:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del cuarto contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file5" class="block text-md font-medium text-gray-700 dark:text-gray-300">Grado académico</label>
                                                <input type="file" name="files[]" id="file5" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Grado académico en copia autenticada o fedatada </span>
                                                <a href="https://enlinea.sunedu.gob.pe/" class="block text-xs font-medium text-blue-600">https://enlinea.sunedu.gob.pe/</a>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Nota: Los grados o títulos obtenidos en el extranjero deben ser visados por el Consulado respectivo.</span>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file6" class="block text-md font-medium text-gray-700 dark:text-gray-300">Curriculum Vitae </label>
                                                <input type="file" name="files[]" id="file6" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">Currículum Vitae documentado (en formato PDF).</span>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file6" class="block text-md font-medium text-gray-700 dark:text-gray-300">Proyecto de Investigación</label>
                                                <input type="file" name="files[]" id="file6" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                <a href="" class="mt-1 px-1 block text-xs font-medium text-green-600">Esquema de presentación de proyecto de investigación cuantitativa</a>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file6" class="block text-md font-medium text-gray-700 dark:text-gray-300">Adjuntar Documento de Identidad</label>
                                                <input type="file" name="files[]" id="file6" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                <span class="mt-1 px-1 block text-xs font-medium text-green-600">DNI u Otro documento, escaneado legible anverso y reverso en formato PDF</span>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sexto contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Seleccione y recorte su fotografía:</h2><br>
                                <div id="imageContainer" class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                            <!-- cropper-->
                                            <div id="imageContainer" class="shadow overflow-hidden sm:rounded-md">
                                                    <div class="m-4">

                                                        <label for="file7" class="block text-md font-medium text-gray-700 dark:text-gray-300">FOTO (Solo formato jpg) </label>
                                                        <input type="file" name="files[]" id="file7" accept=".jpg" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                        <span class="mt-1 px-1 block text-xs font-medium text-green-600">Cargue su fotografía tamaño carnet de acuerdo al modelo mostrado, en caso de no tener las medidas adecuadas podrá adecuarlo con el siguiente botón:</span>
                                                        @error('files')
                                                        <p class="text-red-500">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <a href="{{ route('pagina.recorte') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4"  target="_blank">Recortar imagen</a>
                                                    <div id="logo-image-container" class="m-4">
                                                    <img src="{{ asset('img/foto_carnet.jpg') }}" alt="Logo" id="logo-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                               <!-- <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <a href="finalizado" onclick="event.preventDefault(); document.getElementById('miFormulario').submit();" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        Fin de Inscripcion
                                    </a>
                                </div> -->
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-700 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                        Finalizar inscripcion
                                    </button>
                                </div>
                  </div>
                </div>
              </form>
              {{--@elseif ($currentStep == 6)
               <!-- Sección de Subir Archivos-->
               <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
               @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                    <h1 class="font-bold text-black dark:text-white">VI. SUBIR ARCHIVOS</h1>
                    <br>
                        <div class="grid grid-cols-6 gap-6">
                            <!-- Primer contenedor -->
                            <div class="col-span-6">
                            <h2  class="text-black dark:text-white">Genere y firme sus archivos, luego seleccione para poder enviarlos:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file1" class="block text-md font-medium text-gray-700 dark:text-gray-300">Solicitud de Postulación</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <div style="display: flex; align-items: center;">
                                                    <a type="button" href="{{ route('solicitudpdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                        Generar PDF
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file1" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Segundo contenedor -->
                            <div class="col-span-6">
                            <h2  class="text-black dark:text-white">Genere y firme sus archivos, luego seleccione para poder enviarlos:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file2" class="block text-md font-medium text-gray-700 dark:text-gray-300">Ficha de Inscripción</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del primer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <div style="display: flex; align-items: center;">
                                                    <a type="button" href="{{ route('preinscripcion.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                        Generar PDF
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file2" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Tercer contenedor -->
                            <div class="col-span-6">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file3" class="block text-md font-medium text-gray-700 dark:text-gray-300">Carta de Compromiso</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del segundo contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <a type="button" href="{{ route('carta.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                    Generar PDF
                                                </a>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <input type="file" name="files[]" id="file3" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cuarto contenedor -->
                            <div class="col-span-6">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                    <label for="file4" class="block text-md font-medium text-gray-700 dark:text-gray-300">Declaración Jurada</label>
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del tercer contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <a type="button" href="{{ route('declaracion.pdf') }}" style="margin-right: 10px;" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center" target="_blank">
                                                    Generar PDF
                                                </a>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                            <input type="file" name="files[]" id="file4" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quinto contenedor -->
                            <div class="col-span-6">
                               <h2  class="text-black dark:text-white">Seleccione y cargue sus archivos:</h2><br>
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- Contenido del cuarto contenedor -->
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file5" class="block text-md font-medium text-gray-700 dark:text-gray-300">Grado académico Bachillerato</label>
                                                <input type="file" name="files[]" id="file5" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="file6" class="block text-md font-medium text-gray-700 dark:text-gray-300">Curriculum Vitae </label>
                                                <input type="file" name="files[]" id="file6" accept=".pdf,.png" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                @error('files')
                                                <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sexto contenedor -->
                            <div class="col-span-6">
                                <h2  class="text-black dark:text-white">Seleccione y recorte su fotografía:</h2><br>
                                <div id="imageContainer" class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                            <!-- cropper-->
                                            <div id="imageContainer" class="shadow overflow-hidden sm:rounded-md">
                                                    <div class="m-4">

                                                        <label for="file7" class="block text-md font-medium text-gray-700 dark:text-gray-300">FOTO (Solo formato jpg) </label>
                                                        <input type="file" name="files[]" id="file7" accept=".jpg" class="mt-2 py-1 block w-full text-sm text-gray-700 dark:text-gray-300 border-gray-300 dark:border-zinc-500 focus:border-indigo-500 dark:focus:border-indigo-600 rounded-md shadow-sm " required>
                                                        @error('files')
                                                        <p class="text-red-500">{{ $message }}</p>
                                                        @enderror
                                                        <span class="mt-1 px-1 block text-xs font-medium text-green-600">Cargue su fotografía tamaño carnet de acuerdo al modelo mostrado, en caso de no tener las medidas adecuadas podrá adecuarlo con el siguiente boton:</span>
                                                    </div>
                                                    <a href="{{ route('pagina.recorte') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded m-4" target="_blank">Recortar imagen</a>
                                                    <div id="logo-image-container" class="m-4">
                                                    <img src="{{ asset('img/foto_carnet.jpg') }}" alt="Logo" id="logo-image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-blue-900">
                                Guardar
                            </button>
                        </div>
                    </div>
                  </div>
                </div>
              </form>
        @endif--}}

        @elseif ($currentStep == 7)
               <!-- fin de proceso-->
               @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                    <h1 class="font-bold text-black dark:text-white">VII. PROCESO FINALIZADO</h1>
                    <br>
                        <div class="bg-green-200 dark:bg-green-400 shadow-lg sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ __("Se han guardado correctamente sus datos") }}
                            </div>
                        </div>
                        <br>
                        <div>
                            <div class="bg-white dark:bg-zinc-700 shadow-lg sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 ">
                            <div class="grid grid-cols-6 gap-6">
                                <div class=" col-span-6 sm:col-span-3 flex  justify-between">
                                <span class="mt-2 px-1">Ficha de Inscripcion</span>

                                    <a id="botonPdf" type="button" href="{{route('inscripcion.pdf')}}"  class="inline-flex border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                        Generar PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

       </div>

        <!-- Div derecho -->
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 w-1/4 right-div">
                    <ul id="navigation-bar">
                        <li class="text-black dark:text-gray-300">I. DATOS GENERALES</li>
                        <li class="text-black dark:text-gray-300">II. INFORMACIÓN ACADEMICA</li>
                        <li class="text-black dark:text-gray-300">III. EXPERIENCIA PROFESIONAL</li>
                        <li class="text-black dark:text-gray-300">IV. REDACCIÓN CIENTÍFICA</li>
                        <li class="text-black dark:text-gray-300">V. IDIOMAS EXTRANJEROS Y NATIVOS</li>
                        <li class="text-black dark:text-gray-300">VI. SUBIR ARCHIVOS</li>
                        <li class="text-black dark:text-gray-300">VII. PROCESO FINALIZADO</li>
                    </ul>
            </div>

                <script>
                $(document).ready(function() {
                    var currentStep = {{ $currentStep }}; // Obtener el número de la vista actual

                    // Agregar la clase "active" a todos los elementos anteriores
                    $('#progress-bar li').slice(0, currentStep).addClass('active');

                    // Agregar la clase "active" al elemento correspondiente al currentStep en la segunda lista
                    $('#navigation-bar li:nth-child(' + currentStep + ')').addClass('active');
                });
                </script>
    </div>

@section('js')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
        $(document).ready(function() {
        // Carga los valores almacenados en sessionStorage cuando la página se carga
        $('form').each(function(index, form) {
            var formulario = $(form);
            formulario.find('input, select, textarea').each(function() {
            var element = $(this);
            var name = element.attr('name');
            var storedValue = sessionStorage.getItem(name);
            if (storedValue !== null) {
                element.val(storedValue);
            }
            });

            // Guarda los valores en sessionStorage cuando cambian
            formulario.on('change', 'input, select, textarea', function() {
            var element = $(this);
            var name = element.attr('name');
            var value = element.val();
            sessionStorage.setItem(name, value);
            });
        });
        });
        </script>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.formulario-guardar').submit(function(e){
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
        });

        document.getElementById('departamento_id').addEventListener('change', function() {
        var departamentoId = this.value;
        var provinciaSelect = document.getElementById('provincia_id');

        // Borra las opciones anteriores
        provinciaSelect.innerHTML = '<option value="">Seleccione una provincia</option>';

        // Realiza la solicitud para obtener las provincias correspondientes al departamento seleccionado
        if (departamentoId) {
            var url = "{{ route('ubigeo.provincias') }}?departamento_id=" + departamentoId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de provincias al campo de selección
                    data.forEach(provincia => {
                        var option = document.createElement('option');
                        option.value = provincia.id;
                        option.textContent = provincia.nombre;
                        provinciaSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });

    document.getElementById('provincia_id').addEventListener('change', function() {
        var provinciaId = this.value;
        var distritoSelect = document.getElementById('distrito_domic_id');

        // Borra las opciones anteriores
        distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';

        // Realiza la solicitud para obtener los distritos correspondientes a la provincia seleccionada
        if (provinciaId) {
            var url = "{{ route('ubigeo.distritos') }}?provincia_id=" + provinciaId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de distritos al campo de selección
                    data.forEach(distrito => {
                        var option = document.createElement('option');
                        option.value = distrito.id;
                        option.textContent = distrito.nombre;
                        distritoSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });

    </script>

@endsection

</x-app-layout>
