<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

require_once 'php/conexion.php';

// Obtener todos los reclamos
$sql = "SELECT * FROM reclamos ORDER BY estado ASC, id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$reclamos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reclamos - Market Mar</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'php/navbar.php'; ?>

    <div class="container mt-4">
        <h2>Lista de Reclamos</h2>
        
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Tipo Reclamo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reclamos as $reclamo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reclamo['id']); ?></td>
                        <td><?php echo htmlspecialchars($reclamo['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($reclamo['dni']); ?></td>
                        <td><?php echo htmlspecialchars($reclamo['tipo_reclamo']); ?></td>
                        <td><?php echo htmlspecialchars($reclamo['descripcion']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $reclamo['estado'] == 'PENDIENTE' ? 'warning' : 'success'; ?>">
                                <?php echo $reclamo['estado']; ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" 
                                    data-bs-target="#detalleModal" 
                                    onclick="verDetalle(<?php echo htmlspecialchars(json_encode($reclamo)); ?>)">
                                Ver Detalle
                            </button>
                            <?php if ($reclamo['estado'] == 'PENDIENTE'): ?>
                            <button class="btn btn-success btn-sm" 
                                    onclick="cambiarEstado(<?php echo $reclamo['id']; ?>)">
                                Marcar Atendido
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal de Detalle -->
        <div class="modal fade" id="detalleModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del Reclamo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nombre:</strong> <span id="modal-nombre"></span></p>
                                <p><strong>DNI:</strong> <span id="modal-dni"></span></p>
                                <p><strong>Teléfono:</strong> <span id="modal-telefono"></span></p>
                                <p><strong>Email:</strong> <span id="modal-mail"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Domicilio:</strong> <span id="modal-domicilio"></span></p>
                                <p><strong>Tipo de Bien:</strong> <span id="modal-bien"></span></p>
                                <p><strong>Monto:</strong> S/. <span id="modal-monto"></span></p>
                                <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <p><strong>Descripción:</strong></p>
                                <p id="modal-descripcion"></p>
                                <p><strong>Pedido:</strong></p>
                                <p id="modal-pedido"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/ver_reclamos.js"></script>
</body>
</html>