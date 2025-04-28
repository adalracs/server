<?php
	ini_set("max_execution_time", 1800);
	ini_set("memory_limit", "1024M");
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
				vistafichaitem.produccodigo, vistafichaitem.produccoduno, vistafichaitem.producnombre, 
				vistafichaitem.tippronombre, vistafichaitem.tipprocodigo, vistafichaitem.ordcomcodcli,
				 vistafichaitem.ordcomrazsoc
			FROM vistafichaitem ORDER BY vistafichaitem.produccoduno";
	
	$rsProducto = fncsqlrun($sbSql, $idcon);
	$nrProducto = fncnumreg($rsProducto);
	
	$objPHPExcel->setActiveSheetIndex(0)->setTitle(substr( utf8_decode("Listado de Estructura"), 0, 30));

	$objPHPExcel->getDefaultStyle()->getFont()->setName("Tahoma");
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(43);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(49);

	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(25);

	$rcont = 2;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':C'.$rcont)->setCellValue('A'.$rcont, utf8_decode('Fecha Generación'))->getStyle('A'.$rcont.':C'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$rcont, utf8_decode('Día'))->getStyle('A'.$rcont)->applyFromArray($styleArray);
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
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, 'TIPO PRODUCTO')->getStyle('E'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, 'NIT')->getStyle('F'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, 'CLIENTE')->getStyle('G'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':G'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A'.($rcont).':G'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	for($a = 0; $a < $nrProducto; $a++){

		$rwProducto = fncfetch($rsProducto, $a);

		$rcont++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, $rwProducto["produccoduno"])->getStyle('A'.$rcont.':B'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, $rwProducto['producnombre'])->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, $rwProducto["tippronombre"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, $rwProducto["ordcomcodcli"])->getStyle('F'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, $rwProducto["ordcomrazsoc"])->getStyle('G'.$rcont)->applyFromArray($styleArray);

		$sbSql = "SELECT 
					padreitem.paditecodigo, padreitem.paditenombre, padreitem.paditedensid,
					producpadreitem_ft.propadcalib, producpadreitem_ft.propadcolor, 
					producpadreitem_ft.propaddesem, producpadreitem_ft.propadtipo 
					FROM producpadreitem_ft LEFT JOIN padreitem ON producpadreitem_ft.paditecodigo = padreitem.paditecodigo
					WHERE producpadreitem_ft.produccodigo = '{$rwProducto['produccodigo']}' ORDER BY producpadreitem_ft.propadindex";

		$rsProducpadreitem_ft = fncsqlrun($sbSql, $idcon);
		$nrProducpadreitem_ft = fncnumreg($rsProducpadreitem_ft);

		if($nrProducpadreitem_ft > 0){

			$tcalibre = 0;
			$tgramaje = 0;

			$rcont++;
			$rcont++;
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, '');
			$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, 'ESTRUCTURA')->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, "COLOR")->getStyle('E'.$rcont)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, "CALIBRE")->getStyle('F'.$rcont)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, "GRAMAJE")->getStyle('G'.$rcont)->applyFromArray($styleArray);

			$objPHPExcel->getActiveSheet()->getStyle('B'.($rcont).':G'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
			$objPHPExcel->getActiveSheet()->getStyle('B'.($rcont).':G'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$rcont++;

			for($b = 0; $b < $nrProducpadreitem_ft; $b++){

				$rwProducpadreitem_ft = fncfetch($rsProducpadreitem_ft, $b);

				$tcalibre += $rwProducpadreitem_ft["propadcalib"];
				$tgramaje += ($rwProducpadreitem_ft["propadcalib"] * $rwProducpadreitem_ft["paditedensid"]);

				$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, '');
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, $rwProducpadreitem_ft["paditenombre"])->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, $rwProducpadreitem_ft["propadcolor"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, $rwProducpadreitem_ft["propadcalib"])->getStyle('F'.$rcont)->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, ($rwProducpadreitem_ft["propadcalib"] * $rwProducpadreitem_ft["paditedensid"]))->getStyle('G'.$rcont)->applyFromArray($styleArray);
				$rcont++;
			}

			$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, $tcalibre)->getStyle('F'.$rcont)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, $tgramaje)->getStyle('G'.$rcont)->applyFromArray($styleArray);
			$rcont++;
		}
	}

	$objPHPExcel->setActiveSheetIndex(0);//Listado de estructura

	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);

	if(file_exists($uploaddir."ADM_Listestructura.xls")){

		unlink($uploaddir."ADM_Listestructura.xls");
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
	$objWriterSinzona->save($uploaddir.'ADM_Listestructura.xls');
	
	echo 'ADM_Listestructura.xls';