<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['admin'])) {
    die(json_encode(['success' => false]));
}

try {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria_id = $_POST['categoria_id'];
    
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    if ($id) {
        // Actualizar
        if (isset($imagen)) {
            $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, stock=?, categoria_id=?, imagen=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $precio, $stock, $categoria_id, $imagen, $id]);
        } else {
            $sql = "UPDATE productos SET nombre=?, precio=?, stock=?, categoria_id=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $precio, $stock, $categoria_id, $id]);
        }
    } else {
        // Insertar nuevo
        $sql = "INSERT INTO productos (nombre, precio, stock, categoria_id, imagen) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $precio, $stock, $categoria_id, $imagen]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}