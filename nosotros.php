<?php
session_start();
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Nosotros</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/nosotros.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="nosotros-bg">
  <!-- Navbar -->
  <?php include 'php/navbar.php'; ?>

  <div class="container mt-5">
    <h1 class="text-center nosotros-title mb-4">Sobre Nosotros</h1>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="nosotros-card text-center">
          <div class="nosotros-icon"><i class="fas fa-users"></i></div>
          <h3 class="nosotros-title">Nuestro Equipo</h3>
          <p>Contamos con profesionales apasionados por el comercio y la atención al cliente, siempre listos para ayudarte.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="nosotros-card text-center">
          <div class="nosotros-icon"><i class="fas fa-bullseye"></i></div>
          <h3 class="nosotros-title">Nuestra Misión</h3>
          <p>Brindar una experiencia de compra fácil, segura y satisfactoria, ofreciendo productos de calidad y precios competitivos.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="nosotros-card text-center">
          <div class="nosotros-icon"><i class="fas fa-handshake"></i></div>
          <h3 class="nosotros-title">Compromiso</h3>
          <p>Nos esforzamos por mantener la confianza de nuestros clientes, garantizando transparencia y responsabilidad en cada venta.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="nosotros-card text-center">
          <div class="nosotros-icon"><i class="fas fa-leaf"></i></div>
          <h3 class="nosotros-title">Sostenibilidad</h3>
          <p>Nos preocupamos por el medio ambiente y promovemos prácticas responsables en toda nuestra cadena de suministro.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="nosotros-card text-center">
          <div class="nosotros-icon"><i class="fas fa-award"></i></div>
          <h3 class="nosotros-title">Calidad Garantizada</h3>
          <p>Seleccionamos cuidadosamente nuestros productos para asegurar la mejor calidad y frescura para nuestros clientes.</p>
        </div>
      </div>
    </div>

    </div>
    <!-- Video de gente comprando -->
    <div class="row justify-content-center mt-4">
      <div class="col-12 col-md-10">
        <div class="ratio ratio-16x9">
          <video controls poster="img/poster_video.jpeg" style="border-radius: 16px; box-shadow: 0 4px 16px rgba(40,60,90,0.15);">
            <source src="video/marketmarvideo.mp4" type="video/mp4">
            Tu navegador no soporta el video.
          </video>
        </div>
      </div>

    <div class="container mt-5">
        <h1 class="text-center nosotros-gracias mb-4">¡Gracias por confiar en Market Mar!</h1>
    </div>
  </div>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>