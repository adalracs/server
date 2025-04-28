<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblitem.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['itemnombre'] = $termino;
	$recordop['itemnombre'] = 'like';
	$idcon = fncconn();
	$rs_item = dinamicscanopitem($record, $recordop, $idcon);
	
	if($rs_item > 0)
		$numReg = fncnumreg($rs_item);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("id" => $arr['itemcodigo'], "label" => $arr['itemnombre'], "value" => strip_tags($arr['itemnombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);