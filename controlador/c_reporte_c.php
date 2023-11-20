<?php 
require_once '../modelo/m_reporte_c.php';

$reporte = new Reporte();

if (isset($_POST['orden']) and $_POST['orden'] != "") {
    $orden = $_POST['orden'];
} else {
    $orden = 1;
}

$reporte->crearReporte($orden);