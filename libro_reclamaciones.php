<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Market Mar | Libro de Reclamaciones</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <?php include 'php/navbar.php'; ?>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Libro de Reclamaciones</h2>
    <form id="form-reclamaciones" action="php/guardar_reclamo.php" method="post" class="bg-light p-4 rounded shadow-sm" novalidate>
      <!-- Datos del cliente -->
      <h4 class="mb-3">Identificación del consumidor reclamante</h4>

      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre Completo:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
      </div>

      <div class="mb-3">
        <label for="domicilio" class="form-label">Domicilio:</label>
        <input type="text" class="form-control" id="domicilio" name="domicilio" required>
      </div>

      <div class="mb-3">
        <label for="dni" class="form-label">DNI / CE:</label>
        <input type="text" class="form-control" id="dni" name="dni" required>
      </div>

      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="number" class="form-control" id="telefono" name="telefono" required>
      </div>

      <div class="mb-3">
        <label for="mail" class="form-label">Correo Electrónico:</label>
        <input type="email" class="form-control" id="mail" name="mail" required>
      </div>

      <!-- Bien contratado -->
      <h4 class="mt-4 mb-3">Identificación del bien contratado</h4>

      <div class="mb-3">
        <label for="bien" class="form-label">Tipo de bien:</label>
        <select class="form-select" id="bien" name="bien" required>
          <option value="" disabled selected>Seleccionar tipo de bien</option>
          <option value="producto">Producto</option>
          <option value="servicio">Servicio</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="monto" class="form-label">Monto Reclamado (S/.):</label>
        <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
      </div>

      <!-- Reclamo -->
      <h4 class="mt-4 mb-3">Detalle de la reclamación y pedido</h4>

      <div class="mb-3">
        <label for="tipo_reclamo" class="form-label">Tipo de Reclamación:</label>
        <select class="form-select" id="tipo_reclamo" name="tipo_reclamo" required>
          <option value="" disabled selected>Seleccionar tipo de reclamación</option>
          <option value="Reclamo">Reclamo</option>
          <option value="Queja">Queja</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="reclamo" class="form-label">Detalle:</label>
        <textarea class="form-control" id="reclamo" name="reclamo" rows="4" placeholder="Ingresa el detalle de tu reclamación" required></textarea>
      </div>

      <div class="mb-4">
        <label for="pedido" class="form-label">Pedido:</label>
        <textarea class="form-control" id="pedido" name="pedido" rows="4" placeholder="Ingresa el detalle de tu pedido" required></textarea>
      </div>

      <button type="submit" class="btn btn-warning w-100 fw-bold">ENVIAR HOJA DE RECLAMACIÓN</button>
    </form>
  </main>

  <!-- Footer -->
  <?php include 'php/footer.php'; ?>

  <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmacionModalLabel">¿Está seguro de enviar?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            Una vez enviado, su reclamo será registrado en el sistema.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelar-envio">No</button>
            <button type="button" class="btn btn-primary" id="confirmar-envio">Sí, enviar</button>
        </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="javascript/form-reclamo.js"></script>
</body>
</html>
