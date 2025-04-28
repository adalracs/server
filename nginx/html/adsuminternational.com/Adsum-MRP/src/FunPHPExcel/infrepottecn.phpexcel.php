<?php 
//	error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunPerSecNiv/fncfetchall.php';
	
	
	include '../FunPerPriNiv/pktblplanta.php';
	include '../FunPerPriNiv/pktblotestado.php';
	include '../FunPerPriNiv/pktblsistema.php';
	include '../FunPerPriNiv/pktblequipo.php';
	include '../FunPerPriNiv/pktbltipotrab.php';
	include '../FunPerPriNiv/pktbltarea.php';
	include '../FunPerPriNiv/pktblusuario.php';
	include '../FunPerPriNiv/pktbltipomant.php';
	include '../FunGen/cargainput.php';
	
	
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
	
	
	$subSql = '';
	//******************************************************************
	if(empty($arrusuaplanta)) $arrusuaplanta = $usuaplanta;
	if(empty($arrusuatipotrab)) $arrusuatipotrab = $usuatipotrab;
	if(!empty($lsttecnico)) $subSql = "AND usuariotareot.usuacodi IN ({$lsttecnico})" ;
	
	$idcon = fncconn();
	
	$sbSql = "	SELECT ot.plantacodigo, planta.plantanombre, MAX(tareot.tareotsecuen) 
				FROM ot 
					LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
					LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
					LEFT JOIN planta ON planta.plantacodigo = ot.plantacodigo
				WHERE ot.plantacodigo IN ({$arrusuaplanta}) AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab}) {$subSql}
				GROUP BY ot.plantacodigo, planta.plantanombre";
	$rsOt = fncsqlrun($sbSql, $idcon);
	$nrOt = fncnumreg($rsOt);
	($nrOt > 0) ? $rwOtAll = fncfetchall($rsOt) : $rwOtAll = null; 

	if(!$lsttecnico):
		for($a = 0; $a < $nrOt; $a++):
			$arrTotaltipos = array();
		
			if($sheet > 0) $objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr(strtoupper($rwOtAll[$a]['plantanombre']),0,30));
		
			$objPHPExcel->getActiveSheet()->setCellValue('A1', '# Orden')->getStyle('A1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Sistema')->getStyle('B1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Equipo')->getStyle('C1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Mantenimiento')->getStyle('D1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tipo trabajo')->getStyle('E1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tarea')->getStyle('F1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Fecha inicio')->getStyle('G1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Encargado')->getStyle('H1')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB("FF1F497D");
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(3);
			
		
			$sbSql = "	SELECT ot.*, tareot.tiptracodigo, tareot.tareacodigo, usuariotareot.usuacodi AS encargado 
					FROM ot 
						LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
						LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
					WHERE ot.plantacodigo = '{$rwOtAll[$a]['plantacodigo']}' AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab})
						AND tareot.tareotsecuen = '0' AND usuariotareot.usutarlider = 't'
					ORDER BY tiptracodigo";

			$rsOttipo = fncsqlrun($sbSql, $idcon);
			$nrOttipo = fncnumreg($rsOttipo);
			
			
			
			//Content: LIST ROWS
			for($b = 0; $b < $nrOttipo; $b++):
				$rwOttipo = fncfetch($rsOttipo, $b);
				
				$arrTotaltipos[$rwOttipo['tiptracodigo']]++;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.($b + 3), $rwOttipo['ordtracodigo'])->getStyle('A'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($b + 3), cargasistemnombre($rwOttipo['sistemcodigo'], $idcon))->getStyle('B'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($b + 3), cargaequiponombre($rwOttipo['equipocodigo'], $idcon))->getStyle('C'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($b + 3), cargatipmannombre1($rwOttipo['tipmancodigo'], $idcon))->getStyle('D'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($b + 3), cargatiptrabnombre($rwOttipo['tiptracodigo'], $idcon))->getStyle('E'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.($b + 3), cargatareanombre1($rwOttipo['tareacodigo'], $idcon))->getStyle('F'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.($b + 3), date("Y-m-d",strtotime($rwOttipo['ordtrafecini'])))->getStyle('G'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.($b + 3), cargausuanombre($rwOttipo['encargado'], $idcon))->getStyle('H'.($b + 3))->applyFromArray($styleArray);
			endfor;
			
			$objPHPExcel->getActiveSheet()->getStyle('A3:H'.(2 + $nrOttipo))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:H'.(2 + $nrOttipo))->getFill()->getStartColor()->setARGB('FFDAEEF3');
			
			$objPHPExcel->getActiveSheet()->getRowDimension($nrOttipo + 3)->setRowHeight(3);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->setCellValue('A'.($nrOttipo + 4), 'Total Ordenes '.$nrOttipo)->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFont()->setBold(true);
			
			
			$c = 0;
			foreach($arrTotaltipos AS $key => $value):
				$objPHPExcel->getActiveSheet()->mergeCells('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->setCellValue('A'.($nrOttipo + 7 + $c), cargatiptrabnombre($key, $idcon))->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFill()->getStartColor()->setARGB('FFC5D9F1');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFont()->getColor()->setARGB("FF1F497D");
				
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($nrOttipo + 7 + $c), $value.' Ot(s)')->getStyle('D'.($nrOttipo + 7 + $c))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($nrOttipo + 7 + $c))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($nrOttipo + 7 + $c))->getFill()->getStartColor()->setARGB('FFDAEEF3');
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':D'.($nrOttipo + 7 + $c))->getFont()->setBold(true);
				
				$c++;
			endforeach;
			
			$objPHPExcel->getActiveSheet()->setShowGridlines(false);
			$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			
			$sheet++;
		endfor;
		//Content: Column Head
		
	else:
		$arrTecnico = explode(',', $lsttecnico);
	
		for($a = 0; $a < count($arrTecnico); $a++):
			$arrTotaltipos = array();
		
			if($sheet > 0) $objPHPExcel->createSheet();
			$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr('FUNCIONARIO '.strtoupper(cargausuanombre($arrTecnico[$a], $idcon)),0,30));
		
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1', '# Orden')->getStyle('A1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Planta')->getStyle('B1')->applyFromArray($styleArray);
//			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Sistema')->getStyle('C1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Equipo')->getStyle('C1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Mantenimiento')->getStyle('D1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tipo trabajo')->getStyle('E1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tarea')->getStyle('F1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Fecha inicio')->getStyle('G1')->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Asignado como:')->getStyle('H1')->applyFromArray($styleArray);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->getColor()->setARGB("FF1F497D");
			$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(3);
			
			//DB
			$sbSql = "	SELECT ot.*, tareot.tiptracodigo, tareot.tareacodigo, usuariotareot.usutarlider 
						FROM ot 
							LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
							LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
						WHERE ot.plantacodigo IN ({$arrusuaplanta}) AND ot.ordtrafecini BETWEEN '{$consulfecini}' AND '{$consulfecfin}' AND tareot.tiptracodigo IN ({$arrusuatipotrab})
							AND tareot.tareotsecuen = (SELECT max(tareot.tareotsecuen) FROM tareot WHERE tareot.ordtracodigo = ot.ordtracodigo)
							AND usuariotareot.usuacodi = '$arrTecnico[$a]'
						ORDER BY tiptracodigo, plantacodigo";	

			
			
			$rsOttipo = fncsqlrun($sbSql, $idcon);
			$nrOttipo = fncnumreg($rsOttipo);

			for($b = 0; $b < $nrOttipo; $b++):
				$rwOttipo = fncfetch($rsOttipo, $b);
				($rwOttipo['usutarlider'] == 't') ? $como = 'ENCARGADO' : $como = 'AUXILIAR';				
				
				$arrTotaltipos[$rwOttipo['tiptracodigo']]++;
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.($b + 3), $rwOttipo['ordtracodigo'])->getStyle('A'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($b + 3), cargaplantanombre($rwOttipo['plantacodigo'], $idcon))->getStyle('B'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($b + 3), cargaequiponombre($rwOttipo['equipocodigo'], $idcon))->getStyle('C'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($b + 3), cargatipmannombre1($rwOttipo['tipmancodigo'], $idcon))->getStyle('D'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($b + 3), cargatiptrabnombre($rwOttipo['tiptracodigo'], $idcon))->getStyle('E'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.($b + 3), cargatareanombre1($rwOttipo['tareacodigo'], $idcon))->getStyle('F'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.($b + 3), date("Y-m-d",strtotime($rwOttipo['ordtrafecini'])))->getStyle('G'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.($b + 3), $como)->getStyle('H'.($b + 3))->applyFromArray($styleArray);
			endfor;
			
			$objPHPExcel->getActiveSheet()->getStyle('A3:H'.(2 + $nrOttipo))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:H'.(2 + $nrOttipo))->getFill()->getStartColor()->setARGB('FFDAEEF3');
			
			$objPHPExcel->getActiveSheet()->getRowDimension($nrOttipo + 3)->setRowHeight(3);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->setCellValue('A'.($nrOttipo + 4), 'Total Ordenes '.$nrOttipo)->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 4).':H'.($nrOttipo + 4))->getFont()->setBold(true);
			
			
			$c = 0;
			foreach($arrTotaltipos AS $key => $value):
				$objPHPExcel->getActiveSheet()->mergeCells('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->setCellValue('A'.($nrOttipo + 7 + $c), cargatiptrabnombre($key, $idcon))->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->applyFromArray($styleArray);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFill()->getStartColor()->setARGB('FFC5D9F1');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':C'.($nrOttipo + 7 + $c))->getFont()->getColor()->setARGB("FF1F497D");
				
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($nrOttipo + 7 + $c), $value.' Ot(s)')->getStyle('D'.($nrOttipo + 7 + $c))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($nrOttipo + 7 + $c))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
				$objPHPExcel->getActiveSheet()->getStyle('D'.($nrOttipo + 7 + $c))->getFill()->getStartColor()->setARGB('FFDAEEF3');
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($nrOttipo + 7 + $c).':D'.($nrOttipo + 7 + $c))->getFont()->setBold(true);
				
				$c++;
			endforeach;
			
			
			$objPHPExcel->getActiveSheet()->setShowGridlines(false);
			$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			
			
			$sheet++;
		endfor;
	endif;
		
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_InfOrdenEjecutado.xls');
	
	echo 'ADM_InfOrdenEjecutado.xls';