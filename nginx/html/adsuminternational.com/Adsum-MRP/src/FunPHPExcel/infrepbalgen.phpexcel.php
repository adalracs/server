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
	
	
	// Arreglos para los balances
	$arr_mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	
	$geneinter = array();
	$menprovee = array();
	$disparinv = array();
	$invactfijo = array();
	$masincrobli = array();
	$masingegroper = array();
	$totaflujfina = array();
	$varotrcuepat = array();
	$flujcajautil = array();
	$capitaliza = array();
	$flujoneto = array();
	
	if(!$balgenperiod)
		$balgenperiod = '1-0';	
	// Arreglos para los balances
	
	
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName('Tahoma');
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
	
	$uploaddir = '../../temp/';
	$sheet = 0;
	$metRow = 1;
	
	//Para modulo de Balance
	$ctrl = 0;
	$date = date('Y-m-d', strtotime('2000-12-31'));
	
	
	
	for(;;):
		$subdate = $date;
		$ctrl ++;
		
		if(($ctrl % 2) == 0)
			$date = date('Y-m-d' , strtotime($date." + 6 months + 1 days"));
		else
			$date = date('Y-m-d' , strtotime($date." + 6 months - 1 days"));
			
		if($date > date('Y-m-d'))
			break;
	
		$strd = strtotime($date);
		$strsd = strtotime($subdate);	

		$ar_periodo = array($ctrl, ($ctrl-1));
		
		
		if($sheet > 0) $objPHPExcel->createSheet();
		$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr(sprintf('%s %s - %s %s', $arr_mes[date('n',$strd)-1], date('Y',$strd), $arr_mes[date('n',$strsd)-1], date('Y',$strsd)),0,30));

		/* B  A  L  A  N  C  E     G  E  N  E  R  A  L */
		
		$objPHPExcel->getActiveSheet()->mergeCells('A1:F1')->setCellValue('A1', 'CONTRATO No. CGE-027-2000')->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->mergeCells('A2:F2')->setCellValue('A2', 'Concesion Alumbrado Publico de Cali')->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->mergeCells('A3:F3')->setCellValue('A3', 'B  A  L  A  N  C  E     G  E  N  E  R  A  L')->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->mergeCells('A4:F4')->setCellValue('A4', sprintf('Al %s de %s de %s y %s de %s de %s', date('d',$strd), $arr_mes[date('n',$strd)-1], date('Y',$strd), date('d',$strsd), $arr_mes[date('n',$strsd)-1], date('Y',$strsd)))->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1:A4')->getFont()->setBold(true);
		
		$metRow = 6; // se inicializa a metrow con '6'
		
		//SESSION ONE
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'ACTIVO')->getStyle('A'.$metRow.':F'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 'Nota')->getStyle('D'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[0]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[0]])))->getStyle('E'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[1]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[1]])))->getStyle('F'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'ACTIVO CORRIENTE');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 1120);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Disponible  - Fideicomiso');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 3);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1120][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1120][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Total Activo Corriente  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1120][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1120][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 1255);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'INVERSIONES PERMANENTES - Obligatorias');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1255][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1255][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;							
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 1500);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'PROPIEDADES PLANTA Y EQUIPO');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 4);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1500][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1500][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);							
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 1710);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'DIFERIDOS');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1710][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1710][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		
		//Formula sumatoria de las cuentas
		$count_a =  $ar_count[1500][$ar_periodo[0]] + $ar_count[1710][$ar_periodo[0]] + $ar_count[1255][$ar_periodo[0]] + $ar_count[1120][$ar_periodo[0]];
		$count_b =  $ar_count[1500][$ar_periodo[1]] + $ar_count[1710][$ar_periodo[1]] + $ar_count[1255][$ar_periodo[1]] + $ar_count[1120][$ar_periodo[1]];
		//Formula sumatoria de las cuentas
		
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'TOTAL DEL ACTIVO  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_a))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_b))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		$metRow++;
		//-

		
		//SESSION TWO
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'PASIVO  Y  PATRIMONIO DE LOS ACCIONISTAS')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 'Nota')->getStyle('D'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[0]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[0]])))->getStyle('E'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[1]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[1]])))->getStyle('F'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'PASIVO CORRIENTE');
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Cuentas por Pagar');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Total Pasivo Corriente  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'PASIVO NO CORRIENTE');
		$metRow++;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 2105);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Obligaciones Financieras');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 5);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[2105][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[2105][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 235505);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Retorno Equity - Intereses');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 6);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[235505][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[235505][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		
		//Formula sumatoria de las cuentas
		$count_c =  $ar_count[2105][$ar_periodo[0]] + $ar_count[235505][$ar_periodo[0]];
		$count_d =  $ar_count[2105][$ar_periodo[1]] + $ar_count[235505][$ar_periodo[1]];
		//Formula sumatoria de las cuentas
										
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Total Pasivo a Largo Plazo  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_c))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_d))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'TOTAL DEL PASIVO  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_c))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_d))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		$metRow++;
		//-
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'PATRIMONIO');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 7);
		$metRow++;
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 2105);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Capital Aportado al Proyecto');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3140][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3140][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 3705);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Resultados de Ejercicios Anteriores');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3705][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3705][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 3605);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Resultado del Ejercicio');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3605][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3605][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		
		//Formula sumatoria de las cuentas
		$count_e =  $ar_count[3140][$ar_periodo[0]] + $ar_count[3705][$ar_periodo[0]] + $ar_count[3605][$ar_periodo[0]];
		$count_f =  $ar_count[3140][$ar_periodo[1]] + $ar_count[3705][$ar_periodo[1]] + $ar_count[3605][$ar_periodo[1]];
		//Formula sumatoria de las cuentas
		
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'TOTAL DEL PATRIMONIO  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_e))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_f))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'TOTAL PASIVO Y PATRIMONIO  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_c + $count_e))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_d + $count_f))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		//-

		
		
		/* E S T A D O   D E   G A N A N C I A S   Y   P E R D I D A S */
		$metRow += 4;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'CONTRATO No. CGE-027-2000')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'Concesion Alumbrado Publico de Cali')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'E S T A D O   D E   G A N A N C I A S   Y   P E R D I D A S')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, sprintf('Al %s de %s de %s y %s de %s de %s', date('d',$strd), $arr_mes[date('n',$strd)-1], date('Y',$strd), date('d',$strsd), $arr_mes[date('n',$strsd)-1], date('Y',$strsd)))->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$metRow++;
		
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 'Nota')->getStyle('D'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[0]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[0]])))->getStyle('E'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[1]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[1]])))->getStyle('F'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 4125);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Ingresos - Recaudo Alumbrado Publico');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[4125][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[4125][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 6135);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Costos - Energia');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[6135][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[6135][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		//Formula sumatoria de las cuentas		
		$count_g =  $ar_count[4125][$ar_periodo[0]] - $ar_count[6135][$ar_periodo[0]];
		$count_h =  $ar_count[4125][$ar_periodo[1]] - $ar_count[6135][$ar_periodo[1]];
		//Formula sumatoria de las cuentas		
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Utilidad Bruta  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_g))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_h))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 52);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Gastos de Ventas');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 7);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_countt[52][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_countt[52][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 51);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Gastos de Administracion');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 8);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_countt[51][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_countt[51][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		//Formula sumatoria de las cuentas			
		$count_i = $count_g - $ar_countt[52][$ar_periodo[0]] - $ar_countt[51][$ar_periodo[0]];
		$count_j = $count_h - $ar_countt[52][$ar_periodo[1]] - $ar_countt[51][$ar_periodo[1]];
		//Formula sumatoria de las cuentas		
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Utilidad Operacional  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_i))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_j))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 42);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Ingresos no Operacionales');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_countt[42][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_countt[42][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$metRow, 53);
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Gastos no Operacionales');
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 9);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_countt[53][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_countt[53][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		//Formula sumatoria de las cuentas			
		$count_k = $count_i + $ar_countt[42][$ar_periodo[0]] - $ar_countt[53][$ar_periodo[0]];
		$count_l = $count_j + $ar_countt[42][$ar_periodo[1]] - $ar_countt[53][$ar_periodo[1]];
		//Formula sumatoria de las cuentas		
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Utilidad Antes de Impuestos  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_k))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_l))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Provision Impuesto de Renta');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':C'.$metRow)->setCellValue('A'.$metRow, 'Utilidad Neta del Ejercicio  ')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_k))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_l))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		//-
		
		/* E S T A D O   D E   F L U J O   D E   E F E C T I V O */
		$metRow += 4;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'CONTRATO No. CGE-027-2000')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'Concesion Alumbrado Publico de Cali')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, 'E S T A D O   D E   F L U J O   D E   E F E C T I V O')->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$metRow.':F'.$metRow)->setCellValue('A'.$metRow, sprintf('Al %s de %s de %s y %s de %s de %s', date('d',$strd), $arr_mes[date('n',$strd)-1], date('Y',$strd), date('d',$strsd), $arr_mes[date('n',$strsd)-1], date('Y',$strsd)))->getStyle('A'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$metRow)->getFont()->setBold(true);
		$metRow++;
		$metRow++;
		
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$metRow, 'Nota')->getStyle('D'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[0]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[0]])))->getStyle('E'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, $arr_mes[date('n', strtotime($ar_date[$ar_periodo[1]])) - 1].'-'.date('Y', strtotime($ar_date[$ar_periodo[1]])))->getStyle('F'.$metRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$metRow++;
		//-
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Flujo de efectivo proveniente de las operaciones:');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Utilidad neta del ejercicio');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3605][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3605][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Ajuste para conciliar la ganancia neta al efectivo');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Provisto (usado) por las operaciones:');
		$metRow++;
		//-
		//Formula sumatoria de las cuentas	
		$count_m = $ar_count[5160][$ar_periodo[0]] - $ar_count[5265][$ar_periodo[0]];
		$count_n = $ar_count[5160][$ar_periodo[1]] - $ar_count[5265][$ar_periodo[1]];
		//Formula sumatoria de las cuentas	
		//-
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Depreciacion y Amortizacion');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($count_m))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($count_n))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Perdida en venta de Inversiones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Utilidad en venta de Inversiones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Utilidad en venta y retiro de bienes');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;

		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3605][$ar_periodo[0]] + $count_m))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3605][$ar_periodo[1]] + $count_m))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Cambios en Activos y Pasivos Operacionales');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Disminucion (Aumento) Deudores');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento de las inversiones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento Inventario');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento gastos pagados por anticipado');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento (Disminucion) Diferidos');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento Proveedores');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento (disminucion)  Cuentas por Pagar');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[235505][$ar_periodo[0]] - $ar_count[235505][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[235505][$ar_periodo[1]] - $ar_count[235505][$ar_periodo[1] -1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento Pasivos estimados y provisiones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
				
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento (Disminucion)  Anticipos Recibidos');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
				
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento Impuestos por Pagar');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
				
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aumento Obligaciones Laborales');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
		$metRow++;		
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Efectivo neto provisto por (usado en) las operaciones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[235505][$ar_periodo[0]] - $ar_count[235505][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[235505][$ar_periodo[1]] - $ar_count[235505][$ar_periodo[1] -1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Flujo de efectivo de las actividades de Inversion');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Intangibles');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Valor Recibido en Venta de Inversiones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Otros activos');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Adquisicion de propiedad y equipo');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1505][$ar_periodo[1]] - $ar_count[1505][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1505][$ar_periodo[1]-1] - $ar_count[1505][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Efectivo neto provisto por (usado en) las actividades de Inversion');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1505][$ar_periodo[1]] - $ar_count[1505][$ar_periodo[0]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1505][$ar_periodo[1]-1] - $ar_count[1505][$ar_periodo[1]]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Flujo de efectivo de actividades de Financiacion:');
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Obligaciones Financieras adquiridas');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[2105][$ar_periodo[0]] - $ar_count[2105][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[2105][$ar_periodo[1]] - $ar_count[2105][$ar_periodo[1]-1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Pagos de obligaciones financieras');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Pago Dividendos');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Aportes de Capital');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[3140][$ar_periodo[0]] - $ar_count[3140][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[3140][$ar_periodo[1]] - $ar_count[3140][$ar_periodo[1]-1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
		
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$metRow, 'Prima en Colocacion de acciones');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, 0)->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, 0)->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;		
		$metRow++;		
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Efectivo neto usado (provisto) en las actividades de Financiacion');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round(($ar_count[2105][$ar_periodo[0]] - $ar_count[2105][$ar_periodo[1]]) + ($ar_count[3140][$ar_periodo[0]] - $ar_count[3140][$ar_periodo[1]])))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round(($ar_count[2105][$ar_periodo[1]] - $ar_count[2105][$ar_periodo[1]-1]) + ($ar_count[3140][$ar_periodo[1]] - $ar_count[3140][$ar_periodo[1]-1])))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
		//-
		//Formula sumatoria de las cuentas	
		$aumdimefec_a = ($ar_count[3605][$ar_periodo[0]] + $count_m) +
						($ar_count[235505][$ar_periodo[0]] - $ar_count[235505][$ar_periodo[1]]) +
						($ar_count[1505][$ar_periodo[1]] - $ar_count[1505][$ar_periodo[0]]) +
						(($ar_count[2105][$ar_periodo[0]] - $ar_count[2105][$ar_periodo[1]]) + ($ar_count[3140][$ar_periodo[0]] - $ar_count[3140][$ar_periodo[1]]) );
						
		$aumdimefec_b = ($ar_count[3605][$ar_periodo[1]] + $count_n) +
						($ar_count[235505][$ar_periodo[1]] - $ar_count[235505][$ar_periodo[1] -1]) +
						($ar_count[1505][$ar_periodo[1]-1] - $ar_count[1505][$ar_periodo[1]]) +
						(($ar_count[2105][$ar_periodo[1]] - $ar_count[2105][$ar_periodo[1]-1]) + ($ar_count[3140][$ar_periodo[1]] - $ar_count[3140][$ar_periodo[1]-1]));
		//Formula sumatoria de las cuentas	
		//-	
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Aumento (Disminucion) en efectivo');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($aumdimefec_a))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($aumdimefec_b))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Efectivo al principio del periodo');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($ar_count[1120][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($ar_count[1120][$ar_periodo[1] - 1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$metRow++;
		$metRow++;
						
		$objPHPExcel->getActiveSheet()->mergeCells('B'.$metRow.':C'.$metRow)->setCellValue('B'.$metRow, 'Efectivo al final del periodo');
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$metRow, round($aumdimefec_a + $ar_count[1120][$ar_periodo[1]]))->getStyle('E'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$metRow, round($aumdimefec_b + $ar_count[1120][$ar_periodo[1] - 1]))->getStyle('F'.$metRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
		//-
		
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$sheet++;
	endfor;
	
	
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setLastModifiedBy("ADSUM KALLPA");
	$objPHPExcel->getProperties()->setTitle("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setSubject("Office 5 XLS Adsum Document");
	$objPHPExcel->getProperties()->setDescription("Este documento fue generado desde el software Adsum ");
	$objPHPExcel->getProperties()->setKeywords("office php adsum kallpa");
	$objPHPExcel->getProperties()->setCategory("Export result file");
	$objWriterSinzona = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriterSinzona->save($uploaddir.'ADM_BalanceGeneral.xls');
	
	echo 'ADM_BalanceGeneral.xls';
	