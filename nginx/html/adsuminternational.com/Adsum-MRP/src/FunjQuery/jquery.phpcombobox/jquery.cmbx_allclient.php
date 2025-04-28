<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.phpscripts/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblsistema.php';
	include '../../FunPerPriNiv/pktblvistaclientegrup.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['sistemnombre'] = $termino;
	$recordop['sistemnombre'] = 'like';
	$idcon = fncconn();
	$rs_sistema = dinamicscanopsistema($record, $recordop, $idcon);
//
	$numReg = fncnumreg($rs_sistema);
//	
	$result = array();	
//
	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_sistema, $i);
			array_push($result, array("id" => 'st:'.$arr['sistemcodigo'], "label" => $arr['sistemnombre'], "value" => strip_tags($arr['sistemnombre'])));

			if (count($result) > 15)
				break;
		}
	}
	
	$record['usuanombre'] = $termino;
	$recordop['usuanombre'] = 'like';
	$rs_usuario = dinamicscanopvistaclientegrup($record, $recordop, $idcon);
	
	$numReg = fncnumreg($rs_usuario);

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_usuario, $i);
			array_push($result, array("id" => 'us:'.$arr['usuacodi'], "label" => $arr['usuanombre'], "value" => strip_tags($arr['usuanombre'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);