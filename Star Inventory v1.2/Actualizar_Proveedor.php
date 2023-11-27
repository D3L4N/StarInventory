<?php
include("Php/Conexion.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['ID_Proveedor'])) {
    $id = $_GET['ID_Proveedor'];

    // Consulta para obtener los datos del usuario
    $sql = "SELECT * FROM proveedor WHERE ID_Proveedor='$id'";
    $query = mysqli_query($CONEXION, $sql);
    $row = mysqli_fetch_array($query);

    if ($row) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Proveedor</title>
    <!-- ========== Estilos =========== --> 
    <link href="Css/Edits.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/Alerts.css" />
    <script src="Js/Alerts.js" defer></script> 
    <script src="js/Ver_Contraseña.js"></script>
      <!-- ========== Íconos =========== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="Icons/StarInventory.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
    
</head>
<body>
    <?php
    if (isset($_SESSION['Rol_Usuario'])) {
        $menuDirectory = "Menus/";

        $menuFiles = [
            'Administrador' => 'Menu_Administrador.php',
            'Cajero' => 'Menu_Cajero.php',
            'Bodeguero' => 'Menu_Bodeguero.php',
        ];

        if (array_key_exists($_SESSION['Rol_Usuario'], $menuFiles)) {
            // Incluye el archivo de menú correspondiente
            require($menuDirectory . $menuFiles[$_SESSION['Rol_Usuario']]);
?>
<!-- ========== Boton regresar =========== -->
<button class="regresar"><a href="Crud_Proveedores.php">Cancelar Edición</a></button>
 <!-- ========== Formulario =========== -->
    <form action="Php/Editar_Proveedor.php" method="POST" enctype="multipart/form-data">
        <div class="input_login">
            <input type="hidden" name="ID" value="<?= $row['ID_Proveedor'] ?>">
        </div>
    <div class="Contenedor_login">
        <h1>ACTUALIZAR<br>DATOS</h1>
        <div class="input_login">
            <label for="Nombre">Nombre</label>
            <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" value="<?= $row['Nombre_Proveedor'] ?>" required>
            <span class="material-symbols-outlined">person</span>
        </div>
        <div class="input_login">
            <label for="Numero_Contacto">Numero Contacto</label>
            <input type="text" id="Numero_Contacto" name="Numero_Contacto" placeholder="Numero Contacto" value="<?= $row['Numero_Contacto'] ?>" required>
            <span class="material-symbols-outlined">person</span>
        </div>
        <button class="btn_login" name="Enviar" value="Actualizar">Actualizar datos</button>
        <script src="js/File.js"></script>
    </form>
</div>
 <!-- ========== Mostrar Alerta =========== -->
<div class="contenedor">
    <div class="hero">
        <div class="contenedor-botones" id="contenedor-botones"></div>
    </div>
    <div class="contenedor-toast" id="contenedor-toast"></div>
</div>
<?php
            require("Php/Conexion.php");
        } else {
            header("Location: Index.php");
        }
    } else {
        header("Location: Index.php");
    }
?>
</body>
</html>

<?php
    } else {
        echo "Usuario no encontrado.";
    }
} else {
    echo "ID de usuario no proporcionado.";
}
?>
<body>
</body>
</html>
<?php
include("Alerts_Productos.Php")
?>


