<?php 
	ini_set("display_errors", 1);
	include_once '../../FunjQuery/jquery.service/jquery.array_json.php';
	include_once '../../FunPerPriNiv/pktblestadoanalisis.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncsqlrun.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';


	$respuesta[0]["tipestcodigo"] = 0;

	$idcon = fncconn();

	if( $estanacodigo > 0){

		$rwAnalisisMp = loadrecordestadoanalisis($estanacodigo,$idcon);
		$respuesta[0]["tipestcodigo"] = $rwAnalisisMp["tipestcodigo"];
	}

	fncclose($idcon);

	echo array_to_json($respuesta[0]);