<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "docente") {
    header("Location: login.html");
    exit();
}
include 'config.php';

echo "<h1>Panel de Docente</h1>";
echo "<a href='logout.php'>Cerrar Sesión</a>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $estudiante_id = $_POST["estudiante_id"];
    $materia = $_POST["materia"];
    $nota = $_POST["nota"];
    
    $stmt = $conn->prepare("INSERT INTO calificaciones (estudiante_id, materia, nota) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $estudiante_id, $materia, $nota);
    $stmt->execute();
    echo "<p>Nota registrada correctamente.</p>";
}

$result = $conn->query("SELECT id, usuario FROM usuarios WHERE rol='estudiante'");
echo "<form method='POST'>";
echo "<label>Estudiante:</label><select name='estudiante_id'>";
while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['id']}'>{$row['usuario']}</option>";
}
echo "</select>";
echo "<label>Materia:</label><input type='text' name='materia' required>";
echo "<label>Nota:</label><input type='number' step='0.01' name='nota' required>";
echo "<button type='submit'>Guardar</button>";
echo "</form>";
?>
