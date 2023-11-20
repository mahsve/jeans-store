<?php 
require_once '../modelo/m_entrar.php';

$usuario = $_POST['usuario'];
$clave = sha1($_POST['clave']);

$login = new Entrar();
$datos = $login->consultarUsuario($usuario,$clave);

if ($datos) {
    if ($datos[2] == 'A') {
        session_start();
        $_SESSION['usuario'] = $datos[0];

        header('Location: ../vista');
    } else {
        header('Location: ../index.php?mensaje=usuario_inactivo');
    }
} else {
    header('Location: ../index.php?mensaje=error_usuario');
}