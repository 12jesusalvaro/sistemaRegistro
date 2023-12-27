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
