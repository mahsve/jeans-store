$(function () {
    $("#generar").click(generar);

    function generar () {
        if (document.formulario.orden.value == "") {
            swal("Atención",'Escoja el orden de la lista','info');
        } else {
            document.formulario.submit();
        }
    }
});