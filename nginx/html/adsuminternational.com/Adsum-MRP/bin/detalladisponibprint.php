<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre:		detalladisponibprint.php
* Descripcion:  Convierte una cadena de HTML en PDF
*
* Fecha: 10052006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

// Convierte una orden de trabajo en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

$date = date('Y-m-d');
// Cadena que contiene los datos de el indicador "DISPONIBILIDAD" (HTML)
$html = $_SESSION['htmlreport'];

$pdf = new HTML2FPDF('P', 'mm', 'letter');
$pdf->AddPage('P');
$pdf->Image(fnccargapresentac(3), 10, 10, 30, 25);
$pdf->WriteHTML("<CENTER><H3>Adsum Kallpa</H3></CENTER>");
$pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>");
$pdf->WriteHTML("<hr color='Black'>");
$pdf->WriteHTML("<BR />");
$pdf->WriteHTML($html);
// Generacion del PDF
$pdf->Output("EQAV_".$date.'.pdf', 'I');
?>