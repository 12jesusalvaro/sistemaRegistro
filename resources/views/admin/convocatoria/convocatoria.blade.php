<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Tipos de Estudio, Programas y Menciones</title>
    <!-- Agrega aquí tus enlaces a las hojas de estilo y otros recursos si es necesario -->
</head>
<body class="bg-gray-100 dark:bg-gray-800">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-4">Seleccionar Tipos de Estudio, Programas y Menciones</h1>

        <form action="{{ route('admin.convocatoria.guardar') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="col-span-6 sm:col-span-3">
                    <label class="font-bold text-gray-700 dark:text-white">{{ 'Tipos de Estudio' }}</label>
                    <div class="space-y-2">
                        @foreach($tipo_programas as $tipo_estudio)
                            <div class="flex items-center">
                                <input type="checkbox" name="tipo_estudio_ids[]" value="{{ $tipo_estudio->id }}" class="mr-2 tipo-estudio-checkbox">
                                <span>{{ $tipo_estudio->nombre }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <div id="tablas-programas-menciones">
                        <!-- Aquí se mostrarán las tablas dinámicamente -->
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar Selección</button>
        </form>
    </div>

    <script>
    // Tu script JavaScript aquí

    const checkboxes = document.querySelectorAll('.tipo-estudio-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const tipoEstudioId = this.value;
            const tablasContainer = document.getElementById('tablas-programas-menciones');

            if (this.checked) {
                // Crea una nueva tabla para los programas y menciones
                const tabla = document.createElement('table');
                tabla.classList.add('min-w-full', 'table-auto');
                tabla.innerHTML = `
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Programa</th>
                            <th class="px-4 py-2">Seleccionar</th>
                        </tr>
                    </thead>
                    <tbody id="programas-container-${tipoEstudioId}">
                        <!-- Los programas se mostrarán aquí dinámicamente -->
                    </tbody>
                `;

                // Realiza la solicitud para obtener los programas correspondientes al tipo de estudio seleccionado
                const urlProgramas = '/obtener-programas/' + tipoEstudioId;
                fetch(urlProgramas)
                    .then(response => response.json())
                    .then(data => {
                        // Agrega las filas de programas a la tabla
                        const programasContainer = document.getElementById(`programas-container-${tipoEstudioId}`);
                        data.forEach(programa => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td class="px-4 py-2">${programa.nombre}</td>
                                <td class="px-4 py-2"><input type="checkbox" name="programa_ids[]" value="${programa.id}" class="programa-checkbox"></td>
                            `;
                            programasContainer.appendChild(row);

                            // Agrega un evento para cargar las menciones cuando se marca el programa
                            const programaCheckbox = row.querySelector('.programa-checkbox');
                            programaCheckbox.addEventListener('change', function() {
                                if (this.checked) {
                                    cargarMenciones(this.value, tipoEstudioId);
                                }
                            });
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

                // Agrega la tabla al contenedor
                tablasContainer.appendChild(tabla);
            } else {
                // Si se desmarca, elimina la tabla correspondiente
                const tablaEliminar = document.getElementById(`programas-container-${tipoEstudioId}`);
                if (tablaEliminar) {
                    tablaEliminar.parentElement.remove();
                }
            }
        });
    });

    function cargarMenciones(programaId, tipoEstudioId) {
        // Crea una nueva tabla para las menciones
        const tablaMenciones = document.createElement('table');
        tablaMenciones.classList.add('min-w-full', 'table-auto', 'mt-4');
        tablaMenciones.innerHTML = `
            <thead>
                <tr>
                    <th class="px-4 py-2">Mención</th>
                    <th class="px-4 py-2">Seleccionar</th>
                </tr>
            </thead>
            <tbody id="menciones-container-${programaId}-${tipoEstudioId}">
                <!-- Las menciones se mostrarán aquí dinámicamente -->
            </tbody>
        `;

        // Realiza la solicitud para obtener las menciones correspondientes al programa seleccionado
        const urlMenciones = `/obtener-menciones/${programaId}`;
        fetch(urlMenciones)
            .then(response => response.json())
            .then(data => {
                // Agrega las filas de menciones a la tabla
                const mencionesContainer = document.getElementById(`menciones-container-${programaId}-${tipoEstudioId}`);
                data.forEach(mencion => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-4 py-2">${mencion.nombre}</td>
                        <td class="px-4 py-2"><input type="checkbox" name="mencion_ids[]" value="${mencion.id}" class="mencion-checkbox"></td>
                    `;
                    mencionesContainer.appendChild(row);
                });
            })
            .catch(error => {
                console.error(error);
            });

        // Agrega la tabla de menciones al contenedor
        const programasContainer = document.getElementById(`programas-container-${tipoEstudioId}`);
        programasContainer.appendChild(tablaMenciones);
    }
    </script>
</body>
</html>
