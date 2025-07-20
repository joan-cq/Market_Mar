<?php
session_start();
require_once 'conexion.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

if (!isset($_POST['producto_id']) || !isset($_POST['change'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$producto_id = (int)$_POST['producto_id'];
$change = (int)$_POST['change'];

// Obtener cantidad actual
$stmt = $conn->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
$stmt->bind_param("ii", $usuario_id, $producto_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Producto no encontrado en el carrito']);
    exit;
}
$current_quantity = $result->fetch_assoc()['cantidad'];
$new_quantity = $current_quantity + $change;

if ($new_quantity <= 0) {
    // Eliminar si la cantidad es 0 o menos
    $stmt = $conn->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $producto_id);
    $stmt->execute();
} else {
    // Actualizar cantidad
    $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
    $stmt->bind_param("iii", $new_quantity, $usuario_id, $producto_id);
    $stmt->execute();
}

// Recalcular subtotal y total
$new_subtotal = 0;
if ($new_quantity > 0) {
    $stmt = $conn->prepare("SELECT precio FROM productos WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    $new_subtotal = $producto['precio'] * $new_quantity;
}

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

echo json_encode([
    'success' => true,
    'newQuantity' => $new_quantity,
    'newSubtotal' => $new_subtotal,
    'newTotal' => $total_carrito
]);

$stmt->close();
$conn->close();
?>