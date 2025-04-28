<?php
	ini_set('display_errors', 1);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktbldepartam.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['departnombre'] = $termino;
	$recordop['departnombre'] = 'like';
	
	$idcon = fncconn();
	$rsDepartam = dinamicscanopdepartam($record, $recordop, $idcon);
	
	if($rsDepartam > 0)
		$numReg = fncnumreg($rsDepartam);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rsDepartam, $i);
			array_push($result, array("id" => $arr['departcodigo'], "label" => $arr['departnombre'], "value" => strip_tags($arr['departnombre'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);