<?php
session_start();

// Verificar si el usuario tiene el rol adecuado
if ($_SESSION['Rol_Usuario']) {
    include("../Php/Conexion.php");

    // Verificar si la solicitud es mediante el método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario de edición
        $id = $_POST["ID"];
        $name = $_POST['Nombre'];
        $categoria = $_POST['Categoria'];

        // Preparar la consulta SQL para actualizar la subcategoría
        $sqlUpdateSubcategoria = "UPDATE subcategoria SET Nombre_Subcategoria=?, ID_Categoria=? WHERE ID_Subcategoria=?";
        $stmtUpdateSubcategoria = mysqli_prepare($CONEXION, $sqlUpdateSubcategoria);
        mysqli_stmt_bind_param($stmtUpdateSubcategoria, "sii", $name, $categoria, $id);
        $queryUpdateSubcategoria = mysqli_stmt_execute($stmtUpdateSubcategoria);

        // Verificar si la actualización fue exitosa
        if ($queryUpdateSubcategoria) {
            header("Location: ../Crud_Subcategorias.php");
            exit();
        } else {
            agregarToast('error', 'Error', 'Error al actualizar la subcategoría.');
            exit();
        }
    } else {
        // Obtener el ID de la subcategoría a editar desde la URL
        if (isset($_GET['ID_Subcategoria'])) {
            $id = $_GET['ID_Subcategoria'];

            // Consultar la base de datos para obtener los datos de la subcategoría usando una consulta preparada
            $sql = "SELECT * FROM subcategoria WHERE ID_Subcategoria=?";
            $stmt = mysqli_prepare($CONEXION, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

            // Verificar si la subcategoría fue encontrada
            if (!$row) {
                agregarToast('error', 'Error', 'Subcategoría no encontrada.');
                exit();
            }
        } else {
            agregarToast('error', 'Error', 'ID de subcategoría no proporcionado.');
            exit();
        }
    }
} else {
    // Redirigir si el usuario no tiene el rol adecuado
    header("Location: ../Index.php");
    exit();
}

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
?>
