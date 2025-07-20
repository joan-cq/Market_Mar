<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['admin'])) {
    die(json_encode(['success' => false]));
}

try {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    if ($id) {
        if (isset($imagen)) {
            $sql = "UPDATE categorias SET nombre=?, descripcion=?, imagen=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $descripcion, $imagen, $id]);
        } else {
            $sql = "UPDATE categorias SET nombre=?, descripcion=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $descripcion, $id]);
        }
    } else {
        $sql = "INSERT INTO categorias (nombre, descripcion, imagen) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $imagen]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}