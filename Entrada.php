<?php
// Inicia la sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Asegúrate de que exista la sesión y el rol de usuario
if (isset($_SESSION['Rol_Usuario'])) {
    // Define el directorio de los archivos de menú
    $menuDirectory = "Menus/";

    // Define un array asociativo que mapea roles a archivos de menú
    $menuFiles = [
        'Administrador' => 'Menu_Administrador.php',
        'Cajero' => 'Menu_Cajero.php',
        'Bodeguero' => 'Menu_Bodeguero.php',
    ];

    // Verifica si el rol del usuario está en el array de menú
    if (array_key_exists($_SESSION['Rol_Usuario'], $menuFiles)) {
        // Incluye el archivo de menú correspondiente
        require($menuDirectory . $menuFiles[$_SESSION['Rol_Usuario']]);
        require("Php/Conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedidos productos</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ========== Estilos =========== -->
    <link rel="stylesheet" href="Css/Alerts.css" />
    <link rel="stylesheet" href="Css/Registros.css">
    <script src="Js/Alerts.js" defer></script>
     <!-- ========== Íconos =========== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="Icons/StarInventory.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<body>
    <div class="Contenedor_login">
        <h1>PEDIDOS DE PRODUCTOS</h1>
        <form method="post" enctype="multipart/form-data" action="Php/insertar_entrada.php">
            <?php    
                if (isset($_SESSION['Usuario'])) {
                    $nombreUsuario = $_SESSION['Usuario'];
                    echo '<p>Bienvenido, ' . $nombreUsuario . '</p>';
                    // Incluye el campo oculto "usuario" en el formulario
                    echo '<input type="hidden" name="usuario" value="' . $nombreUsuario . '">';
                }
            ?>
            <div class="select">
                <label for="producto">Producto</label>
                <select name="producto" id="producto" required>
                    <option selected disabled>Seleccionar</option>
                    <?php
                    // Lógica para obtener y mostrar la lista de productos
                    include("Php/get_product_list.php");
                    ?>
                </select>
            </div>
            <div class="input_login">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" required>
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="input_login">
                <label for="fecha_caducidad">Fecha de Caducidad</label>
                <input type="date" name="fecha_caducidad" required>
            </div>
            <div class="select">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" required>
                <option selected disabled>Seleccionar</option>
                    <?php
                    // Lógica para obtener y mostrar la lista de productos
                    include("Php/get_supplier_list.php");
                    ?>
                </select>
            </div>
            <button class="btn_login" name="RegistrarEntrada">Registrar Entrada</button>
        </form>
    </div>
    <!-- ========== Mostrar Alertas =========== -->
    <div class="contenedor">
        <div class="hero">
            <div class="contenedor-botones" id="contenedor-botones"></div>
        </div>
        <div class="contenedor-toast" id="contenedor-toast"></div>
    </div>
</body>
</html>
<?php
    } else {
        header("Location: Index.php");
    }
} else {
    header("Location: Index.php");
}
?>
<?php
include("Alerts_Productos.Php")
?>
