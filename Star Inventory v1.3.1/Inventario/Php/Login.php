<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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
    $contrasena = $_POST['Contraseña'];

    if (strlen($usuario) >= 1 && strlen($contrasena) >= 1) {
        $hashed_password = hash('sha256', $contrasena);

        // =========== Consulta SQL segura ==================
        $stmt = mysqli_prepare($CONEXION, "SELECT Usuario, Rol_Usuario FROM usuario WHERE Usuario=? AND Contraseña=?");
        mysqli_stmt_bind_param($stmt, "ss", $usuario, $hashed_password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['Usuario'] = $row['Usuario'];
            $_SESSION['Rol_Usuario'] = $row['Rol_Usuario'];

            // Redireccionar al usuario según su rol
            switch ($_SESSION['Rol_Usuario']) {
                case 'Administrador':
                    header("Location: Panel_Administrador.php");
                    exit();
                case 'Cajero':
                    header("Location: Panel_Cajero.php");
                    exit();
                case 'Bodeguero':
                    header("Location: Panel_Bodeguero.php");
                    exit();
            }
        } else {
            agregarToast('error', 'Error', '¡Usuario o contraseña incorrecta!');
        }
    } else {
        if (empty($usuario)) {
            agregarToast('error', 'Error', '¡Falta el nombre de usuario!');
        } elseif (empty($contrasena)) {
            agregarToast('error', 'Error', '¡Falta la contraseña!');     
        } else {
            agregarToast('error', 'Error', '¡Llena todos los campos!');
        }
    }
}
?>
</body>
</html>
