// Scripts de la aplicación (JavaScript sin dependencias adicionales)
document.addEventListener('DOMContentLoaded', function () {

    // 1. Confirmación antes de eliminar un zapato
    document.querySelectorAll('.form-eliminar').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            const nombre = form.dataset.nombre || 'este zapato';
            if (!confirm('¿Seguro que deseas eliminar "' + nombre + '"?\nEsta acción no se puede deshacer.')) {
                event.preventDefault();
            }
        });
    });

    // 2. Validación en el navegador (complementaria a la validación de Laravel)
    document.querySelectorAll('form.needs-validation').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
});
