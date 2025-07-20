<?php
$productos = [
  ["nombre" => "Papa Canchán (1 kg)", "precio" => 1.80, "imagen" => "img/papa_canchan.jpg"],
  ["nombre" => "Yuca Blanca (1 kg)", "precio" => 2.50, "imagen" => "img/yuca.jpg"],
  ["nombre" => "Camote Morado (1 kg)", "precio" => 2.20, "imagen" => "img/camote.webp"],
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Tubérculos</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <?php include 'php/navbar.php'; ?>

  <!-- Banner -->
  <section class="imagen_banner d-flex align-items-center justify-content-center">
    <h1 class="bienvenido-text">Tubérculos</h1>
  </section>

  <!-- Productos -->
  <main class="py-5 fondo-principal">
    <div class="container">
      <section class="categorias">
        <h2>Categoría Túberculos</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php foreach ($productos as $producto): ?>
            <div class="col">
              <div class="card h-100 shadow-sm">
                <img src="<?= $producto["imagen"] ?>" class="card-img-top" alt="<?= $producto["nombre"] ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= $producto["nombre"] ?></h5>
                  <p class="card-text">S/ <?= number_format($producto["precio"], 2) ?> por Kg</p>
                  <button
                    class="btn btn-primary w-100"
                    onclick="agregarAlCarrito('<?= htmlspecialchars($producto['nombre']) ?>', <?= $producto['precio'] ?>)"
                  >
                    Agregar al carrito
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
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
