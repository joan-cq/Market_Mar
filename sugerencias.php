<?php
session_start();
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Sugerencias</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php include 'php/navbar.php'; ?>

<!-- Banner -->
<section class="imagen_banner d-flex align-items-center justify-content-center">
  <h1 class="sugerencias-text">Sugerencias</h1>
</section>

<main class="container py-5 fondo-principal">
  <div class="row">
    <!-- Información de contacto -->
    <div class="col-md-4 mb-4">
      <div class="p-4 bg-white rounded shadow-sm">
        <h4 class="mb-4 text-primary">Contáctanos</h4>
        <p><img src="icons/direccion.png" alt="Dirección" class="me-2 icono-reclamaciones">Av. Los Héroes 757, Cañete, Lima</p>
        <p><img src="icons/telefono.png" alt="Teléfono" class="me-2 icono-reclamaciones">+51 987 654 321</p>
        <p><img src="icons/correo.png" alt="Correo" class="me-2 icono-reclamaciones">contactos@marketmar.com</p>
      </div>
    </div>

    <!-- Formulario de sugerencias -->
    <div class="col-md-8">
      <div class="p-4 bg-white rounded shadow-sm">
        <h4 class="mb-4 text-success">Envíanos tus sugerencias</h4>
        <form id="form-sugerencias" action="#" method="post" novalidate>
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>

          <div class="mb-3">
            <label for="mail" class="form-label">Email:</label>
            <input type="email" class="form-control" id="mail" name="mail" required>
          </div>

          <div class="mb-3">
            <label for="sugerencia" class="form-label">Sugerencia:</label>
            <textarea class="form-control" id="sugerencia" name="sugerencia" rows="6" required></textarea>
          </div>

          <button type="submit" class="btn btn-warning fw-bold w-100">Enviar sugerencia</button>
        </form>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<?php include 'php/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="javascript/form-sugerencia.js"></script>
</body>
</html>
