<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;
	
	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblpedidotemp.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	include '../../../FunPerSecNiv/fncsqlrun.php';
	
	$idcon = fncconn();
	$sql = "SELECT DISTINCT(pedtemnit),pedtemrazsoc FROM pedidotemp WHERE upper(pedtemrazsoc::text) LIKE upper('%$termino%') ORDER BY pedtemnit";
	$rsNumeroPV = fncsqlrun($sql,$idcon);
	
	if($rsNumeroPV > 0) 
		$numReg = fncnumreg($rsNumeroPV);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rsNumeroPV, $i);
			
			$registro = array();
			$registro =  array("id" => $arr['pedtemnit'], "label" => $arr['pedtemrazsoc'] , "value" => strip_tags($arr['pedtemrazsoc']));
			array_push($result,$registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);