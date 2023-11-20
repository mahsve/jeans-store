<?php
require_once 'conexion.php';

class Cliente extends conexion
{
    public function Cliente ()
    {
        $this->conexion();
    }

    public function registrarCliente ($cedula,$nombre,$direccion)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "INSERT INTO clientes (cedula, nombres, direccion) VALUES ('$cedula','$nombre','$direccion')";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            return false;
        }

        mysqli_close($consulta);
        return true;
    }

    public function consultarCliente ($cedula)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT * FROM clientes WHERE cedula='$cedula'";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);
            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);
        return $array;
    }

    public function modificarCliente ($cedula,$nombre,$direccion,$cedula2)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "UPDATE clientes SET cedula='$cedula', nombres='$nombre', direccion='$direccion' WHERE cedula='$cedula2'";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            return false;
        }

        $sql = "SELECT * FROM clientes WHERE cedula='$cedula'";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);
            mysqli_free_result($resultado);
        } else {
            return false;
        }

        return $array;

        mysqli_close($consulta);
        return true;
    }

    public function bajaCliente ($cedula)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "UPDATE clientes SET estatus='I' WHERE cedula='$cedula'";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            return false;
        }

        mysqli_close($consulta);
        return true;
    }

    public function altaCliente ($cedula)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "UPDATE clientes SET estatus='A' WHERE cedula='$cedula'";
        if (!$resultado = mysqli_query($consulta, $sql)) {
            return false;
        }

        mysqli_close($consulta);
        return true;
    }
}