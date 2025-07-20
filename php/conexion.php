<?php
// php/conexion.php

$host = "localhost";
$user = "admin"; // Cambia esto si tu usuario es diferente
$pass = "123456789"; // Por defecto en XAMPP
$db   = "market_mar";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Opcional: para que los resultados sean en UTF-8
$conn->set_charset("utf8mb4");
?>