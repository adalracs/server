<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblvistacuadrillausuario.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['usuacodi'] = $termino;
	$recordop['usuacodi'] = 'like';
	$record['usuanombre'] = $termino;
	$recordop['usuanombre'] = 'like';
	$record['usuapriape'] = $termino;
	$recordop['usuapriape'] = 'like';
	$record['usuasegape'] = $termino;
	$recordop['usuasegape'] = 'like';
	
	$idcon = fncconn();
	$rs_usuario = dinamicscanoporvistacuadrillausuario($record, $recordop, $idcon);
	
	if($rs_usuario > 0)
		$numReg = fncnumreg($rs_usuario);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_usuario, $i);
			array_push($result, array("id" => $arr['usuacodi'], "label" => $arr['usuacodi'].' - '.$arr['usuanombre'].' '.$arr['usuapriape'].' '.$arr['usuasegape'], "value" => strip_tags($arr['usuacodi'].' - '.$arr['usuanombre'].' '.$arr['usuapriape'].' '.$arr['usuasegape'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);