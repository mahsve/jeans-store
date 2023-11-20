<?php 
require_once '../modelo/m_factura.php';

$factura = new Factura();
$opcion = $_POST['opcion'];

if ($opcion == "registrar") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $descuento = $_POST['descuento'];

    $resultado = $factura->registrarFactura($cedula,$nombre,$direccion,$cantidad,$precio,$descuento);

    if ($resultado) {
        $rcantidad = $resultado[2];
        $rprecio = $resultado[4]; 
        $rdescuento = $resultado[5];

        $monto = $rcantidad*$rprecio;
        $totaldescuento = $monto*$rdescuento/100;

        $total = $monto-$totaldescuento;

        header('Location: ../vista/factura.php?mensaje=registro_exitoso&numero='.$resultado[0].'&cantidad='.$resultado[2].'&precio='.$resultado[4].'&subtotal='.$monto.'&descuento='.$resultado[5].'&total='.$total.'&estatus='.$resultado[6].'&cedula='.$resultado[7]."&nombre=".$resultado[8]."&direccion=".$resultado[9]);
    } else {
        header('Location: ../vista/factura.php?mensaje=error_factura');
    }
} else if ($opcion == "consultar") {
    $numero = $_POST['numero'];

    $resultado = $factura->consultarFactura($numero);

    if ($resultado) {
        $cantidad = $resultado[2];
        $precio = $resultado[4]; 
        $descuento = $resultado[5];

        $monto = $cantidad*$precio;
        $totaldescuento = $monto*$descuento/100;

        $total = $monto-$totaldescuento;

        header('Location: ../vista/factura.php?numero='.$resultado[0].'&cantidad='.$resultado[2].'&precio='.$resultado[4].'&subtotal='.$monto.'&descuento='.$resultado[5].'&total='.$total.'&estatus='.$resultado[6].'&cedula='.$resultado[7]."&nombre=".$resultado[8]."&direccion=".$resultado[9]);
    } else {
        header('Location: ../vista/factura.php?mensaje=no_existe');
    }
} else if ($opcion == "cancelar") {
    $numero = $_POST['numero'];

    $resultado = $factura->cancelarFactura($numero);

    if ($resultado) {
        header('Location: ../vista/factura.php?mensaje=cancelado_exitosamente');
    } else {
        header('Location: ../vista/factura.php?mensaje=error_cancelar');
    }

} else if ($opcion == "buscar") {
    if (isset($_POST['cedula']) or isset($_POST['nombre'])) {
        if ($_POST['cedula'] != "") {
            $buscar = $_POST['cedula'];
            $busqueda = 1;
        } else {
            $buscar = $_POST['nombre'];
            $busqueda = 2;
        }
    }

    $resultado = $factura->buscarCliente($buscar,$busqueda);

    if ($resultado) {
        if ($resultado[3] == 'I') {
            header('Location: ../vista/factura.php?mensaje=cliente_inactivo');
        } else {
            header('Location: ../vista/factura.php?cedula='.$resultado[0]."&nombre=".$resultado[1]."&direccion=".$resultado[2]);
        }
    } else {
        if ($busqueda == 1) {
            header('Location: ../vista/factura.php?mensaje=error_cedula');
        } else {
            header('Location: ../vista/factura.php?mensaje=error_nombre');
        }
    }
} else {
    header('Location: ../vista/cliente.php?mensaje=error');
}