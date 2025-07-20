<?php
session_start();
require_once 'php/conexion.php';

// Redirigir si no es un usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: cuenta.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$total_carrito = 0;

// Consulta para obtener los productos del carrito del usuario
$sql = "SELECT c.producto_id, p.nombre, p.precio, c.cantidad, (p.precio * c.cantidad) AS subtotal
        FROM carrito c
        JOIN productos p ON c.producto_id = p.id
        WHERE c.usuario_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$carrito_productos = $result->fetch_all(MYSQLI_ASSOC);

$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Carrito de Compras</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <!--Navbar-->
    <?php include 'php/navbar.php'; ?>
    
  <main class="py-5 fondo-principal">
    <div class="container">
      <h2 class="text-center mb-4">Carrito de Compras</h2>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>Producto</th>
              <th>Precio Unitario</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody id="cart-body">
            <?php if (!empty($carrito_productos)): ?>
              <?php foreach ($carrito_productos as $item): ?>
                <tr data-id="<?php echo $item['producto_id']; ?>">
                  <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                  <td class="price">S/ <?php echo number_format($item['precio'], 2); ?></td>
                  <td>
                    <div class="input-group" style="width: 120px;">
                      <button class="btn btn-outline-secondary btn-sm btn-decrement" data-id="<?php echo $item['producto_id']; ?>">-</button>
                      <input type="text" class="form-control form-control-sm text-center quantity-input" value="<?php echo $item['cantidad']; ?>" readonly data-id="<?php echo $item['producto_id']; ?>">
                      <button class="btn btn-outline-secondary btn-sm btn-increment" data-id="<?php echo $item['producto_id']; ?>">+</button>
                    </div>
                  </td>
                  <td class="subtotal">S/ <?php echo number_format($item['subtotal'], 2); ?></td>
                  <td>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo $item['producto_id']; ?>">
                      <i class="bi bi-trash"></i> Eliminar
                    </button>
                  </td>
                </tr>
                <?php $total_carrito += $item['subtotal']; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">Tu carrito está vacío.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="text-end">
        <h4 id="cart-total">Total: S/ <?php echo number_format($total_carrito, 2); ?></h4>
        <a href="cuenta.php" class="btn btn-success mt-3">Finalizar Pedido</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="javascript/carrito.js"></script>
</body>
</html>