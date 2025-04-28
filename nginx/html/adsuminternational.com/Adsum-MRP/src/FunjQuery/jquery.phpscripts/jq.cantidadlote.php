<?php 
	ini_set("display_errors", 1);
	include_once '../../FunjQuery/jquery.service/jquery.array_json.php';
	include_once '../../FunPerPriNiv/pktblrecepcionmercancia.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncsqlrun.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';

	$idcon = fncconn();

	$respuesta[0]['analiscantap'] = 0;
	$respuesta[0]['unidadcodigo'] = "";

	if($itedescodigo && $lotecodigo){

		$rsRecepcionMercancia = dinamicscanoprecepcionmercancia(array("lotecodigo" => $lotecodigo, "itedescodigo" => $itedescodigo), array("lotecodigo" => "=", "itedescodigo" => "="),$idcon);
		$nrRecepcionMercancia = fncnumreg($rsRecepcionMercancia);

		for( $a = 0; $a < $nrRecepcionMercancia; $a++){

			$rwRecepcionMercancia = fncfetch($rsRecepcionMercancia,$a);

			$respuesta[0]['analiscantap'] += (int) $rwRecepcionMercancia["recmercantidad"];
			$respuesta[0]['unidadcodigo'] = $rwRecepcionMercancia["unidadcodigo"];

		}

	}

	fncclose($idcon);

	echo array_to_json($respuesta[0]);