<?php
require_once 'conexion.php';

class Factura extends conexion
{
    public function Factura ()
    {
        $this->conexion();
    }

    public function consultarUltimaFactura ()
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT numero FROM factura ORDER BY numero DESC LIMIT 1";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);

            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);

        if ($array) {
            return $array[0]+1;
        } else {
            return 1;
        }
    }

    public function registrarFactura ($cedula,$nombre,$direccion,$cantidad,$precio,$descuento)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        mysqli_query($consulta, "START TRANSACTION");

        $sql = "SELECT * FROM clientes WHERE cedula='$cedula'";
        $resultado = mysqli_query($consulta, $sql);
        
        if (mysqli_num_rows($resultado) == 0) {
            $sql = "INSERT INTO clientes (cedula, nombres, direccion) VALUES ('$cedula','$nombre','$direccion')";
            if (!$resultado = mysqli_query($consulta, $sql)) {
                mysqli_rollback($consulta);
                return false;
            }
        }
        
        $sql = "SELECT existencia FROM producto WHERE codigo=1";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $fila = mysqli_fetch_row($resultado);
            $existencia = $fila[0];

            if ($existencia < $cantidad) {
                mysqli_rollback($consulta);
                return false;
            } else {
                $nuevaExistencia = $existencia-$cantidad;

                $sql = "UPDATE producto SET existencia='$nuevaExistencia' WHERE codigo=1";
                if (!$resultado = mysqli_query($consulta, $sql)) {
                    mysqli_rollback($consulta);
                    return false;
                }
            }
        }

        $sql = "INSERT INTO factura (cliente, cantidad, producto, precio, descuento) VALUES ('$cedula','$cantidad',1,'$precio','$descuento')";
        if (!mysqli_query($consulta, $sql)) {
            mysqli_rollback($consulta);
            return false;
        }
        $numeroFactura = mysqli_insert_id($consulta);
        mysqli_commit($consulta);

        $sql = "SELECT * FROM factura INNER JOIN clientes ON factura.cliente=clientes.cedula WHERE numero='$numeroFactura'";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);

            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);
        return $array;
    }

    public function consultarFactura ($numero) 
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "SELECT * FROM factura INNER JOIN clientes ON factura.cliente=clientes.cedula WHERE numero='$numero'";
        if ($resultado = mysqli_query($consulta, $sql)) {
            $array = mysqli_fetch_row($resultado);

            mysqli_free_result($resultado);
        } else {
            return false;
        }

        mysqli_close($consulta);
        return $array;
    }

    public function cancelarFactura ($factura)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        $sql = "UPDATE factura SET estatus='C' WHERE numero='$factura'";
        mysqli_query($consulta, $sql);
        if (mysqli_affected_rows($consulta) > 0) {
            $estado = true;
        } else {
            $estado = false;
        }

        mysqli_close($consulta);
        return $estado;
    }

    public function buscarCliente ($elemento,$busqueda)
    {
        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        if ($busqueda == 1) {
            $sql = "SELECT * FROM clientes WHERE cedula='$elemento'";
        } else {
            $sql = "SELECT * FROM clientes WHERE nombres='$elemento'";
        }
        
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