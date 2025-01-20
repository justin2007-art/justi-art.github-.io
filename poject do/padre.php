<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "padre") {
    header("Location: login.html");
    exit();
}
include 'config.php';

echo "<h1>Panel de Padres</h1>";
echo "<a href='logout.php'>Cerrar Sesión</a>";

$result = $conn->query("SELECT id, usuario FROM usuarios WHERE rol='estudiante'");
echo "<form method='POST'>";
echo "<label>Seleccionar hijo:</label><select name='estudiante_id'>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['usuario']}</option>";
}
echo "</select>";
echo "<button type='submit'>Ver Notas</button>";
echo "</form>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudiante_id = $_POST["estudiante_id"];
    $result = $conn->query("SELECT materia, nota FROM calificaciones WHERE estudiante_id=$estudiante_id");
    echo "<h2>Notas</h2>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['materia']}: {$row['nota']}</p>";
    }
}
?>
