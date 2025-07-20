<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['admin'])) {
    die(json_encode(['success' => false]));
}

try {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $dni = $_POST['dni'];
    $celular = $_POST['celular'];
    $tipo = $_POST['tipo'];
    $clave = $_POST['clave'];

    if ($id) {
        // Actualizar
        if (!empty($clave)) {
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nombre=?, correo=?, dni=?, celular=?, tipo=?, clave=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $correo, $dni, $celular, $tipo, $clave_hash, $id]);
        } else {
            $sql = "UPDATE usuarios SET nombre=?, correo=?, dni=?, celular=?, tipo=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $correo, $dni, $celular, $tipo, $id]);
        }
    } else {
        // Insertar nuevo
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre, correo, dni, celular, tipo, clave) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nombre, $correo, $dni, $celular, $tipo, $clave_hash]);
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}