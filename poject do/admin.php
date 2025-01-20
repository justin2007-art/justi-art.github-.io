<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "admin") {
    header("Location: login.html");
    exit();
}
include 'config.php';

echo "<h1>Panel de Administración</h1>";
echo "<a href='logout.php'>Cerrar Sesión</a>";

// Mostrar lista de usuarios
$result = $conn->query("SELECT id, usuario, rol FROM usuarios");
echo "<h2>Usuarios</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>ID: {$row['id']} - Usuario: {$row['usuario']} - Rol: {$row['rol']}</p>";
}
?>
