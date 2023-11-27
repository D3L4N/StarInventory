<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="icon" href="Icons/StarInventory.ico">
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
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

include('Php/Conexion.php');

if (isset($_POST['Enviar'])) {
    $usuario = mysqli_real_escape_string($CONEXION, $_POST['Usuario']);
    $nuevacontrasena = $_POST['Nueva_Contraseña'];
    $repetircontrasena = $_POST['Repetir_Contraseña'];

    // Verificar si el usuario existe
    $stmt_verificar_usuario = mysqli_prepare($CONEXION, "SELECT Usuario FROM usuario WHERE Usuario=?");
    mysqli_stmt_bind_param($stmt_verificar_usuario, "s", $usuario);
    mysqli_stmt_execute($stmt_verificar_usuario);
    $result_verificar_usuario = mysqli_stmt_get_result($stmt_verificar_usuario);

    if (mysqli_num_rows($result_verificar_usuario) > 0) {
        if (!empty($nuevacontrasena) && !empty($repetircontrasena)) {
            // Verificar si las contraseñas coinciden
            if ($nuevacontrasena === $repetircontrasena) {
                // Hash SHA-256 de la nueva contraseña
                $hashed_password = hash('sha256', $nuevacontrasena);

                // Actualizar la contraseña en la base de datos
                $stmt_actualizar_contraseña = mysqli_prepare($CONEXION, "UPDATE usuario SET Contraseña=? WHERE Usuario=?");
                mysqli_stmt_bind_param($stmt_actualizar_contraseña, "ss", $hashed_password, $usuario);
                mysqli_stmt_execute($stmt_actualizar_contraseña);

                agregarToast('exito', 'Éxito', 'Contraseña cambiada correctamente!');
            } else {
                agregarToast('error', 'Error', '¡Las contraseñas no coinciden!');
            }
        } else {
            agregarToast('error', 'Error', '¡Llena todos los campos!');
        }
    } else {
        agregarToast('error', 'Error', '¡Usuario no registrado!');
    }
}
?>
</body>
</html>
