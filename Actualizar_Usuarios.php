<?php
include("Php/Conexion.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['ID_Usuario'])) {
    $id = $_GET['ID_Usuario'];

    // Consulta para obtener los datos del usuario
    $sql = "SELECT * FROM usuario WHERE ID_Usuario='$id'";
    $query = mysqli_query($CONEXION, $sql);
    $row = mysqli_fetch_array($query);

    if ($row) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar usuarios</title>
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
<button class="regresar"><a href="Crud_Usuarios.php">Cancelar Edición</a></button>
 <!-- ========== Formulario =========== -->
<div class="Contenedor_login">
    <h1>ACTUALIZAR<br>DATOS</h1>
    <form action="Php/Editar_Usuarios.php" method="POST" enctype="multipart/form-data">
        <div class="input_login">
            <input type="hidden" name="ID" value="<?= $row['ID_Usuario'] ?>">
        </div>
        <div class="input_login">
            <label for="Nombre">Nombre</label>
            <input type="text" id="Nombre" name="Nombre" placeholder="Nombre" value="<?= $row['Nombre'] ?>" required>
            <span class="material-symbols-outlined">person</span>
        </div>
        <div class="input_login">
            <label for="Apellido">Apellido</label>
            <input type="text" id="Apellido" name="Apellido" placeholder="Apellido" value="<?= $row['Apellido'] ?>" required>
            <span class="material-symbols-outlined">person</span>
        </div>
        <div class="input_login">
            <label for="Usuario">Usuario</label>
            <input type="text" id="Usuario" name="Usuario" placeholder="Usuario" value="<?= $row['Usuario'] ?>" required>
            <span class="material-symbols-outlined">person</span>
        </div>
        <div class="input_login">
            <label for="Contraseña">Nueva Contraseña</label>
            <input type="password" name="Contraseña" id="inputContraseña1" placeholder="Contraseña">
            <!-- ========== Ícono de contraseña =========== -->
            <span id="verContraseña1" onclick="mostrarContraseña('inputContraseña1', 'verContraseña1')">
            <span class="material-symbols-outlined">password</span>
            </span>
        </div>
        <div class="select">
            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/rfnfarqt.json"
                trigger="loop"
                colors="outline:#121331,primary:#b26836,secondary:#ffc738"
                style="width:60px;height:40px">
            </lord-icon>
            <select id="Cargo" name="Rol_Usuario" required>
                <option value="Administrador" <?= ($row['Rol_Usuario'] === 'Administrador') ? 'selected' : '' ?>>Administrador</option>
                <option value="Bodeguero" <?= ($row['Rol_Usuario'] === 'Bodeguero') ? 'selected' : '' ?>>Bodeguero</option>
                <option value="Cajero" <?= ($row['Rol_Usuario'] === 'Cajero') ? 'selected' : '' ?>>Cajero</option>
            </select>
        </div>
        <div class="input_container">
            <label for="files" class="btn" name="foto">
                Seleccionar una Foto de Perfil
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/mxddzdmt.json"
                    trigger="loop"
                    colors="outline:#121331,primary:#3a3347,secondary:#646e78,quaternary:#08a88a,quinary:#ffc738,senary:#ebe6ef"
                    style="width:60px;height:60px">
                </lord-icon>
            </label>
            <input id="files" style="display:none;" type="file" name="foto">
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


