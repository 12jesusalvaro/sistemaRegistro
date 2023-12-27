<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{'Calificando a:  '. $nombres->nombres.' '.$nombres->primer_apellido.' '.$nombres->segundo_apellido}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full sm:w-2/3 md:w-2/3 lg:w-2/3 xl:w-2/3 mx-auto">
            <div class="bg-gray-50 dark:bg-zinc-800 overflow-hidden shadow-md sm:rounded-lg">
                <h1 class="font-bold text-center text-black dark:text-white">I. EVALUACIÓN DEL EXPEDIENTE</h1>
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

                <!--Calificacion para los de doctorado-->
                   @if ($studyType==1)
                        {!! Form::model($postulante, ['method' => 'POST','route' => ['evaluador.calificarExped', $postulante->id]]) !!}
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class="block font-medium text-gray-700 dark:text-gray-300 ">Currículo vitae</label>
                                </div>
                                <div>
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_cv" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Currículo vitae documentado</label>
                                {!! Form::number('nota_cv', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class="block font-medium text-gray-700 dark:text-gray-300 ">Proyecto de investigación</label>
                                </div>
                                <div>
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6 rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_proyecto" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Proyecto de investigación</label>
                                {!! Form::number('nota_proyecto', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>

                            <!--<div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_final" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Parcial</label>
                                {!! Form::number('nota_final', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>-->

                            <div class="py-4 col-span-6 flex justify-between">
                                <button type="button" onclick="window.location.href = '{{ route('evaluador.index') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Guardar</button>
                            </div>

                        </div>
                        {!! Form::close() !!}


                <!--Calificacion para los de doctorado-->
                   @elseif ($studyType==2)
                   {!! Form::model($postulante, ['method' => 'POST','route' => ['evaluador.calificarExped', $postulante->id]]) !!}
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Currículo vitae</label>
                                </div>
                                <div>
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6  rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_cv" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Currículo vitae documentado</label>
                                {!! Form::number('nota_cv', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>

                            <div class="col-span-6 sm:col-span-3 flex justify-between items-center">
                                <div>
                                    <label for="nota_proyecto" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Proyecto de investigación</label>
                                </div>
                                <div>
                                    <a href="" class="bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-6 rounded">{{ __('Ver') }}</a>
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_proyecto" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Proyecto de investigación</label>
                                {!! Form::number('nota_proyecto', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div><div class="col-span-6 sm:col-span-3">
                                <label for="docencia" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Experiencia Docencia</label>
                                {!! Form::number('docencia', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>



                            <!--<div class="col-span-6 sm:col-span-3 ">
                                <label for="nota_final" class="block font-medium text-sm text-gray-700 dark:text-gray-300 ">Nota Parcial</label>
                                {!! Form::number('nota_final', null, [
                                    'class' => 'block w-full border-gray-300 dark:border-zinc-500 dark:bg-zinc-800 text-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-xl dark:shadow-zinc-900 text-sm',
                                    'step' => '0.1',
                                ]) !!}
                            </div>-->

                            <div class="py-4 col-span-6 flex justify-between">
                                <button type="button" onclick="window.location.href = '{{ route('evaluador.index') }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-5 rounded">{{ __('Cancelar') }}</button>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">Guardar</button>
                            </div>

                        </div>
                        {!! Form::close() !!}

                    @endif

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
