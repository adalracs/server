<?php
	ini_set("display_errors", 1);
	ini_set('memory_limit', '512M');
	
	date_default_timezone_set('America/Bogota');

	include '../FunPerSecNiv/fncconn.php';
	include '../FunPerSecNiv/fncsqlrun.php';
	include '../FunPerSecNiv/fncnumreg.php';
	include '../FunPerSecNiv/fncfetch.php';
	include '../FunPerSecNiv/fncfetchall.php';
	
	include '../FunPerPriNiv/pktblitemdesa.php';
	include '../FunPerPriNiv/pktblnumerado.php';
	include '../FunPerPriNiv/pktblinvplantaresina.php';	
	
	
	include 'Classes/PHPExcel.php';
	require 'Classes/PHPExcel/IOFactory.php';
	require 'Classes/PHPExcel/Reader/Excel5.php';
	require 'Classes/PHPExcel/Reader/Excel2007.php';


	/**
	 * conseInvplantaresina
	 * @param $idcon
	 * @return unknown_type
	 */
	function conseInvplantaresina($idcon)
	{
		$rsNumerado = loadrecordnumerado(307, $idcon);
		$nuidtemp = $rsNumerado['numeprox'];
		
		do{
			$nuresult = loadrecordinvplantaresina($nuidtemp,$idcon);
			if($nuresult == -3) return $nuidtemp;
			$nuidtemp ++;
		} while ($nuresult != -3);
	}

	/**
	 * updconseInvplantaresina
	 * @param $idcon
	 * @return unknown_type
	 */
	function updconseInvplantaresina($invrescodigo, $idcon)
	{
		$rsNumerado = loadrecordnumerado(307, $idcon);
		$rsNumerado["numeprox"] = $invrescodigo;

		uprecordnumerado($rsNumerado, $idcon);
	}

	
	$objReader = new PHPExcel_Reader_Excel5();
	$objReader->setReadDataOnly(true);

	$files = explode('::', $uploadocumen);
	
	for($a = 0; $a < count($files); $a++)
	{
		$objPHPExcel = $objReader->load('../../doc/upload/temp/'.$files[$a]);
		$objWorksheet = $objPHPExcel->getActiveSheet();
	
		$highestRow = $objWorksheet->getHighestRow(); 								// Maxima Fila
		$highestColumn = $objWorksheet->getHighestColumn(); 						// Maxima Columna en Letras
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); // Maxima Columna en Numero
	
		$idcon = fncconn();
		$invrescodigo = conseInvplantaresina($idcon);
	
		for($row = 2; $row <= $highestRow ; $row++)
		{
			$iReginvplantaresina = array();

			$itedescodigo = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(0, $row)->getValue()));
			$invrescantid = trim(utf8_decode($objWorksheet->getCellByColumnAndRow(1, $row)->getValue()));

			$rsInvplantaresina = dinamicscanopinvplantaresina(array("itedescodigo" => $itedescodigo), array("itedescodigo" => "="), $idcon);
			$nrInvplantaresina = fncnumreg($rsInvplantaresina);

			if($nrInvplantaresina > 0){

				$rwInvplantaresina = fncfetch($rsInvplantaresina, 0);

				$iReginvplantaresina['invrescodigo'] = $rwInvplantaresina['invrescodigo'];
				$iReginvplantaresina['itedescodigo'] = $itedescodigo;
				$iReginvplantaresina['invrescantid'] = $invrescantid;
				$iReginvplantaresina['usuacodi'] = $usuacodi;
				$iReginvplantaresina['invresfecha'] = date("Y-m-d");
				$iReginvplantaresina['invreshora'] = date("H:i");					
				
				uprecordinvplantaresina($iReginvplantaresina, $idcon);

			}else{

				$iReginvplantaresina['invrescodigo'] = $invrescodigo;
				$iReginvplantaresina['itedescodigo'] = $itedescodigo;
				$iReginvplantaresina['invrescantid'] = $invrescantid;
				$iReginvplantaresina['usuacodi'] = $usuacodi;
				$iReginvplantaresina['invresfecha'] = date("Y-m-d");
				$iReginvplantaresina['invreshora'] = date("H:i");					
				
				if(insrecordinvplantaresina($iReginvplantaresina, $idcon) > 0 ){

					$invrescodigo++;
				}
			}

		}	
	}

	updconseInvplantaresina($invrescodigo, $idcon);
