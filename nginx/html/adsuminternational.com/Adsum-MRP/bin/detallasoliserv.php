<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre: 		  detallasoliserv.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 14-JUN-2006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

// Convierte una solicitud de servicio en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

$date = date('Y-m-d');
// Cadena que contiene los datos de la solicitud de servicio (HTML)
$html = $_SESSION['htmlreport'];
$pdf = new HTML2FPDF('P', 'mm', 'letter');
$pdf->AddPage('P');
$pdf->SetMargins(10, 10, 8);
$pdf->Image(fnccargapresentac(3), 8, 18, 30, 25);
$pdf->WriteHTML("<CENTER><H3>Solicitud de Servicio</H3></CENTER>");
$pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>");
$pdf->WriteHTML("<hr color='Black'>");
$pdf->WriteHTML("<BR />");
$pdf->WriteHTML($html);
$pdf->Output("SS_".$date.'.pdf', 'I');
?>