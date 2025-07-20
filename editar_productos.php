<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

require_once 'php/conexion.php';

// Obtener categorías para el select
$sqlCategorias = "SELECT id, nombre FROM categorias";
$stmtCategorias = $conn->prepare($sqlCategorias);
$stmtCategorias->execute();
$result1 = $stmtCategorias->get_result();
$categorias = $result1->fetch_all(MYSQLI_ASSOC);

// Obtener productos
$sqlProductos = "SELECT p.*, c.nombre as categoria_nombre 
                FROM productos p 
                JOIN categorias c ON p.categoria_id = c.id";
$stmtProductos = $conn->prepare($sqlProductos);
$stmtProductos->execute();
$result2 = $stmtProductos->get_result();
$productos = $result2->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos - Market Mar</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <?php include 'php/navbar.php'; ?>

    <div class="container mt-4">
        <h2>Gestión de Productos</h2>
        
        <!-- Botón para agregar nuevo producto -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProducto">
            Agregar Producto
        </button>

        <!-- Tabla de productos -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td>S/. <?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                        <td><?php echo htmlspecialchars($producto['categoria_nombre']); ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" 
                                 alt="Producto" style="max-width: 50px;">
                        </td>
                        <td>
                           <?php
                           $producto_data = [
                               'id' => $producto['id'],
                               'nombre' => $producto['nombre'],
                               'precio' => $producto['precio'],
                               'stock' => $producto['stock'],
                               'categoria_id' => $producto['categoria_id']
                           ];
                           ?>
                           <button class="btn btn-sm btn-warning btn-editar"
                                   data-producto='<?php echo htmlspecialchars(json_encode($producto_data), ENT_QUOTES, 'UTF-8'); ?>'>
                               Editar
                           </button>
                            <button class="btn btn-sm btn-danger" 
                                    onclick="eliminarProducto(<?php echo $producto['id']; ?>)">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para agregar/editar producto -->
        <div class="modal fade" id="modalProducto" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formProducto" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="producto_id" name="id">
                            
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control" name="precio" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <select class="form-control" name="categoria_id" required>
                                    <?php foreach ($categorias as $categoria): ?>
                                        <option value="<?php echo $categoria['id']; ?>">
                                            <?php echo htmlspecialchars($categoria['nombre']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
    <script src="javascript/editar_productos.js"></script>
</body>
</html>