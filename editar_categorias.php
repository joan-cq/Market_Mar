<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

require_once 'php/conexion.php';

// Obtener categorías
$sql = "SELECT * FROM categorias";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$categorias = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categorías - Market Mar</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'php/navbar.php'; ?>

    <div class="container mt-4">
        <h2>Gestión de Categorías</h2>
        
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalCategoria">
            Agregar Categoría
        </button>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($categoria['id']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($categoria['descripcion']); ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($categoria['imagen']); ?>" 
                                 alt="Categoría" style="max-width: 50px;">
                        </td>
                        <td>
                            <?php
                            $categoria_data = [
                                'id' => $categoria['id'],
                                'nombre' => $categoria['nombre'],
                                'descripcion' => $categoria['descripcion']
                            ];
                            ?>
                            <button class="btn btn-sm btn-warning btn-editar"
                                    data-categoria='<?php echo htmlspecialchars(json_encode($categoria_data), ENT_QUOTES, 'UTF-8'); ?>'>
                                Editar
                            </button>
                            <button class="btn btn-sm btn-danger" 
                                    onclick="eliminarCategoria(<?php echo $categoria['id']; ?>)">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para agregar/editar categoría -->
        <div class="modal fade" id="modalCategoria" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formCategoria" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="categoria_id" name="id">
                            
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" required></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" class="form-control" name="imagen" accept="image/*">
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
    <script src="javascript/editar_categorias.js"></script>
</body>
</html>