$(function () {
    $("#registrar").click(registrar);
    $("#consultar").click(consultar);
    $("#buscar").click(buscar);
    $("#cancelar").click(cancelar);
    $("#limpiar").click(limpiar);

    $("#cantidad").keyup(obtenerTotal);
    $("#precio").keyup(obtenerTotal);

    function registrar () {
        if ($("#cedula").val() == "") {
            swal("Alerta","El campo cedula no debe estar vacio.","warning");
        } else if (validarNumeros($("#cedula").val()) == false) {
            swal("Alerta","El campo cedula no debe tener letras.","warning");
        } else if ($("#nombre").val() == "") {
            swal("Alerta","El campo nombre no debe estar vacio.","warning");
        } else if (validarLetras($("#nombre").val()) == false) {
            swal("Alerta","El campo nombre no debe tener números.","warning");
        } else if ($("#direccion").val() == "") {
            swal("Alerta","El campo direccion no debe estar vacio.","warning");
        } else if ($("#cantidad").val() == "") {
            swal("Alerta","El campo cantidad no debe estar vacio.","warning");
        } else if (validarNumeros($("#cantidad").val()) == false) {
            swal("Alerta","El campo cantidad no debe tener letras.","warning");
        } else if ($("#precio").val() == "") {
            swal("Alerta","El campo precio no debe estar vacio.","warning");
        } else if (validarNumerosD($("#precio").val()) == false) {
            swal("Alerta","El campo precio no debe tener letras.","warning");
        } else {
            $("#opcion").val("registrar");

            document.formulario.submit();
        }
    }

    function consultar () {
        if ($("#numero").val() == "") {
            swal("Alerta","Escriba el número de factura.","warning");
        } else {
            $("#opcion").val("consultar");

            document.formulario.submit();
        }
    }

    function buscar () {
        if ($("#cedula").val() != "" || $("#nombre").val() != "") {
            if ($("#cedula").val() != "") {
                if (validarNumeros($("#cedula").val()) == false) {
                    swal('Atención','La cedula no puede tener letras.','warning');
                } else {
                    $("#opcion").val("buscar");
                    document.formulario.submit();
                }
            } else if ($("#nombre").val() != "") {
                if (validarLetras($("#nombre").val()) == false) {
                    swal('Atención','El nombre no puede tener números.','warning');
                } else {
                    $("#opcion").val("buscar");
                    document.formulario.submit();
                }
            }
        } else {
            swal('Atención','Escriba la cedula o en todo caso el nombre.','warning');
        }
    }

    function cancelar () {
        swal({
            title: "Cancelar Factura",
            text: "¿Estas seguro que quieres cancelar esta factura?\nSi la eliminar no habra vuelta atras.",
            icon: "warning",
            buttons: ["Cancelar", "Proceder"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $("#opcion").val("cancelar");

                document.formulario.submit();
            }
        });
    }

    if ($("#mensaje").length > 0) {
        if ($("#mensaje").attr("mensaje") == "error_cedula") {
            swal("Error","Cedula incorrecta o el cliente no esta registrado.","error");
        } else if ($("#mensaje").attr("mensaje") == "error_nombre") {
            swal("Error","El nombre esta mal o el cliente no esta registrado.","error");
        } else if ($("#mensaje").attr("mensaje") == "cliente_inactivo") {
            swal("Error","Cliente inactivo, debe dar de alta al cliente.","error");
        } else if ($("#mensaje").attr("mensaje") == "registro_exitoso") {
            swal("Exito","La factura se registro correctamente.","success");
        } else if ($("#mensaje").attr("mensaje") == "error_factura") {
            swal("Error","Ocurrio un error al registrar la factura.\n\nNo sobre pase existencia.","error");
        } else if ($("#mensaje").attr("mensaje") == "no_existe") {
            swal("Error","Esta factura no existe.","error");
        } else if ($("#mensaje").attr("mensaje") == "cancelado_exitosamente") {
            swal("Exito","La factura fue cancelada exitosamente","success");
        } else if ($("#mensaje").attr("mensaje") == "error_cancelar") {
            swal("Error","Ocurrio un error al cancelar la factura","error");
        } else {
            swal("Alerta",$("#mensaje").attr("mensaje"),"warning");
        }
    }

    function obtenerTotal () {
        var cantidad = $("#cantidad").val();
        var precio = $("#precio").val();
        var descuento;

        if (cantidad >= 4) {
            $("#descuento").val(30);
            descuento = 30;
        } else {
            $("#descuento").val('');
            descuento = 0;
        }

        var subtotal = cantidad*precio;
        $("#subtotal").val(subtotal);

        totalDescuento = subtotal*descuento/100;
        var total = subtotal-totalDescuento;
        $("#total").val(total);
    }

    function limpiar () {
        document.formulario.reset();
        $('input').removeAttr('value');
        $('textarea').text('');

        $( "#registrar").removeAttr('style');
        $( "#cancelar").remove();
    }

    if ($("#estatus").val() == 'C') {
        swal('Atención','Esta factura fue cancelada','info');
    }

    /* ----------------------------------------- función para validar que solo tenga letras ----------------------------------------- */
    function validarLetras(letras){
        if (/^([a-zA-Zá-úÁ-Ú .])*$/.test(letras)){
            return true;
        }
        else{
            return false;
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
    /* ----------------------------------------- función para validar que solo tenga números decimales ----------------------------------------- */
    function validarNumerosD(numeros){
        if (/^([0-9.])*$/.test(numeros)){
            return true;
        }
        else{
            return false;
        }
    }
});

