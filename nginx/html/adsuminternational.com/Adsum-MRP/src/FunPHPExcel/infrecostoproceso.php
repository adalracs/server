<?php

	ini_set("memory_limit", "512M");
	ini_set("display_errors", 1);
	 
	date_default_timezone_set("America/Bogota");

	include "../FunPerSecNiv/fncconn.php";
	include "../FunPerSecNiv/fncsqlrun.php";
	include "../FunPerSecNiv/fncnumreg.php";
	include "../FunPerSecNiv/fncfetch.php";
	include "../FunPerSecNiv/fncfetchall.php";
	include "../FunPerPriNiv/pktblreporteopp.php";
	 
	include "../FunPerPriNiv/pktblusuario.php";
	include "../JSON/JSON.php";
	include "../FunGen/cargainput.php";
	
	
	include "Classes/PHPExcel.php";
	require "Classes/PHPExcel/Writer/Excel5.php";

	

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getDefaultStyle()->getFont()->setName("Tahoma");
	$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
	
	$uploaddir = '../../temp/';
	$uploaddir2 = '../temp/';
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


   $sqlMaterias="SELECT DISTINCT vistaopp.ordoppcodigo,vistaopp.equipocodigo,vistaopp.equiponombre,vistaopp.ordprofecgen,vistaopp.procednombre,
				 vistaopp.produccoduno,vistaopp.producnombre,gestionoppitemdesa.itedescodigo,itemdesa.itedesnombre,
				 gestionoppitemdesa.gesoppcantkg,gestionoppitemdesa.gesoppcantmt,itemdesa.itedescosto,(itemdesa.itedescosto * gestionoppitemdesa.gesoppcantkg) as costo
					from vistaopp 
					inner join reporteopp on reporteopp.ordoppcodigo=vistaopp.ordoppcodigo
					inner join reporteoppmaterial on reporteoppmaterial.repoppcodigo=reporteopp.repoppcodigo
					inner join gestionoppreporte on gestionoppreporte.geoprecodigo=reporteoppmaterial.geoprecodigo
					left join gestionoppitemdesa on gestionoppitemdesa.itedescodigo=gestionoppreporte.itedescodigo
					left join itemdesa on itemdesa.itedescodigo=gestionoppitemdesa.itedescodigo
					where vistaopp.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
					 AND vistaopp.tipsolcodigo ='".$ordcomcodcli."' order by vistaopp.ordoppcodigo";
	
	//$sbSql .= " WHERE producto.producfecha BETWEEN '{$producfechaini}' AND '{$producfechafin}' ";
	//$sbSql .= " AND producto.producdelrec = 1 ORDER BY producto.produccodigo,producformula.proforindice ";
	
	$rsMateriales = fncsqlrun($sqlMaterias, $idcon);
	$nrMateriales = fncnumreg($rsMateriales);

	$sqlTiempos="SELECT  tiempopn.tiemponombre,reporteopptiempopn.reoptihorini,reporteopptiempopn.reoptihorfin,sum((reporteopptiempopn.reoptihorfin - reporteopptiempopn.reoptihorini))as horas
				from vistaopp
				inner join reporteopp on reporteopp.ordoppcodigo=vistaopp.ordoppcodigo
				inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
				inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
				where vistaopp.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
				 AND vistaopp.tipsolcodigo ='".$ordcomcodcli."'
				group by tiempopn.tiemponombre,reporteopptiempopn.reoptihorini,vistaopp.ordprofecgen,reporteopptiempopn.reoptihorfin";
				

	$rsTiempos=fncsqlrun($sqlTiempos,$idcon);				
	$nrTiempos=fncnumreg($rsTiempos);

	 $sql="SELECT  DISTINCT vistaopp.ordoppcodigo,vistaopp.producnombre,vistaopp.equipocodigo,vistaopp.equiponombre,sum((reporteopptiempopn.reoptihorfin - reporteopptiempopn.reoptihorini))as horas
							from vistaopp
							inner join reporteopp on reporteopp.ordoppcodigo=vistaopp.ordoppcodigo
							inner join reporteopptiempopn on  reporteopptiempopn.repoppcodigo=reporteopp.repoppcodigo
							inner join tiempopn on tiempopn.tiempocodigo = reporteopptiempopn.tiempocodigo
							where vistaopp.ordprofecgen BETWEEN '".$consulfecini."' AND '".$consulfecfin."' 
							 AND vistaopp.tipsolcodigo ='".$ordcomcodcli."'
							group by vistaopp.ordoppcodigo,vistaopp.producnombre,vistaopp.ordprofecgen,vistaopp.equipocodigo,vistaopp.equiponombre";
	
	$rsManoobra=fncsqlrun($sql,$idcon);				
	$nrManoobra=fncnumreg($rsManoobra);

	$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr('Lista de Materialess',0,30));

	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('A')->setWidth(6);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('B')->setWidth(6);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('C')->setWidth(6);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('D')->setWidth(43);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('F')->setWidth(30);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('G')->setWidth(49);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('H')->setWidth(49);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('I')->setWidth(49);

	$rcont = 2;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('A'.$rcont.':C'.$rcont)->setCellValue('A'.$rcont, utf8_decode('Fecha Generación'))->getStyle('A'.$rcont.':C'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, 'Dia')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, 'Mes')->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, utf8_decode('Año'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, date('d'))->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, date('m'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, date('Y'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$rcont += 2;	
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, 'CODIGO DE MATERIAL')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('B'.$rcont.':D'.$rcont)->setCellValue('B'.$rcont, 'MATERIAS PRIMAS CONSUMIDAS')->getStyle('B'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, 'CANTIDAD')->getStyle('E'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont, 'KILOGRAMOS')->getStyle('F'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont, 'COSTOS')->getStyle('G'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('A'.$rcont)->setWidth($objPHPExcel->getActiveSheet($sheet)->getColumnDimension('A'.$rcont)->getWidth()*2.1);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('E'.$rcont)->setWidth($objPHPExcel->getActiveSheet($sheet)->getColumnDimension('E'.$rcont)->getWidth()*2.1);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('F'.$rcont)->setWidth($objPHPExcel->getActiveSheet($sheet)->getColumnDimension('F'.$rcont)->getWidth()*2.1);
	$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('G'.$rcont)->setWidth($objPHPExcel->getActiveSheet($sheet)->getColumnDimension('G'.$rcont)->getWidth()*2.1);
	

	for($a = 0; $a < $nrMateriales; $a++){

		$rwMateriales = fncfetch($rsMateriales,$a);
		$cantidad+=$rwMateriales["gesoppcantmt"];
		$Kilogramos+=$rwMateriales["gesoppcantkg"];
		$cosot+=$rwMateriales["costo"];

		$rcont++;
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, $rwMateriales["itedescodigo"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->mergeCells('B'.$rcont.':D'.$rcont)->setCellValue('B'.$rcont, $rwMateriales['itedesnombre'])->getStyle('B'.$rcont.':D'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, $rwMateriales["gesoppcantmt"])->getStyle('E'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('F'.$rcont, $rwMateriales["gesoppcantkg"])->getStyle('F'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('G'.$rcont, $rwMateriales["costo"])->getStyle('G'.$rcont)->applyFromArray($styleArray);
	}

	//Consolidado de materiales
	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('A'.$rcont.':D'.$rcont)->setCellValue('A'.$rcont, 'CANTIDAD')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, $cantidad)->getStyle('E'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('A'.$rcont.':D'.$rcont)->setCellValue('A'.$rcont, 'KILOGRAMOS')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, $Kilogramos)->getStyle('E'.$rcont)->applyFromArray($styleArray);	

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('A'.$rcont.':D'.$rcont)->setCellValue('A'.$rcont, 'COSTOS')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	//$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('A')->setWidth(3);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, $cosot)->getStyle('E'.$rcont)->applyFromArray($styleArray);	
	//$objPHPExcel->getActiveSheet($sheet)->getColumnDimension('B')->setWidth(3);
	$rcont=4;
	$rcont += 2;	
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('I'.$rcont, 'TIEMPOS')->getStyle('I'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('J'.$rcont, 'HORA INICIAL')->getStyle('J'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont, 'HORA FINAL')->getStyle('K'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont, 'TOTAL')->getStyle('L'.$rcont)->applyFromArray($styleArray);

	for($a = 0; $a < $nrTiempos; $a++){

		$rwTiempos = fncfetch($rsTiempos,$a);
		$tiem=explode(":", $rwTiempos["horas"]);
		$hor=$tiem[0]*1;
		$min=$tiem[1]/60;
		$tiempo=$hor+$min;
		$totaltiempo+=$tiempo;

		$rcont++;
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('I'.$rcont, $rwTiempos["tiemponombre"])->getStyle('I'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('J'.$rcont, $rwTiempos["reoptihorini"])->getStyle('J'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont, $rwTiempos["reoptihorfin"])->getStyle('K'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('L'.$rcont, $tiempo)->getStyle('L'.$rcont)->applyFromArray($styleArray);
	}

	//Consolidado de materiales
	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('I'.$rcont.':J'.$rcont)->setCellValue('I'.$rcont, 'TOTAL TIEMPO')->getStyle('I'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('K'.$rcont, $totaltiempo)->getStyle('K'.$rcont)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet($sheet)->setShowGridlines(true);
	$objPHPExcel->getActiveSheet($sheet)->getSheetView()->setZoomScale(85);
//*************************************************************************************************************************************************
//*************************************************************************************************************************************************
	$objPHPExcel->createSheet();
	$sheet=1;
	$objPHPExcel->setActiveSheetIndex($sheet)->setTitle(substr('Mano de obra',0,30));

		$rcont = 2;
	$objPHPExcel->getActiveSheet($sheet)->mergeCells('A'.$rcont.':C'.$rcont)->setCellValue('A'.$rcont, utf8_decode('Fecha Generación'))->getStyle('A'.$rcont.':C'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, 'Dia')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, 'Mes')->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, utf8_decode('Año'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->getStartColor()->setARGB('FFC5D9F1');
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-1).':C'.$rcont)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);

	$rcont++;
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, date('d'))->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, date('m'))->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, date('Y'))->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet($sheet)->getStyle('A'.($rcont-2).':C'.$rcont)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


	$rcont += 2;	
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, 'PRODUCTO')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, 'EQUIPO')->getStyle('B'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, 'HORAS')->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont, 'CANTIDAD OPERARIOS')->getStyle('C'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, 'COSTOS')->getStyle('C'.$rcont)->applyFromArray($styleArray);

	

	for($a = 0; $a < $nrManoobra; $a++){

		$rwManoobra = fncfetch($rsManoobra, $a);
		$tiem=explode(":", $rwManoobra["horas"]);
		$hor=$tiem[0]*1;
		$min=$tiem[1]/60;
		$tiempo=$hor+$min;
		$totaltiempo+=$tiempo;

		$rsreporte = dinamicscanopreporteopp(array("ordoppcodigo"=>$rwManoobra["ordoppcodigo"]),array("ordoppcodigo"=>"="),$idcon);
		$nrreporte = fncnumreg($rsreporte);

	 	for($i=0 ; $i < $nrreporte ; $i++){
		  $rwreporte = fncfetch($rsreporte,$i);
		  $rwUsuario = loadrecordusuario($rwreporte['usuacodi'],$idcon);
		  $totalmanoobra+=($tiempo*$rwUsuario['usuavalhor']);
		  $cosotmanodeobra+=$totalmanoobra;
		}
		$rcont++;
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('A'.$rcont, $rwManoobra["producnombre"])->getStyle('A'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('B'.$rcont, $rwManoobra["equiponombre"])->getStyle('B'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('C'.$rcont, $rwManoobra["horas"])->getStyle('C'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('D'.$rcont, $nrreporte)->getStyle('D'.$rcont)->applyFromArray($styleArray);
		$objPHPExcel->getActiveSheet($sheet)->setCellValue('E'.$rcont, $totalmanoobra)->getStyle('E'.$rcont)->applyFromArray($styleArray);
	}

	$rcont++;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, 'TIEMPO TOTAL')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rcont, $totaltiempo)->getStyle('C'.$rcont)->applyFromArray($styleArray);

	$rcont++;
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$rcont.':B'.$rcont)->setCellValue('A'.$rcont, 'COSTO MANO DE OBRA')->getStyle('A'.$rcont)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rcont, $cosotmanodeobra)->getStyle('C'.$rcont)->applyFromArray($styleArray);	
				

	$objPHPExcel->getActiveSheet($sheet)->setShowGridlines(true);
	$objPHPExcel->getActiveSheet($sheet)->getSheetView()->setZoomScale(85);

	if(file_exists($uploaddir."ADM_InfCosto.xls")){

		unlink($uploaddir."ADM_InfCosto.xls");
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
	$objWriterSinzona->save($uploaddir.'ADM_InfCosto.xls');


	$direccion=$uploaddir2.'ADM_InfCosto.xls';
	
	echo '<a href="'.$direccion.'">ADM_InfCosto.xls</a>';