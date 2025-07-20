<?php
session_start();
require_once 'conexion.php';

$correo = $_POST['correo'];
$clave  = $_POST['clave'];

$sql = "SELECT id, nombre, clave, tipo FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($clave, $row['clave'])) {
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nombre'] = $row['nombre'];
        $_SESSION['admin'] = ($row['tipo'] === 'ADMINISTRADOR');
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>
            alert('Contraseña incorrecta.');
            window.location.href = '../cuenta.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Correo no registrado.');
        window.location.href = '../cuenta.php';
    </script>";
}

$stmt->close();
$conn->close();
?>