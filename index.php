<?php
session_start();
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Inicio</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <!--Navbar-->
    <?php include 'php/navbar.php'; ?>

  <!-- Contenido principal -->
  <section class="imagen_banner d-flex align-items-center justify-content-center">
    <h1 class="bienvenido-text">Bienvenido</h1>
  </section>
  <main class="py-5 fondo-principal">
    <div class="container">
    <section class="search">
      <h2>¡Los mejores Productos al mejor Precio!</h2>
      
      <div class="search-box">
        <input type="text" placeholder="Busque sus productos aquí" />
        <button>Buscar</button>
      </div>
    </section>
    </div>
    <section class="categorias">
      <h2>Categorías</h2>
      <div class="categorias-grid">
        <div>
          <img src="img/categoria_arroz.jpg" alt="Arroz" />
          <br>
          <a href="arroz.php"><strong>Arroz</strong></a>
        </div>
        <div>
          <img src="img/categoria_aceite.jpg" alt="Aceite" />
          <br>
          <a href="aceite.php"><strong>Aceite</strong></a>
        </div>
        <div>
          <img src="img/categoria_azucar.jpg" alt="Azucar" />
          <br>
          <a href="azucar.php"><strong>Azucar</strong></a>
        </div>
        <div>
          <img src="img/categoria_tuberculos.jpg" alt="Tubérculos" />
          <br>
          <a href="tuberculos.php"><strong>Tubérculos</strong></a>
        </div>
        <div>
          <img src="img/categoria_verduras.jpg" alt="Verduras" />
          <br>
          <a href="verduras.php"><strong>Verduras</strong></a>
        </div>
        <div>
          <img src="img/categoria_golosinas.jpg" alt="Golosinas" />
          <br>
          <a href="golosinas.php"><strong>Golosinas</strong></a>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
