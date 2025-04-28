<?php 
	error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include ('../../def/configvarphp.php');
	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	
	include ( '../FunPerPriNiv/pktblflujcajainfra.php');
	
	include '../FunPerPriNiv/pktblflujoejecutado.php';
	include '../FunPerPriNiv/pktblrecaudo.php';
	include '../FunPerPriNiv/pktblippipc.php';
	include '../FunPerPriNiv/pktblenergia.php';
	include '../FunPerPriNiv/pktblenergiaexccom.php';
	include '../FunPerPriNiv/pktbldatos.php';
	include '../FunPerPriNiv/pktbldatosentrada.php';
	include '../FunPerPriNiv/pktblexphurtcpl.php';
	include '../FunPerPriNiv/pktblpodaarboles.php';
	include '../FunPerPriNiv/pktblcrecsap.php';
	include '../FunPerPriNiv/pktbldtfsemana.php';
	include '../FunGen/fncformat.php';
	//----
	include '../FunPerPriNiv/pktblflujejecdetalle.php';
	include '../FunjQuery/jquery.phpscripts/jquery.flucajalib.php';
	
	include 'Classes/PHPExcel.php';
	require 'Classes/PHPExcel/Writer/Excel5.php';
	

	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Tahoma');
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10); 
	
	$uploaddir = '../../temp/';
	$sheet = 0;
	$styleArray = array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => 'FF92CDDC'),
			),
		),
	);
				

	$objPHPExcel->setActiveSheetIndex(0)->setTitle(substr('FLUJO CAJA LIBRE',0,30));

	//Conf: Column Head
	//Var
	$key = array('','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$keycol = array();
	$indicador = 0;
	
	//Conf: Column Head
	for($a = 0; $a <= count($ar_date); $a++):
		$keycol[] = $key[$inidicador].$key[$a+1];
		
		if(($a % 26) == 0) 	$indicador++;
	endfor;
	//Conf: Column Head
	
	//Content: Column Head
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].'1', 'Cuenta')->getStyle($keycol[0].'1')->applyFromArray($styleArray);
	
	for($a = 0; $a < count($ar_date); $a++)
		if(date('Y', strtotime($ar_date[$a])) >= 2000) $objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].'1', $arr_mes[date('n', strtotime($ar_date[$a])) - 1].'-'.date('Y', strtotime($ar_date[$a])))->getStyle($keycol[$a+1].'1')->applyFromArray($styleArray);
		
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$keycol[count($ar_date)].'1')->getFont()->setBold(true);
	
	
	//Content: Column Head		
	//Var
	$row = 2;
		
	//Content: Counts :: Session A
	foreach($a_session as $value):
		switch ($value):
			case 'pgoblc': $label = 'Pago Obligaciones'; break;
			case 'rtinvst': $label = 'Retorno Inversionista'; break;
			case 'valrtinvst_1':
			case 'valrtinvst_2':
			case 'valrtinvst_3':
			case 'Cont2355_a': $label = ''; break;
			case 'valrtinvst': $label = 'Validacion Retorno Inversionista'; break;
			default: $label = $value; break;
		endswitch;	

		$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, $label)->getStyle($keycol[0].$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
		
		
		for($a = 0; $a < count($ar_date); $a++):
			if(date('Y', strtotime($ar_date[$a])) >= 2000):
				($ar_count[$value][$a]) ? $datValue = round($ar_count[$value][$a]) : $datValue = 0;
				$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
			endif;
		endfor;
		
		$row++;
	endforeach;
	//Content: Counts :: Session A
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
		
	//Ingresos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Ingresos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
							
	for($a = 0; $a < count($ar_date); $a++):
		$rest = 0;
										
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-01-01'))):
			$ingresos[$a] = $ar_count[2105][$a] + $ar_count[3140][$a] + $ar_count[4125][$a] + $ar_count[4205][$a];
		elseif($ar_date[$a] < date('Y-m-d', strtotime('2002-12-01'))):
			$ingresos[$a] = $ar_count[2105][$a] + $ar_count[3140][$a] + $ar_count[4125][$a] + $ar_count[4205][$a] - ($ar_count[2105][$a-1] + $ar_count[3140][$a-1]);
		else:
			if($ar_count[2105][$a] > $ar_count[2105][$a-1])
				$rest = $ar_count[2105][$a] - $ar_count[2105][$a-1];
			
			$ingresos[$a] = $ar_count[4125][$a] + $ar_count[4205][$a] + ($ar_count[3140][$a] - $ar_count[3140][$a-1]) + $rest;
		endif;
								
//		if($ar_date[$a] == date('Y-m-d', strtotime('2008-06-01')))
//			$ingresos[$a] -= (1757305240.91177); //Ajuste Retorno inversionista;
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ingresos[$a]) ? $datValue = round($ingresos[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Ingresos	
	$row++;
	
	//Egresos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Egresos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$rest = 0;
										
		$part1 = $ar_count[1255][$a] + $ar_count[1505][$a] + $ar_count[171005][$a] +
				($ar_count[5105][$a] + $ar_count[5115][$a] + $ar_count[5120][$a] + $ar_count[5135][$a] + 
				$ar_count[5145][$a] + $ar_count[5160][$a] + $ar_count[5195][$a] + $ar_count[5205][$a] + 
				$ar_count[5215][$a] + $ar_count[5230][$a] + $ar_count[5235][$a] + $ar_count[5245][$a] +
				$ar_count[5250][$a] + $ar_count[5265][$a] + $ar_count[5295][$a] + $ar_count[5305][$a] +
				$ar_count[5315][$a] + $ar_count[6135][$a]) - $ar_count[5160][$a] - $ar_count[5265][$a];

		if($ar_date[$a] == date('Y-m-d', strtotime('2000-12-01')))
			$egresos[$a] = $part1 - $ar_count[235505][$a];
		elseif($ar_date[$a] >= date('Y-m-d', strtotime('2001-06-01')))
		{
			$part1 = $part1 - $ar_count[1505][$a-1] - $ar_count[171005][$a-1] + $ar_count['pgoblc'][$a] - 
					$ar_count[1255][$a-1] - $ar_count[235505][$a] + $ar_count[235505][$a-1];
											
//		if($ar_date[$a] > date('Y-m-d', strtotime('2005-12-01')))
//			$part1 = $part1 + $ar_count['rtinvst'][$a];
											
			$egresos[$a] = $part1;
		}
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($egresos[$a]) ? $datValue = round($egresos[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Egresos	
	$row++;
	
	//Disponible
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$disponible[$a] = $ingresos[$a] - $egresos[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($disponible[$a]) ? $datValue = round($disponible[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Disponible	
	$row++;

	//Caja
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$valtot -= $caja[$a - 1];
		$valtoth += $caja[$a - 1];
	
		if($ar_date[$a] < date('Y-m-d', strtotime('2002-01-01'))):
		
			$caja[$a] =  $ar_count[1120][$a] + $valtot;
		else:
			$caja[$a] = $ar_count[1120][$a] - $valtoth;
		endif;

//		$caja[$a] = $ar_count[1120][$a] - $decr;
//		$decr += $ar_count[1120][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($caja[$a]) ? $datValue = round($caja[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Caja	
	$row++;

	//Diferencia
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$diferencia[$a] = $disponible[$a] - $caja[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($diferencia[$a]) ? $datValue = round($diferencia[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Diferencia	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	//Caja Final
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Final')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$cajafinal[$a] = $cajafinal[$a-1] + $disponible[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($cajafinal[$a]) ? $datValue = round($cajafinal[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	
	//Caja Final	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	
	//Content: Counts :: Session B
	foreach($b_session as $value):
		$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, $value)->getStyle($keycol[0].$row)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
		for($a = 0; $a < count($ar_date); $a++):
			if(date('Y', strtotime($ar_date[$a])) >= 2000):
				($ar_countt[$value][$a]) ? $datValue = round($ar_countt[$value][$a]) : $datValue = 0;
				$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
			endif;
		endfor;
		
		$row++;
	endforeach;
	//Content: Counts :: Session B
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'FLUJO DE CAJA');
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	
	$exrow = $row;
	
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row.':'.$keycol[count($ar_date)].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');

	$row++;
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
	
	
	
	//Utilidad Operativa
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Utilidad Operativa')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] =  $ar_count[4125][$a] - $ar_countt[51][$a] - $ar_countt[52][$a] - $ar_count[6135][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($geneinter[$a]) ? $datValue = round($geneinter[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Utilidad Operativa	
	$row++;

	//Mas : Depreciacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Depreciacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5160][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ar_count[5160][$a]) ? $datValue = round($ar_count[5160][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Depreciacion
	$row++;

	//Mas : Amortizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Amortizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5265][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($ar_count[5265][$a]) ? $datValue = round($ar_count[5265][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Amortizacion
	$row++;

	//Mas : Provisiones
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Provisiones')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Provisiones
	$row++;

	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Generacion Interna
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Generacion Interna')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$geneinter[$a] += $ar_count[5265][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($geneinter[$a]) ? $datValue = round($geneinter[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Generacion Interna
	$row++;

	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Capital de Trabajo
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Capital de Trabajo')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Capital de Trabajo
	$row++;

	//Mas : Cartera Nacional
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Cartera Nacional')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Cartera Nacional
	$row++;

	//Mas : Inventarios Operacionales
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Inventarios Operacionales')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Inventarios Operacionales
	$row++;
	
	//Menos : Proveedores
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Menos : Proveedores')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$menprovee[$a] += 0 - ($ar_count[235505][$a] - $ar_count[235505][$a - 1]);
		$print = $ar_count[235505][$a] - $ar_count[235505][$a - 1];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			($print) ? $datValue = round($print) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Menos : Proveedores
	$row++;

	//Mas : Impuestos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Impuestos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Impuestos
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Total Capital de Trabajo
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Total Capital de Trabajo')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($menprovee[$a]) ? $datValue = round($menprovee[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Total Capital de Trabajo
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Otras Fuentes - Otros Usos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Otras Fuentes - Otros Usos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Otras Fuentes - Otros Usos
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Disponible Para Inversion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible Para Inversion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$disparinv[$a] =  $geneinter[$a] - $menprovee[$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($disparinv[$a]) ? $datValue = round($disparinv[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Disponible Para Inversion
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Inversion Activos Fijos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Inversion Activos Fijos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$invactfijo[$a] += $ar_count[1505][$a] - $invactfijo[$a-1];
		else
			$invactfijo[$a] += $ar_count[1505][$a] - $ar_count[1505][$a-1];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($invactfijo[$a]) ? $datValue = round($invactfijo[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Inversion Activos Fijos
	$row++;
		
	//Inversiones Permanentes
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Inversiones Permanentes')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($ar_count[1255][$a]) ? $datValue = round($ar_count[1255][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Inversiones Permanentes
	$row++;
								
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
			
	//Flujo de Caja Libre
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo de Caja Libre')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujcajalibr[$a] = $disparinv[$a] - $invactfijo[$a] - $ar_count[1255][$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujcajalibr[$a]) ? $datValue = round($flujcajalibr[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Flujo de Caja Libre
	$row++;				
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Menos : Pago de Intereses
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Menos : Pago de Intereses')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($ar_count[5305][$a]) ? $datValue = round($ar_count[5305][$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Menos : Pago de Intereses
	$row++;

	//Mas : Incremento Obligaciones
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Incremento Obligaciones')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$masincrobli[$a] += $ar_count[2105][$a] - $masincrobli[$a-1];
		else
			$masincrobli[$a] += $ar_count[2105][$a] - $ar_count[2105][$a-1];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($masincrobli[$a]) ? $datValue = round($masincrobli[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Incremento Obligaciones
	$row++;

	//Mas : Ing (Egr) no Operacionales
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Ing (Egr) no Operacionales')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$masingegroper[$a] += $ar_countt[42][$a] -  $ar_count[5315][$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($masingegroper[$a]) ? $datValue = round($masingegroper[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Incremento Obligaciones
	$row++;
	
	//Mas : Otros
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Mas : Otros')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Mas : Otros
	$row++;
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells

	//Total Flujo Financiero
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Total Flujo Financiero')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$totaflujfina[$a] = $masincrobli[$a] - $ar_count[5305][$a] + $masingegroper[$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($totaflujfina[$a]) ? $datValue = round($totaflujfina[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Total Flujo Financiero
	$row++;
									
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
	
	//Variacion Otras Cuentas Patrimonio
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Variacion Otras Cuentas Patrimonio')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($varotrcuepat[$a]) ? $datValue = round($varotrcuepat[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Variacion Otras Cuentas Patrimonio
	$row++;
										
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Flujo de Caja para Utilizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo de Caja para Utilizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujcajautil[$a] = $flujcajalibr[$a] + $totaflujfina[$a] + $varotrcuepat[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujcajautil[$a]) ? $datValue = round($flujcajautil[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Flujo de Caja para Utilizacion
	$row++;
											
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
		
	//Reparto de Dividendos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Reparto de Dividendos')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000):
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, 0)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Reparto de Dividendos
	$row++;
			
	//Capitalizacion
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Capitalizacion')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y-m', strtotime($ar_date[$a])) == '2009-12') 
			$capitaliza[$a] =  -5768009885;
		elseif(date('Y-m', strtotime($ar_date[$a])) < '2009-12')
			$capitaliza[$a] += $ar_count[3140][$a] -  $ar_count[3140][$a-1];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($capitaliza[$a]) ? $datValue = round($capitaliza[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Capitalizacion
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	//Space: Meger Cells
	
	//Reparto de Dividendos
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, '')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
						
	for($a = 0; $a < count($ar_date); $a++)
		if(date('Y', strtotime($ar_date[$a])) >= 2000) $objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $arr_mes[date('n', strtotime($ar_date[$a])) - 1].'-'.date('Y', strtotime($ar_date[$a])))->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':'.$keycol[count($ar_date)].$row)->getFont()->setBold(true);
	
	//Reparto de Dividendos
	$row++;
	
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
				
	//Flujo Neto
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Flujo Neto')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$flujoneto[$a] = $flujcajautil[$a] + $capitaliza[$a];
	
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($flujoneto[$a]) ? $datValue = round($flujoneto[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Flujo Neto
	$row++;
		
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(3);
	$row++;
	//Space: Meger Cells
				
	//Caja Inicial
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Inicial')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if($ar_date[$a] < date('Y-m-d', strtotime('2001-06-30')))
			$cajaini[$a] += $flujoneto[$a-1];
		else
			$cajaini[$a] += $flujoneto[$a-1] + $cajaini[$a-1];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($cajaini[$a]) ? $datValue = round($cajaini[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFDAEEF3');
		endif;
	endfor;
	//Caja Inicial
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
				
	//Caja Final
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Caja Final')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');
						
	for($a = 0; $a < count($ar_date); $a++):
		$total = $flujoneto[$a] + $cajaini[$a];

		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($total) ? $datValue = round($total) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FF4F81BD');
		endif;
	endfor;
	//Caja Final
	$exrow_to = $row;
	
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$row++;
	//Space: Meger Cells
				
	//Disponible Balance
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Disponible Balance')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($cajafinal[$a]) ? $datValue = round($cajafinal[$a]) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Disponible Balance
	$row++;
	
	//Space: Meger Cells
	$objPHPExcel->getActiveSheet()->mergeCells($keycol[0].$row.':'.$keycol[count($ar_date)].$row);
	$objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(4);
	$row++;
	//Space: Meger Cells
					
	//Diferencia
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$difbalance = ($flujoneto[$a] + $cajaini[$a]) - $cajafinal[$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($difbalance) ? $datValue = round($difbalance) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Diferencia
	$row++;
					
	//Diferencia 2
	$objPHPExcel->getActiveSheet()->setCellValue($keycol[0].$row, 'Diferencia 2')->getStyle($keycol[0].$row)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
						
	for($a = 0; $a < count($ar_date); $a++):
		$difbalance = $cajafinal[$a] - $ar_count[1120][$a];
		
		if(date('Y', strtotime($ar_date[$a])) >= 2000): 
			($difbalance) ? $datValue = round($difbalance) : $datValue = 0;
			$objPHPExcel->getActiveSheet()->setCellValue($keycol[$a+1].$row, $datValue)->getStyle($keycol[$a+1].$row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle($keycol[$a+1].$row)->getFont()->getColor()->setARGB("FF1F497D");
		endif;
	endfor;
	//Diferencia 2
	$row++;
	
	
	foreach($keycol AS $filed)
		$objPHPExcel->getActiveSheet()->getColumnDimension($filed)->setAutoSize(true);
		
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
	$objPHPExcel->getActiveSheet()->getStyle()->applyFromArray($styleArray);
	
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$exrow)->getFont()->getColor()->setARGB("FFFFFFFF");
	$objPHPExcel->getActiveSheet()->getStyle($keycol[0].$exrow_to.':'.$keycol[count($ar_date)].$exrow_to)->getFont()->getColor()->setARGB("FFFFFFFF");
	$objPHPExcel->getActiveSheet()->getStyle('A2:'.$keycol[0].$row)->getFont()->setBold(true);
	
	
	
	
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->getColor()->setARGB("FF1F497D");
//	$objPHPExcel->getActiveSheet()->getStyle('A2:I'.($nrOttipo + 1))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
//	
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
//	$objPHPExcel->getActiveSheet()->getStyle('A2:I'.($nrOttipo + 1))->getFill()->getStartColor()->setARGB('FFDAEEF3');
//	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	
	
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_FlujoCajaLibre.xls');
	
	echo 'ADM_FlujoCajaLibre.xls';