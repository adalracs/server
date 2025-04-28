<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre: 		  detallaotprint.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 14-JUN-2006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunPerSecNiv/fncconn.php');
include('../src/FunPerSecNiv/fncnumreg.php');
include('../src/FunPerSecNiv/fncfetch.php');
include('../src/FunGen/fncprintprogramacion.php');
include('../src/FunGen/fnccargapresentac.php');
include( '../src/FunPerPriNiv/pktblusuariotareot.php');
include( '../src/FunPerPriNiv/pktblprogramacion.php');
include( '../src/FunPerPriNiv/pktbltipotrab.php');
include( '../src/FunPerPriNiv/pktblpriorida.php');
include( '../src/FunPerPriNiv/pktblusuario.php');
include( '../src/FunPerPriNiv/pktbltareot.php');
include( '../src/FunPerPriNiv/pktbltarea.php');
include( '../src/FunPerPriNiv/pktblot.php');

ob_start();
fncprintprogramacion($progracodigo);
$html = ob_get_contents();
ob_end_clean();

// ---
$date = date('Y-m-d');
//// Cadena que contiene los datos de la programacion(HTML)
$pdf = new HTML2FPDF('L', 'mm', 'LEGAL');
$pdf->SetRightMargin(3);
$pdf->AddPage('L');
//----------------------------------------------------------------
$pdf->Image(fnccargapresentac(3), 10, 10, 57, 15);
$pdf->WriteHTML("<CENTER><H3>Adsum CMMS</H3></CENTER>");
$pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>");
//$pdf->WriteHTML("<hr color='Black' size='100%'>");
//----------------------------------------------------------------
//$pdf->WriteHTML("<BR />");
//$pdf->WriteHTML($pdf->rMargin);
$pdf->WriteHTML($html);
$pdf->Output("PROGRAMM_".$date.'.pdf', 'I');

?>