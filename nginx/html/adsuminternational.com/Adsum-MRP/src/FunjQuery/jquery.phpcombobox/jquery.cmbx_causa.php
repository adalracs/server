<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblcausa.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();

	$record["causanombre"] = $termino;
	$recordop["causanombre"] = "like";

	$rs_item = dinamicscanopcausa($record, $recordop, $idcon);
	
	if($rs_item > 0)
		$numReg = fncnumreg($rs_item);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("id" => $arr['causacodigo'], "label" => rtrim($arr['causanombre']), "value" => rtrim($arr['causanombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);