<?php
session_start();
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
$isLogged = isset($_SESSION['usuario']); // Cambia 'usuario' por el nombre de tu variable de sesión de usuario
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Cuenta</title>
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
        <?php if (!$isLogged): ?>
          <?php if ($isAdmin): ?>
            <!-- Solo registro para admin -->
            <div class="col-md-6">
              <div class="bg-white rounded p-4 shadow-sm">
                <h2 class="mb-4 text-center">Crear cuenta</h2>
                <form action="php/registro.php" method="post" onsubmit="return validarRegistro(this);">
                  <input type="text" name="nombre" placeholder="Nombre" required class="form-control mb-3">
                  <input type="email" name="correo" placeholder="Correo" required class="form-control mb-3">
                  <input type="text" name="celular" placeholder="Celular" required class="form-control mb-3" maxlength="9">
                  <input type="text" name="dni" placeholder="DNI" required class="form-control mb-3" maxlength="8">
                  <input type="password" name="clave" placeholder="Contraseña" required class="form-control mb-3">
                  <input type="password" name="clave2" placeholder="Confirmar contraseña" required class="form-control mb-3">
                  <select name="tipo" class="form-control mb-3" required>
                    <option value="USUARIO">Usuario</option>
                    <option value="ADMINISTRADOR">Administrador</option>
                  </select>
                  <button type="submit" class="btn btn-success w-100">Registrar</button>
                </form>
              </div>
            </div>
          <?php else: ?>
            <div class="row justify-content-center">
              <!-- Login -->
              <div class="col-md-6">
                <div class="bg-white rounded p-4 shadow-sm">
                  <h2 class="mb-4 text-center">Iniciar sesión</h2>
                  <form action="php/login.php" method="post">
                    <input type="email" name="correo" placeholder="Correo" required class="form-control mb-3">
                    <input type="password" name="clave" placeholder="Contraseña" required class="form-control mb-3">
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                  </form>
                </div>
              </div>
              <!-- Registro -->
              <div class="col-md-6 mt-4 mt-md-0">
                <div class="bg-white rounded p-4 shadow-sm">
                  <h2 class="mb-4 text-center">Crear cuenta</h2>
                  <form action="php/registro.php" method="post" onsubmit="return validarRegistro(this);">
                    <input type="text" name="nombre" placeholder="Nombre" required class="form-control mb-3">
                    <input type="email" name="correo" placeholder="Correo" required class="form-control mb-3">
                    <input type="text" name="celular" placeholder="Celular" required class="form-control mb-3" maxlength="9">
                    <input type="text" name="dni" placeholder="DNI" required class="form-control mb-3" maxlength="8">
                    <input type="password" name="clave" placeholder="Contraseña" required class="form-control mb-3">
                    <input type="password" name="clave2" placeholder="Confirmar contraseña" required class="form-control mb-3">
                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>