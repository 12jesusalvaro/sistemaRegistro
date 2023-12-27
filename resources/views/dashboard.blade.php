<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
            {{--{{ Auth::user()->nombres }}--}}
            @if(auth()->check() && auth()->user()->hasRole('Postulante'))
            <div class="grid grid-cols-6 gap-6">
               <div class=" col-span-6 sm:col-span-3 shadow-sm sm:rounded-lg" >
                    <p class="font-semibold leading-tight">{{__("Paso 1: ")}}</p>
                    @if($currentStep>=1)
                    <div class=" dark:text-green-400  text-green-600 shadow-sm sm:rounded-lg font-semibold leading-tight">
                    {{ __("PreInscripcion 100%") }}
                    @endif
                    </div>
                    @if($currentStep==0)
                    {{ __("PreInscripcion 0%") }}
                    <p class="font-semibold leading-tight">
                    Usted no está preinscrito.
                    @endif

                    @if($currentStep==1)
                    <p class="font-semibold leading-tight"> {{ __("Usted se ha preinscrito satisfactoriamente a la ")}}
                    {{__("$mencion_nombre ")}}</p>
                    @endif
                    @if($estado_pago==0)
                    <div class=" text-xs dark:text-yellow-400  text-yellow-600 shadow-sm sm:rounded-lg font-semibold leading-tight">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ __("Realiza el depósito por derechos de postulación al Banco Scotiabank, indicando el codigo generado en la ficha de preinscripción. ")}}
                     </div>
                     @endif

                </div>
                <div class="col-span-6 sm:col-span-3 shadow-sm sm:rounded-lg" >
                    <p class="font-semibold leading-tight">{{__("Paso 2:")}}</p>
                    @if($estado_pago==0)
                    {{ __("Validar Pago 0%") }}
                    <div class=" text-xs dark:text-yellow-400  text-yellow-600 shadow-sm sm:rounded-lg font-semibold leading-tight">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ __("Nota: Debe realizarce un día después de pagar.")}}
                    </div>
                    @endif

                    @if($estado_pago==1)
                    <div class=" dark:text-green-400  text-green-600 shadow-sm sm:rounded-lg font-semibold leading-tight">
                    {{ __("Validar Pago 100%") }}
                     @endif
                    </div>

                </div>
                <div class="col-span-6 shadow-sm sm:rounded-lg" >
                <p class="font-semibold leading-tight">{{__("Paso 3:")}}</p>
                    {{ __("Inscripcion $progress%") }}
                    <div id="progress-bar-container" >
                        <ul id="progress-bar">
                            <li class="{{ $currentStep == 1 ? 'active' : '' }}">Vista 1</li>
                            <li class="{{ $currentStep == 2 ? 'active' : '' }}">Vista 2</li>
                            <li class="{{ $currentStep == 3 ? 'active' : '' }}">Vista 3</li>
                            <li class="{{ $currentStep == 4 ? 'active' : '' }}">Vista 4</li>
                            <li class="{{ $currentStep == 5 ? 'active' : '' }}">Vista 5</li>
                            <li class="{{ $currentStep == 6 ? 'active' : '' }}">Vista 6</li>
                            <li class="{{ $currentStep == 7 ? 'active' : '' }}">Vista 7</li>

                        </ul>
                    </div>
                    <br>
                    @if($currentStep==7)
                        {{__("!Usted a culminado el proceso de inscripcion!")}}
                        {{__("No olvide ir a la entrevista personal y presencial!")}}
                    @endif
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

<script>
    $(document).ready(function() {
        var currentStep = {{ $currentStep }}; // Obtener el número de la vista actual
        var previousStep = {{ $currentStep - 1 }}; // Obtener el paso anterior

        // Agregar la clase "active" a todos los elementos anteriores
        $('#progress-bar li').slice(0, currentStep).addClass('active');

        // Agregar la clase "active" al elemento correspondiente al currentStep en la segunda lista
        $('#navigation-bar li:nth-child(' + currentStep + ')').addClass('active');

        // Si necesitas trabajar con el paso anterior, puedes usar la variable previousStep
        // Por ejemplo, para agregar una clase específica al paso anterior en la segunda lista:
        $('#navigation-bar li:nth-child(' + previousStep + ')').addClass('previous');
    });
