<?php
 /* $Id cPDF.php,v1.0 2010/03/10 aedavies */ 
 require( 'fpdf/fpdf.php' );

class cPDF extends FPDF
{
 # Page header
 function Header()
 {
    global $comname;
    global $comaddr;
    global $comphone;
    global $comemail;
    global $logo;

    # Logo
    $this->Image( $logo ,2 ,2 ,33 );

    # Arial bold 15
    $this->SetFont( 'Arial' ,'B' ,15 );

    # Title
    $this->cell( 20 ); # Shift to right by 8cm
    $this->Cell( 0 ,10 ,$comname ,0 ,1 ,'C' );

    $this->Ln(10);
    $this->SetFont( 'Arial' ,'' ,8 );
    $this->MultiCell( 0 ,5 ,"$comaddr\n$comphone\n$comemail" ,0 );

    # Line break
    $this->Ln( 4 );
 }

 # Page footer
 function Footer()
 {
    # Position at 2.5 cm from bottom
    $this->SetY(-25);
    # Arial italic 8
    $this->SetFont('Arial','I',8);
    # Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,'C');
    $this->SetFont( 'Helvetica', 'I', 7 );
    $this->SetTextColor( 53, 53, 23 );
    $this->Cell(0,10,'(c)2010/11 Start Smart Ghana.',0,0,'C');
 }
}
?>
