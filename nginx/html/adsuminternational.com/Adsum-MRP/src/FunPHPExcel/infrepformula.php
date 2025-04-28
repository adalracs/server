<?php

	ini_set("max_execution_time", 1800);
	ini_set("memory_limit", "512M");
	ini_set("display_errors", 1);
	 
	date_default_timezone_set("America/Bogota");

	include "../FunPerSecNiv/fncconn.php";
	include "../FunPerSecNiv/fncsqlrun.php";
	include "../FunPerSecNiv/fncnumreg.php";
	include "../FunPerSecNiv/fncfetch.php";
	include "../FunPerSecNiv/fncfetchall.php";
	 
	include "../FunPerPriNiv/pktblusuario.php";
	include "../JSON/JSON.php";
	include "../FunGen/cargainput.php";
	
	
	include "Classes/PHPExcel.php";
	require "Classes/PHPExcel/Writer/Excel5.php";

	

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName("Tahoma");
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
	

	$idcon = fncconn();

	$sbSql = "SELECT 
				producto.produccoduno, producto.producnombre, formula.formulnumero, formula.formulnombre,
				producformula.proforanilox, producformula.proforgrupo, producformula.proforindice
			FROM producformula 
			LEFT JOIN producto ON producformula.produccodigo = producto.produccodigo
			LEFT JOIN formula ON producformula.formulcodigo = formula.formulcodigo";
	
	$sbSql .= " WHERE producto.producfecha BETWEEN '{$producfechaini}' AND '{$producfechafin}' ";
	$sbSql .= " AND producto.producdelrec = 1 ORDER BY producto.produccodigo,producformula.proforindice ";
	
	$rsFormula = fncsqlrun($sbSql, $idcon);
	$nrFormula = fncnumreg($rsFormula);
	
	$objPHPExcel->setActiveSheetIndex(0)->setTitle(substr('Lista de formulas',0,30));

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(43);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(49);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(49);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(49);

	$rcont = 2;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':C'.$rcont)->setCellValue('A'.$rcont, utf8_decode('Fecha Generación'))->getStyle('A'.$rcont.':C'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$rcont, 'Dia')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$rcont, 'Mes')->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rcont, utf8_decode('Año'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	$rcont++;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$rcont, date('d'))->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$rcont, date('m'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rcont, date('Y'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$rcont += 2;

	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, 'ITEM')->getStyle('A'.$rcont.':B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, 'REFERENCIA')->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, 'COD COLOR')->getStyle('E'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, 'COLOR')->getStyle('F'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, 'ANILOX')->getStyle('G'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$rcont, 'GRUPO')->getStyle('H'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$rcont, 'INDICE')->getStyle('I'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':I'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':I'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	for($a = 0; $a < $nrFormula; $a++){

		$rwFormula = fncfetch($rsFormula,$a);

		$rcont++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, $rwFormula["produccoduno"])->getStyle('A'.$rcont.':B'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, $rwFormula['producnombre'])->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, $rwFormula["formulnumero"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, $rwFormula["formulnombre"])->getStyle('F'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, $rwFormula["proforanilox"])->getStyle('G'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$rcont, $rwFormula["proforgrupo"])->getStyle('H'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$rcont, $rwFormula["proforindice"])->getStyle('I'.$rcont)->applyFromArray($styleArray);
	}




	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);


	if(file_exists($uploaddir."ADM_InfFormula.xls")){

		unlink($uploaddir."ADM_InfFormula.xls");
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
	$objWriterSinzona->save($uploaddir.'ADM_InfFormula.xls');
	
	echo 'ADM_InfFormula.xls';