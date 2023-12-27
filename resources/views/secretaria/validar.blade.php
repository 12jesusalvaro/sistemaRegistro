<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Validar Documentos' }} {{' de: '.$user->nombres.' '.$user->primer_apellido. ' ' .$user->segundo_apellido}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow sm:rounded-lg">
            <h2  class=" p-6 font-bold dtext-black dark:text-white">Desenmarcar los archivos que no sean validos:</h2>

                <div class="shadow p-6 bg-gray-50 dark:bg-zinc-800 border-gray-200">

                    @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        {!! Form::model($user, ['method' => 'PATCH','route' => ['secretaria.update', $user->id]]) !!}
                        <h2  class=" font-bold dtext-black dark:text-white">Archivos Generados</h2>
                        <div class= " shadow grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Solicitud de postulación </label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Ficha de Inscripción</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Carta compromiso </label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Declaración Jurada</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>
                         <br>
                        </div>

                        <br>
                        <h2  class=" font-semibold text-black dark:text-white">Archivos Cargados</h2>

                        <div class="shadow grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Grado Académico</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Ficha de Inscripción</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Currículo vitae</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Proyecto de investigación </label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6 rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Documento de Identidad </label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6 rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class=" text-gray-700 dark:text-white">Foto</label>
                                </div>
                                <div>
                                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white  py-2 px-6 rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>
                            <br>
                            </div>


                            <div class="py-4 col-span-6 flex justify-between">
                                <button type="button" onclick="window.location.href = '{{ route('secretaria.index') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Guardar</button>
                            </div>

                        </div>
                        {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
