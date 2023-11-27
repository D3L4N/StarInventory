<?php 
    include("./Php/Conexion.php");

    $id = $_GET['ID_Producto'];

    $sql = "SELECT * FROM producto WHERE ID_Producto='$id'";
    $query = mysqli_query($CONEXION, $sql);

    $row = mysqli_fetch_array($query);

    // Consulta y generación de opciones para categorías
    $queryCategorias = "SELECT ID_Categoria, Nombre_Categoria FROM Categoria";
    $resultCategorias = mysqli_query($CONEXION, $queryCategorias);

    // Consulta y generación de opciones para subcategorías
    $querySubcategorias = "SELECT ID_Subcategoria, Nombre_Subcategoria, ID_Categoria FROM Subcategoria";
    $resultSubcategorias = mysqli_query($CONEXION, $querySubcategorias);

    // Consulta y generación de opciones para proveedores
    $queryProveedores = "SELECT ID_Proveedor, Nombre_Proveedor FROM Proveedor";
    $resultProveedores = mysqli_query($CONEXION, $queryProveedores);
?>
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Productos</title>
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
        <!-- ========== Boton regresar =========== -->
        <button class="regresar"><a href="Crud_Productos.php">Cancelar Edición</a></button>
        <!-- ========== Formulario =========== -->
        <form action="Php/Editar_Productos.php" method="POST" enctype="multipart/form-data">
            <div class="input_login">
                <input type="hidden" name="ID" value="<?= $row['ID_Producto']?>">
            </div>
        <div class="Contenedor_login">
            <h1>ACTUALIZAR DATOS<br>DE PRODUCTOS</h1>
            <div class="input_login">
                <input type="date" name="Fecha_Caducidad" placeholder="Fecha_Caducidad"  value="<?= $row['Fecha_Caducidad']?>">
            </div>
            <div class="input_login">
                <input type="number" name="Stock" placeholder="Stock"  value="<?= $row['Stock']?>">
            </div>
            <div class="select">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" required>
                <option selected disabled>Seleccionar</option>
                    <?php
                    // Lógica para obtener y mostrar la lista de proveedores
                    include("Php/get_supplier_list.php");
                    ?>
                </select>
            </div>
            <div class="input_login">
                <input type="text" name="Nombre_Producto" placeholder="Nombre"  value="<?= $row['Nombre_Producto']?>">
            </div>
            <div class="input_login">
                <input type="number" name="Precio" placeholder="Precio" value="<?= $row['Precio']?>">
                
            </div>
            <div class="select">
                <label for="Categoria">Categoría:</label>
                <select name="Categoria" id="Categoria">
                    <option selected disabled>Seleccionar</option>
                    <?php
                    // Recorrer la lista de categorías y generar las opciones
                    while ($categoriaRow = mysqli_fetch_assoc($resultCategorias)) {
                        $selected = ($categoriaRow['ID_Categoria'] == $row['Categoria']) ? 'selected' : '';
                        echo '<option value="' . $categoriaRow['ID_Categoria'] . '" ' . $selected . '>' . $categoriaRow['Nombre_Categoria'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="select">
                <label for="Subcategoria">Subcategoría:</label>
                <select name="Subcategoria" id="Subcategoria">
                    <option selected disabled>Seleccionar</option> <!-- Agregar una opción predeterminada "Seleccionar" -->
                    <?php
                    // Recorrer la lista de subcategorías y generar las opciones
                    while ($subcategoriaRow = mysqli_fetch_assoc($resultSubcategorias)) {
                        $selected = ($subcategoriaRow['ID_Subcategoria'] == $row['Subcategoria']) ? 'selected' : '';
                        echo '<option value="' . $subcategoriaRow['ID_Subcategoria'] . '" ' . $selected . ' data-categoria="' . $subcategoriaRow['ID_Categoria'] . '">' . $subcategoriaRow['Nombre_Subcategoria'] . '</option>';
                    }
                    ?>
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
            <button class="btn_login" name="Enviar">EDITAR</button>
        </form>
    </div>
    <!-- ========== Mostrar Alerta =========== -->
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




