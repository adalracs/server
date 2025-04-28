<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblitemdesa.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	$sql = "select distinct(keylinea),itedeslinea from itemdesa WHERE ( upper(itedeslinea) LIKE upper('%".$termino."%') or upper(keylinea) LIKE upper('%".$termino."%') ) AND keylinea is not null AND itedeslinea is not null";
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
			array_push($result, array("id" => $arr['keylinea'], "label" => rtrim($arr['keylinea']." - ".$arr['itedeslinea']), "value" => rtrim($arr['keylinea']." - ".$arr['itedeslinea'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);