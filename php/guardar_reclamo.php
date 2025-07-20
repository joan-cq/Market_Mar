<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "admin", "123456789", "market_mar");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre     = $_POST['nombre'];
$domicilio  = $_POST['domicilio'];
$dni        = $_POST['dni'];
$telefono   = $_POST['telefono'];
$mail       = $_POST['mail'];
$bien       = $_POST['bien'];
$monto      = $_POST['monto'];
$descripcion = $_POST['descripcion'];
$tipo_reclamo = $_POST['tipo_reclamo'];
$reclamo    = $_POST['reclamo'];
$pedido     = $_POST['pedido'];

// Insertar en la base de datos
$sql = "INSERT INTO reclamos (nombre, domicilio, dni, telefono, correo, tipo_bien, monto, descripcion, tipo_reclamo, detalle, pedido) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssisssssss", $nombre, $domicilio, $dni, $telefono, $mail, $bien, $monto, $descripcion, $tipo_reclamo, $reclamo, $pedido);

if ($stmt->execute()) {
    echo "<script>
        alert('Reclamo enviado con éxito.');
        window.location.href = '../index.php';
    </script>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
