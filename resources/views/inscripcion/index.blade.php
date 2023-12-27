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
        </ul>
    </div>
    <br>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
      <!-- Div izquierdo -->
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-3/4 left-div">
            @if ($currentStep == 1)
                <!-- Sección de datos generales -->
                @include('inscripcion.datos-generales')

            @elseif ($currentStep == 2 && $studyType == 1)
                <!-- Código para la vista de maestría -->
                @include('inscripcion.info-academica1')

            @elseif ($currentStep == 2 && $studyType == 2)
                <!-- Código para la vista de doctorado -->
                @include('inscripcion.info-academica2')

            @elseif ($currentStep == 3)
                <!-- Sección de experiencia profecioonal-->
                @include('inscripcion.experiencia-profecional')

            @elseif ($currentStep == 4)
                <!-- Sección de producción científica -->
                @include('inscripcion.produccion-cientifica')

            @elseif ($currentStep == 5)
                <!-- Sección de Idiomas Extrangeros y Nativos-->
                @include('inscripcion.idiomas')

            @elseif ($currentStep == 6)
                <!-- Sección de Subir Archivos-->
                @include('inscripcion.archivos')
            @endif
      </div>

        <!-- Div derecho -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-1/4 right-div">
                    <ul id="navigation-bar">
                        <li class="text-black dark:text-white">I. DATOS GENERALES</li>
                        <li class="text-black dark:text-white">II. INFORMACIÓN ACADEMICA</li>
                        <li class="text-black dark:text-white">III. EXPERIENCIA PROFESIONAL</li>
                        <li class="text-black dark:text-white">IV. REDACCIÓN CIENTÍFICA</li>
                        <li class="text-black dark:text-white">V. IDIOMAS EXTRANJEROS Y NATIVOS</li>
                        <li class="text-black dark:text-white">VI. SUBIR ARCHIVOS</li>
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

    </script>

@endsection

</x-app-layout>
