<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("Php/Cambio_Contraseña.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <!-- ========== Estilos =========== -->
    <link rel="stylesheet" href="Css/Login.css">
    <link rel="stylesheet" href="Css/Alert.css">
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
<button class="regresar"><a href="Index.php">Regresar al inicio</a></button>
<!-- ========== Formulario =========== -->
<div class="Contenedor_login">
        <h1>Cambiar Contraseña</h1>
        <form method="post">
            <div class="input_login">
                <input type="text" name="Usuario" placeholder="Usuario">
                <!-- ========== Ícono de usuario =========== -->
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/cjyxqyly.json"
                    trigger="loop"
                    colors="primary:#b26836,secondary:#4bb3fd,tertiary:#f9c9c0"
                    style="width:40px;height:40px">
                </lord-icon>
            </div>
            <div class="input_login">
                <input type="password" name="Nueva_Contraseña" id="inputContraseña1" placeholder="Nueva Contraseña">
                <!-- ========== Ícono de contraseña =========== -->
                <span id="verContraseña1" onclick="mostrarContraseña('inputContraseña1', 'verContraseña1')">
                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/nrzqxhfu.json"
                        trigger="loop"
                        colors="primary:#121331,secondary:#646e78"
                        style="width:50px;height:50px">
                    </lord-icon>
                </span>
            </div>
            <div class="input_login">
                <input type="password" name="Repetir_Contraseña" id="inputContraseña2" placeholder="Repetir Contraseña">
                <!-- ========== Ícono de contraseña =========== -->
                <span id="verContraseña2" onclick="mostrarContraseña('inputContraseña2', 'verContraseña2')">
                    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/nrzqxhfu.json"
                        trigger="loop"
                        colors="primary:#121331,secondary:#646e78"
                        style="width:50px;height:50px">
                    </lord-icon>
                </span>
            </div>
            <button class="btn_login" name="Enviar"> 
                Cambiar Contraseña 
                <!-- =========== Ícono de envío ========== -->
                <script src="https://cdn.lordicon.com/clcopglh.json"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/clcopglh.json"
                    trigger="loop"
                    colors="primary:#121331,secondary:#ffc738"
                    style="width:40px;height:40px">
                </lord-icon>
            </button>
        </form>
    </div>
<!-- =========== Mostrar Alertas ========== -->
<div class="contenedor">
    <div class="hero">
        <div class="contenedor-botones" id="contenedor-botones"></div>
    </div>
    <div class="contenedor-toast" id="contenedor-toast"></div>
</div> 
</body>
</html>