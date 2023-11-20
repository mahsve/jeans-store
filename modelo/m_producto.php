<?php
require_once 'conexion.php';

class Producto extends conexion
{
    public function Producto ()
    {
        $this->conexion();
    }

    public function agregarExistencia ($cantidad)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT existencia FROM producto WHERE codigo=1";
        if ($resultado = mysqli_query($consulta, $sql)) {
            if ($fila = mysqli_fetch_row($resultado)) {
                $existencia = $cantidad+$fila[0];
            } else {
                return false;
            }
        } else {
            return false;
        }

        $sql = "UPDATE producto SET existencia='$existencia' WHERE codigo=1";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            mysqli_rollback($consulta);
            return false;
        }

        mysqli_close($consulta);

        return true;
    }
}