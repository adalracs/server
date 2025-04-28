<?php 
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerPriNiv/pktblprocedimiento.php';
		
	$idcon = fncconn();
	$respuesta[0]['bandera'] = '0';
	$rwProcedimiento = loadrecordprocedimiento($procedcodigo,$idcon);
	if($rwProcedimiento['tipsolcodigo'] == '10')
		$respuesta[0]['bandera'] = '1';
	
	echo array_to_json($respuesta[0]);
?>