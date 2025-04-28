<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblherramie.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['herramnombre'] = $termino;
	$recordop['herramnombre'] = 'like';
	$idcon = fncconn();
	$rs_herramie = dinamicscanopherramie($record, $recordop, $idcon);
	
	if($rs_herramie > 0)
		$numReg = fncnumreg($rs_herramie);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_herramie, $i);
			array_push($result, array("id" => $arr['herramcodigo'], "label" => $arr['herramnombre'], "value" => strip_tags($arr['herramnombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);