<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "estudiante") {
    header("Location: login.html");
    exit();
}
include 'config.php';

echo "<h1>Panel de Estudiante</h1>";
echo "<a href='logout.php'>Cerrar Sesión</a>";

$usuario = $_SESSION["usuario"];
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->bind_result($id);
$stmt->fetch();
$stmt->close();

$result = $conn->query("SELECT materia, nota FROM calificaciones WHERE estudiante_id=$id");
echo "<h2>Mis Notas</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['materia']}: {$row['nota']}</p>";
}
?>
