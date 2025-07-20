<?php
session_start();
require_once 'conexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

if (!isset($_POST['producto_id'])) {
    echo json_encode(['success' => false, 'error' => 'ID de producto no proporcionado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$producto_id = (int)$_POST['producto_id'];

$stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
$stmt->bind_param("ii", $usuario_id, $producto_id);

if ($stmt->execute()) {
    // Recalcular el total del carrito
    $total_carrito = 0;
    $sql_total = "SELECT SUM(p.precio * c.cantidad) AS total
                  FROM carrito c
                  JOIN productos p ON c.producto_id = p.id
                  WHERE c.usuario_id = ?";
    $stmt_total = $conn->prepare($sql_total);
    $stmt_total->bind_param("i", $usuario_id);
    $stmt_total->execute();
    $result_total = $stmt_total->get_result()->fetch_assoc();
    if ($result_total && $result_total['total']) {
        $total_carrito = $result_total['total'];
    }

    echo json_encode(['success' => true, 'newTotal' => $total_carrito]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error al eliminar el producto del carrito']);
}

$stmt->close();
$conn->close();
?>