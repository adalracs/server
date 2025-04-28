<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre:         detallareporte.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 14-JUN-2006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
* mstroh	 08102006    Implementacion de nuevo metodo para guardar el documento
* 						 PDF en la maquina cliente.
*
*/

// Convierte un reporte en PDF
require_once('../src/FunPrint/html2fpdf.php');
include('../src/FunGen/fnccargapresentac.php');

$date = date('Y-m-d');
// Cadena que contiene los datos del reporte (HTML)
$html = $_SESSION['htmlreport'];

$strsplitindex = strpos($html, "<tr>");
$reportHeader = substr($html, 0, $strsplitindex);
/**
 * Se utiliza una expresion regular para eliminar las etiquetas
 * HTML del encabezado de la tabla, y finalmente tener un acceso
 * mas facil a los datos necesarios del reporte.
 * ----
 * $arrDatReporte[0] = Nombre de la empresa
 * $arrDatReporte[1] = Presentacion de la empresa
 * $arrDatReporte[3] = Nombre del reporte
 * $arrDatReporte[5] = Fecha del reporte
 */
$arrDatReporte = preg_split('/<[^>]*>/i', $reportHeader, -1, PREG_SPLIT_NO_EMPTY);

$arrDatReporte[3] = preg_replace("/\s/", "&nbsp;", trim($arrDatReporte[3]));

for ( ; ; )
{
	$strEndSplit = strpos($html, "</tr>", $strsplitindex);

	for ($i=$strsplitindex; $i<($strEndSplit+5); $i++)
		$strHTMLRow .= $html{$i};

	$finalHTML[] = $strHTMLRow;
	unset($strHTMLRow);
	$strsplitindex = strpos($html, "<tr>", $strEndSplit);

	if ($strsplitindex === false)
		break;
}
ob_end_clean();
//-------------------------
$count = 0;
$numRows = count($finalHTML);
$tableTitle = $finalHTML[0];
// -- Inicio del documento PDF
$pdf = new HTML2FPDF('L', 'mm', 'letter');
$pdf->AddPage('L');
//$pdf->SetMargins(8, 17, 8);
$pdf->WriteHTML("<hr color='Black'>");
$pdf->WriteHTML("<b>".fnccargapresentac(4)."</b><br />");
$pdf->WriteHTML("Nombre: <b>Ot Equipos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Fecha Generado: <b>".trim($arrDatReporte[5])."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>Fecha Impresi&oacute;n:&nbsp;&nbsp;<b>$date</b><br/>");
$pdf->WriteHTML("&nbsp;&nbsp;&nbsp;&nbsp;Periodo Observado: <b>".trim($arrDatReporte[7])."</b><br/>");
$pdf->WriteHTML("<hr color='Black'><br />");
$pdf->WriteHTML("<table border='1' width='100%' align='center'>");

if ($numRows <= 25)
{
	for ($i=0; $i<($numRows-1); $i++)
	{
		$pdf->WriteHTML($finalHTML[$i]);
	}
	$pdf->WriteHTML("</table>");
}
else
{
	for ($i=0; $i<($numRows-1); $i++)
	{
		if ($i<30)
		{
			$pdf->WriteHTML($finalHTML[$i]);
		}
		elseif ($i == 25)
			$pdf->WriteHTML("</table>");
		else
		{
			if (!$count)
			{
				$pdf->WriteHTML("<table border='1' width='100%' align='center'>");
				$pdf->WriteHTML($tableTitle);
			}
			elseif ($count == 28)
			{
				$pdf->WriteHTML("</table>");
				$pdf->AddPage('L');
				$pdf->WriteHTML("<table border='1' width='100%' align='center'>");
				$pdf->WriteHTML($tableTitle);
				$count = 0;
			}
			$pdf->WriteHTML($finalHTML[$i]);
			$count += 1;
		}
	}
}
$pdf->WriteHTML("</table><br /><br />");
$pdf->WriteHTML("<table border='1' width='100%' align='center'>");
$pdf->WriteHTML($finalHTML[$numRows-1]);
$pdf->WriteHTML("</table>");
// Se envia el documento al navegador
$pdf->Output(strtoupper($arrDatReporte[3])."_".$date.'.pdf', 'I');
?>