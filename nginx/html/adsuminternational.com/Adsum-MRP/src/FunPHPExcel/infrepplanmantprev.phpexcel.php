<?php 
//	error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunPerSecNiv/fncfetchall.php';
	
	
	include '../FunPerPriNiv/pktblequipo.php';
	include '../FunPerPriNiv/pktbltipotrab.php';
	include '../FunPerPriNiv/pktbltarea.php';
	include '../FunPerPriNiv/pktblplanta.php';
	include '../FunPerPriNiv/pktblsistema.php';
	include '../FunPerPriNiv/pktbltipomedi.php';
	include '../FunPerPriNiv/pktbltipomant.php';
	include '../FunPerPriNiv/pktblpriorida.php';
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
	
	
	//******************************************************************
	$idcon = fncconn();
	$arrPlantas = explode(',', $arrplanta);
	
	for($a = 0; $a < count($arrPlantas); $a++)
	{
		if($sheet > 0) $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr(strtoupper(cargaplantanombre($arrPlantas[$a], $idcon)),0,30));
		
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID Prog.')->getStyle('A1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Sistema')->getStyle('B1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Codigo Equipo')->getStyle('C1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Equipo')->getStyle('C1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Mantenimiento')->getStyle('D1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tipo trabajo')->getStyle('E1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Tarea')->getStyle('F1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Descripcion')->getStyle('G1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Periodo')->getStyle('H1')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Prioridad')->getStyle('H1')->applyFromArray($styleArray);
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->getColor()->setARGB("FF1F497D");
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(3);		
	
		//DB
		$sbSql = "	SELECT programacion.*, tareot.tareacodigo, tareot.tiptracodigo, sistema.sistemnombre, equipo.equiponombre
					FROM planta 
						LEFT JOIN sistema ON sistema.plantacodigo = planta.plantacodigo
						LEFT JOIN equipo ON equipo.sistemcodigo = sistema.sistemcodigo
						LEFT JOIN programacion ON programacion.equipocodigo = equipo.equipocodigo
						LEFT JOIN tareot ON tareot.progracodigo = programacion.progracodigo 
					WHERE planta.plantacodigo = '{$arrPlantas[$a]}' AND tareot.ordtracodigo IS NULL AND programacion.prograacti = '1'";
		
		if($arrtipotrabajo) $sbSql .= " AND tareot.tiptracodigo IN ({$arrtipotrabajo})"; 
			
		$sbSql .= " ORDER BY tareot.tiptracodigo";
		
		$rsProgramacion = fncsqlrun($sbSql, $idcon);
		$nrProgramacion = fncnumreg($rsProgramacion);
			
		if($nrProgramacion > 0)
		{
			for($b = 0; $b < $nrProgramacion; $b++)
			{
				$rwProgramacion = fncfetch($rsProgramacion, $b);	
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.($b + 3), $rwProgramacion['progracodigo'])->getStyle('A'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.($b + 3), $rwProgramacion['sistemnombre'])->getStyle('B'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.($b + 3), $rwProgramacion['equipocodigo'])->getStyle('C'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.($b + 3), cargaequiponombre($rwProgramacion['equipocodigo'], $idcon))->getStyle('D'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.($b + 3), cargatipmannombre1($rwProgramacion['tipmancodigo'], $idcon))->getStyle('E'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.($b + 3), cargatiptrabnombre($rwProgramacion['tiptracodigo'], $idcon))->getStyle('F'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.($b + 3), cargatareanombre1($rwProgramacion['tareacodigo'], $idcon))->getStyle('G'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.($b + 3), $rwProgramacion['progranota'])->getStyle('H'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.($b + 3), $rwProgramacion['prografrecue'].' '.cargatipmnombre($rwProgramacion['tipmedcodigo'], $idcon))->getStyle('I'.($b + 3))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.($b + 3), cargapriorinombre($rwProgramacion['prioricodigo'], $idcon))->getStyle('J'.($b + 3))->applyFromArray($styleArray);
				
				
			}
			
			$objPHPExcel->getActiveSheet()->getStyle('A3:J'.(2 + $nrProgramacion))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:J'.(2 + $nrProgramacion))->getFill()->getStartColor()->setARGB('FFDAEEF3');
			
			$objPHPExcel->getActiveSheet()->getRowDimension($nrProgramacion + 3)->setRowHeight(3);
			$objPHPExcel->getActiveSheet()->mergeCells('A'.($nrProgramacion + 4).':J'.($nrProgramacion + 4))->setCellValue('A'.($nrProgramacion + 4), 'Total Rutinas Programadas '.$nrProgramacion)->getStyle('A'.($nrProgramacion + 4).':J'.($nrProgramacion + 4))->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrProgramacion + 4).':J'.($nrProgramacion + 4))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A'.($nrProgramacion + 4).':J'.($nrProgramacion + 4))->getFill()->getStartColor()->setARGB('FFDAEEF3');
			
		}
		else
		{
			$objPHPExcel->getActiveSheet()->mergeCells('A3:J3')->setCellValue('A3', 'NO SE ENCONTRARON PROGRAMACIONES ACTIVAS')->getStyle('A'.($nrProgramacion + 4).':J'.($nrProgramacion + 4))->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFill()->getStartColor()->setARGB('FFDAEEF3');
		}
		
		
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
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		
		$sheet++;
	}
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_PlanMantenimientoPrev.xls');
	
	echo 'ADM_PlanMantenimientoPrev.xls';