</script>


            </div>
            @endif

            @if(auth()->check() && auth()->user()->hasRole('Evaluador'))
                <div class="p-6 text-gray-900 dark:text-gray-100">
                Número de Postulantes a Calificar : {{ $Noevaluados }}
                    <br>
                Número de Postulantes en proceso de evaluación: {{ $evaluadosEnProceso}}
                    <br>
                Número de Postulantes Calificados : {{ $evaluados }}
                </div>
            @endif

            @if(auth()->check() && auth()->user()->hasRole('Secretaria'))
            <div class="grid grid-cols-6 gap-6">
            <div class="p-6 col-span-6 sm:col-span-3 shadow-md sm:rounded-lg ">
                <p class="font-semibold leading-tight">Número de Postulantes Preinscritos: {{__($preinscritos)}}</p>
            </div>
            <div class="p-6 col-span-6 sm:col-span-3 shadow-md sm:rounded-lg ">
                <p class="font-semibold leading-tight">Número de Postulantes que validaron el pago: {{__($validados)}}</p>
            </div>
            <div class="p-6 col-span-6 shadow-md sm:rounded-lg ">
            <p class="font-semibold leading-tight">Número de Postulantes en el Paso 3 por Vistas:</p>
                <div class=" sm:flex justify-center text-md font-semibold text-center">
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p>  Vista 1 = {{__($postulantesPorCurrentStep[0]) }}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 2 = {{__($postulantesPorCurrentStep[1])}}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 3 = {{__($postulantesPorCurrentStep[2])}}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 4 = {{__($postulantesPorCurrentStep[3])}}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 5 = {{__($postulantesPorCurrentStep[4])}}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 6 = {{__($postulantesPorCurrentStep[5])}}</p>
                    </div>
                    <div class="block px-3 py-2 mt-2 shadow-md rounded-md mr-4">
                        <p> Vista 7 = {{__($postulantesPorCurrentStep[6])}}</p>
                    </div>
                </div>
            </div>
            </div>
            @endif
            </div>
        </div>
        <br>
        <div class="bg-white dark:bg-zinc-800 shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 ">
            <p class="p-6 font-semibold leading-tight">{{ __("Cronograma de Actividades") }}</p>
                <div class="p-4 sm:flex justify-center text-center  shadow-md">
                    <div class="  w-auto h-auto-100 mx-2 ">
                        <div class=" w-8 h-8 rounded-full
                             @if (strtotime('now') >= strtotime($cronograma['actividad1Fin'])) bg-blue-500 @else border-2 border-blue-500 @endif">
                        </div>
                        <div class="block mt-4 ">
                            <h4 class="text-md font-semibold">Publicidad e inscripciones</h4>
                            <p class="text-xs font-semibold">{{ __("Inicio") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad1Inicio"] }}</p>
                            <p class="text-xs font-semibold">{{ __("Fin") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad1Fin"] }}</p>
                        </div>
                    </div>

                    <div class="  w-auto h-auto-100 mx-2">
                        <div class=" w-8 h-8 rounded-full
                             @if (strtotime('now') >= strtotime($cronograma['actividad2Fin'])) bg-blue-500 @else border-2 border-blue-500 @endif">
                        </div>
                        <div class="block mt-4">
                            <h4 class="text-md font-semibold">Calificación de expedientes</h4>
                            <p class="text-xs font-semibold">{{ __("Inicio") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad2Inicio"] }}</p>
                            <p class="text-xs font-semibold">{{ __("Fin") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad2Fin"] }}</p>
                        </div>
                    </div>


                    <div class="  w-auto h-auto-100 mx-2">
                        <div class=" w-8 h-8 rounded-full
                             @if (strtotime('now') >= strtotime($cronograma['actividad3Fin'])) bg-blue-500 @else border-2 border-blue-500 @endif">
                        </div>
                        <div class="block mt-4">
                            <h4 class="text-md font-semibold">Entrevista personal presencial</h4>
                            <p class="text-xs font-semibold">{{ __("Inicio") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad3Inicio"] }}</p>
                            <p class="text-xs font-semibold">{{ __("Fin") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad3Fin"] }}</p>
                        </div>
                    </div>


                    <div class="  w-auto h-auto-100 mx-2">
                        <div class=" w-8 h-8 rounded-full
                             @if (strtotime('now') >= strtotime($cronograma['actividad4Fin'])) bg-blue-500 @else border-2 border-blue-500 @endif">
                        </div>
                        <div class="block mt-4">
                            <h4 class="text-md font-semibold">Publicación de resultados</h4>
                            <p class="text-xs font-semibold">{{ __("Inicio") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad4Inicio"] }}</p>
                            <p class="text-xs font-semibold">{{ __("Fin") }}:</p>
                            <p class="text-sm"> {{ $cronograma["actividad4Fin"] }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- Cierre del div de "Cronograma de Actividades" -->
    </div>
</div>

</x-app-layout>
<!--Funcion para determinar la fecha actual-->
@section('js')
<script>
    date = new Date();
    year = date.getFullYear();
    month = date.getMonth() + 1;
    day = date.getDate();
    document.getElementById("current_date").innerHTML = month + "/" + day + "/" + year;
</script>

@endsection
