<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>

        @if (session('status'))
        <div class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-200 dark:bg-yellow-400  dark:text-yellow-700" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            {{ session('status') }}
        </div>
        @endif

    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="numero_documento" :value="__('Numero de Documento')" />
            <x-text-input id="numero_documento" name="numero_documento" type="text" class="mt-1 block w-full" :value="old('numero_documento', $user->numero_documento)" required autofocus autocomplete="numero_documento" />
            <x-input-error class="mt-2" :messages="$errors->get('numero_documento')" />
        </div>

        <div>
            <x-input-label for="nombres" :value="__('Nombres')" />
            <x-text-input id="nombres" name="nombres" type="text" class="mt-1 block w-full" :value="old('nombres', $user->nombres)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nombres')" />
        </div>

        <!-- Cant Apellidos-->
        <div>
            <x-input-label for="cant_apellidos" :value="__('Cantidad de Apellidos:')" />
            <select id="cant_apellidos" name="cant_apellidos" :value="old('cant_apellidos')" required autofocus autocomplete="cant_apellidos"
            class="mt-1 block w-full py-2 px-3 border-gray-300 dark:border-gray-500 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-xl focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @if (Auth::user()->cant_apellidos == 2)
                    <option value="2">Dos</option>
                    <option value="1">Uno</option>
                @else
                    <option value="1">Uno</option>
                    <option value="2">Dos</option>
                @endif
            </select>
            <x-input-error :messages="$errors->get('cant_apellidos')" class="mt-2" />
        </div>

        <div id="a_paterno">
            <x-input-label for="primer_apellido" :value="__('Primer Apellido')" />
            <x-text-input id="primer_apellido" name="primer_apellido" type="text" class="mt-1 block w-full" :value="old('primer_apellido', $user->primer_apellido)" required autofocus autocomplete="primer_apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('primer_apellido')" />
        </div>
        <div id="a_materno">
            <x-input-label for="segundo_apesllido" :value="__('Segundo Apellido')" />
            <x-text-input id="segundo_apellido" name="segundo_apellido" type="text" class="mt-1 block w-full" :value="old('segundo_apellido', $user->segundo_apellido)" required autofocus autocomplete="segundo_apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('segundo_apellido')" />
        </div>

        <div>
            <x-input-label for="celular" :value="__('Número de Celular')" />
            <x-text-input id="celular" name="celular" type="text" class="mt-1 block w-full" :value="old('celular', $user->celular)" required autofocus autocomplete="segundo_apellido" />
            <x-input-error class="mt-2" :messages="$errors->get('celular')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Actualizar') }}</x-primary-button>

            @if (session('status') === 'Perfil-Actualizado')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Función para cambiar la propiedad "required" y el valor en función de la selección del usuario
        $('#cant_apellidos').on('change', function () {
            var cantApellidos = $(this).val();
            if (cantApellidos == '2') {
                $('#segundo_apellido').prop('required', true);
            } else {
                $('#segundo_apellido').prop('required', false);
            }
        });
    });

</script>
