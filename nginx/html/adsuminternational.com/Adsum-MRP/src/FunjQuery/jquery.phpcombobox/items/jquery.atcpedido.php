<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;
	
	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblpedidoventa.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	include '../../../FunPerSecNiv/fncsqlrun.php';
	
	$idcon = fncconn();
	
	if(!$cliente)
	{
		$record['pedvennumero'] = $termino;
		$recordop['pedvennumero'] = 'like';
		$rsNumeroPV = dinamicscanoppedidoventa($record, $recordop, $idcon);
	}
	else
	{
		$sql = "	SELECT pedvencodigo,pedvennumero,ordcomcodcli FROM pedidoventa 
					LEFT JOIN ordencompra ON pedidoventa.ordcomcodigo = ordencompra.ordcomcodigo
					WHERE ordcomcodcli = '$cliente' AND pedvennumero LIKE '%$termino%'";
		$rsNumeroPV = fncsqlrun($sql,$idcon);
	}
	
	if($rsNumeroPV > 0) 
		$numReg = fncnumreg($rsNumeroPV);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rsNumeroPV, $i);
			
			$registro = array();
			$registro =  array("id" => $arr['pedvencodigo'], "label" => $arr['pedvennumero'] , "value" => strip_tags($arr['pedvennumero']));
			array_push($result,$registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);