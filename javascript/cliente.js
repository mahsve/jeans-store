$(function () {
    // clicks
    $("#registrar").click(registrar);
    $("#consultar").click(consultar);
    $("#modificar").click(modificar);
    $("#baja").click(baja);
    $("#alta").click(alta);
    $("#limpiar").click(limpiar);

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
        } else {
            $("#opcion").val("registrar");

            document.formulario.submit();
        }
    }

    function consultar () {
        if ($("#cedula").val() == "") {
            swal("Alerta","El campo cedula no debe estar vacio.","warning");
        } else {
            $("#opcion").val("consultar");

            document.formulario.submit();
        }
    }

    function modificar () {
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
        } else {
            $("#opcion").val("modificar");

            document.formulario.submit();
        }
    }

    function baja () {
        if ($("#cedula").val() == "") {
            swal("Alerta","El campo cedula no debe estar vacio.","warning");
        } else {
            swal({
                title: "Dar de baja",
                text: "¿Estas seguro que quieres dar de baja este cliente?",
                icon: "warning",
                buttons: ["Cancelar", "Dar de baja"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#opcion").val("baja");

                    document.formulario.submit();
                }
            });
        }
    }

    function alta () {
        if ($("#cedula").val() == "") {
            swal("Alerta","El campo cedula no debe estar vacio.","warning");
        } else {
            swal({
                title: "Dar de alta",
                text: "¿Estas seguro que quieres dar de alta este cliente?",
                icon: "warning",
                buttons: ["Cancelar", "Dar de alta"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#opcion").val("alta");

                    document.formulario.submit();
                }
            });
        }
    }

    if ($("#mensaje").length > 0) {
        if ($("#mensaje").attr("mensaje") == "registro_exitoso") {
            swal("Exito","Cliente registrado con exito.","success");
        }else if ($("#mensaje").attr("mensaje") == "registro_fallido") {
            swal("Error","Registro fallido, tal vez ya se encuentra registrado.","error");
        } else if ($("#mensaje").attr("mensaje") == "no_existe") {
            swal("Error","El cliente no exite.","error");
        } else if ($("#mensaje").attr("mensaje") == "modificacion_exitosa") {
            swal("Exito","Se modifico correctamente.","success");
        } else if ($("#mensaje").attr("mensaje") == "baja_exitosa") {
            swal("Exito","El cliente esta inactivo.","success");
        } else if ($("#mensaje").attr("mensaje") == "baja_error") {
            swal("Error","Ocurrio un error al dar de baja.","error");
        } else if ($("#mensaje").attr("mensaje") == "alta_exitosa") {
            swal("Exito","El cliente esta activo.","success");
        } else if ($("#mensaje").attr("mensaje") == "alta_error") {
            swal("Error","Ocurrio un error al dar de alta.","error");
        } else {
            swal("Alerta",$("#mensaje").attr("mensaje"),"warning");
        }
    }

    function limpiar () {
        document.formulario.reset();
        $('input').removeAttr('value');
        $('textarea').text('');
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
});