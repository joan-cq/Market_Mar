<?php
session_start();
require_once 'php/conexion.php';

// 1. Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: cuenta.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$mensaje = '';

// 2. Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $celular = $_POST['celular'];
    $clave_nueva = $_POST['clave_nueva'];
    $clave_confirmar = $_POST['clave_confirmar'];

    // Actualizar nombre y celular
    $sql_update = "UPDATE usuarios SET nombre = ?, celular = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssi", $nombre, $celular, $usuario_id);
    $stmt_update->execute();

    // Actualizar contraseña si se proporcionó y coincide
    if (!empty($clave_nueva) && $clave_nueva === $clave_confirmar) {
        $clave_hash = password_hash($clave_nueva, PASSWORD_DEFAULT);
        $sql_pass = "UPDATE usuarios SET clave = ? WHERE id = ?";
        $stmt_pass = $conn->prepare($sql_pass);
        $stmt_pass->bind_param("si", $clave_hash, $usuario_id);
        $stmt_pass->execute();
        $mensaje = 'Datos y contraseña actualizados correctamente.';
    } elseif (!empty($clave_nueva) && $clave_nueva !== $clave_confirmar) {
        $mensaje = 'Las contraseñas no coinciden. No se ha actualizado la contraseña.';
    } else {
        $mensaje = 'Datos actualizados correctamente.';
    }
}

// 3. Obtener los datos actuales del usuario para mostrarlos en el formulario
$sql_select = "SELECT nombre, correo, celular, dni FROM usuarios WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $usuario_id);
$stmt_select->execute();
$resultado = $stmt_select->get_result();
$usuario = $resultado->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Mi Cuenta</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/index.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
  <!--Navbar-->
  <?php include 'php/navbar.php'; ?>

  <!-- Contenido -->
  <main class="py-5 fondo-principal">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="bg-white rounded p-4 shadow-sm">
            <h2 class="mb-4 text-center">Mi Información Personal</h2>
            
            <?php if (!empty($mensaje)): ?>
              <div class="alert alert-success"><?php echo $mensaje; ?></div>
            <?php endif; ?>

            <form action="mi_cuenta.php" method="post">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
              </div>
              <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" name="celular" id="celular" class="form-control" value="<?php echo htmlspecialchars($usuario['celular']); ?>" required maxlength="9">
              </div>
              <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" value="<?php echo htmlspecialchars($usuario['dni']); ?>" disabled>
              </div>
              <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo htmlspecialchars($usuario['correo']); ?>" disabled>
              </div>
              <hr>
              <h4 class="mb-3">Cambiar Contraseña</h4>
              <div class="mb-3">
                <label for="clave_nueva" class="form-label">Nueva Contraseña</label>
                <input type="password" name="clave_nueva" id="clave_nueva" class="form-control" placeholder="Dejar en blanco para no cambiar">
              </div>
              <div class="mb-3">
                <label for="clave_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
                <input type="password" name="clave_confirmar" id="clave_confirmar" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary w-100">Actualizar Información</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>