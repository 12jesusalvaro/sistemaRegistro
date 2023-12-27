<section>
    <!-- Sección de datos generales -->
                 <form action="{{ route('inscripcion.saveDatosGenerales') }}" method="POST" class="inline formulario-guardar">
                           <!-- Campos de datos generales -->
                           @csrf
                           <div class="shadow overflow-hidden sm:rounded-md">
                               <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                                   <h1 class="font-bold text-black dark:text-white">I. DATOS GENERALES: </h1>
                                   <br>
                                   <div class="grid grid-cols-6 gap-6">
                                       <!-- Primer contenedor -->
                                       <div class="col-span-6">
                                       <h2 class="text-black dark:text-white">Datos personales</h2><br>
                                           <div class="shadow overflow-hidden sm:rounded-md">
                                               <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                                   <div class="grid grid-cols-6 gap-6">
                                                       <!-- Contenido del primer contenedor -->
                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="tipo_documento"class="block text-sm font-medium text-gray-700 dark:text-white">Tipo de Documento (*)</label>
                                                           <select id="tipo_documento" name="tipo_documento" autocomplete="tipo_documento"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">                                                        <option value="Documento Nacional de Identidad">Documento Nacional de Identidad</option>
                                                                   <option value="Pasaporte">Pasaporte</option>
                                                                   <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                                                   <option value="Cédula de identidad">Cédula de identidad</option>
                                                                   <option value="Documento Extranjero - Otros">Documento Extranjero - Otros</option>
                                                                   <option value="Permiso Temporal de Permanencia">Permiso Temporal de Permanencia</option>
                                                                   <option value="Carné de Identidad">Carné de Identidad</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="numero_documento" class="block text-sm font-medium text-gray-700 dark:text-white">Número de Documento (*)</label>
                                                           <input type="text" name="numero_documento" id="numero_documento" autocomplete="numero_documento"
                                                           class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           required value="{{ $datos['numero_documento']}}">
                                                           <span class="block text-xs font-medium text-green-600">Nota: Si el tipo de documento es Documento Nacional de Identidad (DNI), el número de dígitos es 8.</span>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="catidad_apellidos" class="block text-sm font-medium text-gray-700 dark:text-white">¿Cuántos apellidos tiene? (*)</label>
                                                           <select id="catidad_apellidos" name="catidad_apellidos" autocomplete="catidad_apellidos" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value="2">Dos</option>
                                                               <option value="1">Uno</option>
                                                           </select>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="nombres" class="block text-sm font-medium text-gray-700 dark:text-white">Nombres (*)</label>
                                                           <input type="text" name="nombres" id="nombres" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           required value="{{ $datos['nombres']}}" >
                                                           <span class="block text-xs font-medium text-green-600">Completar sólo los "nombres" debe ir idéntico al documento de identidad.</span>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2" id="a_paterno">
                                                           <label for="primer_apellido" class="block text-sm font-medium text-gray-700 dark:text-white">Primer Apellido(*)</label>
                                                           <input type="text" name="primer_apellido" id="primer_apellido" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           required value="{{ $datos['primer_apellido']}}">
                                                           <span class="block text-xs font-medium text-green-600">Debe ir idéntico al documento de identidad.</span>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2" id="a_materno">
                                                           <label for="segundo_apellido" class="block text-sm font-medium text-gray-700 dark:text-white">Segundo Apellido (*)</label>
                                                           <input type="text" name="segundo_apellido" id="segundo_apellido" autocomplete="postal-code" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           value="{{ $datos['segundo_apellido']}}">
                                                           <span class="block text-xs font-medium text-green-600">Debe ir idéntico al documento de identidad.</span>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                                           <label for="apellido_casada" class="block text-sm font-medium text-gray-700 dark:text-white">Apellido casada</label>
                                                           <input type="text" name="apellido_casada" id="apellido_casada" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                           <span class="block text-xs font-medium text-green-600">Opcional (Idéntico al documento de identidad). Sólo para el sexo femenino</span>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="sexo" class="block text-sm font-medium text-gray-700 dark:text-white">Sexo (*)</label>
                                                           <select id="sexo" name="sexo" autocomplete="sexo"
                                                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="MASCULINO">Masculino</option>
                                                               <option value="FEMENINO">Femenino</option>
                                                           </select>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="estado_civil" class="block text-sm font-medium text-gray-700 dark:text-white">Estado Civil</label>
                                                           <select id="estado_civil" name="estado_civil" autocomplete="estado_civil" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="SOLTERO">Soltero</option>
                                                               <option value="CASADO">Casado</option>
                                                               <option value="CONVIVIENTE">Conviviente</option>
                                                               <option value="VIUDO">Viudo</option>
                                                               <option value="DIVORSIADO">Divorsiado</option>
                                                               <option value="OTRO">OTRO</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                                           <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 dark:text-white">Fecha de Nacimiento (*)</label>
                                                           <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                           <span class="block text-xs font-medium text-green-600">Ingresar el día/mes/año.</span>
                                                       </div>
                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="edad" class="block text-sm font-medium text-gray-700 dark:text-white">Edad (*)</label>
                                                           <input type="text" name="edad" id="edad" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="discapacidad" class="block text-sm font-medium text-gray-700 dark:text-white">¿Tiene alguna discapacidad? (*)</label>
                                                           <select id="discapacidad" name="discapacidad" autocomplete="discapacidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="si">Si</option>
                                                               <option value="no">No</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2" id="discapacidad_si" style="display: none;">
                                                           <label for="tipo_discapacidad" class="block text-sm font-medium text-gray-700 dark:text-white">Tipo de discapacidad (*)</label>
                                                           <select id="tipo_discapacidad" name="tipo_discapacidad" autocomplete="tipo_discapacidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value="">Seleccionar...</option>
                                                               <option value="motora">Discapacidad motora</option>
                                                               <option value="visual">Discapacidad visual</option>
                                                               <option value="auditiva">Discapacidad auditiva</option>
                                                               <option value="cognitiva">Discapacidad cognitiva</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="correo_electronico" class="block text-sm font-medium text-gray-700 dark:text-white"> Correo Electrónico (*)</label>
                                                           <input type="text" name="correo_electronico" id="correo_electronico" autocomplete="correo_electronico"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           value="{{ $datos['email']}}">
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3">
                                                           <label for="numero_celular" class="block text-sm font-medium text-gray-700 dark:text-white">Número de Celular(*)</label>
                                                           <input type="tel" name="numero_celular" id="numero_celular" autocomplete="numero_celular"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                       </div>

                                                   </div>
                                               </div>
                                           </div>
                                       </div>

                                       <!-- Segundo contenedor -->
                                       <div class="col-span-6">
                                       <h2 class="text-black dark:text-white">Datos de nacimiento</h2><br>
                                           <div class="shadow overflow-hidden sm:rounded-md">
                                               <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                                   <div class="grid grid-cols-6 gap-6">
                                                       <!-- Contenido del segundo contenedor -->
                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="pais_nacimiento" class="block text-sm font-medium text-gray-700 dark:text-white">Pais de nacimiento (*)</label>
                                                           <select id="pais_nacimiento" name="pais_nacimiento" autocomplete="pais_nacimiento" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Pais1</option>
                                                               <option value="02">Pais2</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="nacionalidad" class="block text-sm font-medium text-gray-700 dark:text-white">Nacionalidad (*)</label>
                                                           <select id="nacionalidad" name="nacionalidad" autocomplete="nacionalidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Nacionalidad01</option>
                                                               <option value="02">Nacionalidad02</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="ubigeo_nac" class="block text-sm font-medium text-gray-700 dark:text-white">Ubigeo de Nacimiento (*)</label>
                                                           <input type="text" name="ubigeo_nac" id="ubigeo_nac"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md "
                                                           >
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="departamento_nac" class="block text-sm font-medium text-gray-700 dark:text-white">Departamento de Nacimiento (*)</label>
                                                           <select id="departamento_nac" name="departamento_nac" autocomplete="departamento_nac" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Departamento01</option>
                                                               <option value="02">Departamento02</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="provincia_nac" class="block text-sm font-medium text-gray-700 dark:text-white">Provincia de Nacimiento (*)</label>
                                                           <select id="provincia_nac" name="provincia_nac" autocomplete="provincia_nac" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Provincia01</option>
                                                               <option value="02">Provincia02</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="distrito_nac" class="block text-sm font-medium text-gray-700 dark:text-white">Distrito de Nacimiento (*)</label>
                                                           <select id="distrito_nac" name="distrito_nac" autocomplete="distrito_nac" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Distrito01</option>
                                                               <option value="02">Distrito02</option>
                                                           </select>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>

                                       <!-- Tercer contenedor -->
                                       <div class="col-span-6">
                                       <h2 class="text-black dark:text-white">Datos de domicilio</h2><br>
                                           <div class="shadow overflow-hidden sm:rounded-md">
                                               <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                                   <div class="grid grid-cols-6 gap-6">
                                                       <!-- Contenido del tercer contenedor -->
                                                       <div class="col-span-6 sm:col-span-4">
                                                           <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-white"> Direccion domiciliaria (*)</label>
                                                           <input type="text" name="direccion" id="direccion" autocomplete="direccion" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="ubigeo_dom" class="block text-sm font-medium text-gray-700 dark:text-white">Ubigeo de domicilio</label>
                                                           <input type="text" name="ubigeo_dom" id="ubigeo_dom" class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="departamento_dom" class="block text-sm font-medium text-gray-700 dark:text-white">Departamento de Domicilio (*)</label>
                                                           <select id="departamento_dom" name="departamento_dom" autocomplete="departamento_dom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Departamento01</option>
                                                               <option value="02">Departamento02</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="provincia_dom" class="block text-sm font-medium text-gray-700 dark:text-white">Provincia de Domicilio (*)</label>
                                                           <select id="provincia_dom" name="provincia_dom" autocomplete="provincia_dom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Provincia01</option>
                                                               <option value="02">Provincia02</option>
                                                           </select>
                                                       </div>

                                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                           <label for="distrito_dom" class="block text-sm font-medium text-gray-700 dark:text-white">Distrito de Domicilio (*)</label>
                                                           <select id="distrito_dom" name="distrito_dom" autocomplete="distrito_dom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                               <option value=""></option>
                                                               <option value="01">Distrito01</option>
                                                               <option value="02">Distrito02</option>
                                                           </select>
                                                       </div>

                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                       <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                       Siguiente</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <br>
                       </form>
   </section>
