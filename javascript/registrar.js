$(function () {
    // Validaciones
    $("#registrar").click(registrar);

    function registrar() {
        if($("#usuario").val() == "") {
            swal("Alerta","Debe escribir un nombre de usuario.","warning");
        } else if ($("#clave1").val() == "") {
            swal("Alerta","Debe escribir una contraseña.","warning");
        } else if ($("#clave1").val().length < 6) {
            swal("Alerta","La contraseña debe tener minimo 6 digitos.","warning");
        } else if ($("#clave2").val() != $("#clave1").val()) {
            swal("Alerta","Las contraseñas no coinciden.","warning");
        } else {
            $("#opcion").val('registrar');
            
            document.registro.submit();
        }
    }

    if ($("#mensaje").length > 0) {
        if ($("#mensaje").attr("mensaje") == "claves_incorrectas") {
            swal("Error","Las contraseñas no coinciden, revise nuevamente.","error");
        } else if ($("#mensaje").attr("mensaje") == "registro_exitoso") {
            swal("Exito","El usuario se registro correctamente.","success");
        } else if ($("#mensaje").attr("mensaje") == "registro_fallido") {
            swal("Error","El usuario no se pudo registrar, tal vez ya este registrado.","error");
        } else {
            swal("Alerta","Error","warning");
        }
    }
});