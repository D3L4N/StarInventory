<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
error_reporting(0);
if (isset($_SESSION['Rol_Usuario']) && $_SESSION['Rol_Usuario'] === 'Administrador') {
    include './Php/Conexion.php';

    function agregarToast($tipo, $titulo, $descripcion) {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                agregarToast({
                    tipo: '<?= $tipo ?>',
                    titulo: '<?= $titulo ?>',
                    descripcion: '<?= $descripcion ?>',
                    autoCierre: true
                });
            });
        </script>
        <?php
    }

    $NOMBRE = "";
    $CADUCIDAD = NULL;
    $PRECIO = "";
    $PROVEEDOR = NULL;
    $CATEGORIA = "";
    $SUBCATEGORIA = "";
    $STOCK_ACTUAL = NULL;
    $IMAGEN_PRODUCTO = '';

    if (isset($_POST['Enviar'])) {
        $NOMBRE = $_POST['Nombre'];
        $PRECIO = $_POST['Precio'];
        $CATEGORIA = $_POST['Categoria'];
        $SUBCATEGORIA = $_POST['Subcategoria'];

        if (
            strlen($NOMBRE) >= 1 &&
            strlen($PRECIO) >= 1 &&
            strlen($CATEGORIA) >= 1 &&
            strlen($SUBCATEGORIA) >= 1
        ) {
            $FOTO = $_FILES['foto'];
            $img_file = $FOTO['name'];
            $img_type = $FOTO['type'];

            $directorio_destino = "Imagen_Producto";
            $destino = $directorio_destino . '/' . basename($img_file);

            $allowed_image_types = array("image/jpeg", "image/jpg", "image/png", "image/gif");

            if (in_array($img_type, $allowed_image_types) && move_uploaded_file($FOTO['tmp_name'], $destino)) {
                $IMAGEN_PRODUCTO = 'Imagen_Producto/' . basename($img_file);
            } else {
                $IMAGEN_PRODUCTO = 'Imagen_Producto/Predeterminada.png';
            }

            $stmt = mysqli_prepare($CONEXION, "INSERT INTO producto (Nombre_Producto, Precio, Categoria, Subcategoria, Imagen_Producto) 
                                              VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sssss", $NOMBRE, $PRECIO, $CATEGORIA, $SUBCATEGORIA, $IMAGEN_PRODUCTO);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            agregarToast('exito', 'Exito', '¡Producto Registrado Exitosamente!');
        } else {
            agregarToast('error', 'Error', '¡Llene todos los campos!');
        }
    }

    // Realizar las consultas antes de cerrar la conexión
    $queryCategorias = "SELECT ID_Categoria, Nombre_Categoria FROM Categoria";
    $resultCategorias = mysqli_query($CONEXION, $queryCategorias);

    $querySubcategorias = "SELECT ID_Subcategoria, Nombre_Subcategoria, ID_Categoria FROM Subcategoria";
    $resultSubcategorias = mysqli_query($CONEXION, $querySubcategorias);

    // Cerrar la conexión después de realizar todas las consultas
    mysqli_close($CONEXION);
} else {
    header("Location: Index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Productos</title>
</head>
<body>

<!-- Resto del código HTML... -->

</body>
</html>
