
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
    @csrf

        <div id="step1">

            <!-- Names -->
            <div class="mt-4">
                <x-input-label for="nombres" :value="__('Nombres:')" />
                <x-text-input id="nombres" class="block mt-1 w-full" type="text" name="nombres" :value="old('nombres')" required autofocus autocomplete="nombres" />
                <x-input-error :messages="$errors->get('nombres')" class="mt-2" />
            </div>

            <!-- Cant Apellidos-->
            <div class="mt-4" >
                <x-input-label for="cant_apellidos" :value="__('Cantidad de Apellidos:')" />
                <select id="cant_apellidos" name="cant_apellidos" :value="old('cant_apellidos')" required autofocus autocomplete="cant_apellidos"
                class="mt-1 block w-full py-2 px-3 border-gray-300 dark:border-gray-500 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="2">Dos</option>
                    <option value="1">Uno</option>
                </select>                
                <x-input-error :messages="$errors->get('cant_apellidos')" class="mt-2" />
            </div>

            <!-- First Name-->
            <div class="mt-4" id="a_paterno">
                <x-input-label for="primer_apellido" :value="__('Primer Apellido:')" />
                <x-text-input id="primer_apellido" class="block mt-1 w-full" type="text" name="primer_apellido" :value="old('primer_apellido')" required autofocus autocomplete="primer_apellido" />
                <x-input-error :messages="$errors->get('primer_apellido')" class="mt-2" />
            </div>

            <!-- Last Name-->
            <div class="mt-4" id="a_materno">
                <x-input-label for="segundo_apellido" :value="__('Segundo Apellido:')" />
                <x-text-input id="segundo_apellido" class="block mt-1 w-full" type="text" name="segundo_apellido" :value="old('segundo_apellido')" required autofocus autocomplete="segundo_apellido" />
                <x-input-error :messages="$errors->get('segundo_apellido')" class="mt-2" />
            </div>

            <!-- Celular-->
            <div class="mt-4">
                <x-input-label for="celular" :value="__('Número de Celular:')" />
                <x-text-input id="celular" class="block mt-1 w-full" type="tel" name="celular" :value="old('celular')" required autofocus autocomplete="celular" />
                <x-input-error :messages="$errors->get('celular')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-secondary-button onclick="nextStep()">
                        {{ __('Siguiente') }}
                </x-secondary-button>
            </div>

        </div>

        <div id="step2" style="display: none;">

            <!-- Tipo de Documento -->
            <div class="mt-4">
                <x-input-label for="tipo_documento_id" :value="__('Tipo de Documento:')" />
                <select id="tipo_documento_id" name="tipo_documento_id" :value="old('tipo_documento_id')" required autofocus autocomplete="tipo_documento_id"
                    class="mt-1 block w-full py-2 px-3 border-gray-300 dark:border-gray-500 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Seleccione el tipo de documento</option>
                    @foreach ($tipoDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->nombre }}</option>
                    @endforeach
                    </select>
                <x-input-error :messages="$errors->get('tipo_documento_id')" class="mt-2" />
            </div>

            <!-- Numero de Documento -->
            <div class="mt-4">
                <x-input-label for="numero_documento" :value="__('Numero de Documento:')" />
                <x-text-input id="numero_documento" class="block mt-1 w-full" type="text" name="numero_documento" :value="old('numero_documento')" required autofocus autocomplete="numero_documento" />
                <x-input-error :messages="$errors->get('numero_documento')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email:')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password:')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password:')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

            <x-secondary-button onclick="previousStep()">
                    {{ __('Anterior') }}
            </x-secondary-button>
                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

        </div>
    </form>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        let currentStep = 1;

        function nextStep() {
            if (currentStep === 1) {
                // Validación dinámica para apellidos
                const cantApellidos = document.getElementById('cant_apellidos').value;
                if (cantApellidos === '1') {
                    document.getElementById('segundo_apellido').removeAttribute('required');
                }
            }

            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'block';
            currentStep = 2;
        }

        function previousStep() {
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step1').style.display = 'block';
            currentStep = 1;
        }
    </script>
    </x-guest-layout>
