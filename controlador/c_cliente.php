<?php 
require_once '../modelo/m_cliente.php';

$cliente = new Cliente();
$opcion = $_POST['opcion'];

if ($opcion == "registrar") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];

    $resultado = $cliente->registrarCliente($cedula,$nombre,$direccion);

    if ($resultado) {
        header('Location: ../vista/cliente.php?mensaje=registro_exitoso');
    } else {
        header('Location: ../vista/cliente.php?mensaje=registro_fallido');
    }
} else if ($opcion == "consultar") {
    $cedula = $_POST['cedula'];

    $resultado = $cliente->consultarCliente($cedula);

    if ($resultado) {
        header('Location: ../vista/cliente.php?cedula='.$resultado[0]."&nombre=".$resultado[1]."&direccion=".$resultado[2]."&estatus=".$resultado[3]);
    } else {
        header('Location: ../vista/cliente.php?mensaje=no_existe');
    }
} else if ($opcion == "modificar") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $cedula2 = $_POST['cedula2'];

    $resultado = $cliente->modificarCliente($cedula,$nombre,$direccion,$cedula2);

    if ($resultado) {
        header('Location: ../vista/cliente.php?mensaje=modificacion_exitosa&cedula='.$resultado[0]."&nombre=".$resultado[1]."&direccion=".$resultado[2]."&estatus=".$resultado[3]);
    } else {
        header('Location: ../vista/cliente.php?mensaje=modificacion_fallida');
    }
} else if ($opcion == "baja") {
    $cedula = $_POST['cedula'];

    $resultado = $cliente->bajaCliente($cedula);

    if ($resultado) {
        header('Location: ../vista/cliente.php?mensaje=baja_exitosa');
    } else {
        header('Location: ../vista/cliente.php?mensaje=baja_error');
    }
} else if ($opcion == "alta") {
    $cedula = $_POST['cedula'];

    $resultado = $cliente->altaCliente($cedula);

    if ($resultado) {
        header('Location: ../vista/cliente.php?mensaje=alta_exitosa');
    } else {
        header('Location: ../vista/cliente.php?mensaje=alta_error');
    }
} else {
    header('Location: ../vista/cliente.php?mensaje=error');
}