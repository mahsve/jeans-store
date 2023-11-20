<?php require_once('../fpdf/fpdf.php');

class PDF extends FPDF{
    function Header(){
        $FechaActual = date('d/m/Y', time()); // guardamos la hora en una variable

        $this->Image('../imagenes/mujer-jeans-2.jpg',4,5,25,30);
        $this->Image('../imagenes/titulo.jpg',70,7,70,20);
        $this->Ln(23);
        $this->SetDrawColor(35,77,133);
        $this->Cell(0,2,'','B',1);
        $this->Ln(2);
    }

    function Footer(){
        $this->SetY(-15); 
        $this->SetFont('Arial','I',8);
        $this->Cell(160,5,'My Jeans Store','T',0,' ');
        $this->Cell(40,5,utf8_decode('Página ').$this->PageNo().'/{nb}','T',1,'R');
    }
}