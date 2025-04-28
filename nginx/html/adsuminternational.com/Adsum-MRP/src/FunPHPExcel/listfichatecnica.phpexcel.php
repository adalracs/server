<?php
	ini_set('memory_limit', '2048M');
	ini_set("max_execution_time", 72000);
	 
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
	$objPHPExcel->getActiveSheet()->getColumnDimension('EP')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('EQ')->setWidth(40);
	$objPHPExcel->getActiveSheet()->getColumnDimension('ER')->setWidth(40);

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

	$objPHPExcel->getActiveSheet()->setCellValue('CP'.$rcont, utf8_decode('OBSERVACIONES FORMA DE EMPAQUE'))->getStyle('CP'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$rcont, utf8_decode('UNIDADES'))->getStyle('CQ'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CR'.$rcont, utf8_decode('KILOGRAMOS'))->getStyle('CR'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CS'.$rcont, utf8_decode('COLOR EMPALME CARA'))->getStyle('CS'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CT'.$rcont, utf8_decode('COLOR EMPALME DORSO'))->getStyle('CT'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CU'.$rcont, utf8_decode('OBSERVACIONES TEXTOS LEGALES'))->getStyle('CU'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CV'.$rcont, utf8_decode('TIPO SELLE'))->getStyle('CV'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CW'.$rcont, utf8_decode('NO. SELLES'))->getStyle('CW'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CX'.$rcont, utf8_decode('TIPO CIERRE'))->getStyle('CX'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CY'.$rcont, utf8_decode('TIPO APERTURA'))->getStyle('CY'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('CZ'.$rcont, utf8_decode('OBSERVACIONES SELLADO'))->getStyle('CZ'.$rcont)->applyFromArray($styleArray);

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
	$objPHPExcel->getActiveSheet()->setCellValue('EQ'.$rcont, utf8_decode('OBSERVACIONES MICROPERFORADO'))->getStyle('EQ'.$rcont)->applyFromArray($styleArray);	
	$objPHPExcel->getActiveSheet()->setCellValue('ER'.$rcont, utf8_decode('OBSERVACIONES DOBLADO'))->getStyle('ER'.$rcont)->applyFromArray($styleArray);	

	$objPHPExcel->getActiveSheet()->getStyle('EA'.($rcont).':ER'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('EA'.($rcont).':ER'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);	
###### Aqui está el errir
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
########## La idea es pasar esto a un archivo
		$rsCpfichdetope = fncsqlrun($sbSql, $idcon);
		$nrCpfichdetope = fncnumreg($rsCpfichdetope);

		$arrCamperfichaT =array();

		if($nrCpfichdetope > 0){

			for($b = 0; $b < $nrCpfichdetope; $b++){

				$rwCpfichdetope = fncfetch($rsCpfichdetope, $b);

				$arrCamperfichaT[$rwProducto["produccodigo"]][$rwCpfichdetope["cpfichnombre"]] = $rwCpfichdetope["cpftdovalor"];
			}
		}

		$objPHPExcel->getActiveSheet()->setCellValue('I'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["respon"]))->getStyle('I'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["codigosap"]))->getStyle('J'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('K'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_estruc"]))->getStyle('K'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('L'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_impresion"]))->getStyle('L'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('M'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["equiponombre"]))->getStyle('M'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('N'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["producto_avaliable"]))->getStyle('N'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["product_imp_nomb"]))->getStyle('O'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('P'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["laminado_1"]))->getStyle('P'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('Q'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["laminado_2"]))->getStyle('Q'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('R'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["laminado_3"]))->getStyle('R'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('S'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["pantone"] > 0)? "SI" : "NO" ))->getStyle('S'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('T'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["muestra"] > 0)? "SI" : "NO" ))->getStyle('T'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('U'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["est_color"] > 0)? "SI" : "NO" ))->getStyle('U'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('V'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["pcolor"] > 0)? "SI" : "NO" ))->getStyle('V'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('W'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_calor"] > 0)? "SI" : "NO" ))->getStyle('W'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('X'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_luz"] > 0)? "SI" : "NO" ))->getStyle('X'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('Y'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_acidos"] > 0)? "SI" : "NO" ))->getStyle('Y'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('Z'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_alcalis"] > 0)? "SI" : "NO" ))->getStyle('Z'.$rcont)->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setCellValue('AA'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_agua"] > 0)? "SI" : "NO" ))->getStyle('AA'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AB'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_grasas"] > 0)? "SI" : "NO" ))->getStyle('AB'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AC'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_brillo"] > 0)? "SI" : "NO" ))->getStyle('AC'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AD'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tnt_rayado"] > 0)? "SI" : "NO" ))->getStyle('AD'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AE'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_laminacion"] > 0)? "SI" : "NO" ))->getStyle('AE'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AF'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_superficie"] > 0)? "SI" : "NO" ))->getStyle('AF'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AG'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_uretelasto"] > 0)? "SI" : "NO" ))->getStyle('AG'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AH'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_nitropolia"] > 0)? "SI" : "NO" ))->getStyle('AH'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AI'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_vinilica"] > 0)? "SI" : "NO" ))->getStyle('AI'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_nitrocelu"] > 0)? "SI" : "NO" ))->getStyle('AJ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AK'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_nitroure"] > 0)? "SI" : "NO" ))->getStyle('AK'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AL'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["tntesp_poliamo"] > 0)? "SI" : "NO" ))->getStyle('AL'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AM'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_pmetali"] > 0)? "SI" : "NO" ))->getStyle('AM'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AN'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_lacacaliz"] > 0)? "SI" : "NO" ))->getStyle('AN'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AO'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_bamiz1"] > 0)? "SI" : "NO" ))->getStyle('AO'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AP'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_lacatermo"] > 0)? "SI" : "NO" ))->getStyle('AP'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_hotmelt"] > 0)? "SI" : "NO" ))->getStyle('AQ'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AR'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_parafina"] > 0)? "SI" : "NO" ))->getStyle('AR'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AS'.$rcont, strtoupper( ($arrCamperfichaT[$rwProducto['produccodigo']]["other_lacaantiperoxido"] > 0)? "SI" : "NO" ))->getStyle('AS'.$rcont)->applyFromArray($styleArray);		

		$objPHPExcel->getActiveSheet()->setCellValue('AU'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["version_arte"]))->getStyle('AU'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AV'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["papel_pouch_imppor"]))->getStyle('AV'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AW'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["foil_imppor"]))->getStyle('AW'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AX'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["total_calibre"]))->getStyle('AX'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AY'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["total_gramaje"]))->getStyle('AY'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('AZ'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_calib_ms"]." -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_calib_mn"]))->getStyle('AZ'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BA'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_grama_ms"]." -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_grama_mn"]))->getStyle('BA'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BB'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ancho"]))->getStyle('BB'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BC'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_ancho_ms"]." -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_ancho_mn"]))->getStyle('BC'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BD'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["largo"]))->getStyle('BD'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BE'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_largo_ms"]." -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_largo_mn"]))->getStyle('BE'.$rcont)->applyFromArray($styleArray);	
		$objPHPExcel->getActiveSheet()->setCellValue('BF'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["fuelle"]))->getStyle('BF'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BG'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_fuelle_ms"]." -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_fuelle_mn"]))->getStyle('BG'.$rcont)->applyFromArray($styleArray);	
		$objPHPExcel->getActiveSheet()->setCellValue('BH'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["traslape"]))->getStyle('BH'.$rcont)->applyFromArray($styleArray);		
		$objPHPExcel->getActiveSheet()->setCellValue('BI'.$rcont, strtoupper("+ ".$tole_traslape_ms." -".$tole_traslape_mn))->getStyle('BI'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BJ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_traslape"]))->getStyle('BJ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BK'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["aselle_bolsa"]))->getStyle('BK'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BL'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["valve"]))->getStyle('BL'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BM'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ctapa_valve"]))->getStyle('BM'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BN'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["medi_valve"]))->getStyle('BN'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BO'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ubic_valve"]))->getStyle('BO'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BP'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_valve"]))->getStyle('BP'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BQ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["troquel"]))->getStyle('BQ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BR'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_troquel"]))->getStyle('BR'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BS'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_llenado"]))->getStyle('BS'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BT'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cod_barras"]))->getStyle('BT'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BU'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["color_fondo_barras"]))->getStyle('BU'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BV'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["color_barras"]))->getStyle('BV'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BW'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["continuo"]))->getStyle('BW'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BX'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["nrorepet"]))->getStyle('BX'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BY'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["rodillo"]))->getStyle('BY'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('BZ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["nropistas"]))->getStyle('BZ'.$rcont)->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setCellValue('CB'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_empaque"]))->getStyle('CB'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CC'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["uni_empaque"]))->getStyle('CC'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CD'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cod_caja"]))->getStyle('CD'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CE'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["caja_item"]))->getStyle('CE'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CF'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["uni_paquete"]))->getStyle('CF'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CG'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["peso_empaque"]))->getStyle('CG'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CH'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["estibado"]))->getStyle('CH'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CI'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tam_estiba"]))->getStyle('CI'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CJ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_estiba"]))->getStyle('CJ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CK'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["alt_pallet"]))->getStyle('CK'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CL'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["pes_pallet"]))->getStyle('CL'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CM'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["estresado"]))->getStyle('CM'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CN'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cod_estiba"]))->getStyle('CN'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('CO'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["estiba_item"]))->getStyle('CO'.$rcont)->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setCellValue('CP'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_formaempaque"]))->getStyle('CP'.$rcont)->applyFromArray($styleArray); unset($tipoemp_palletenf);
		$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["unimedi_und"]))->getStyle('CQ'.$rcont)->applyFromArray($styleArray); unset($tipoemp_bolsatubpet);
		$objPHPExcel->getActiveSheet()->setCellValue('CR'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["unimedi_kgs"]))->getStyle('CR'.$rcont)->applyFromArray($styleArray); unset($tipoemp_caja);
		$objPHPExcel->getActiveSheet()->setCellValue('CS'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cempal_cara"]))->getStyle('CS'.$rcont)->applyFromArray($styleArray); unset($tipoemp_pcore);
		$objPHPExcel->getActiveSheet()->setCellValue('CT'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cempal_dorso"]))->getStyle('CT'.$rcont)->applyFromArray($styleArray); unset($tipoemp_cartonext);
		$objPHPExcel->getActiveSheet()->setCellValue('CU'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_product"]))->getStyle('CU'.$rcont)->applyFromArray($styleArray); unset($tipoemp_separadorc);
		$objPHPExcel->getActiveSheet()->setCellValue('CV'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_selle"]))->getStyle('CV'.$rcont)->applyFromArray($styleArray); unset($tipoemp_envueltoc);
		$objPHPExcel->getActiveSheet()->setCellValue('CW'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["sellos"]))->getStyle('CW'.$rcont)->applyFromArray($styleArray); unset($tipoemp_suspendido);
		$objPHPExcel->getActiveSheet()->setCellValue('CX'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_cierre"]))->getStyle('CX'.$rcont)->applyFromArray($styleArray); unset($tipoemp_estibaexp);
		$objPHPExcel->getActiveSheet()->setCellValue('CY'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_aper"]))->getStyle('CY'.$rcont)->applyFromArray($styleArray); unset($unimedi_und);
		$objPHPExcel->getActiveSheet()->setCellValue('CZ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_sellado"]))->getStyle('CZ'.$rcont)->applyFromArray($styleArray); unset($unimedi_kgs);

		$objPHPExcel->getActiveSheet()->setCellValue('DB'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["unimedi_mill"]))->getStyle('DB'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DC'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["unimedi_mtr"]))->getStyle('DC'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DD'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["papel_pouch_lampor"]))->getStyle('DD'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DE'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["foil_lampor"]))->getStyle('DE'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DF'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["trata_corte"]))->getStyle('DF'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DG'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_drollo_ms"]. " -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_drollo_mn"]))->getStyle('DG'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DH'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tam_core"]))->getStyle('DH'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DI'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["abundancia"]))->getStyle('DI'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DJ'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_abundancia_ms"]. " -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_abundancia_mn"]))->getStyle('DJ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DK'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["forma_sellado"]))->getStyle('DK'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DL'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["dist_precalentadores"]))->getStyle('DL'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DM'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["maquina"]))->getStyle('DM'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DN'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tamano_solapa"]))->getStyle('DN'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DO'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cod_valve"]))->getStyle('DO'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DP'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["valve_item"]))->getStyle('DP'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DQ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["doblado"]))->getStyle('DQ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DR'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["micro"]))->getStyle('DR'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DS'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["mcr_tipo_perforacion"]))->getStyle('DS'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DT'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["mrc_cant_cara_microper"]))->getStyle('DT'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DU'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["niv_estiba"]))->getStyle('DU'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DV'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["cant_estiba"]))->getStyle('DV'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DW'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ancho_impresion"]))->getStyle('DW'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DX'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_ancho_impresion_ms"]. " -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_ancho_impresion_mn"]))->getStyle('DX'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('DY'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_sellado"]))->getStyle('DY'.$rcont)->applyFromArray($styleArray);

		$objPHPExcel->getActiveSheet()->setCellValue('EA'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ancho_fotoc"]))->getStyle('EA'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EB'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["largo_fotoc"]))->getStyle('EB'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EC'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["dfotoc_borde"]))->getStyle('EC'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('ED'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["color_fotoc"]))->getStyle('ED'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EE'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["flag"]))->getStyle('EE'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EF'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["color_flag"]))->getStyle('EF'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EG'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["ubic_flag"]))->getStyle('EG'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EH'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["tipo_emb"]))->getStyle('EH'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EI'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["con_resp"]))->getStyle('EI'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EJ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["nmax_empal"]))->getStyle('EJ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EK'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["mrollo"]))->getStyle('EK'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EL'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["drollo"]))->getStyle('EL'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EM'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["prollo"]))->getStyle('EM'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EN'.$rcont, strtoupper("+ ".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_prollo_ms"]. " -".$arrCamperfichaT[$rwProducto['produccodigo']]["tole_prollo_mn"]))->getStyle('EN'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EO'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["fotoc_lado"]))->getStyle('EO'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EP'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_embalaje"]))->getStyle('EP'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('EQ'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_micro"]))->getStyle('EQ'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('ER'.$rcont, strtoupper($arrCamperfichaT[$rwProducto['produccodigo']]["note_doblado"]))->getStyle('ER'.$rcont)->applyFromArray($styleArray);
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