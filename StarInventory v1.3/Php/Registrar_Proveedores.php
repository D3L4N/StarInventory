<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Proveedor</title>
</head>
<body>
<?php
// Función para agregar un mensaje de toast
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

// Se establece la conexión a la base de datos (asegúrate de que esté incluido correctamente)
include("./Php/Conexion.php");

// Verificar si se ha enviado el formulario
if (isset($_POST['Enviar'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['Nombre'];
    $numeroContacto = $_POST['Numero_Contacto'];

    // Validar que los campos no estén vacíos
    if (strlen($nombre) >= 1 && strlen($numeroContacto) >= 1) {
        // Insertar el nuevo proveedor en la base de datos
        $stmt = mysqli_prepare($CONEXION, "INSERT INTO proveedor (Nombre_Proveedor, Numero_Contacto) 
                                          VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $nombre, $numeroContacto);
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);
        
        // Mostrar mensaje de éxito
        agregarToast('exito', 'Éxito', '¡Proveedor registrado correctamente!');
    } else {
        // Mostrar mensaje de error si hay campos vacíos
        agregarToast('error', 'Error', '¡Llena todos los campos!');
    }
}
?>
</body>
</html>
