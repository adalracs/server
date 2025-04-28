<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblmodulo.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	//$sql = "select distinct(keylinea),itedeslinea from itemdesa WHERE upper(itedeslinea) LIKE upper('%".$termino."%')";
	$sql = "select distinct(modulocodigo),modulonombre from modulo WHERE upper(modulonombre) LIKE upper('%".$termino."%')";
//	$rs_item = dinamicscanopitem($record, $recordop, $idcon);
	$rs_item = fncsqlrun($sql,$idcon);
	
	if($rs_item > 0)
		$numReg = fncnumreg($rs_item);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("id" => $arr['modulocodigo'], "label" => rtrim($arr['modulonombre']), "value" => rtrim($arr['modulonombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);