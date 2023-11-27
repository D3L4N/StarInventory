<?php
session_start();

// Verificar si el usuario tiene el rol adecuado
if ($_SESSION['Rol_Usuario']) {
    // Incluir el archivo de conexión a la base de datos
    include("../Php/Conexion.php");

    // Verificar si se ha enviado un formulario POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario de edición
        $id = $_POST['ID'];  // Añadido: Obtener el ID del formulario
        $nombre = $_POST['Nombre'];
        $numeroContacto = $_POST['Numero_Contacto'];

        // Construir la consulta SQL para actualizar el proveedor
        $sql = "UPDATE proveedor SET Nombre_Proveedor='$nombre', Numero_Contacto='$numeroContacto' WHERE ID_Proveedor='$id'";

        // Ejecutar la consulta
        $query = mysqli_query($CONEXION, $sql);

        // Verificar el resultado de la consulta y redirigir
        if ($query) {
            header("Location: ../Crud_Proveedores.php?edicion=exitosa");
            exit();
        } else {
            header("Location: ../Crud_Proveedores.php?edicion=fallida");
            exit();
        }
    } else {
        // Obtener el ID del proveedor a editar desde la URL
        if (isset($_GET['ID_Proveedor'])) {
            $id = $_GET['ID_Proveedor'];

            // Consultar la base de datos para obtener los datos del proveedor
            $sql = "SELECT * FROM proveedor WHERE ID_Proveedor='$id'";
            $query = mysqli_query($CONEXION, $sql);
            $row = mysqli_fetch_array($query);

            // Verificar si se encontró el proveedor
            if (!$row) {
                // Mostrar una alerta JavaScript y salir
                showJavaScriptAlert('error', 'ERROR', 'Proveedor no encontrado.');
                exit();
            }
        } else {
            // Mostrar una alerta JavaScript y salir si no se proporcionó el ID del proveedor
            showJavaScriptAlert('error', 'ERROR', 'ID de Proveedor no proporcionado.');
            exit();
        }
    }
} else {
    // Redirigir si el usuario no tiene el rol adecuado
    header("Location: ../Index.php");
    exit();
}
?>
