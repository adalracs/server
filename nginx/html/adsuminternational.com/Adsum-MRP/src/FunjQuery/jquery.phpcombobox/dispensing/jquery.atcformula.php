<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;
	
	ini_set('display_errors',1);
	
	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblformula.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['formulnumero'] = $termino;
	$recordop['formulnumero'] = 'like';
	$record['formulnombre'] = $termino;
	$recordop['formulnombre'] = 'like';

	
	$idcon = fncconn();
	$rs_item = dinamicscanopformula($record, $recordop, $idcon, 1);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['formulcodigo'], "label" => $rw_item['formulnumero'].' - '.$rw_item['formulnombre'] , "value" => strip_tags($rw_item['formulnumero'].' - '.$rw_item['formulnombre']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);