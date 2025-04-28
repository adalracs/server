<?php 
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerPriNiv/pktblplano.php');
	include ('../src/FunPerPriNiv/pktblmanual.php');
	include ('../src/FunPerPriNiv/pktbldocuequi.php');

	if(file_exists($filename))
	{
		$rs_buffer_del = @unlink($filename);
		
		if($to == 'file_manual')
		{
			$idconn = fncconn();
			$field_manual['manualruta'] = $filename;
			$field_manualop['manualruta'] = '=';
			
			$irecord = dinamicscanopmanual($field_manual, $field_manualop, $idconn);
			$sbRow = fncfetch($irecord, 0);
			
			delrecorddocuequimanual($sbRow[0], $idconn);	
			delrecordmanual($sbRow[0], $idconn);	
			fncclose($idconn);
		}	
		if($to == 'file_plano')
		{
			$idconn = fncconn();
			$field_plano['planoruta'] = $filename;
			$field_planoop['planoruta'] = '=';
			
			$irecord = dinamicscanopplano($field_plano, $field_planoop, $idconn);
			$sbRow = fncfetch($irecord, 0);
			
			delrecorddocuequiplano($sbRow[0], $idconn);	
			delrecordplano($sbRow[0], $idconn);	
			fncclose($idconn);
		}
	}