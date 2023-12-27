<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Crear usuario' }}
        </h2>
    </x-slot>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!--  Datatables  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

        <!--  extension responsive  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    </head>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow sm:rounded-lg">
                <div class="shadow p-6 bg-gray-50 dark:bg-zinc-800 border-gray-200">
                    @if ($errors->any())
                            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:text-red-500" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                {!! Form::open(array('route' => 'admin.users.store','method'=>'POST')) !!}
                <div class="grid grid-cols-6 gap-6">

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="tipo_docuemnto_id" class=" text-gray-700 dark:text-white">{{'Tipo de Documento'}}</label>
                        {!! Form::select('tipo_documento_id', $tipo_documentos->pluck('nombre', 'id'), null, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}

                        {{--  {!! Form::text('tipo_docuemnto_id', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    --}}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="numero_documento" class=" text-gray-700 dark:text-white">{{'Numero de Documento'}}</label>
                        {!! Form::text('numero_documento', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="cant_apellidos" class=" text-gray-700 dark:text-white">{{'Cantidad de Apellidos'}}</label>
                        {!! Form::select('cant_apellidos', [1 => '1', 2 => '2'], null, ['id' => 'cant_apellidos', 'class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}

                    </div>


                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="nombres" class=" text-gray-700 dark:text-white">{{'Nombre'}}</label>
                        {!! Form::text('nombres', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800  dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2"  id="a_paterno">
                        <label for="primer_apellido" class=" text-gray-700 dark:text-white">{{'Primer apellido'}}</label>
                        {!! Form::text('primer_apellido', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2" id="a_materno">
                        <label for="segundo_apellido" class=" text-gray-700 dark:text-white">{{'Segundo apellido'}}</label>
                        {!! Form::text('segundo_apellido', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="celular" class=" text-gray-700 dark:text-white">{{'Numero de celular'}}</label>
                        {!! Form::text('celular', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>


                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="email" class=" text-gray-700 dark:text-white">{{'Email'}}</label>
                        {!! Form::text('email', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="password" class=" text-gray-700 dark:text-white">{{'Password'}}</label>
                        {!! Form::text('password', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="confirm-password" class=" text-gray-700 dark:text-white">{{'Confirmar Password'}}</label>
                        {!! Form::text('confirm-password', null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>


                    <div class="col-span-6 sm:col-span-3">
                        <label for="" class=" text-gray-700 dark:text-white">Roles</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="menciones" class=" text-gray-700 dark:text-white">Menciones</label>
                        {!! Form::select('menciones', $menciones->pluck('nombre', 'id'), null, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                    </div>

                    <div class="py-4 col-span-6 flex justify-between">
                        <button type="button" onclick="window.location.href = '{{ route('admin.users.index') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</button>

                        <!--<button id="myButton" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Guardar</button>-->

                        <!-- Botón en tu formulario -->
                        <button id="saveButton" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded" onclick="submitForm()">Guardar</button>

                    </div>

                </div>

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@section('js')
    <script src="{{ asset('js\doubleClick.js') }}"></script>
    <!--
    <script>
    function submitForm() {
        var myButton = document.getElementById('saveButton');
        var myForm = myButton.closest('form');
        // Deshabilitar el botón para evitar clics adicionales
        myButton.disabled = true;
        myForm.submit();
        // Puedes cambiar el contenido o mostrar un mensaje para indicar que la acción está en progreso
        // myButton.innerHTML = 'Guardando...';

        // Aquí puedes agregar lógica para enviar el formulario o realizar la acción deseada

        // Ejemplo: Simulación de un retraso de 3 segundos
        setTimeout(function() {
            // Habilitar el botón después de 3 segundos (ajusta según sea necesario)
            myButton.disabled = false;

            // Restaurar el contenido original del botón si lo cambiaste antes
            // myButton.innerHTML = 'Guardar';
        }, 10000);
    }
    </script>
-->
@endsection

</x-app-layout>
