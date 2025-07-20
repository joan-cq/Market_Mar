document.addEventListener('DOMContentLoaded', function () {
    const modalCategoria = new bootstrap.Modal(document.getElementById('modalCategoria'));
    const formCategoria = document.getElementById('formCategoria');
    const modalTitle = document.querySelector('#modalCategoria .modal-title');

    // Configurar para "Agregar Categoría"
    document.querySelector('[data-bs-target="#modalCategoria"]').addEventListener('click', function() {
        modalTitle.textContent = 'Agregar Categoría';
        formCategoria.reset();
        document.getElementById('categoria_id').value = '';
    });

    // Configurar para "Editar Categoría"
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function() {
            const categoriaData = this.getAttribute('data-categoria');
            const categoria = JSON.parse(categoriaData);

            modalTitle.textContent = 'Editar Categoría';
            formCategoria.reset();
            
            document.getElementById('categoria_id').value = categoria.id;
            formCategoria.nombre.value = categoria.nombre;
            formCategoria.descripcion.value = categoria.descripcion;
            
            modalCategoria.show();
        });
    });

    // Función global para eliminar (si aún se usa onclick)
    window.eliminarCategoria = function(id) {
        if (confirm('¿Está seguro de eliminar esta categoría?')) {
            fetch('php/eliminar_categoria.php', {
                method: 'POST',
                body: JSON.stringify({ id: id }),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al eliminar la categoría: ' + data.error);
                }
            });
        }
    }

    // Manejo del envío del formulario
    formCategoria.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('php/guardar_categoria.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalCategoria.hide();
                location.reload();
            } else {
                alert('Error al guardar la categoría: ' + data.error);
            }
        });
    });
});