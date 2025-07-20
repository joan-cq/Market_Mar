<?php
require_once 'conexion.php';

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
$estado     = 'PENDIENTE'; // Estado por defecto

// Insertar en la base de datos
$sql = "INSERT INTO reclamos (nombre, domicilio, dni, telefono, correo, tipo_bien, monto, descripcion, tipo_reclamo, detalle, pedido, estado) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssissssssss", $nombre, $domicilio, $dni, $telefono, $mail, $bien, $monto, $descripcion, $tipo_reclamo, $reclamo, $pedido, $estado);

if ($stmt->execute()) {
    echo "<script>
        alert('Reclamo enviado con éxito.');
        window.location.href = '../index.php';
    </script>";
} else {
    echo "Error al guardar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>