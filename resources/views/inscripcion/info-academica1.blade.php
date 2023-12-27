<section>
    <!-- Código para la vista de maestría -->
                   <form action="{{ route('inscripcion.saveInfoAcademica') }}" method="POST" class="inline formulario-guardar">
                      <!-- Campos de información académica -->
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-gray-50 dark:bg-zinc-800 sm:p-6">
                            <h1 class="font-bold text-black dark:text-white">II. INFORMACIÓN ACADEMICA:</h1><br>
                            <div class="grid grid-cols-6 gap-6">
                                <!-- Primer contenedor -->
                                <div class="col-span-6">
                                    <h2  class="text-black dark:text-white">Infomración de la universidad donde realizó sus estudios de Pregrado</h2><br>
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <!-- Contenido del primer contenedor -->
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="universidad_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Universidad </label>
                                                    <input type="text" name="universidad_pre" id="universidad_pre"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="tipo_universidad" class="block text-sm font-medium text-gray-700 dark:text-white">Tipo de Universidad</label>
                                                    <select id="tipo_universidad" name="tipo_universidad" autocomplete="tipo_universidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="particular">Particular</option>
                                                        <option value="nacional">Nacional</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="anio_ingreso_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Año de ingrso</label>
                                                    <input type="text" name="anio_ingreso_pre" id="anio_ingreso_pre"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="anio_egreso_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Año de egreso</label>
                                                    <input type="text" name="anio_egreso_pre" id="anio_egreso_pre"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="pais_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Pais</label>
                                                    <select id="pais_pre" name="pais_pre" autocomplete="pais_pre" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Pais01</option>
                                                        <option value="02">Pais02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="departamento_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Departamento</label>
                                                    <select id="departamento_pre" name="departamento_pre" autocomplete="departamento_pre" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Departamento01</option>
                                                        <option value="02">Departamento02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="provincia_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Provincia</label>
                                                    <select id="provincia_pre" name="provincia_pre" autocomplete="provincia_dom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Provincia01</option>
                                                        <option value="02">Provincia02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="distrito_pre" class="block text-sm font-medium text-gray-700 dark:text-white">Distrito</label>
                                                    <select id="distrito_pre" name="distrito_pre" autocomplete="distrito_pre" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Distrito01</option>
                                                        <option value="02">Distrito02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="grado" class="block text-sm font-medium text-gray-700 dark:text-white">Grado obtenido:</label>
                                                    <input type="text" name="grado" id="grado"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="est_concluidos" class="block text-sm font-medium text-gray-700 dark:text-white">Estudios concluidos en:</label>
                                                    <input type="text" name="est_concluidos" id="est_concluidos"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Segundo contenedor -->
                                <div class="col-span-6">
                                    <h2  class="text-black dark:text-white">Información de otra Universidad/Instituto</h2><br>
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white dark:bg-zinc-800 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <!-- Contenido del segundo contenedor -->
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="otra_universidad" class="block text-sm font-medium text-gray-700 dark:text-white">Universidad dónde realizó sus estudios de Pregrado</label>
                                                    <input type="text" name="otra_universidad" id="otra_universidad"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="tipo_universidad_otra" class="block text-sm font-medium text-gray-700 dark:text-white">Tipo de Universidad</label>
                                                    <select id="tipo_universidad_otra" name="tipo_universidad_otra" autocomplete="tipo_universidad_otra" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="particular">Particular</option>
                                                        <option value="nacional">Nacional</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="anio_ingreso_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Año de ingrsó a la universidad</label>
                                                    <input type="text" name="anio_ingreso_otro" id="anio_ingreso_otro"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="anio_egreso_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Año de egreso de la universidad</label>
                                                    <input type="text" name="anio_egreso_otro" id="anio_egreso_otro"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="pais_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Pais dónde culminó sus estudios</label>
                                                    <select id="pais_otro" name="pais_otro" autocomplete="pais_otro" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Pais01</option>
                                                        <option value="02">Pais02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="departamento_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Departamento</label>
                                                    <select id="departamento_otro" name="departamento_otro" autocomplete="departamento_otro" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Departamento01</option>
                                                        <option value="02">Departamento02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="provincia_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Provincia</label>
                                                    <select id="provincia_otro" name="provincia_otro" autocomplete="provincia_dom" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Provincia01</option>
                                                        <option value="02">Provincia02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                                    <label for="distrito_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Distrito</label>
                                                    <select id="distrito_otro" name="distrito_otro" autocomplete="distrito_otro" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">>
                                                        <option value=""></option>
                                                        <option value="01">Distrito01</option>
                                                        <option value="02">Distrito02</option>
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="grado_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Grado obtenido:</label>
                                                    <input type="text" name="grado_otro" id="grado_otro"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>

                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="est_concluidos_otro" class="block text-sm font-medium text-gray-700 dark:text-white">Estudios concluidos en:</label>
                                                    <input type="text" name="est_concluidos_otro" id="est_concluidos_otro"                 class="mt-1 bg-white dark:bg-zinc-800 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300  text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:focus:ring-blue-900">
                                Siguiente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
    </section>
