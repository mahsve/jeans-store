$(function () {
    // Validaciones
    $("#iniciar").click(iniciarSesion);

    function iniciarSesion() {
        if($("#usuario").val() == "") {
            swal("Alerta","Debe escribir un nombre de usuario.","warning");
        } else if ($("#clave").val() == "") {
            swal("Alerta","Debe escribir una contraseña.","warning");
        } else {
            document.login.submit();
        }
    }

    if ($("#mensaje").length > 0) {
        if ($("#mensaje").attr("mensaje") == "error_usuario") {
            swal("Error","Usuario o contraseña incorrecta.","error");
        }else if ($("#mensaje").attr("mensaje") == "inicie_sesion") {
            swal("Error","Debe iniciar sesión.","warning");
        } else {
            swal("Alerta","Usuario inactivo","warning");
        }
    }
});