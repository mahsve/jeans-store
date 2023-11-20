<?php 
require_once '../modelo/m_registrar.php';

$registrar = new Registrar();
$opcion = $_POST['opcion'];

if ($opcion == "registrar") {
    $usuario = $_POST['usuario'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2'];

    if ($clave1 != $clave2) {
        header('Location: ../registrar.php?mensaje=claves_incorrectas');
    } else {
        $resultado = $registrar->registrarUsuario($usuario,$clave1);

        if ($resultado) {
            header('Location: ../registrar.php?mensaje=registro_exitoso');
        } else {
            header('Location: ../registrar.php?mensaje=registro_fallido');
        }
    }
} else {
    header('Location: ../registrar.php?mensaje=error');
}