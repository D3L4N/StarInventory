<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "starinventory";

$CONEXION = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$CONEXION) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
