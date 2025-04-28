<?php
	ini_set("display_errors", 1);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerPriNiv/pktblusuaplanta.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	$strSql = "SELECT vistaequipoplanta.* 
				FROM vistaequipoplanta
				WHERE (UPPER(vistaequipoplanta.equipocodigo::text) LIKE '%".strtoupper($termino)."%' OR UPPER(vistaequipoplanta.equiponombre::text) LIKE '%".strtoupper($termino)."%')";
	
	if(!$plantacodigo)
	{
		$rsUsuaplanta = loadrecordusuaplanta($id, $idcon);

		if($rsUsuaplanta > 0) 
			$strSql.= " AND plantacodigo IN (".$rsUsuaplanta.")";
	}			
	else
		$strSql.= " AND plantacodigo = '".$plantacodigo."'";
	
	if($sistemcodigo > 0) 
			$strSql.= " AND sistemcodigo = '".$sistemcodigo."'";

	$rsEquipo = fncsqlrun($strSql.' ORDER BY equiponombre', $idcon);		
	
	if($rsEquipo > 0)
		$nrEquipo = fncnumreg($rsEquipo);
	
	$result = array();	

	if($nrEquipo)
	{
		for ($i = 0; $i < $nrEquipo; $i++)
		{
			$arr = fncfetch($rsEquipo, $i);
			array_push($result, array("id" => $arr['equipocodigo'], "label" => $arr['equipocodigo'].' / '.$arr['equiponombre'], "value" => strip_tags($arr['equiponombre'])));

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);