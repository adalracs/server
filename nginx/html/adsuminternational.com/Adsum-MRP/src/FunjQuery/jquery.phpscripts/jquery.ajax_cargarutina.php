<?php
	include '../../Funexcel/reader.php';
	
	$arrColumns = array('CODIGO EQUIPO' => 'equipocodigo',
						'CODIGO COMPONENTE' => 'componcodigo',
						'CODIGO TIPO MANTENIMIENTO' => 'tipmancodigo',
						'CODIGO PRIORIDAD' => 'prioricodigo',
						'CODIGO MEDIDOR' => 'tipmedcodigo',
						'PERIODO DE RUTINA' => 'prografrecue',
						'FECHA INICIO DE RUTINA' => 'prografecini',
						'DURACION DE LA ORDEN' => 'progratiedur',
						'HORAS/MINUTOS' => 'tipotiedur',
						'ESTADO DE OT' => 'otestacodigo',
						'CODIGO TIPO DE TRABAJO' => 'tiptracodigo',
						'CODIGO TAREA' => 'tareacodigo',
						'DESCRIPCION DEL TRABAJO' => 'progranota'
	);
	
	$arrCols = array();
	$arrRows = array();
	
	$objExcel = new Spreadsheet_Excel_Reader();
	$objExcel->setOutputEncoding('CP1251');
	$objExcel->read('../../../doc/upload/temp/'.$uploadocumen);
	
	$nrColums = $objExcel->sheets[0]['numCols']; 
	$nrRows = $objExcel->sheets[0]['numRows']; 

	for($a = 1; $a <= $nrRows; $a++):
		for($b = 1; $b <= $nrColums; $b++):
			if(array_key_exists(trim($objExcel->sheets[0]['cells'][$a][$b]), $arrColumns))
				$arrCols[$b] = 	$arrColumns[trim($objExcel->sheets[0]['cells'][$a][$b])];
			else
				$arrRows[$a][$b] = trim($objExcel->sheets[0]['cells'][$a][$b]);
		endfor;
	endfor;
	
	
	for($a = 2; $a <= count($arrRows); $a++):
		
	
	
	endfor;
	
	
	
	var_dump($arrCols);
	var_dump($arrRows);