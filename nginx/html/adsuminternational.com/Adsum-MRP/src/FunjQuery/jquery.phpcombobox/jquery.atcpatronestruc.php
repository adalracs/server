<?php
ini_set('display_errors',1);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblpatronestruc.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['patestnombre'] = $termino;
	$recordop['patestnombre'] = 'like';
	
	$idcon = fncconn();
	$rs_item = dinamicscanoppatronestruc($record, $recordop, $idcon);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['patestcodigo'], "label" => $rw_item['patestnombre'] , "value" => strip_tags($rw_item['patestnombre']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);