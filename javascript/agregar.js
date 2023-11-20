$(function () {
    // clicks
    $("#agregar").click(agregar);

    function agregar () {
        if ($("#cantidad").val() == "") {
            swal("Alerta","El campo cantidad no debe estar vacio.","warning");
        } else if (validarNumeros($("#cantidad").val()) == false) {
            swal("Alerta","El campo cantidad no debe tener letras.","warning");
        } else {
            $("#opcion").val("agregar");

            document.formulario.submit();
        }
    }

    if ($("#mensaje").length > 0) {
        if ($("#mensaje").attr("mensaje") == "exito_producto") {
            swal("Exito","Se agrego la cantidad exitosamente.","success");
        } else if ($("#mensaje").attr("mensaje") == "error_producto") {
            swal("Error","Error al agregar la cantidad.","error");
        } else {
            swal("Alerta",$("#mensaje").attr("mensaje"),"warning");
        }
    }

    /* ----------------------------------------- función para validar que solo tenga números ----------------------------------------- */
    function validarNumeros(numeros){
        if (/^([0-9])*$/.test(numeros)){
            return true;
        }
        else{
            return false;
        }
    }
});