<?php
session_start();
require_once 'conexion.php';
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Obtener productos del carrito
$sql = "SELECT producto_id, cantidad, p.precio
        FROM carrito c
        JOIN productos p ON c.producto_id = p.id
        WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);

if (empty($productos)) {
    echo json_encode(['success' => false, 'message' => 'El carrito está vacío.']);
    exit;
}

// Calcular total
$total = 0;
foreach ($productos as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// Insertar pedido
$sqlPedido = "INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)";
$stmtPedido = $conn->prepare($sqlPedido);
$stmtPedido->bind_param("id", $usuario_id, $total);

if (!$stmtPedido->execute()) {
    echo json_encode(['success' => false, 'message' => 'Error al registrar el pedido.']);
    exit;
}

$pedido_id = $stmtPedido->insert_id;

// Insertar detalle_pedido
$sqlDetalle = "INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
$stmtDetalle = $conn->prepare($sqlDetalle);

foreach ($productos as $item) {
    $subtotal = $item['precio'] * $item['cantidad'];
    $stmtDetalle->bind_param("iiidd", $pedido_id, $item['producto_id'], $item['cantidad'], $item['precio'], $subtotal);
    $stmtDetalle->execute();
}

// Vaciar carrito
$sqlVaciar = "DELETE FROM carrito WHERE usuario_id = ?";
$stmtVaciar = $conn->prepare($sqlVaciar);
$stmtVaciar->bind_param("i", $usuario_id);
$stmtVaciar->execute();

echo json_encode(['success' => true]);
