<?php
// Verificar si la conexión a la base de datos se realizó correctamente
if (!$CONEXION) {
    die("Connection failed: " . mysqli_connect_error());
}

$NOMBRE = "";
$CATEGORIA = "";

// Verificar si el formulario se ha enviado
if (isset($_POST['Enviar'])) {
    // Sanitizar y validar las entradas
    $NOMBRE = mysqli_real_escape_string($CONEXION, $_POST['Nombre']);
    $CATEGORIA = mysqli_real_escape_string($CONEXION, $_POST['Categoria']);

    // Verificar que los campos no estén vacíos
    if (strlen($NOMBRE) >= 1 && strlen($CATEGORIA) >= 1) {
        // Verificar si la categoría ya existe
        $stmtVerificacion = mysqli_prepare($CONEXION, "SELECT ID_Subcategoria FROM subcategoria WHERE Nombre_Subcategoria = ?");
        mysqli_stmt_bind_param($stmtVerificacion, "s", $NOMBRE);
        mysqli_stmt_execute($stmtVerificacion);
        mysqli_stmt_store_result($stmtVerificacion);

        if (mysqli_stmt_num_rows($stmtVerificacion) > 0) {
            // La categoría ya existe, manejar el caso si es necesario
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    agregarToast({
                        tipo: 'error',
                        titulo: 'ERROR',
                        descripcion: 'La subcategoría ya existe.',
                        autoCierre: true
                    });
                });
            </script>
            <?php
        } else {
            // Preparar la consulta SQL usando una declaración preparada
            $stmt = mysqli_prepare($CONEXION, "INSERT INTO subcategoria (Nombre_Subcategoria, ID_Categoria) VALUES (?, ?)");

            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, "ss", $NOMBRE, $CATEGORIA);

            // Ejecutar la consulta
            mysqli_stmt_execute($stmt);

            // Cerrar la declaración preparada
            mysqli_stmt_close($stmt);

            // No cierres la conexión aquí, hazlo después de todas las operaciones necesarias
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Asegúrate de que la función agregarToast esté definida
                    agregarToast({
                        tipo: 'exito',
                        titulo: 'ÉXITO',
                        descripcion: 'Subcategoría registrada exitosamente.',
                        autoCierre: true
                    });
                });
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                agregarToast({
                    tipo: 'error',
                    titulo: 'ERROR',
                    descripcion: 'Llene todos los campos.',
                    autoCierre: true
                });
            });
        </script>
        <?php
    }
}

// Consulta para obtener las categorías
$queryCategorias = "SELECT ID_Categoria, Nombre_Categoria FROM Categoria";
$resultCategorias = mysqli_query($CONEXION, $queryCategorias);

// Cierra la conexión después de realizar todas las operaciones necesarias
mysqli_close($CONEXION);
?>
