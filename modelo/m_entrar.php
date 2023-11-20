<?php
require_once 'conexion.php';

class Entrar extends conexion
{
    public function Entrar ()
    {
        $this->conexion();
    }

    public function consultarUsuario ($usuario,$clave)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND clave='$clave'";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);
            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);
        return $array;
    }
}