<?php
include '../Php/Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Usuario = $_POST['Usuario'];
    $NuevoNombre = $_POST['Nombre'];
    $NuevoApellido = $_POST['Apellido'];
    $NuevaContraseña = $_POST['Nueva_Contraseña'];
    $RepetirContraseña = $_POST['Repetir_Contraseña'];

    // Validation: Add your validation logic here

    $contraseña_hasheada = '';
    if (!empty($NuevaContraseña)) {
        // Use sha256 for password hashing
        $contraseña_hasheada = hash('sha256', $NuevaContraseña);
    }

    $set_clause = "Nombre = '$NuevoNombre', Apellido = '$NuevoApellido'";

    if (!empty($NuevaContraseña)) {
        $set_clause .= ", Contraseña = '$contraseña_hasheada'";
    }

    $sql = "UPDATE Usuario SET $set_clause WHERE Usuario = ?";

    // Use prepared statement to prevent SQL injection
    $stmt = $CONEXION->prepare($sql);
    $stmt->bind_param("s", $Usuario);

    if ($stmt->execute()) {
        // Redirect to the profile page
        header("Location: ../Visualizar_Perfil.php");
        exit();
    } else {
        echo "Error al actualizar los datos.";
        // Log detailed error for debugging: echo $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $CONEXION->close();
}
?>
