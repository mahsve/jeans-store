<?php
require_once 'conexion.php';

class Registrar extends conexion
{
    public function Registrar ()
    {
        $this->conexion();
    }

    public function registrarUsuario ($usuario,$clave)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $clave = sha1($clave);

        $sql = "INSERT INTO usuario (usuario, clave) VALUES ('$usuario','$clave')";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            return false;
        }

        mysqli_close($consulta);
        return true;
    }
}