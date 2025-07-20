<?php
session_start();
require_once 'conexion.php';

header('Content-Type: application/json');

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

// Verificar que se recibió el ID del producto
if (!isset($_POST['producto_id'])) {
    echo json_encode(['success' => false, 'error' => 'ID de producto no proporcionado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$producto_id = $_POST['producto_id'];

try {
    // Comprobar si el producto ya está en el carrito del usuario
    $sql_check = "SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $usuario_id, $producto_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Si ya existe, actualizar la cantidad
        $carrito_item = $result->fetch_assoc();
        $nueva_cantidad = $carrito_item['cantidad'] + 1;
        
        $sql_update = "UPDATE carrito SET cantidad = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $nueva_cantidad, $carrito_item['id']);
        $stmt_update->execute();
    } else {
        // Si no existe, insertar un nuevo registro
        $sql_insert = "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, 1)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $usuario_id, $producto_id);
        $stmt_insert->execute();
    }

    echo json_encode(['success' => true]);

} catch (Exception $e) {
    // En un entorno de producción, sería mejor registrar el error que mostrarlo.
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$conn->close();
?>