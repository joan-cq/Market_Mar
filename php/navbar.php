<?php
$isAdmin = isset($_SESSION['admin']) && $_SESSION['admin'] === true;
$isUser = isset($_SESSION['usuario_id']) && !$isAdmin;
?>

<script>
  const IS_LOGGED_IN = <?php echo json_encode($isUser || $isAdmin); ?>;
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="img/Market_mar_logo.png" alt="Market Mar" class="logo-img">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <!-- Opciones comunes -->
        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="nosotros.php">Nosotros</a></li>

        <?php if ($isUser): ?>
          <!-- Opciones solo para usuarios normales -->
          <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito</a></li>
          <li class="nav-item"><a class="nav-link" href="mi_cuenta.php">Mi Cuenta</a></li>
        <?php endif; ?>

        <?php if ($isAdmin): ?>
          <!-- Opciones solo para administradores -->
          <li class="nav-item"><a class="nav-link admin-link" href="editar_cuentas.php">Editar Cuentas</a></li>
          <li class="nav-item"><a class="nav-link admin-link" href="ver_reclamos.php">Ver Reclamos</a></li>
          <li class="nav-item"><a class="nav-link admin-link" href="editar_categorias.php">Editar Categorías</a></li>
          <li class="nav-item"><a class="nav-link admin-link" href="editar_productos.php">Editar Productos</a></li>
        <?php endif; ?>

        <?php if (!$isUser && !$isAdmin): ?>
          <!-- Opciones para usuarios no logueados -->
          <li class="nav-item"><a class="nav-link" href="cuenta.php">Cuenta</a></li>
        <?php endif; ?>

        <?php if ($isUser || $isAdmin): ?>
          <li class="nav-item logout-icon">
            <a class="nav-link" href="php/logout.php" title="Cerrar sesión">
              <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>