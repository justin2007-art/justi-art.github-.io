<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.html");
    exit();
}

echo "Bienvenido, " . $_SESSION["usuario"];
if ($_SESSION["rol"] == "admin") {
    echo "<a href='admin.php'>Panel de Administración</a>";
} elseif ($_SESSION["rol"] == "docente") {
    echo "<a href='docente.php'>Panel de Docente</a>";
} elseif ($_SESSION["rol"] == "estudiante") {
    echo "<a href='estudiante.php'>Panel de Estudiante</a>";
} elseif ($_SESSION["rol"] == "padre") {
    echo "<a href='padre.php'>Panel de Padres</a>";
}
?>
