function mostrarContraseña(idCampoContraseña, idIconoVerContraseña) {
    var inputContraseña = document.getElementById(idCampoContraseña);
    var iconoVerContraseña = document.getElementById(idIconoVerContraseña);

    if (inputContraseña.type === "password") {
        inputContraseña.type = "text";
        iconoVerContraseña.style.color = "#4CAF50"; // Cambiar color cuando la contraseña es visible
    } else {
        inputContraseña.type = "password";
        iconoVerContraseña.style.color = "#646e78"; // Restaurar el color original
    }
}