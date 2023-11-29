<?php
include("../Php/Conexion.php");

$id = $_GET["ID_Producto"];

$sql = "DELETE FROM producto WHERE ID_Producto='$id'";
$query = mysqli_query($CONEXION, $sql);

if ($query) {
    header("Location: ../Crud_Productos.php?eliminacion=exitosa");
} else {
    header("Location: ../Crud_Productos.php?eliminacion=fallida");
}
?>
