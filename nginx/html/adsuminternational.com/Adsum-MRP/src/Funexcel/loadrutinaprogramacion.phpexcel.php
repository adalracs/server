<?php
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunPerSecNiv/fncfetchall.php';
	
	
	include '../FunPerPriNiv/pktblprogramacion.php';
	include '../FunPerPriNiv/pktbltareot.php';
	
	include '../FunPerPriNiv/pktblcomponen.php';
	include '../FunPerPriNiv/pktblequipo.php';
	include '../FunPerPriNiv/pktblsistema.php';
	include '../FunPerPriNiv/pktbltipomant.php';
	include '../FunPerPriNiv/pktblpriorida.php';
	include '../FunPerPriNiv/pktbltipomedi.php';
	include '../FunPerPriNiv/pktblotestado.php';
	include '../FunPerPriNiv/pktbltipotrab.php';
	include '../FunPerPriNiv/pktbltarea.php';
	
	include '../FunPerPriNiv/pktblnumerado.php';
	
	
	include 'Classes/PHPExcel.php';
	require 'Classes/PHPExcel/IOFactory.php';
	require 'Classes/PHPExcel/Reader/Excel5.php';
	require 'Classes/PHPExcel/Reader/Excel2007.php';


	/**
	 * conseProgramacion
	 * @param $idcon
	 * @return unknown_type
	 */
	function conseProgramacion($idcon)
	{
		$rsNumerado = loadrecordnumerado(63, $idcon);
		$nuidtemp = $rsNumerado['numeprox'];
		
		do{
			$nuresult = loadrecordprogramacionserial($nuidtemp,$idcon);
			if($nuresult == -3) return $nuidtemp;
			$nuidtemp ++;
		} while ($nuresult != -3);
	}

	/**
	 * conseTareot
	 * @param $idcon
	 * @return unknown_type
	 */
	function conseTareot($idcon)
	{
		$rsNumerado = loadrecordnumerado(38, $idcon);
		$nuidtemp = $rsNumerado['numeprox'];
		
		do{
			$nuresult = loadrecordtareot($nuidtemp,$idcon);
			if($nuresult == -3) return $nuidtemp;
			$nuidtemp ++;
		} while ($nuresult != -3);
	}
	
	
	$objReader = new PHPExcel_Reader_Excel5();
	$objReader->setReadDataOnly(true);
//	$objReader->setReadFilter(new RowReadFilter());

	$files = explode('::', $uploadocumen);
	
	for($a = 0; $a < count($files); $a++)
	{
		$objPHPExcel = $objReader->load('../../doc/upload/temp/'.$files[$a]);
		$objWorksheet = $objPHPExcel->getActiveSheet();
	
		$highestRow = $objWorksheet->getHighestRow(); 								// Maxima Fila
		$highestColumn = $objWorksheet->getHighestColumn(); 						// Maxima Columna en Letras
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // Maxima Columna en Numero
	
		$idcon = fncconn();
		$progracodigo = conseProgramacion($idcon);
		$tareotcodigo = conseTareot($idcon);
	
		
		for($row = 2; $row <= $highestRow ; $row++)
		{
			$arrRow = array();
			$equipocodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()));
			
			$rsEquipo = loadrecordequipo($equipocodigo, $idcon);
			$rsSistema = loadrecordsistema($rsEquipo['sistemcodigo'], $idcon);
			
			$componcodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()));
			$tipmancodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(2, $row)->getValue()));
			$prioricodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(3, $row)->getValue()));
			$tipmedcodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(4, $row)->getValue()));
			$prografrecue = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(5, $row)->getValue()));
			$prografecini = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(6, $row)->getValue()));
			$progratiedur = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(7, $row)->getValue()));
			$optiedur = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(8, $row)->getValue()));
			$progranota = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(12, $row)->getValue()));
			
			$otestacodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(9, $row)->getValue()));
			$tiptracodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(10, $row)->getValue()));
			$tareacodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(11, $row)->getValue()));
			
			
			
			$arrRow['progracodigo'] = $progracodigo;
			$arrRow['prioricodigo'] = $prioricodigo;
			$arrRow['equipocodigo'] = $equipocodigo;
			$arrRow['sistemcodigo'] = $rsSistema['sistemcodigo'];
			$arrRow['plantacodigo'] = $rsSistema['plantacodigo'];
			$arrRow['componcodigo'] = $componcodigo;
			$arrRow['tipmedcodigo'] = $tipmedcodigo;
			$arrRow['usuacodi'] = $usuacodi;
			$arrRow['prografecgen'] = date("Y-m-d");
			$arrRow['prograhorgen'] = date("H:i");
			$arrRow['prografrecue'] = $prografrecue;
			$arrRow['prografecini'] = $prografecini;
			$arrRow['prograhorini'] = '00:00';
			(strtoupper($optiedur) == 'HR') ?  $arrRow['progratiedur'] = $progratiedur : $arrRow['progratiedur'] = ($progratiedur / 60);
			$arrRow['progranota'] = $progranota;
			$arrRow['tipmancodigo'] = $tipmancodigo;
			$arrRow['prograacti'] = 1;
			$arrRow['progranumgru'] = 1;
			$arrRow['prograrepot'] = 'f';
			$arrRow['prografechfutur'] = $prografecini;
				
			
			$result = insrecordprogramacion($arrRow, $idcon);
			
			
			$arrRow['tareotcodigo'] = $tareotcodigo;
			$arrRow['tareacodigo'] = $tareacodigo;
			$arrRow['tiptracodigo'] = $tiptracodigo;
			(strtoupper($optiedur) == 'HR') ?  $arrRow['tareottiedur'] = $progratiedur : $arrRow['tareottiedur'] = ($progratiedur / 60);
			$arrRow['tareotnota'] = $progranota;
			$arrRow['tareotsecuen'] = 0;
			$arrRow['otestacodigo'] = $otestacodigo;
			$arrRow['tareotfecgen'] = date("Y-m-d");
			$arrRow['tareothorgen'] = date("H:i");
		
			$result = insrecordtareot($arrRow, $idcon);
			
			$tareotcodigo++;
			$progracodigo++;
		}	
	}