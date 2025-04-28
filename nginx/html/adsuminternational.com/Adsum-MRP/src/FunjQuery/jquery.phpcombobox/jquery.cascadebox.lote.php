<?php
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';

	$itedescodigo = $_REQUEST['itedescodigo'];
	
	if(!$itedescodigo) return;

	$strSql = 
		"SELECT DISTINCT (recepcionmercancia.lotecodigo),lote.lotenumero,proveedo.proveenombre 
		FROM recepcionmercancia 
		LEFT JOIN lote ON lote.lotecodigo = recepcionmercancia.lotecodigo 
		LEFT JOIN proveedo ON proveedo.proveecodigo = lote.proveecodigo 
		WHERE itedescodigo = {$itedescodigo}";

	$idcon = fncconn();

	$rsResult = fncsqlrun($strSql, $idcon);
	$nrResult = fncnumreg($rsResult);
	
	$result = array();	

	if($nrResult)
	{
		for ($i = 0; $i < $nrResult; $i++)
		{
			$arr = fncfetch($rsResult, $i);
			array_push($result, array("id" => $arr["lotecodigo"], "label" => $arr["lotenumero"].' - '.$arr["proveenombre"]));
		}
	}

	echo array_to_json($result);