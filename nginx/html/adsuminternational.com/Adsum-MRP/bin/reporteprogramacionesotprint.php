<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre:         detallaprogramacionesotprint.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 23-AUG-2007
* Autor: cbedoya
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
*
*/

//require_once('../src/FunPrint/tcpdf.php');
/*
 require_once('../src/FunPrint/html2fpdf.php');
 include('../src/FunGen/fnccargapresentac.php');
 
 
 	
 $date = date('Y-m-d');
 $pdf = new HTML2FPDF('L', 'mm', 'LETTER');
// $pdf-> SetRightMargin(3);
 $pdf->AddPage('L');
 //$pdf->SetFontSize(8);
//Encabesado normal del documento
 $pdf->Image(fnccargapresentac(3), 10, 10, 57, 15);
 $pdf-> WriteHTML("<CENTER><H3>Adsum CMMS</H3></CENTER>");
 $pdf->WriteHTML("<CENTER>".fnccargapresentac(4)."</CENTER>1");
 $pdf->WriteHTML("<hr color='Black'>");
 $pdf->WriteHTML("<BR />");
 //parte el archivo html en partes segun las tablas de calendario
 $posa=0;
 $posb=0;
 for ( ; ; ){
   $posb = strpos($html,'</th>',$posa) + 5;
	
   $parthtml=substr($html,$posa,$posb - $posa);
   $pdf->WriteHTML(trim($parthtml));
   $posa = strpos( $html,'<th scope="col">',$posb); 
	
   if ($posa === false){ break; } else { $pdf->AddPage('P'); }
 }
 $pdf-> Close();
 $pdf->Output("PROGRAMM_".$date.'.pdf','I');
*/
 $html=$_SESSION['htmlreport'];
?>
	<body>
	<div align="center" class="Estilo10">REPORTE</div>
	<p align="center">

<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=excel.xls"); 

	echo $html
/*
 
 //include('../src/FunGen/font/');
 include('../src/FunGen/fnccargapresentac.php');
 
 $html=$_SESSION['htmlreport']; 
 $pdf1=new TCPDF('P','mm','A4',true);
 //$pdf1->AliasNbPages();
 $pdf1->AddPage('P');
 $pdf1->SetAutoPageBreak(true,25);
//$pdf1->SetCompression(true);
 //$pdf1-> SetFont('Arial','',2);
/* 
	$pdf1->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf1->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf1->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf1->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf1->setImageScale(PDF_IMAGE_SCALE_RATIO); 
	$pdf1->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf1->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf1->setLanguageArray($l);
 */
 /*$pdf1->Image(fnccargapresentac(3),10,10,57,15);
 
 $pdf1->writeHTML("<CENTER><H3>Adsum CMMS</H3></CENTER>",true,0);
 $pdf1->writeHTML("<CENTER>".fnccargapresentac(4)."</CENTER>",true,0);
 $pdf1->writeHTML("<hr color='Black'>",true,0);
 $pdf1->WriteHTML("<BR />");

 $date = date('Y-m-d');
 
 //parte el archivo html en partes segun las tablas de calendario creados
 $posa=0;
 $posb=0;
 for ( ; ; ){
   $posb = strpos($html,'</th>',$posa) + 5;
	
   $parthtml=substr($html,$posa,$posb - $posa);
   $pdf1->WriteHTML(trim($parthtml),true,0);
   $posa = strpos( $html,'<th scope="col">',$posb); 
	
   if ($posa === false){ break; } else { $pdf1->AddPage('P'); }
 }
 $pdf1->Close();
 $pdf1->Output("PROGRAMM_".$date.'.pdf', '/root/');
 */
 ?>
