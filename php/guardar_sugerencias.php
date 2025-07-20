<?php
header('Content-Type: application/json');
require_once 'conexion.php'; // Asegúrate que $conn sea tu conexión mysqli

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = trim($_POST['nombre'] ?? '');
    $mail       = trim($_POST['mail'] ?? '');
    $sugerencia = trim($_POST['sugerencia'] ?? '');

    if ($nombre && $mail && $sugerencia) {
        // Preparar consulta segura
        $stmt = $conn->prepare("INSERT INTO sugerencias (nombre, mail, sugerencia, fecha) VALUES (?, ?, ?, NOW())");
        if ($stmt) {
            $stmt->bind_param("sss", $nombre, $mail, $sugerencia);
            $success = $stmt->execute();

            if ($success) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => "Error al guardar."]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "error" => "Error en la preparación."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Campos incompletos."]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido."]);
}
