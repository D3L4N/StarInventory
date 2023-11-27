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
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Usa hash con el algoritmo SHA-256 para obtener el hash de la contraseña
    $contraseña_hasheada = hash('sha256', $NuevaContraseña);

    // Actualiza el usuario en la base de datos
    $stmt = mysqli_prepare($CONEXION, "UPDATE usuario SET Nombre=?, Apellido=?, Contraseña=? WHERE Usuario=?");
    mysqli_stmt_bind_param($stmt, "ssss", $NuevoNombre, $NuevoApellido, $contraseña_hasheada, $Usuario);

    if ($stmt && mysqli_stmt_execute($stmt)) {
        header("Location: ../Visualizar_Perfil.php");
        exit();
    } else {
        echo "Error al actualizar el usuario.";
    }

    // Cierra la declaración
    mysqli_stmt_close($stmt);

    // Cierra la conexión
    $CONEXION->close();
}
?>
