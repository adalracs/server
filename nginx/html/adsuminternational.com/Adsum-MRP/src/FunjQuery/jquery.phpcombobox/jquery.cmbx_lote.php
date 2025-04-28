<?php
	$termino = $_GET["term"];
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktbllote.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	$sql = "select * from lote WHERE lotenumero like'%".$termino."%'";
	$rs_item = fncsqlrun($sql,$idcon);
	
	if($rs_item > 0)
		$numReg = fncnumreg($rs_item);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("id" => $arr['lotecodigo'], "label" => rtrim($arr['lotenumero']), "value" => rtrim($arr['lotenumero'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);