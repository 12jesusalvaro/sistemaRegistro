ahora la vista fin:
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fin de inscripción') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-green-200 dark:bg-green-400 shadow-lg sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("Se han guardado correctamente sus datos") }}
            </div>
        </div>
        <br>
        <div>
            <div class="bg-white dark:bg-zinc-700 shadow-lg sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 ">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    Ficha de Inscripcion
                </div>
                <div class="col-span-6 sm:col-span-3">
                      <a id="botonPdf" type="button" href="{{route('inscripcion.pdf')}}"  class="inline-flex py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-900 hover:bg-red-700 focus:outline-none text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                        Generar PDF
                      </a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
