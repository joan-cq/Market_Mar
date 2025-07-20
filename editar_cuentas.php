<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

require_once 'php/conexion.php';

// Obtener todas las cuentas
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cuentas - Market Mar</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'php/navbar.php'; ?>

    <div class="container mt-4">
        <h2>Gestión de Cuentas</h2>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalUsuario">
            Agregar Usuario
        </button>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Celular</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['dni']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['celular']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['tipo']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" 
                                    onclick="editarUsuario(<?php echo htmlspecialchars(json_encode($usuario)); ?>)">
                                Editar
                            </button>
                            <button class="btn btn-danger btn-sm" 
                                    onclick="eliminarUsuario(<?php echo $usuario['id']; ?>)">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para agregar/editar usuario -->
        <div class="modal fade" id="modalUsuario" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formUsuario">
                        <div class="modal-body">
                            <input type="hidden" id="usuario_id" name="id">
                            
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correo" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">DNI</label>
                                <input type="text" class="form-control" name="dni" maxlength="8" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Celular</label>
                                <input type="text" class="form-control" name="celular" maxlength="9" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="USUARIO">Usuario</option>
                                    <option value="ADMINISTRADOR">Administrador</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="clave" 
                                       minlength="6" id="clave_input">
                                <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/editar_cuentas.js"></script>
</body>
</html>