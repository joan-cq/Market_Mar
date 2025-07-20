<?php
session_start();
require_once 'php/conexion.php';

// Definir el nombre de la categoría para esta página
$categoria_nombre = "Golosinas";

// Preparar la consulta para obtener los productos
$sql = "SELECT p.id, p.nombre, p.precio, p.imagen
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE c.nombre = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $categoria_nombre);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Golosinas</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <?php include 'php/navbar.php'; ?>

  <!-- Banner -->
  <section class="imagen_banner d-flex align-items-center justify-content-center">
    <h1 class="bienvenido-text">Golosinas</h1>
  </section>

  <!-- Productos -->
  <main class="py-5 fondo-principal">
    <div class="container">
      <section class="categorias">
        <h2>Categoría Golosinas</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
              <div class="col">
                <div class="card h-100 shadow-sm">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                    <p class="card-text">S/ <?php echo number_format($producto['precio'], 2); ?> por unidad</p>
                    <button
                      class="btn btn-primary w-100"
                      onclick="agregarAlCarrito(<?php echo $producto['id']; ?>, '<?php echo htmlspecialchars($producto['nombre'], ENT_QUOTES); ?>', <?php echo $producto['precio']; ?>)"
                    >
                      Agregar al carrito
                    </button>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col">
              <p>No hay productos disponibles en esta categoría.</p>
            </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="javascript/carrito.js"></script>
</body>
</html>
