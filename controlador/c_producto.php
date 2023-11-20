<?php 
require_once '../modelo/m_producto.php';

$producto = new Producto();
$opcion = $_POST['opcion'];

if ($opcion == "agregar") {
    $cantidad = $_POST['cantidad'];

    $resultado = $producto->agregarExistencia($cantidad);

    if ($resultado) {
        header('Location: ../vista/agregar.php?mensaje=exito_producto');
    } else {
        header('Location: ../vista/agregar.php?mensaje=error_producto');
    }
} else {
    header('Location: ../vista/cliente.php?mensaje=error');
}