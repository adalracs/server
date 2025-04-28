<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblbodega.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['bodeganombre'] = $termino;
	$recordop['bodeganombre'] = 'like';
	$idcon = fncconn();
	$rs_item = dinamicscanopbodega($record, $recordop, $idcon);
	
	if($rs_item > 0)
		$numReg = fncnumreg($rs_item);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("id" => $arr['bodegacodigo'], "label" => $arr['bodeganombre'], "value" => strip_tags($arr['bodeganombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);