<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.phpscripts/jquery.array_json.php';
	include '../../FunPerPriNiv/pktbltipoequipo.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['tipequnombre'] = $termino;
	$recordop['tipequnombre'] = 'like';
	
	$idcon = fncconn();
	$rs_tipoequipo = dinamicscanoptipoequipo($record, $recordop, $idcon);
	
	if($rs_tipoequipo > 0)
		$numReg = fncnumreg($rs_tipoequipo);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_tipoequipo, $i);
			array_push($result, array("id" => $arr['tipequcodigo'], "label" => $arr['tipequnombre'], "value" => strip_tags($arr['tipequnombre'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);