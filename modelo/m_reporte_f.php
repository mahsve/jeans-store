<?php
require_once 'conexion.php';

date_default_timezone_set("America/Caracas");

class Reporte extends conexion
{
    public function Reporte ()
    {
        $this->conexion();
    }

    public function crearReporte($orden)
    {
        include_once("m_estilo_pdf.php");
        $fecha = date('d/m/Y', time());
        
    	$pdf=new PDF('P','mm','Letter');
        $pdf->AliasNbPages();
    	$pdf->AddPage();
    
        $pdf->SetTextColor(35,77,133);
        $pdf->SetFont('Arial','BI',18);
        $pdf->Cell(0,8,'Lista de clientes',0,0,'C');

        $pdf->SetFont('Arial','',9);
        $pdf->Cell(0,8,$fecha,0,1,'R');

        $pdf->SetDrawColor(35,77,133);

        $pdf->Ln(2);
        $pdf->Cell(17,8,utf8_decode('Número'),1,0,'C');
        $pdf->Cell(17,8,utf8_decode('Cédula'),1,0,'C');
        $pdf->Cell(35,8,'Nombre y apellido',1,0,'C');
        $pdf->Cell(20,8,utf8_decode('Cantidad'),1,0,'C');
        $pdf->Cell(20,8,utf8_decode('Precio'),1,0,'C');
        $pdf->Cell(20,8,utf8_decode('Sub-total'),1,0,'C');
        $pdf->Cell(20,8,utf8_decode('Descuento'),1,0,'C');
        $pdf->Cell(20,8,utf8_decode('Total'),1,0,'C');

        $pdf->Cell(0,8,utf8_decode('Estatus'),1,1,'C');

        $datos = $this->getData();
        $consulta = mysqli_connect($datos['local'], $datos['user'], $datos['password'], $datos['base']);
        if (mysqli_connect_errno()) {
            echo "Conexión fallida: ".mysqli_connect_error();
            exit();
        }

        if ($orden == 1) {
            $sql = "SELECT * FROM factura INNER JOIN clientes ON factura.cliente=clientes.cedula ORDER BY numero DESC";
        } else {
            $sql = "SELECT * FROM factura INNER JOIN clientes ON factura.cliente=clientes.cedula";
        }
        
        if ($resultado = mysqli_query($consulta, $sql)) {
            $numero = mysqli_num_rows($resultado);
            
            while ($fila = mysqli_fetch_row($resultado)) {
                $pdf->Cell(17,8,$fila[0],1,0,'C');
                $pdf->Cell(17,8,$fila[7],1,0,'C');
                $pdf->Cell(35,8,$fila[8],1,0);
                $pdf->Cell(20,8,$fila[2],1,0,'C');
                $pdf->Cell(20,8,$fila[4],1,0,'C');

                $cantidad = $fila[2];
                $precio = $fila[4]; 
                $descuento = $fila[5];

                $monto = $cantidad*$precio;
                $totaldescuento = $monto*$descuento/100;

                $total = $monto-$totaldescuento;

                $pdf->Cell(20,8,$monto,1,0,'C');
                $pdf->Cell(20,8,$fila[5],1,0,'C');
                $pdf->Cell(20,8,$total,1,0,'C');

                if ($fila[6] == 'A') {
                    $pdf->Cell(0,8,'Procesado',1,1);
                } else {
                    $pdf->Cell(0,8,'Cancelado',1,1);
                }
            }

            if ($numero == 0) {
                $pdf->Cell(0,8,'No hay facturas registradas',1,1,'C');
            }

            mysqli_free_result($resultado);
        } else {
            $pdf->Cell(0,8,utf8_decode('Ocurrio un error, pruebe nuevamente.'),0,0,'C');
        }

        $pdf->Output();
    }
}
?>