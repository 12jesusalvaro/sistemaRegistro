<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" >
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <span class="absolute top-0 right-0 h-full w-10 text-center text-gray-400">
            <button type="button" class="btn btn-outline-secondary toggle-password"><i class="fas fa-eye-slash py-9"></i></button>
            </span>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
         <div class="flex items-center justify-between">
         <input class="border rounded dark:bg-zinc-800 border-gray-300 dark:border-gray-700 dark:bg-zinc-800 focus:border-indigo-500 dark:focus:border-indigo-600 text-sky-700 focus:border-sky-300 focus:ring focus:ring-slate-300 dark:focus:ring-slate-800 focus:ring-opacity-50"
                   name="remember"
                   type="checkbox"
            >
            <span class="cursor-pointer ml-2 font-serif-700 text-gray-700 dark:text-gray-300">
                Recordar
            </span>
            </div>
           </div>
            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="w-full text-white bg-sky-600 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Ingresar</button>
            </div>
            <br>
            <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="font-medium text-sm text-gray-700 dark:text-gray-300 hover:underline ">
               ¿Olvidaste tu contraseña?</a>
            @endif
           <p class="text-sm font-light text-gray-500 ">
            <a class="text-sm font-semibold hover:underline border-2 border-transparent rounded  text-gray-700 dark:text-gray-300 focus:border-slate-500 focus:outline-none" href="{{ route('register') }}">Registrarse</a>
            </p>
            </div>
        </div>

    </form>
</x-guest-layout>


<!-- Esto es pafra el icono eye -->

<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      $(document).ready(function() {
  $('.toggle-password').click(function() {
    var passwordInput = $('#password');
    var toggleButton = $(this);
    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      toggleButton.html('<i class="fas fa-eye py-9 "></i>');
      toggleButton.attr('title', 'Hide password');
    } else {
      passwordInput.attr('type', 'password');
      toggleButton.html('<i class="fas fa-eye-slash py-9"></i>');
      toggleButton.attr('title', 'Show password');
    }
  });
});
  </script>
</head>
