<?php

	ini_set('memory_limit', '512M');
	ini_set("max_execution_time", 1800);
	 
	date_default_timezone_set("America/Bogota");

	include "../FunPerSecNiv/fncconn.php";
	include "../FunPerSecNiv/fncclose.php";
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
	
	$objPHPExcel->setActiveSheetIndex(0)->setTitle(substr( utf8_decode("Listado de fichas técnicas"), 0, 30));

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

	$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(25);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(25);


	$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(20);

	$objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CU')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CV')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CW')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CX')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CY')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('CZ')->setWidth(20);

	$objPHPExcel->getActiveSheet()->getColumnDimension('DA')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DB')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DC')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DD')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DE')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DF')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DG')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DH')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DI')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DJ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DK')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DL')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DM')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DN')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DO')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DP')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DQ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DR')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DS')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DT')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DU')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DV')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DW')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DX')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DY')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('DZ')->setWidth(20);

	$objPHPExcel->getActiveSheet()->getColumnDimension('EA')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EB')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EC')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('ED')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EE')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EF')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EG')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EH')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EI')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EJ')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EK')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EL')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EM')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EN')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EO')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EP')->setWidth(20);

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

	$objPHPExcel->getActiveSheet()->setCellValue('I'.$rcont, 'RESPONSABLE')->getStyle('I'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$rcont, utf8_decode('CÓDIGO SAP'))->getStyle('J'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$rcont, utf8_decode('ESTRUCTURA'))->getStyle('K'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$rcont, utf8_decode('TIPO IMPRESIÓN'))->getStyle('L'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$rcont, utf8_decode('EQUIPO'))->getStyle('M'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$rcont, utf8_decode('APROBACIÓN'))->getStyle('N'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$rcont, utf8_decode('MATERIAL / MATERIAL A IMPRIMIR'))->getStyle('O'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$rcont, utf8_decode('MATERIAL A LAMINAR #1'))->getStyle('P'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rcont, utf8_decode('MATERIAL A LAMINAR #2'))->getStyle('Q'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('R'.$rcont, utf8_decode('MATERIAL A LAMINAR #3'))->getStyle('R'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('S'.$rcont, utf8_decode('PANTONE'))->getStyle('S'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('T'.$rcont, utf8_decode('MUESTRA'))->getStyle('T'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('U'.$rcont, utf8_decode('ESTANDAR COLOR'))->getStyle('U'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('V'.$rcont, utf8_decode('PRUEBA COLOR'))->getStyle('V'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('W'.$rcont, utf8_decode('TINTA RESISTENTE CALOR'))->getStyle('W'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('X'.$rcont, utf8_decode('TINTA RESISTENTE LUZ'))->getStyle('X'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('Y'.$rcont, utf8_decode('TINTA RESISTENTE ÁCIDOS'))->getStyle('Y'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('Z'.$rcont, utf8_decode('TINTA RESISTENTE ÁLCALIS'))->getStyle('Z'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->setCellValue('AA'.$rcont, utf8_decode('TINTA RESISTENTE AGUA'))->getStyle('AA'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AB'.$rcont, utf8_decode('TINTA RESISTENTE GRASAS'))->getStyle('AB'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AC'.$rcont, utf8_decode('TINTA RESISTENTE BRILLO'))->getStyle('AC'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AD'.$rcont, utf8_decode('TINTA RESISTENTE RAYADO'))->getStyle('AD'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AE'.$rcont, utf8_decode('TINTA LAMINACIÓN'))->getStyle('AE'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AF'.$rcont, utf8_decode('SUPERFICIE'))->getStyle('AF'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AG'.$rcont, utf8_decode('URETANO ELASTOMÉRICO'))->getStyle('AG'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AH'.$rcont, utf8_decode('NITROPOLIAMIDA'))->getStyle('AH'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AI'.$rcont, utf8_decode('VINÍLICA'))->getStyle('AI'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$rcont, utf8_decode('NITROCELULOSA'))->getStyle('AJ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AK'.$rcont, utf8_decode('NITRO-URETANO'))->getStyle('AK'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AL'.$rcont, utf8_decode('POLIAMIDA'))->getStyle('AL'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AM'.$rcont, utf8_decode('PRIMER METALIZADO'))->getStyle('AM'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AN'.$rcont, utf8_decode('LACA ANTIALCALIS'))->getStyle('AN'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AO'.$rcont, utf8_decode('BAMIZ PIGMENTOS'))->getStyle('AO'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AP'.$rcont, utf8_decode('LACA TERMOSELLABLE'))->getStyle('AP'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$rcont, utf8_decode('HOT-MELT'))->getStyle('AQ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AR'.$rcont, utf8_decode('PARAFINAS'))->getStyle('AR'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AS'.$rcont, utf8_decode('LACA ANTIPEROXIDO'))->getStyle('AS'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('I'.($rcont).':AS'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('I'.($rcont).':AS'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	$objPHPExcel->getActiveSheet()->setCellValue('AU'.$rcont, utf8_decode('VERSIÓN ARTE'))->getStyle('AU'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AV'.$rcont, utf8_decode('PAPEL POUCH IMPRESO'))->getStyle('AV'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AW'.$rcont, utf8_decode('FOIL IMPRESO'))->getStyle('AW'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AX'.$rcont, utf8_decode('TOTAL CALIBRE'))->getStyle('AX'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AY'.$rcont, utf8_decode('TOTAL GRAMAJE'))->getStyle('AY'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('AZ'.$rcont, utf8_decode('TOLERANCIA CALIBRE'))->getStyle('AZ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BA'.$rcont, utf8_decode('TOLERANCIA GRAMAJE'))->getStyle('BA'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BB'.$rcont, utf8_decode('ANCHO'))->getStyle('BB'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BC'.$rcont, utf8_decode('TOLERANCIA ANCHO'))->getStyle('BC'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BD'.$rcont, utf8_decode('LARGO'))->getStyle('BD'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BE'.$rcont, utf8_decode('TOLERANCIA LARGO'))->getStyle('BE'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BF'.$rcont, utf8_decode('FUELLE'))->getStyle('BF'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BG'.$rcont, utf8_decode('TOLERANCIA FUELLE'))->getStyle('BG'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BH'.$rcont, utf8_decode('TRASLAPE'))->getStyle('BH'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BI'.$rcont, utf8_decode('TOLERANCIA TRASLAPE'))->getStyle('BI'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BJ'.$rcont, utf8_decode('TIPO TRASLAPE'))->getStyle('BJ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BK'.$rcont, utf8_decode('ANCHO DE SELLE'))->getStyle('BK'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BL'.$rcont, utf8_decode('VÁLVULA'))->getStyle('BL'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BM'.$rcont, utf8_decode('COLOR TAPA'))->getStyle('BM'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BN'.$rcont, utf8_decode('MEDIDA'))->getStyle('BN'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BO'.$rcont, utf8_decode('UBICACIÓN'))->getStyle('BO'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BP'.$rcont, utf8_decode('TIPO VÁLVULA'))->getStyle('BP'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BQ'.$rcont, utf8_decode('TROQUEL'))->getStyle('BQ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BR'.$rcont, utf8_decode('TIPO TROQUEL'))->getStyle('BR'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BS'.$rcont, utf8_decode('TIPO LLENADO'))->getStyle('BS'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BT'.$rcont, utf8_decode('CÓDIGO DE BARRAS'))->getStyle('BT'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BU'.$rcont, utf8_decode('COLOR FONDO'))->getStyle('BU'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BV'.$rcont, utf8_decode('COLOR BARRAS'))->getStyle('BV'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BW'.$rcont, utf8_decode('CONTINUO'))->getStyle('BW'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BX'.$rcont, utf8_decode('NO. REPETICIONES'))->getStyle('BX'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BY'.$rcont, utf8_decode('RODILLO'))->getStyle('BY'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('BZ'.$rcont, utf8_decode('PISTAS'))->getStyle('BZ'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('AU'.($rcont).':BZ'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('AU'.($rcont).':BZ'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);	

	$objPHPExcel->getActiveSheet()->setCellValue('CB'.$rcont, utf8_decode('TIPO EMPAQUE'))->getStyle('CB'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CC'.$rcont, utf8_decode('UNIDADES EMPAQUE'))->getStyle('CC'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CD'.$rcont, utf8_decode('CÓDIGO CAJA'))->getStyle('CD'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CE'.$rcont, utf8_decode('REF. CAJA'))->getStyle('CE'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CF'.$rcont, utf8_decode('UNIDADES PAQUETE'))->getStyle('CF'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CG'.$rcont, utf8_decode('PESO EMPAQUE'))->getStyle('CG'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CH'.$rcont, utf8_decode('ESTIBADO'))->getStyle('CH'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CI'.$rcont, utf8_decode('TAMAÑO ESTIBA'))->getStyle('CI'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CJ'.$rcont, utf8_decode('TIPO ESTIBA'))->getStyle('CJ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CK'.$rcont, utf8_decode('ALTURA PALLET'))->getStyle('CK'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CL'.$rcont, utf8_decode('PESO PALLET'))->getStyle('CL'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CM'.$rcont, utf8_decode('ESTRESADO'))->getStyle('CM'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CN'.$rcont, utf8_decode('CÓDIGO ESTIBA'))->getStyle('CN'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CO'.$rcont, utf8_decode('REF. ESTIBA'))->getStyle('CO'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CP'.$rcont, utf8_decode('PALLET ENFARDADO'))->getStyle('CP'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$rcont, utf8_decode('BOLSA TOB. PELETIZADA'))->getStyle('CQ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CR'.$rcont, utf8_decode('CAJA'))->getStyle('CR'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CS'.$rcont, utf8_decode('PROTECTOR CORE'))->getStyle('CS'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CT'.$rcont, utf8_decode('CARTÓN EXTREMOS'))->getStyle('CT'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CU'.$rcont, utf8_decode('SEPARADOR CARTÓN'))->getStyle('CU'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CV'.$rcont, utf8_decode('ENVUELTO CARTÓN'))->getStyle('CV'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CW'.$rcont, utf8_decode('SUSPENDIDO'))->getStyle('CW'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CX'.$rcont, utf8_decode('ESTIBA EXPORTACION'))->getStyle('CX'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CY'.$rcont, utf8_decode('UNIDADES'))->getStyle('CY'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CZ'.$rcont, utf8_decode('KILOGRAMOS'))->getStyle('CZ'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('CB'.($rcont).':CZ'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('CB'.($rcont).':CZ'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);	

	$objPHPExcel->getActiveSheet()->setCellValue('DB'.$rcont, utf8_decode('MILLARES'))->getStyle('DB'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DC'.$rcont, utf8_decode('METROS'))->getStyle('DC'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DD'.$rcont, utf8_decode('PAPEL POUCH LAMINADO'))->getStyle('DD'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DE'.$rcont, utf8_decode('FOIL LAMINADO'))->getStyle('DE'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DF'.$rcont, utf8_decode('TRATAMIENTO CORTE'))->getStyle('DF'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DG'.$rcont, utf8_decode('TOLERANCIA DIAM. BOBINA'))->getStyle('DG'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DH'.$rcont, utf8_decode('DIÁMETRO CORE'))->getStyle('DH'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DI'.$rcont, utf8_decode('ABUNDANCIA'))->getStyle('DI'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DJ'.$rcont, utf8_decode('TOLERANCIA ABUNDANCIA'))->getStyle('DJ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DK'.$rcont, utf8_decode('FORMA SELLADO'))->getStyle('DK'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DL'.$rcont, utf8_decode('DISTANCIA PRECALENTADORES'))->getStyle('DL'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DM'.$rcont, utf8_decode('EQUIPO'))->getStyle('DM'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DN'.$rcont, utf8_decode('TAMAÑO SOLAPA'))->getStyle('DN'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DO'.$rcont, utf8_decode('CÓDIGO VÁLVULA'))->getStyle('DO'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DP'.$rcont, utf8_decode('REF. VÁLVULA'))->getStyle('DP'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DQ'.$rcont, utf8_decode('DOBLADO'))->getStyle('DQ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DR'.$rcont, utf8_decode('MICROPERFORADO'))->getStyle('CR'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DS'.$rcont, utf8_decode('TIPO PERFORACIÓN'))->getStyle('DS'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DT'.$rcont, utf8_decode('CANTIDAD CARAS PERFORADAS'))->getStyle('DT'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DU'.$rcont, utf8_decode('NIVEL X ESTIBA'))->getStyle('DU'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DV'.$rcont, utf8_decode('CANTIDAD X ESTIBA'))->getStyle('DV'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DW'.$rcont, utf8_decode('ANCHO IMPRESIÓN'))->getStyle('DW'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DX'.$rcont, utf8_decode('TOLERANCIA ANCHO IMPRESIÓN'))->getStyle('DX'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('DY'.$rcont, utf8_decode('TIPO SELLADO'))->getStyle('DY'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('DB'.($rcont).':DY'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('DB'.($rcont).':DY'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);	

	$objPHPExcel->getActiveSheet()->setCellValue('EA'.$rcont, utf8_decode('ANCHO FOTOCELDA'))->getStyle('EA'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EB'.$rcont, utf8_decode('LARGO FOTOCELDA'))->getStyle('EB'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EC'.$rcont, utf8_decode('DISTANCIA FOTOCELDA AL BORDE'))->getStyle('EC'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('ED'.$rcont, utf8_decode('COLOR FOTOCELDA'))->getStyle('ED'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EE'.$rcont, utf8_decode('BANDERA'))->getStyle('EE'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EF'.$rcont, utf8_decode('COLOR BANDERA'))->getStyle('EF'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EG'.$rcont, utf8_decode('UBICACIÓN BANDERA'))->getStyle('EG'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EH'.$rcont, utf8_decode('TIPO EMBOBINADO'))->getStyle('EH'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('EI'.$rcont, utf8_decode('CON RESPECTO A'))->getStyle('EI'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EJ'.$rcont, utf8_decode('NO. MAX EMPALMES'))->getStyle('EJ'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EK'.$rcont, utf8_decode('METROS DEL ROLLO'))->getStyle('EK'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EL'.$rcont, utf8_decode('DIAMETRO DEL ROLLO'))->getStyle('EL'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EM'.$rcont, utf8_decode('PESO DEL ROLLO'))->getStyle('EM'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EN'.$rcont, utf8_decode('TOLERANCIA PESO DEL ROLLO'))->getStyle('EN'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EO'.$rcont, utf8_decode('FOTOCELDA AL LADO'))->getStyle('EO'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('EP'.$rcont, utf8_decode('OBSERVACIONES'))->getStyle('EP'.$rcont)->applyFromArray($styleArray);	

	$objPHPExcel->getActiveSheet()->getStyle('EA'.($rcont).':EP'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('EA'.($rcont).':EP'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);	

	for($a = 0; $a < $nrProducto; $a++){

		$rwProducto = fncfetch($rsProducto, $a);

		$rcont++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, $rwProducto["produccoduno"])->getStyle('A'.$rcont.':B'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('C'.$rcont.':D'.$rcont)->setCellValue('C'.$rcont, $rwProducto['producnombre'])->getStyle('C'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$rcont, $rwProducto["tippronombre"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$rcont, $rwProducto["ordcomcodcli"])->getStyle('F'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$rcont, $rwProducto["ordcomrazsoc"])->getStyle('G'.$rcont)->applyFromArray($styleArray);

		$sbSql = "SELECT 
					camperfichat.cpfichnombre, cpfichdetope.cpftdovalor 
					FROM cpfichdetope 
					LEFT JOIN camperfichat ON camperfichat.cpfichcodigo = cpfichdetope.cpfichcodigo
					WHERE cpfichdetope.produccodigo = '{$rwProducto['produccodigo']}'";

		$rsCpfichdetope = fncsqlrun($sbSql, $idcon);
		$nrCpfichdetope = fncnumreg($rsCpfichdetope);

		if($nrCpfichdetope > 0){

			for($b = 0; $b < $nrCpfichdetope; $b++){

				$rwCpfichdetope = fncfetch($rsCpfichdetope, $b);

				$objCpftdovalor = $rwCpfichdetope["cpfichnombre"];
				$$objCpftdovalor = $rwCpfichdetope["cpftdovalor"];
			}
		}

		$objPHPExcel->getActiveSheet()->setCellValue('I'.$rcont, strtoupper($respon))->getStyle('I'.$rcont)->applyFromArray($styleArray); unset($respon);
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$rcont, strtoupper($codigosap))->getStyle('J'.$rcont)->applyFromArray($styleArray); unset($codigosap);
		$objPHPExcel->getActiveSheet()->setCellValue('K'.$rcont, strtoupper($tipo_estruc))->getStyle('K'.$rcont)->applyFromArray($styleArray); unset($tipo_estruc);
		$objPHPExcel->getActiveSheet()->setCellValue('L'.$rcont, strtoupper($tipo_impresion))->getStyle('L'.$rcont)->applyFromArray($styleArray); unset($tipo_impresion);
		$objPHPExcel->getActiveSheet()->setCellValue('M'.$rcont, strtoupper($equiponombre))->getStyle('M'.$rcont)->applyFromArray($styleArray); unset($equiponombre);
		$objPHPExcel->getActiveSheet()->setCellValue('N'.$rcont, strtoupper($producto_avaliable))->getStyle('N'.$rcont)->applyFromArray($styleArray); unset($producto_avaliable);
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$rcont, strtoupper($product_imp_nomb))->getStyle('O'.$rcont)->applyFromArray($styleArray); unset($product_imp_nomb);
		$objPHPExcel->getActiveSheet()->setCellValue('P'.$rcont, strtoupper($laminado_1))->getStyle('P'.$rcont)->applyFromArray($styleArray); unset($laminado_1);
		$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rcont, strtoupper($laminado_2))->getStyle('Q'.$rcont)->applyFromArray($styleArray); unset($laminado_2);
		$objPHPExcel->getActiveSheet()->setCellValue('R'.$rcont, strtoupper($laminado_3))->getStyle('R'.$rcont)->applyFromArray($styleArray); unset($laminado_3);
		$objPHPExcel->getActiveSheet()->setCellValue('S'.$rcont, strtoupper( ($pantone > 0)? "SI" : "NO" ))->getStyle('S'.$rcont)->applyFromArray($styleArray); unset($pantone);
		$objPHPExcel->getActiveSheet()->setCellValue('T'.$rcont, strtoupper( ($muestra > 0)? "SI" : "NO" ))->getStyle('T'.$rcont)->applyFromArray($styleArray); unset($muestra);
		$objPHPExcel->getActiveSheet()->setCellValue('U'.$rcont, strtoupper( ($est_color > 0)? "SI" : "NO" ))->getStyle('U'.$rcont)->applyFromArray($styleArray); unset($est_color);
		$objPHPExcel->getActiveSheet()->setCellValue('V'.$rcont, strtoupper( ($pcolor > 0)? "SI" : "NO" ))->getStyle('V'.$rcont)->applyFromArray($styleArray); unset($pcolor);
		$objPHPExcel->getActiveSheet()->setCellValue('W'.$rcont, strtoupper( ($tnt_calor > 0)? "SI" : "NO" ))->getStyle('W'.$rcont)->applyFromArray($styleArray); unset($tnt_calor);
		$objPHPExcel->getActiveSheet()->setCellValue('X'.$rcont, strtoupper( ($tnt_luz > 0)? "SI" : "NO" ))->getStyle('X'.$rcont)->applyFromArray($styleArray); unset($tnt_luz);
		$objPHPExcel->getActiveSheet()->setCellValue('Y'.$rcont, strtoupper( ($tnt_acidos > 0)? "SI" : "NO" ))->getStyle('Y'.$rcont)->applyFromArray($styleArray); unset($tnt_acidos);
		$objPHPExcel->getActiveSheet()->setCellValue('Z'.$rcont, strtoupper( ($tnt_alcalis > 0)? "SI" : "NO" ))->getStyle('Z'.$rcont)->applyFromArray($styleArray); unset($tnt_alcalis);

		/*
		$objPHPExcel->getActiveSheet()->setCellValue('AA'.$rcont, strtoupper( ($tnt_agua > 0)? "SI" : "NO" ))->getStyle('AA'.$rcont)->applyFromArray($styleArray); unset($tnt_agua);
		$objPHPExcel->getActiveSheet()->setCellValue('AB'.$rcont, strtoupper( ($tnt_grasas > 0)? "SI" : "NO" ))->getStyle('AB'.$rcont)->applyFromArray($styleArray); unset($tnt_grasas);
		$objPHPExcel->getActiveSheet()->setCellValue('AC'.$rcont, strtoupper( ($tnt_brillo > 0)? "SI" : "NO" ))->getStyle('AC'.$rcont)->applyFromArray($styleArray); unset($tnt_brillo);
		$objPHPExcel->getActiveSheet()->setCellValue('AD'.$rcont, strtoupper( ($tnt_rayado > 0)? "SI" : "NO" ))->getStyle('AD'.$rcont)->applyFromArray($styleArray); unset($tnt_rayado);
		$objPHPExcel->getActiveSheet()->setCellValue('AE'.$rcont, strtoupper( ($tntesp_laminacion > 0)? "SI" : "NO" ))->getStyle('AE'.$rcont)->applyFromArray($styleArray); unset($tntesp_laminacion);
		$objPHPExcel->getActiveSheet()->setCellValue('AF'.$rcont, strtoupper( ($tntesp_superficie > 0)? "SI" : "NO" ))->getStyle('AF'.$rcont)->applyFromArray($styleArray); unset($tntesp_superficie);
		$objPHPExcel->getActiveSheet()->setCellValue('AG'.$rcont, strtoupper( ($tntesp_uretelasto > 0)? "SI" : "NO" ))->getStyle('AG'.$rcont)->applyFromArray($styleArray); unset($tntesp_uretelasto);
		$objPHPExcel->getActiveSheet()->setCellValue('AH'.$rcont, strtoupper( ($tntesp_nitropolia > 0)? "SI" : "NO" ))->getStyle('AH'.$rcont)->applyFromArray($styleArray); unset($tntesp_nitropolia);
		$objPHPExcel->getActiveSheet()->setCellValue('AI'.$rcont, strtoupper( ($tntesp_vinilica > 0)? "SI" : "NO" ))->getStyle('AI'.$rcont)->applyFromArray($styleArray); unset($tntesp_vinilica);
		$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$rcont, strtoupper( ($tntesp_nitrocelu > 0)? "SI" : "NO" ))->getStyle('AJ'.$rcont)->applyFromArray($styleArray); unset($tntesp_nitrocelu);
		$objPHPExcel->getActiveSheet()->setCellValue('AK'.$rcont, strtoupper( ($tntesp_nitroure > 0)? "SI" : "NO" ))->getStyle('AK'.$rcont)->applyFromArray($styleArray); unset($tntesp_nitroure);
		$objPHPExcel->getActiveSheet()->setCellValue('AL'.$rcont, strtoupper( ($tntesp_poliamo > 0)? "SI" : "NO" ))->getStyle('AL'.$rcont)->applyFromArray($styleArray); unset($tntesp_poliamo);
		$objPHPExcel->getActiveSheet()->setCellValue('AM'.$rcont, strtoupper( ($other_pmetali > 0)? "SI" : "NO" ))->getStyle('AM'.$rcont)->applyFromArray($styleArray); unset($other_pmetali);
		$objPHPExcel->getActiveSheet()->setCellValue('AN'.$rcont, strtoupper( ($other_lacacaliz > 0)? "SI" : "NO" ))->getStyle('AN'.$rcont)->applyFromArray($styleArray); unset($other_lacacaliz);
		$objPHPExcel->getActiveSheet()->setCellValue('AO'.$rcont, strtoupper( ($other_bamiz1 > 0)? "SI" : "NO" ))->getStyle('AO'.$rcont)->applyFromArray($styleArray); unset($other_bamiz1);
		$objPHPExcel->getActiveSheet()->setCellValue('AP'.$rcont, strtoupper( ($other_lacatermo > 0)? "SI" : "NO" ))->getStyle('AP'.$rcont)->applyFromArray($styleArray); unset($other_lacatermo);
		$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$rcont, strtoupper( ($other_hotmelt > 0)? "SI" : "NO" ))->getStyle('AQ'.$rcont)->applyFromArray($styleArray);	unset($other_hotmelt);
		$objPHPExcel->getActiveSheet()->setCellValue('AR'.$rcont, strtoupper( ($other_parafina > 0)? "SI" : "NO" ))->getStyle('AR'.$rcont)->applyFromArray($styleArray); unset($other_parafina);
		$objPHPExcel->getActiveSheet()->setCellValue('AS'.$rcont, strtoupper( ($other_lacaantiperoxido > 0)? "SI" : "NO" ))->getStyle('AS'.$rcont)->applyFromArray($styleArray); unset($other_lacaantiperoxido);

		$objPHPExcel->getActiveSheet()->setCellValue('AU'.$rcont, strtoupper($version_arte))->getStyle('AU'.$rcont)->applyFromArray($styleArray); unset($version_arte);
		$objPHPExcel->getActiveSheet()->setCellValue('AV'.$rcont, strtoupper($papel_pouch_imppor))->getStyle('AV'.$rcont)->applyFromArray($styleArray); unset($papel_pouch_imppor);
		$objPHPExcel->getActiveSheet()->setCellValue('AW'.$rcont, strtoupper($foil_imppor))->getStyle('AW'.$rcont)->applyFromArray($styleArray); unset($foil_imppor);
		$objPHPExcel->getActiveSheet()->setCellValue('AX'.$rcont, strtoupper($total_calibre))->getStyle('AX'.$rcont)->applyFromArray($styleArray); unset($total_calibre);
		$objPHPExcel->getActiveSheet()->setCellValue('AY'.$rcont, strtoupper($total_gramaje))->getStyle('AY'.$rcont)->applyFromArray($styleArray); unset($total_gramaje);
		$objPHPExcel->getActiveSheet()->setCellValue('AZ'.$rcont, strtoupper("+ ".$tole_calib_ms." -".$tole_calib_mn))->getStyle('AZ'.$rcont)->applyFromArray($styleArray);	unset($tole_calib_ms, $tole_calib_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BA'.$rcont, strtoupper("+ ".$tole_grama_ms." -".$tole_grama_mn))->getStyle('BA'.$rcont)->applyFromArray($styleArray);	unset($tole_grama_ms, $tole_grama_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BB'.$rcont, strtoupper($ancho))->getStyle('BB'.$rcont)->applyFromArray($styleArray); unset($ancho);
		$objPHPExcel->getActiveSheet()->setCellValue('BC'.$rcont, strtoupper("+ ".$tole_ancho_ms." -".$tole_ancho_mn))->getStyle('BC'.$rcont)->applyFromArray($styleArray);	unset($tole_ancho_ms, $tole_ancho_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BD'.$rcont, strtoupper($largo))->getStyle('BD'.$rcont)->applyFromArray($styleArray); unset($largo);
		$objPHPExcel->getActiveSheet()->setCellValue('BE'.$rcont, strtoupper("+ ".$tole_largo_ms." -".$tole_largo_mn))->getStyle('BE'.$rcont)->applyFromArray($styleArray);	unset($tole_largo_ms, $tole_largo_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BF'.$rcont, strtoupper($fuelle))->getStyle('BF'.$rcont)->applyFromArray($styleArray);	unset($fuelle);
		$objPHPExcel->getActiveSheet()->setCellValue('BG'.$rcont, strtoupper("+ ".$tole_fuelle_ms." -".$tole_fuelle_mn))->getStyle('BG'.$rcont)->applyFromArray($styleArray); unset($tole_fuelle_ms, $tole_fuelle_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BH'.$rcont, strtoupper($traslape))->getStyle('BH'.$rcont)->applyFromArray($styleArray); unset($traslape);
		$objPHPExcel->getActiveSheet()->setCellValue('BI'.$rcont, strtoupper("+ ".$tole_traslape_ms." -".$tole_traslape_mn))->getStyle('BI'.$rcont)->applyFromArray($styleArray); unset($tole_traslape_ms, $tole_traslape_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('BJ'.$rcont, strtoupper($tipo_traslape))->getStyle('BJ'.$rcont)->applyFromArray($styleArray); unset($tipo_traslape);
		$objPHPExcel->getActiveSheet()->setCellValue('BK'.$rcont, strtoupper($aselle_bolsa))->getStyle('BK'.$rcont)->applyFromArray($styleArray); unset($aselle_bolsa);
		$objPHPExcel->getActiveSheet()->setCellValue('BL'.$rcont, strtoupper($valve))->getStyle('BL'.$rcont)->applyFromArray($styleArray); unset($valve);
		$objPHPExcel->getActiveSheet()->setCellValue('BM'.$rcont, strtoupper($ctapa_valve))->getStyle('BM'.$rcont)->applyFromArray($styleArray); unset($ctapa_valve);
		$objPHPExcel->getActiveSheet()->setCellValue('BN'.$rcont, strtoupper($medi_valve))->getStyle('BN'.$rcont)->applyFromArray($styleArray); unset($medi_valve);
		$objPHPExcel->getActiveSheet()->setCellValue('BO'.$rcont, strtoupper($ubic_valve))->getStyle('BO'.$rcont)->applyFromArray($styleArray); unset($ubic_valve);
		$objPHPExcel->getActiveSheet()->setCellValue('BP'.$rcont, strtoupper($tipo_valve))->getStyle('BP'.$rcont)->applyFromArray($styleArray); unset($tipo_valve);
		$objPHPExcel->getActiveSheet()->setCellValue('BQ'.$rcont, strtoupper($troquel))->getStyle('BQ'.$rcont)->applyFromArray($styleArray); unset($troquel);
		$objPHPExcel->getActiveSheet()->setCellValue('BR'.$rcont, strtoupper($tipo_troquel))->getStyle('BR'.$rcont)->applyFromArray($styleArray); unset($tipo_troquel);
		$objPHPExcel->getActiveSheet()->setCellValue('BS'.$rcont, strtoupper($tipo_llenado))->getStyle('BS'.$rcont)->applyFromArray($styleArray); unset($tipo_llenado);
		$objPHPExcel->getActiveSheet()->setCellValue('BT'.$rcont, strtoupper($cod_barras))->getStyle('BT'.$rcont)->applyFromArray($styleArray); unset($cod_barras);
		$objPHPExcel->getActiveSheet()->setCellValue('BU'.$rcont, strtoupper($color_fondo_barras))->getStyle('BU'.$rcont)->applyFromArray($styleArray); unset($color_fondo_barras);
		$objPHPExcel->getActiveSheet()->setCellValue('BV'.$rcont, strtoupper($color_barras))->getStyle('BV'.$rcont)->applyFromArray($styleArray); unset($color_barras);
		$objPHPExcel->getActiveSheet()->setCellValue('BW'.$rcont, strtoupper($continuo))->getStyle('BW'.$rcont)->applyFromArray($styleArray); unset($continuo);
		$objPHPExcel->getActiveSheet()->setCellValue('BX'.$rcont, strtoupper($nrorepet))->getStyle('BX'.$rcont)->applyFromArray($styleArray); unset($nrorepet);
		$objPHPExcel->getActiveSheet()->setCellValue('BY'.$rcont, strtoupper($rodillo))->getStyle('BY'.$rcont)->applyFromArray($styleArray); unset($rodillo);
		$objPHPExcel->getActiveSheet()->setCellValue('BZ'.$rcont, strtoupper($nropistas))->getStyle('BZ'.$rcont)->applyFromArray($styleArray); unset($nropistas);

		$objPHPExcel->getActiveSheet()->setCellValue('CB'.$rcont, strtoupper($tipo_empaque))->getStyle('CB'.$rcont)->applyFromArray($styleArray); unset($tipo_empaque);
		$objPHPExcel->getActiveSheet()->setCellValue('CC'.$rcont, strtoupper($uni_empaque))->getStyle('CC'.$rcont)->applyFromArray($styleArray); unset($uni_empaque);
		$objPHPExcel->getActiveSheet()->setCellValue('CD'.$rcont, strtoupper($cod_caja))->getStyle('CD'.$rcont)->applyFromArray($styleArray); unset($cod_caja);
		$objPHPExcel->getActiveSheet()->setCellValue('CE'.$rcont, strtoupper($caja_item))->getStyle('CE'.$rcont)->applyFromArray($styleArray); unset($caja_item);
		$objPHPExcel->getActiveSheet()->setCellValue('CF'.$rcont, strtoupper($uni_paquete))->getStyle('CF'.$rcont)->applyFromArray($styleArray); unset($uni_paquete);
		$objPHPExcel->getActiveSheet()->setCellValue('CG'.$rcont, strtoupper($peso_empaque))->getStyle('CG'.$rcont)->applyFromArray($styleArray); unset($peso_empaque);
		$objPHPExcel->getActiveSheet()->setCellValue('CH'.$rcont, strtoupper($estibado))->getStyle('CH'.$rcont)->applyFromArray($styleArray); unset($estibado);
		$objPHPExcel->getActiveSheet()->setCellValue('CI'.$rcont, strtoupper($tam_estiba))->getStyle('CI'.$rcont)->applyFromArray($styleArray); unset($tam_estiba);
		$objPHPExcel->getActiveSheet()->setCellValue('CJ'.$rcont, strtoupper($tipo_estiba))->getStyle('CJ'.$rcont)->applyFromArray($styleArray); unset($tipo_estiba);
		$objPHPExcel->getActiveSheet()->setCellValue('CK'.$rcont, strtoupper($alt_pallet))->getStyle('CK'.$rcont)->applyFromArray($styleArray); unset($alt_pallet);
		$objPHPExcel->getActiveSheet()->setCellValue('CL'.$rcont, strtoupper($pes_pallet))->getStyle('CL'.$rcont)->applyFromArray($styleArray); unset($pes_pallet);
		$objPHPExcel->getActiveSheet()->setCellValue('CM'.$rcont, strtoupper($estresado))->getStyle('CM'.$rcont)->applyFromArray($styleArray); unset($estresado);
		$objPHPExcel->getActiveSheet()->setCellValue('CN'.$rcont, strtoupper($cod_estiba))->getStyle('CN'.$rcont)->applyFromArray($styleArray); unset($cod_estiba);
		$objPHPExcel->getActiveSheet()->setCellValue('CO'.$rcont, strtoupper($estiba_item))->getStyle('CO'.$rcont)->applyFromArray($styleArray); unset($estiba_item);
		$objPHPExcel->getActiveSheet()->setCellValue('CP'.$rcont, strtoupper($tipoemp_palletenf))->getStyle('CP'.$rcont)->applyFromArray($styleArray); unset($tipoemp_palletenf);
		$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$rcont, strtoupper($tipoemp_bolsatubpet))->getStyle('CQ'.$rcont)->applyFromArray($styleArray); unset($tipoemp_bolsatubpet);
		$objPHPExcel->getActiveSheet()->setCellValue('CR'.$rcont, strtoupper($tipoemp_caja))->getStyle('CR'.$rcont)->applyFromArray($styleArray); unset($tipoemp_caja);
		$objPHPExcel->getActiveSheet()->setCellValue('CS'.$rcont, strtoupper($tipoemp_pcore))->getStyle('CS'.$rcont)->applyFromArray($styleArray); unset($tipoemp_pcore);
		$objPHPExcel->getActiveSheet()->setCellValue('CT'.$rcont, strtoupper($tipoemp_cartonext))->getStyle('CT'.$rcont)->applyFromArray($styleArray); unset($tipoemp_cartonext);
		$objPHPExcel->getActiveSheet()->setCellValue('CU'.$rcont, strtoupper($tipoemp_separadorc))->getStyle('CU'.$rcont)->applyFromArray($styleArray); unset($tipoemp_separadorc);
		$objPHPExcel->getActiveSheet()->setCellValue('CV'.$rcont, strtoupper($tipoemp_envueltoc))->getStyle('CV'.$rcont)->applyFromArray($styleArray); unset($tipoemp_envueltoc);
		$objPHPExcel->getActiveSheet()->setCellValue('CW'.$rcont, strtoupper($tipoemp_suspendido))->getStyle('CW'.$rcont)->applyFromArray($styleArray); unset($tipoemp_suspendido);
		$objPHPExcel->getActiveSheet()->setCellValue('CX'.$rcont, strtoupper($tipoemp_estibaexp))->getStyle('CX'.$rcont)->applyFromArray($styleArray); unset($tipoemp_estibaexp);
		$objPHPExcel->getActiveSheet()->setCellValue('CY'.$rcont, strtoupper($unimedi_und))->getStyle('CY'.$rcont)->applyFromArray($styleArray); unset($unimedi_und);
		$objPHPExcel->getActiveSheet()->setCellValue('CZ'.$rcont, strtoupper($unimedi_kgs))->getStyle('CZ'.$rcont)->applyFromArray($styleArray); unset($unimedi_kgs);

		$objPHPExcel->getActiveSheet()->setCellValue('DB'.$rcont, strtoupper($unimedi_mill))->getStyle('DB'.$rcont)->applyFromArray($styleArray); unset($unimedi_mill);
		$objPHPExcel->getActiveSheet()->setCellValue('DC'.$rcont, strtoupper($unimedi_mtr))->getStyle('DC'.$rcont)->applyFromArray($styleArray); unset($unimedi_mtr);
		$objPHPExcel->getActiveSheet()->setCellValue('DD'.$rcont, strtoupper($papel_pouch_lampor))->getStyle('DD'.$rcont)->applyFromArray($styleArray); unset($papel_pouch_lampor);
		$objPHPExcel->getActiveSheet()->setCellValue('DE'.$rcont, strtoupper($foil_lampor))->getStyle('DE'.$rcont)->applyFromArray($styleArray); unset($foil_lampor);
		$objPHPExcel->getActiveSheet()->setCellValue('DF'.$rcont, strtoupper($trata_corte))->getStyle('DF'.$rcont)->applyFromArray($styleArray); unset($trata_corte);
		$objPHPExcel->getActiveSheet()->setCellValue('DG'.$rcont, strtoupper("+ ".$tole_diamax_bobina_ms. " -"-$tole_diamax_bobina_mn))->getStyle('DG'.$rcont)->applyFromArray($styleArray); unset($tole_diamax_bobina_ms, $tole_diamax_bobina_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('DH'.$rcont, strtoupper($diametro_core))->getStyle('DH'.$rcont)->applyFromArray($styleArray); unset($diametro_core);
		$objPHPExcel->getActiveSheet()->setCellValue('DI'.$rcont, strtoupper($abundancia))->getStyle('DI'.$rcont)->applyFromArray($styleArray); unset($abundancia);
		$objPHPExcel->getActiveSheet()->setCellValue('DJ'.$rcont, strtoupper("+ ".$tole_abundancia_ms. " -"-$tole_abundancia_mn))->getStyle('DJ'.$rcont)->applyFromArray($styleArray); unset($tole_abundancia_ms, $tole_abundancia_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('DK'.$rcont, strtoupper($forma_sellado))->getStyle('DK'.$rcont)->applyFromArray($styleArray); unset($forma_sellado);
		$objPHPExcel->getActiveSheet()->setCellValue('DL'.$rcont, strtoupper($dist_precalentadores))->getStyle('DL'.$rcont)->applyFromArray($styleArray); unset($dist_precalentadores);
		$objPHPExcel->getActiveSheet()->setCellValue('DM'.$rcont, strtoupper($maquina))->getStyle('DM'.$rcont)->applyFromArray($styleArray); unset($maquina);
		$objPHPExcel->getActiveSheet()->setCellValue('DN'.$rcont, strtoupper($tamano_solapa))->getStyle('DN'.$rcont)->applyFromArray($styleArray); unset($tamano_solapa);
		$objPHPExcel->getActiveSheet()->setCellValue('DO'.$rcont, strtoupper($cod_valve))->getStyle('DO'.$rcont)->applyFromArray($styleArray); unset($cod_valve);
		$objPHPExcel->getActiveSheet()->setCellValue('DP'.$rcont, strtoupper($valve_item))->getStyle('DP'.$rcont)->applyFromArray($styleArray); unset($valve_item);
		$objPHPExcel->getActiveSheet()->setCellValue('DQ'.$rcont, strtoupper($doblado))->getStyle('DQ'.$rcont)->applyFromArray($styleArray); unset($doblado);
		$objPHPExcel->getActiveSheet()->setCellValue('DR'.$rcont, strtoupper($micro))->getStyle('DR'.$rcont)->applyFromArray($styleArray); unset($micro);
		$objPHPExcel->getActiveSheet()->setCellValue('DS'.$rcont, strtoupper($mcr_tipo_perforacion))->getStyle('DS'.$rcont)->applyFromArray($styleArray); unset($mcr_tipo_perforacion);
		$objPHPExcel->getActiveSheet()->setCellValue('DT'.$rcont, strtoupper($mrc_cant_cara_microper))->getStyle('DT'.$rcont)->applyFromArray($styleArray); unset($mrc_cant_cara_microper);
		$objPHPExcel->getActiveSheet()->setCellValue('DU'.$rcont, strtoupper($niv_estiba))->getStyle('DU'.$rcont)->applyFromArray($styleArray); unset($niv_estiba);
		$objPHPExcel->getActiveSheet()->setCellValue('DV'.$rcont, strtoupper($cant_estiba))->getStyle('DV'.$rcont)->applyFromArray($styleArray); unset($cant_estiba);
		$objPHPExcel->getActiveSheet()->setCellValue('DW'.$rcont, strtoupper($ancho_impresion))->getStyle('DW'.$rcont)->applyFromArray($styleArray); unset($ancho_impresion);
		$objPHPExcel->getActiveSheet()->setCellValue('DX'.$rcont, strtoupper("+ ".$tole_ancho_impresion_ms. " -"-$tole_ancho_impresion_mn))->getStyle('DX'.$rcont)->applyFromArray($styleArray); unset($tole_ancho_impresion_ms, $tole_ancho_impresion_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('DY'.$rcont, strtoupper($tipo_sellado))->getStyle('DY'.$rcont)->applyFromArray($styleArray); unset($tipo_sellado);

		$objPHPExcel->getActiveSheet()->setCellValue('EA'.$rcont, strtoupper($ancho_fotoc))->getStyle('EA'.$rcont)->applyFromArray($styleArray); unset($ancho_fotoc);
		$objPHPExcel->getActiveSheet()->setCellValue('EB'.$rcont, strtoupper($largo_fotoc))->getStyle('EB'.$rcont)->applyFromArray($styleArray); unset($largo_fotoc);
		$objPHPExcel->getActiveSheet()->setCellValue('EC'.$rcont, strtoupper($dfotoc_borde))->getStyle('EC'.$rcont)->applyFromArray($styleArray); unset($dfotoc_borde);
		$objPHPExcel->getActiveSheet()->setCellValue('ED'.$rcont, strtoupper($color_fotoc))->getStyle('ED'.$rcont)->applyFromArray($styleArray); unset($color_fotoc);
		$objPHPExcel->getActiveSheet()->setCellValue('EE'.$rcont, strtoupper($flag))->getStyle('EE'.$rcont)->applyFromArray($styleArray); unset($flag);
		$objPHPExcel->getActiveSheet()->setCellValue('EF'.$rcont, strtoupper($color_flag))->getStyle('EF'.$rcont)->applyFromArray($styleArray); unset($color_flag);
		$objPHPExcel->getActiveSheet()->setCellValue('EG'.$rcont, strtoupper($ubic_flag))->getStyle('EG'.$rcont)->applyFromArray($styleArray); unset($ubic_flag);
		$objPHPExcel->getActiveSheet()->setCellValue('EH'.$rcont, strtoupper($tipo_emb))->getStyle('EH'.$rcont)->applyFromArray($styleArray); unset($tipo_emb);
		$objPHPExcel->getActiveSheet()->setCellValue('EI'.$rcont, strtoupper($con_resp))->getStyle('EI'.$rcont)->applyFromArray($styleArray); unset($con_resp);
		$objPHPExcel->getActiveSheet()->setCellValue('EJ'.$rcont, strtoupper($nmax_empal))->getStyle('EJ'.$rcont)->applyFromArray($styleArray); unset($nmax_empal);
		$objPHPExcel->getActiveSheet()->setCellValue('EK'.$rcont, strtoupper($mrollo))->getStyle('EK'.$rcont)->applyFromArray($styleArray); unset($mrollo);
		$objPHPExcel->getActiveSheet()->setCellValue('EL'.$rcont, strtoupper($drollo))->getStyle('EL'.$rcont)->applyFromArray($styleArray); unset($drollo);
		$objPHPExcel->getActiveSheet()->setCellValue('EM'.$rcont, strtoupper($prollo))->getStyle('EM'.$rcont)->applyFromArray($styleArray); unset($prollo);
		$objPHPExcel->getActiveSheet()->setCellValue('EN'.$rcont, strtoupper("+ ".$tole_prollo_ms. " -".$tole_prollo_mn))->getStyle('EN'.$rcont)->applyFromArray($styleArray); unset($tole_prollo_ms, $tole_prollo_mn);
		$objPHPExcel->getActiveSheet()->setCellValue('EO'.$rcont, strtoupper($fotoc_lado))->getStyle('EO'.$rcont)->applyFromArray($styleArray); unset($fotoc_lado);
		$objPHPExcel->getActiveSheet()->setCellValue('EP'.$rcont, strtoupper($note_embalaje))->getStyle('EP'.$rcont)->applyFromArray($styleArray); unset($note_embalaje);
		*/
	}

	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(85);

	if(file_exists($uploaddir."ADM_Listfichatecnica.xls")){

		unlink($uploaddir."ADM_Listfichatecnica.xls");
	}

	fncclose($idcon);
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");

	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_Listfichatecnica.xls');

	echo 'ADM_Listfichatecnica.xls';