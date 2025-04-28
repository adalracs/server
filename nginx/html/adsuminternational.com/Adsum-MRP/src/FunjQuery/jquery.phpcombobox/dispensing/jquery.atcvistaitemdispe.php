<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;
	
	ini_set('display_errors',1);
	
	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblvistaitemdispe.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['itedescodigo'] = $termino;
	$recordop['itedescodigo'] = 'like';
	$record['itedesnombre'] = $termino;
	$recordop['itedesnombre'] = 'like';

	
	$idcon = fncconn();
	$rs_item = dinamicscanopvistaitemdispe($record, $recordop, $idcon, 1);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['itedescodigo'], "label" => $rw_item['itedescodigo'].' - '.$rw_item['itedesnombre'] , "value" => strip_tags($rw_item['itedesnombre']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);