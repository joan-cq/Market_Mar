<?php
require_once 'conexion.php';

$nombre   = $_POST['nombre'];
$correo   = $_POST['correo'];
$celular  = $_POST['celular'];
$dni      = $_POST['dni'];
$clave    = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$tipo     = isset($_POST['tipo']) ? $_POST['tipo'] : 'USUARIO';

$sql = "INSERT INTO usuarios (nombre, correo, celular, dni, tipo, clave) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nombre, $correo, $celular, $dni, $tipo, $clave);

if ($stmt->execute()) {
    echo "<script>
        alert('Cuenta creada con éxito.');
        window.location.href = '../cuenta.php';
    </script>";
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>