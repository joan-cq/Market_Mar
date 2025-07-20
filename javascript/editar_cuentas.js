const modal = new bootstrap.Modal(document.getElementById('modalUsuario'));
const form = document.getElementById('formUsuario');

        function editarUsuario(usuario) {
            document.getElementById('usuario_id').value = usuario.id;
            form.nombre.value = usuario.nombre;
            form.correo.value = usuario.correo;
            form.dni.value = usuario.dni;
            form.celular.value = usuario.celular;
            form.tipo.value = usuario.tipo;
            document.getElementById('clave_input').required = false;
            modal.show();
        }

        function eliminarUsuario(id) {
            if (confirm('¿Está seguro de eliminar este usuario?')) {
                fetch('php/eliminar_usuario.php', {
                    method: 'POST',
                    body: JSON.stringify({ id: id }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el usuario');
                    }
                });
            }
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('php/guardar_usuario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    modal.hide();
                    location.reload();
                } else {
                    alert('Error al guardar el usuario');
                }
            });
        });