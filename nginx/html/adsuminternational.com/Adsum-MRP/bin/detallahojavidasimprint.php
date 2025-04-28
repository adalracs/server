<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre:		detallahojavidasimprint.php
* Descripcion:  Convierte una cadena de HTML en PDF
*
* Fecha: 09122006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
*/

// Convierte una orden de trabajo en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

$date = date('Y-m-d');
// Cadena que contiene los datos de la hoja de vida del equipo (HTML)
$html = $_SESSION['htmlreport'];
$html_data = explode("|||", $html);
// $html_data[0] = Datos basicos del equipo
// $html_data[1] = Normas de seguridad, OT relacionadas
//				   al equipo, horas de paro de maquina.
// $html_data[2] = Codigo del equipo

// Pagina #1
$pdf = new HTML2FPDF('P', 'mm', 'letter');
$pdf->AddPage('P');
$pdf->Image(fnccargapresentac(3), 10, 10, 30, 25);
$pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>");
$pdf->WriteHTML("<CENTER><H3>Hoja de Vida</H3></CENTER>");
$pdf->WriteHTML("<TABLE BORDER='0' WIDTH='100%'>");
$pdf->WriteHTML($html_data[0]);
$pdf->WriteHTML("</TABLE>");
// Pagina #2
//$pdf->AddPage('P');
//$pdf->Image(fnccargapresentac(3), 10, 10, 57, 15);
//$pdf->WriteHTML("<CENTER><H3>Adsum CMMS</H3></CENTER>");
//$pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>");
$pdf->WriteHTML("<hr color='Black'>");
$pdf->WriteHTML("<BR />");
$pdf->WriteHTML("<TABLE BORDER='0' WIDTH='100%'>");
$pdf->WriteHTML($html_data[1]);
$pdf->WriteHTML("</TABLE>");
// Generacion del PDF
$pdf->Output("HVEQUIPO_{$html_data[2]}_".$date.'.pdf', 'I');
?>
