<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['admin'])) {
    die(json_encode(['success' => false, 'message' => 'No autorizado']));
}

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'];
    $estado = $data['estado'];

    $sql = "UPDATE reclamos SET estado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$estado, $id]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}