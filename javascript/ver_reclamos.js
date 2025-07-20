function verDetalle(reclamo) {
            document.getElementById('modal-nombre').textContent = reclamo.nombre;
            document.getElementById('modal-dni').textContent = reclamo.dni;
            document.getElementById('modal-telefono').textContent = reclamo.telefono;
            document.getElementById('modal-mail').textContent = reclamo.correo;
            document.getElementById('modal-domicilio').textContent = reclamo.domicilio;
            document.getElementById('modal-bien').textContent = reclamo.tipo_bien;
            document.getElementById('modal-monto').textContent = reclamo.monto;
            document.getElementById('modal-estado').textContent = reclamo.estado;
            document.getElementById('modal-descripcion').textContent = reclamo.descripcion;
            document.getElementById('modal-pedido').textContent = reclamo.pedido;
}

function cambiarEstado(id) {
            if (confirm('¿Está seguro de marcar este reclamo como atendido?')) {
                fetch('php/cambiar_estado_reclamo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        estado: 'ATENDIDO'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado del reclamo');
                    }
                });
            }
}