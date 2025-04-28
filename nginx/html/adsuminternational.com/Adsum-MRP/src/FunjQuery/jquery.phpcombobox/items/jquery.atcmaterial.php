<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblitemventas.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['itevennombre'] = $termino;
	$recordop['itevennombre'] = 'like';
	
	$idcon = fncconn();
	$rs_item = dinamicscanopitemventas($record, $recordop, $idcon);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['itevencodigo'], "label" => $rw_item['itevennombre'] , "value" => strip_tags($rw_item['itevennombre']), "densidad" => $rw_item['itevendensid'], "extruido" => $rw_item['itevenextru']);	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);