<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.phpscripts/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblciudad.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['ciudadnombre'] = $termino;
	$recordop['ciudadnombre'] = 'like';
	
	$idcon = fncconn();
	$rs_ciudad = dinamicscanopciudad($record, $recordop, $idcon);
	
	if($rs_ciudad > 0)
		$numReg = fncnumreg($rs_ciudad);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_ciudad, $i);
			array_push($result, array("id" => $arr['ciudadcodigo'], "label" => $arr['ciudadnombre'], "value" => strip_tags($arr['ciudadnombre'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);