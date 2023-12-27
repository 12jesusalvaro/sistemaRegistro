import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
// Función para mostrar u ocultar campos de apellido
const selectApellidos = document.getElementById('cant_apellidos');
const campoApellidoPaterno = document.getElementById('a_paterno');
const campoApellidoMaterno = document.getElementById('a_materno');

function toggleApellidoFields() {
    if (selectApellidos.value === '2') {
        campoApellidoPaterno.style.display = 'block';
        campoApellidoMaterno.style.display = 'block';
    } else {
        campoApellidoPaterno.style.display = 'block';
        campoApellidoMaterno.style.display = 'none';
    }
}

// Llama a la función cuando se carga la página
toggleApellidoFields();

// Agrega un evento change para que la función se ejecute cuando cambia el select
selectApellidos.addEventListener('change', toggleApellidoFields);


//Funcion para mostrar el campo de tipos de discapacidad
    const selectDiscapacidad = document.getElementById('discapacidad');
    const divDiscapacidadSi = document.getElementById('discapacidad_si');

    selectDiscapacidad.addEventListener('change', function() {
        if (selectDiscapacidad.value === 'si') {
        divDiscapacidadSi.style.display = 'block';
        } else {
        divDiscapacidadSi.style.display = 'none';
        }
    });
