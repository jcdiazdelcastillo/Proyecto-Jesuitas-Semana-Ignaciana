<?php
session_start();
include 'configdb.php';

$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
$conexion->set_charset("utf8");

$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];

// Buscar idJesuita según nombre y código
$sql = "SELECT idJesuita FROM jesuita WHERE nombre = '$nombre' AND codigo = '$codigo'";
$resultado = $conexion->query($sql);

if ($conexion->affected_rows > 0) {
    $fila = $resultado->fetch_array();
    $_SESSION["idJesuita"] = $fila["idJesuita"];
    $_SESSION["nombre"] = $nombre;

    echo "<h2>Jesuit found</h2>";
    echo "<h3>EVERYTHING READY TO VISIT: <a href='seleccionarLugar.php'>Go to visit</a></h3>";
} else {
    echo "<h2>Error: Jesuit not found</h2>";
    echo "<h3><a href='inicioSesion.html'>Try again</a></h3>";
}

$conexion->close();
?>