<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'Editar Datos' }}
        </h2>
    </x-slot>



            @php
                $user_id = Auth::user()->id;// DNI específico a verificar
                //$exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)->exists();
                $exists = App\Models\Preinscripcion::where('convocatoria_id', $ultimaConvocatoria->id)
                                   ->where('user_id', $user_id)
                                   ->exists();
            @endphp




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow sm:rounded-lg">
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
                        <div class="grid grid-cols-6 gap-6">


                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <x-input-label for="programa_estudio_id" :value="__('Programa de Estudio')" />

                                <x-select name="programa_estudio_id" id="programa_estudio_id"  exists="{{ $exists }}" class="mt-1 block w-full sm:text-sm ">
                                    @if($userPrograma)
                                        <option value="{{ $userPrograma }}" selected>{{$user->preinscripcion->mencion->programa->nombre}}</option>
                                    @endif

                                    @foreach ($programas as $programa)
                                        @if(!$userPrograma || ($userPrograma && $programa->id !== $userPrograma))
                                            <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                        @endif
                                    @endforeach
                                </x-select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <x-input-label for="mencion_id" :value="__('Mención')" />

                                <x-select name="mencion_id" id="mencion_id"  exists="{{ $exists }}" class="mt-1 block w-full sm:text-sm ">
                                    <option value="{{$userMencion}}">{{$user->preinscripcion->mencion->nombre}}</option>

                                </x-select>


                            </div>

                            <!--
                            <div class="col-span-6 sm:col-span-3">
                              <label for="programa" class=" text-gray-700 dark:text-white">Programa</label>
                              {!! Form::select('programa', $programas, $userPrograma, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}

                            </div>


                            <div class="col-span-6 sm:col-span-3">
                              <label for="mencion" class=" text-gray-700 dark:text-white">Mención</label>
                              {!! Form::select('mencion', $menciones, $userMencion, ['class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-gray-50 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) !!}
                            </div>-->


                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="estado" class=" text-gray-700 dark:text-white">Estado</label>
                                {!! Form::number('current_step', $postulante ? $postulante->current_step : null, array('class' => 'shadow block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm')) !!}
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

@section('js')

    <script>


    document.getElementById('programa_estudio_id').addEventListener('change', function() {
        var programaEstudioId = this.value;
        var mencionSelect = document.getElementById('mencion_id');

        // Borra las opciones anteriores
        mencionSelect.innerHTML = '<option value="">Seleccione una mención</option>';

        // Realiza la solicitud para obtener las menciones correspondientes al programa seleccionado
        if (programaEstudioId) {
            var url = '/obtener-menciones/' + programaEstudioId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Agrega las opciones de menciones al campo de selección
                    data.forEach(mencion => {
                        var option = document.createElement('option');
                        option.value = mencion.id;
                        option.textContent = mencion.nombre;
                        mencionSelect.appendChild(option);
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
