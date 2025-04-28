<?php 
//	error_reporting(E_ALL);
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunPerSecNiv/fncfetchall.php';
	
	include '../FunPerPriNiv/pktbltipoequipo.php';
	include '../FunPerPriNiv/pktblparaprod.php';
	include '../FunPerPriNiv/pktblplanta.php';
	include '../FunPerPriNiv/pktblsistema.php';
	include '../FunPerPriNiv/pktblequipo.php';
	include '../FunGen/cargainput.php';

	include '../FunGen/fncformat.php';
	include '../FunGen/fncdatediff.php';
	
	
	include 'Classes/PHPExcel.php';
	require 'Classes/PHPExcel/Writer/Excel5.php';
	
	
	$validLocale = PHPExcel_Settings::setLocale('Es');
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
	$idcon = fncconn();
//	
	$sbSql = "	SELECT equipo.tipequcodigo, equipo.sistemcodigo, equipo.equipocodigo, sistema.sistemnombre, equipo.equiponombre, sistema.plantacodigo
				FROM equipo, sistema 
				WHERE sistema.plantacodigo IN ({$arrusuaplanta}) AND equipo.sistemcodigo = sistema.sistemcodigo AND equipo.tipequcodigo IN ({$arrtipoequipo})
				ORDER BY sistema.sistemnombre, equipo.equiponombre";
		
	$rsEquipo = fncsqlrun($sbSql, $idcon);
	$nrEquipo = fncnumreg($rsEquipo);

	$hrTotal = datediff('h', $consulfecini.' 00:00:00', date("Y-m-d H:i", strtotime($consulfecfin." 23:59:00 + 1 minutes")) , false);

	$arrPlantas = ($arrusuaplanta) ? explode(',', $arrusuaplanta) : ''; 
	
	
	
	
	//EXCEL
	$objPHPExcel->setActiveSheetIndex($sheet)->setTitle('DISPONIBILIDAD_'.date("Y-m-d"));
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6.86);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(26);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(41);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(23);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(23);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(23);
	
	
	$objPHPExcel->getActiveSheet()->mergeCells('B3:D3')->setCellValue('B3', 'Fecha Generacion')->getStyle('B3:D3')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('B4', 'Dia')->getStyle('B4')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C4', 'Mes')->getStyle('C4')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('D4', 'Anio')->getStyle('D4')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('B5', date("d"))->getStyle('B5')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C5', date("m"))->getStyle('C5')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('D5', date("Y"))->getStyle('D5')->applyFromArray($styleArray);
	
	$objPHPExcel->getActiveSheet()->getStyle('B3:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B3:D5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B3:D4')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B3:D4')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('B5:D5')->getFill()->getStartColor()->setARGB('FFDAEEF3');	
	
	$objPHPExcel->getActiveSheet()->mergeCells('B7:C7')->setCellValue('B7', 'Periodo')->getStyle('B7:C7')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('D7:H7')->setCellValue('D7', "Desde {$consulfecini} Hasta {$consulfecfin}")->getStyle('D7:H7')->applyFromArray($styleArray);
	
	$objPHPExcel->getActiveSheet()->getStyle('B7:H7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B7:C7')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B7:C7')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('D7:H7')->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
	
	$pltRows = (is_array($arrPlantas)) ? (count($arrPlantas) - 1) : 0;
	
	$objPHPExcel->getActiveSheet()->mergeCells('B9:C'.(9 + $pltRows))->setCellValue('B9', 'Planta(s)')->getStyle('B9:C'.(9 + $pltRows))->applyFromArray($styleArray);
	
	for($a = 0; $a < count($arrPlantas); $a++)
		$objPHPExcel->getActiveSheet()->mergeCells('D'.($a + 9).':H'.($a + 9))->setCellValue('D'.($a + 9), cargaplantanombre($arrPlantas[$a], $idcon))->getStyle('D'.($a + 9).':H'.($a + 9))->applyFromArray($styleArray);
	
	$objPHPExcel->getActiveSheet()->getStyle('B9:C'.(9 + $pltRows))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B9:H'.(9 + $pltRows))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B9:C'.(9 + $pltRows))->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B9:C'.(9 + $pltRows))->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('D9:H'.(9 + $pltRows))->getFill()->getStartColor()->setARGB('FFDAEEF3');

	
	$objPHPExcel->getActiveSheet()->mergeCells('B12:E12')->setCellValue('B12', 'Numero de equipos')->getStyle('B12:E12')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('F12', $nrEquipo + 0)->getStyle('F12')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle('F12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->setCellValue('G12', 'Numero de Horas x Equipo')->getStyle('G12')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('H12', $hrTotal)->getStyle('H12')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle('H12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$objPHPExcel->getActiveSheet()->getStyle('B12:H12')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B12:E12')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B12:E12')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('F12')->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
	$objPHPExcel->getActiveSheet()->getStyle('G12')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('G12')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('H12')->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
	$endRows = 0;
	
	if($tiporeport == 1):
		$objPHPExcel->getActiveSheet()->setCellValue('B14', '#')->getStyle('B14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('C14:G14')->setCellValue('C14', 'Sistema')->getStyle('C14:G14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('H14:I14')->setCellValue('H14', 'Equipo')->getStyle('H14:I14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('J14', 'Total horas paradas')->getStyle('J14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('K14', '% Paradas')->getStyle('K14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('L14', '% Disponibilidad')->getStyle('L14')->applyFromArray($styleArray);
		
		if($nrEquipo > 0):
			$hrTotalparada = 0;
								
			for($a = 0; $a < $nrEquipo; $a++):	
				$rwEquipo = fncfetch($rsEquipo,$a);
										
				$record['plantacodigo'] = $rwEquipo['plantacodigo'];
				$record['sistemcodigo'] = $rwEquipo['sistemcodigo'];
				$record['equipocodigo'] = $rwEquipo['equipocodigo'];
				$record['parprofecini'] = "'".$consulfecini."' AND '".$consulfecfin."'";
				
				$recordop['plantacodigo'] = '=';
				$recordop['sistemcodigo'] = '=';
				$recordop['equipocodigo'] = '=';
				$recordop['parprofecini'] = 'between';
				
				$rsParaprod = dinamicscanopparaprod($record, $recordop, $idcon);
				$nrParaprod = fncnumreg($rsParaprod);
										
				$hrParada = 0;
				$intParadas = 0;
				$intDisponibilidad = 100;
										
				if($nrParaprod):
					for($b = 0; $b < $nrParaprod; $b++):
						$rwParaprod = fncfetch($rsParaprod, $b);
	
						$fchInicia = $rwParaprod['parprofecini'].' '.$rwParaprod['parprohorini'];
						($rwParaprod['parprofecfin']) ? $fchFinal = $rwParaprod['parprofecfin'].' '.$rwParaprod['parprohorfin'] : $fchFinal = $fchFin.' 23:59:00';
											
						$nrHoras = datediff('n', $fchInicia, date("Y-m-d H:i", strtotime($fchFinal." + 1 minutes")), false);
						$hrParada += round(($nrHoras / 60) * 100) / 100;
					endfor;
											
					$hrTotalparada += $hrParada;
											
					$intDisponibilidad = round(((($hrTotal - $hrParada) / $hrTotal) * 100) * 100) / 100;
					$intParadas = 100 - $intDisponibilidad; //round((($hr_parada * 100)/$hr_total) * 100) / 100;
				endif;

				$endRows++;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.(15 + $a), ($a + 1))->getStyle('B'.(15 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.(15 + $a).':G'.(15 + $a))->setCellValue('C'.(15 + $a), cargasistemnombre($rwEquipo['sistemcodigo'], $idcon))->getStyle('C'.(15 + $a).':G'.(15 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('H'.(15 + $a).':I'.(15 + $a))->setCellValue('H'.(15 + $a), cargaequiponombre($rwEquipo['equipocodigo'], $idcon))->getStyle('H'.(15 + $a).':I'.(15 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.(15 + $a), $hrParada)->getStyle('J'.(15 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.(15 + $a), $intParadas.' %')->getStyle('K'.(15 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.(15 + $a), $intDisponibilidad.' %')->getStyle('L'.(15 + $a))->applyFromArray($styleArray);	
			
			endfor;
		endif;
		
		
	else:
		$objPHPExcel->getActiveSheet()->setCellValue('B14', '#')->getStyle('B14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('C14:G14')->setCellValue('C14', 'Tipo equipo')->getStyle('C14:G14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->mergeCells('H14:I14')->setCellValue('H14', '# Equipo')->getStyle('H14:I14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('J14', 'Total horas paradas')->getStyle('J14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('K14', '% Paradas')->getStyle('K14')->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet()->setCellValue('L14', '% Disponibilidad')->getStyle('L14')->applyFromArray($styleArray);
		
		if($nrEquipo > 0):
			$hrTotalparada = 0;
			$arrTipequ = array();
			$nrEqu = array();
									
			for($a = 0; $a < $nrEquipo; $a++):	
				$rwEquipo = fncfetch($rsEquipo,$a);
				
				if(!array_key_exists($rwEquipo['tipequcodigo'], $arrTipequ))
					$arrTipequ[$rwEquipo['tipequcodigo']] = 0;

				if(!array_key_exists($rwEquipo['tipequcodigo'], $nrEqu))
					$nrEqu[$rwEquipo['tipequcodigo']] = 1;
				else	
					$nrEqu[$rwEquipo['tipequcodigo']] ++;
					
				$record['plantacodigo'] = $rwEquipo['plantacodigo'];
				$record['sistemcodigo'] = $rwEquipo['sistemcodigo'];
				$record['equipocodigo'] = $rwEquipo['equipocodigo'];
				$record['parprofecini'] = "'".$consulfecini."' AND '".$consulfecfin."'";

				$recordop['plantacodigo'] = '=';
				$recordop['sistemcodigo'] = '=';
				$recordop['equipocodigo'] = '=';
				$recordop['parprofecini'] = 'between';

				$rsParaprod = dinamicscanopparaprod($record, $recordop, $idcon);
				$nrParaprod = fncnumreg($rsParaprod);
				
				$hrParada = 0;
				$intParadas = 0;
				$intDisponibilidad = 100;
				
				if($nrParaprod):
					for($b = 0; $b < $nrParaprod; $b++):
						$rwParaprod = fncfetch($rsParaprod, $b);

						$fchInicia = $rwParaprod['parprofecini'].' '.$rwParaprod['parprohorini'];
						($rwParaprod['parprofecfin']) ? $fchFinal = $rwParaprod['parprofecfin'].' '.$rwParaprod['parprohorfin'] : $fchFinal = $fchFin.' 23:59:00';
											
						$nrHoras = datediff('n', $fchInicia, date("Y-m-d H:i", strtotime($fchFinal." + 1 minutes")), false);
						$hrParada += round(($nrHoras / 60) * 100) / 100;
					endfor;
					
					$arrTipequ[$rwEquipo['tipequcodigo']] += $hrParada;
					$hrTotalparada += $hrParada;
				endif;
			endfor;

			$a = 0;
			foreach ($arrTipequ as $key => $value):
				$a ++;
				$intDisponibilidad = round(((($hrTotal - $value) / $hrTotal) * 100) * 100) / 100;
				$intParadas = 100 - $intDisponibilidad; //round((($hr_parada * 100)/$hr_total) * 100) / 100;

				$endRows++;
				$objPHPExcel->getActiveSheet()->setCellValue('B'.(14 + $a), ($a))->getStyle('B'.(14 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('C'.(14 + $a).':G'.(14 + $a))->setCellValue('C'.(14 + $a), cargatipequnombre($key, $idcon))->getStyle('C'.(14 + $a).':G'.(14 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->mergeCells('H'.(14 + $a).':I'.(14 + $a))->setCellValue('H'.(14 + $a), $nrEqu[$key])->getStyle('H'.(14 + $a).':I'.(14 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.(14 + $a), fmtCurrency($value))->getStyle('J'.(14 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.(14 + $a), fmtCurrency($intParadas).' %')->getStyle('K'.(14 + $a))->applyFromArray($styleArray);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.(14 + $a), fmtCurrency($intDisponibilidad).' %')->getStyle('L'.(14 + $a))->applyFromArray($styleArray);				
			endforeach;
		endif;
	endif;
	
	$objPHPExcel->getActiveSheet()->getStyle('B14:L14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B14:L'.(14 + $endRows))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B14:L14')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B14:L14')->getFont()->getColor()->setARGB("FF1F497D");
	
	if($endRows)
		$objPHPExcel->getActiveSheet()->getStyle('B15:L'.(14 + $endRows))->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
	$fnlRow = (14 + $endRows) + 2;
	$Disponibilidad = round( (((($hrTotal * $nrEquipo) - $hrTotalparada) / ($hrTotal * $nrEquipo)) * 100)	* 100) / 100; 
	$Parada = 100 - $Disponibilidad;	
		
	
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':F'.$fnlRow)->setCellValue('B'.$fnlRow, '% Paradas Total')->getStyle('B'.$fnlRow.':F'.$fnlRow)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('G'.$fnlRow.':I'.$fnlRow)->setCellValue('G'.$fnlRow, $Parada.'%')->getStyle('G'.$fnlRow.':I'.$fnlRow)->applyFromArray($styleArray);
	
	$fnlRow++;
	
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':F'.$fnlRow)->setCellValue('B'.$fnlRow, '% Disponilidad Total')->getStyle('B'.$fnlRow.':F'.$fnlRow)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('G'.$fnlRow.':I'.$fnlRow)->setCellValue('G'.$fnlRow, $Disponibilidad.'%')->getStyle('G'.$fnlRow.':I'.$fnlRow)->applyFromArray($styleArray);
	
	$fnlRow++;
	
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':F'.$fnlRow)->setCellValue('B'.$fnlRow, '% Aceptable')->getStyle('B'.$fnlRow.':F'.$fnlRow)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('G'.$fnlRow.':I'.$fnlRow)->setCellValue('G'.$fnlRow, '95%')->getStyle('G'.$fnlRow.':I'.$fnlRow)->applyFromArray($styleArray);
	
	$fnlRow++;
	
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':F'.$fnlRow)->setCellValue('B'.$fnlRow, 'Formula de disponibilidad')->getStyle('B'.$fnlRow.':F'.$fnlRow)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->mergeCells('G'.$fnlRow.':I'.$fnlRow)->setCellValue('G'.$fnlRow, "(([Total numero de horas] - [Horas paradas]) / [Total numero de horas]) * 100")->getStyle('G'.$fnlRow.':I'.$fnlRow)->applyFromArray($styleArray);
	
	$objPHPExcel->getActiveSheet()->getStyle('G'.($fnlRow - 3).':I'.($fnlRow))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 3).':I'.($fnlRow))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 3).':F'.($fnlRow))->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 3).':F'.($fnlRow))->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('G'.($fnlRow - 3).':I'.($fnlRow))->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
	
	$fnlRow += 2;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':L'.$fnlRow)->setCellValue('B'.$fnlRow, 'Observaciones')->getStyle('B'.$fnlRow.':L'.$fnlRow)->applyFromArray($styleArray);
	$fnlRow++;
	$objPHPExcel->getActiveSheet()->mergeCells('B'.$fnlRow.':L'.$fnlRow)->setCellValue('B'.$fnlRow, $consulobserv)->getStyle('B'.$fnlRow.':L'.$fnlRow)->applyFromArray($styleArray);
	
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 1).':L'.$fnlRow)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 1).':L'.($fnlRow - 1))->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('B'.($fnlRow - 1).':L'.($fnlRow - 1))->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('B'.$fnlRow.':L'.$fnlRow)->getFill()->getStartColor()->setARGB('FFDAEEF3');
	
/*
	->getRowDimension(2)->setRowHeight(2);
	
	
	
	
	
	$objPHPExcel->getActiveSheet()->mergeCells('B3:D3')->setCellValue('B3', 'Fecha Generacion')->getStyle('B3:D3')->applyFromArray($styleArray);
	
	
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'CODIGO ACTIVO')->getStyle('A1')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ACTIVO')->getStyle('B1')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'CODIGO SRF')->getStyle('C1')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'FECHA INSTALACION')->getStyle('D1')->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'VIDA UTIL (Meses)')->getStyle('E1')->applyFromArray($styleArray);
	
	
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$indicCol.'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$indicCol.'1')->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$indicCol.'1')->getFont()->getColor()->setARGB("FF1F497D");
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$indicCol.'1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(3);
	*/
	
	
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);
	$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_InfDisponibilidad.xls');
	
	echo 'ADM_InfDisponibilidad.xls';