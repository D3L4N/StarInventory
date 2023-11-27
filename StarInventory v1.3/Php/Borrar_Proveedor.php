<?php
include("../Php/Conexion.php");

$id = $_GET["ID_Proveedor"];

$sql = "DELETE FROM proveedor WHERE ID_Proveedor='$id'";
$query = mysqli_query($CONEXION, $sql);

if ($query) {
    header("Location: ../Crud_Proveedores.php?eliminacion=exitosa");
} else {
    header("Location: ../Crud_Proveedores.php?eliminacion=fallida");
}
?>
