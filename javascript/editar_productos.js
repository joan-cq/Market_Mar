document.addEventListener('DOMContentLoaded', function () {
    const modalProducto = new bootstrap.Modal(document.getElementById('modalProducto'));
    const formProducto = document.getElementById('formProducto');
    const modalTitle = document.querySelector('#modalProducto .modal-title');

    // Configurar para "Agregar Producto"
    document.querySelector('[data-bs-target="#modalProducto"]').addEventListener('click', function() {
        modalTitle.textContent = 'Agregar Producto';
        formProducto.reset();
        document.getElementById('producto_id').value = '';
    });

    // Configurar para "Editar Producto"
    document.querySelectorAll('.btn-editar').forEach(button => {
        button.addEventListener('click', function() {
            const productoData = this.getAttribute('data-producto');
            const producto = JSON.parse(productoData);

            modalTitle.textContent = 'Editar Producto';
            formProducto.reset();
            
            document.getElementById('producto_id').value = producto.id;
            formProducto.nombre.value = producto.nombre;
            formProducto.precio.value = producto.precio;
            formProducto.stock.value = producto.stock;
            formProducto.categoria_id.value = producto.categoria_id;
            
            modalProducto.show();
        });
    });

    // Función global para eliminar
    window.eliminarProducto = function(id) {
        if (confirm('¿Está seguro de eliminar este producto?')) {
            fetch('php/eliminar_producto.php', {
                method: 'POST',
                body: JSON.stringify({ id: id }),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al eliminar el producto: ' + data.error);
                }
            });
        }
    }

    // Manejo del envío del formulario
    formProducto.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('php/guardar_producto.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                modalProducto.hide();
                location.reload();
            } else {
                alert('Error al guardar el producto: ' + data.error);
            }
        });
    });
});