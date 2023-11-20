<?php
require_once 'conexion.php';

class Principal extends conexion
{
    public function Principal ()
    {
        $this->conexion();
    }

    public function Clientes ()
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT cedula FROM clientes";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $clientes = mysqli_num_rows($resultado);
        } else {
            $clientes = 0;
        }

        mysqli_close($consulta);
        return $clientes;
    }

    public function Facturas ()
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT numero FROM factura";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $facturas = mysqli_num_rows($resultado);
        } else {
            $facturas = 0;
        }

        mysqli_close($consulta);
        return $facturas;
    }

    public function Existencia ()
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
                $existencia = $fila[0];
            }
        }

        mysqli_close($consulta);
        return $existencia;
    }

    public function consultarFacturas () 
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $resultadoConsulta = [];

        $sql = "SELECT * FROM factura INNER JOIN clientes ON factura.cliente=clientes.cedula ORDER BY numero DESC LIMIT 10";
        if ($resultado = mysqli_query($consulta, $sql)) {
            while ($array = mysqli_fetch_row($resultado)) {
                $resultadoConsulta[] = $array;
            }

            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);
        return $resultadoConsulta;
    }
}