<?php
include '../Php/Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Usuario = $_POST['Usuario'];
    $NuevoNombre = $_POST['Nombre'];
    $NuevoApellido = $_POST['Apellido'];
    $NuevaContraseña = $_POST['Nueva_Contraseña'];
    $RepetirContraseña = $_POST['Repetir_Contraseña'];

    // Asegúrate de que las contraseñas coincidan antes de continuar
    if ($NuevaContraseña !== $RepetirContraseña) {
        //contraseñas no coinciden
        header("Location: ../Visualizar_Perfil.php");
        exit();
    }

    // Inicializa la variable de la contraseña hasheada
    $contraseña_hasheada = null;

    // Verifica si se proporcionó una nueva contraseña
    if (!empty($NuevaContraseña)) {
        // Usa hash con el algoritmo SHA-256 para obtener el hash de la nueva contraseña
        $contraseña_hasheada = hash('sha256', $NuevaContraseña);
    }

    // Actualiza el usuario en la base de datos solo si se proporciona una nueva contraseña
    if ($contraseña_hasheada !== null) {
        $stmt = mysqli_prepare($CONEXION, "UPDATE usuario SET Nombre=?, Apellido=?, Contraseña=? WHERE Usuario=?");
        mysqli_stmt_bind_param($stmt, "ssss", $NuevoNombre, $NuevoApellido, $contraseña_hasheada, $Usuario);

        if ($stmt && mysqli_stmt_execute($stmt)) {
            //edicion correcta
            header("Location: ../Visualizar_Perfil.php");
            exit();
        } else {
            //edicion incorrecta
            header("Location: ../Visualizar_Perfil.php");
        }

        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        //no se propociona contraseña
        header("Location: ../Visualizar_Perfil.php");
    }

    // Cierra la conexión
    $CONEXION->close();
}
?>
