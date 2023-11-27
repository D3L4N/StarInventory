<?php
session_start();

include("../Php/Conexion.php");

function showJavaScriptAlert($type, $title, $message) {
    // Implementa la lógica para mostrar alertas de JavaScript
    // según tu necesidad (puede ser mediante JavaScript o PHP).
}

function updateImage($id, $CONEXION) {
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
        $imgFileName = $foto['name'];
        $imgFileType = $foto['type'];

        $allowedImageTypes = array("image/jpeg", "image/jpg", "image/png", "image/gif");

        if (in_array($imgFileType, $allowedImageTypes)) {
            $directorioDestino = "../Imagen_Producto";
            $destino = 'Imagen_Producto/' . basename($imgFileName);

            if (!file_exists($directorioDestino)) {
                mkdir($directorioDestino, 0777, true);
            }

            if (move_uploaded_file($foto['tmp_name'], $directorioDestino . '/' . basename($imgFileName))) {
                $sql = "UPDATE producto SET Imagen_Producto='$destino' WHERE ID_Producto='$id'";
                $query = mysqli_query($CONEXION, $sql);

                if (!$query) {
                    showJavaScriptAlert('error', 'ERROR', 'Error al actualizar la foto del producto. Por favor, inténtalo de nuevo.');
                }
            } else {
                showJavaScriptAlert('error', 'ERROR', 'Error al cargar la nueva foto del producto. Asegúrate de que sea una imagen válida.');
            }
        } else {
            showJavaScriptAlert('error', 'ERROR', 'Tipo de archivo no permitido. Selecciona una imagen válida.');
        }
    }
}

if ($_SESSION['Rol_Usuario']) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["ID"];
        $fechaCaducidad = !empty($_POST['Fecha_Caducidad']) ? $_POST['Fecha_Caducidad'] : null;
        $stock = !empty($_POST['Stock']) ? $_POST['Stock'] : null;
        $nombreProducto = $_POST['Nombre_Producto'];
        $precio = $_POST['Precio'];
        $categoria = $_POST['Categoria'];
        $subcategoria = $_POST['Subcategoria'];
        $proveedor = !empty($_POST['Proveedor']) ? $_POST['Proveedor'] : null;

        $sql = "UPDATE producto SET Fecha_Caducidad=?, Stock=?, Nombre_Producto=?, Precio=?, Categoria=?, Subcategoria=?, Proveedor=? WHERE ID_Producto=?";
        $stmt = mysqli_prepare($CONEXION, $sql);
        mysqli_stmt_bind_param($stmt, "sssisssi", $fechaCaducidad, $stock, $nombreProducto, $precio, $categoria, $subcategoria, $proveedor, $id);
        $query = mysqli_stmt_execute($stmt);

        if ($query) {
            updateImage($id, $CONEXION);
            header("Location: ../Crud_Productos.php?edicion=exitosa");
            exit();
        } else {
            header("Location: ../Crud_Productos.php?edicion=fallida");
        }
    } else {
        if (isset($_GET['ID_Producto'])) {
            $id = $_GET['ID_Producto'];

            $sql = "SELECT * FROM Producto WHERE ID_Producto='$id'";
            $query = mysqli_query($CONEXION, $sql);
            $row = mysqli_fetch_array($query);

            if (!$row) {
                showJavaScriptAlert('error', 'ERROR', 'Producto no encontrado.');
                exit();
            }
        } else {
            showJavaScriptAlert('error', 'ERROR', 'ID de Producto no proporcionado.');
            exit();
        }
    }
} else {
    header("Location: ../Index.php");
    exit();
}
?>
