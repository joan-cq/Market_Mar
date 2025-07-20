<?php
session_start();
require_once 'php/conexion.php';

$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;

// Obtener categorías de la base de datos
$sql = "SELECT nombre, imagen FROM categorias ORDER BY nombre ASC";
$result = $conn->query($sql);
$categorias = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}
// No cerramos la conexión aquí por si se necesita en el footer.
// $conn->close();
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
        <?php if (!empty($categorias)): ?>
          <?php foreach ($categorias as $categoria): ?>
            <?php
              // Crear el nombre del archivo a partir del nombre de la categoría
              // Por ejemplo: "Tubérculos" se convierte en "tuberculos.php"
              $nombre_archivo = strtolower(htmlspecialchars($categoria['nombre']));
              // Manejar caracteres especiales si es necesario, por ejemplo, tildes.
              $nombre_archivo = str_replace('é', 'e', $nombre_archivo); // para "Tubérculos"
            ?>
            <div>
              <a href="<?php echo $nombre_archivo; ?>.php">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($categoria['imagen']); ?>" alt="<?php echo htmlspecialchars($categoria['nombre']); ?>" />
              </a>
              <br>
              <a href="<?php echo $nombre_archivo; ?>.php"><strong><?php echo htmlspecialchars($categoria['nombre']); ?></strong></a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay categorías para mostrar.</p>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
