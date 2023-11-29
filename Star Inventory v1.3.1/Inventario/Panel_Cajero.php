<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['Rol_Usuario'] == 'Cajero') {
    include('Php/Conexion.php');
    
    // Función para obtener el conteo de registros en una tabla
    function getCount($table) {
        global $CONEXION;
        $sql = "SELECT COUNT(*) AS total FROM `$table`";
        $result = $CONEXION->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["total"];
        }
        return 0;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Cajero</title>
    <!-- ========== Estilos =========== -->
    <link rel="stylesheet" href="Css/Panel_Cajero.css">
    <link rel="stylesheet" href="Css/Alerts.css" />
    <script src="Js/Alerts.js" defer></script>
    <!-- ========== Íconos =========== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" href="Icons/StarInventory.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
</head>
<body>
<!-- ========== Menú =========== -->
<?php include("Menus/Menu_Cajero.php")?>

<!-- ========== Cards =========== -->
<section>
    <div class="row_T">
        <?php echo "<center><h1> Bienvenido Usuario " . $_SESSION['Usuario'] . " <img src='Icons/verificado.png' width='18px' alt='Verificado'></h1></center>"; ?>
    </div>
    <div class="row">
        <!-- ========== Productos =========== -->
        <div class="column">
            <a href="Crud_Productos_Cajero.php"><div class="card">
                <div class="icon-wrapper">
                    <img src="Icons/Productos.ico" alt="productos" width="85px">
                </div>
                <h3><?php echo getCount('producto'); ?></h3>
                <h3>Productos</h3>
            </div></a>
        </div>
        <!-- ========== Ventas =========== -->
        <div class="column">
            <a href="Venta_Producto.php"><div class="card">
                <div class="icon-wrapper">
                    <img src="Icons/Productos.ico" alt="productos" width="85px">
                </div>
                <h3>Ventas</h3>
            </div></a>
        </div>
        <!-- ========== Provedores =========== -->
        <div class="column">
            <a href="Entrada.php"><div class="card">
                <div class="icon-wrapper">
                    <img src="Icons/Proveedores.ico" alt="proveedores" width="80px">
                </div>
                <h3>Pedidos</h3>
            </div></a>
        </div>
        <!-- ========== Provedores =========== -->
        <div class="column">
            <a href="Devoluciones.php"><div class="card">
                <div class="icon-wrapper">
                    <img src="Icons/Proveedores.ico" alt="proveedores" width="80px">
                </div>
                <h3>Devolucion</h3>
            </div></a>
        </div>
    </div>
</section>
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
?>
<?php
include("Alerts_Productos.Php")
?>