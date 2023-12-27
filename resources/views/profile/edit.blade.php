<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div  class="max-w-2xl mx-auto sm:px-6 lg:px-8 w-full md:w-2/4 space-y-6">
        <div class="flex justify-between border-gray-300 dark:border-gray-500 ">
            <button id="button1" onclick="showStep(1)"
                class="flex-grow px-4 py-2 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm " style="border-bottom: 1px solid;">
                Información de perfil
            </button>
            <button id="button2" onclick="showStep(2)"
                class="flex-grow px-4 py-2 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm ">
                Actualizar contraseña
            </button>
            <button id="button3" onclick="showStep(3)"
                class="flex-grow px-4 py-2 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm ">
                Borrar cuenta
            </button>
        </div>
            <div id="step1" class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div id="step2" style="display: none;" class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div id="step3" style="display: none;" class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script>
        function showStep(step) {
            document.getElementById('step1').style.display = 'none';
            document.getElementById('step2').style.display = 'none';
            document.getElementById('step3').style.display = 'none';

            document.getElementById('button1').style.border = 'none';
            document.getElementById('button2').style.border = 'none';
            document.getElementById('button3').style.border = 'none';

            if (step === 1) {
                document.getElementById('step1').style.display = 'block';
                document.getElementById('button1').style.borderBottom = '1px solid ';
            } else if (step === 2) {
                document.getElementById('step2').style.display = 'block';
                document.getElementById('button2').style.borderBottom = '1px solid ';
            } else if (step === 3) {
                document.getElementById('step3').style.display = 'block';
                document.getElementById('button3').style.borderBottom = '1px solid ';
            }
        }
    </script>


</x-app-layout>
