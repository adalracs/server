<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblpadreitem.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['paditenombre'] = $termino;
	$recordop['paditenombre'] = 'like';
	
	$idcon = fncconn();
	$rs_item = dinamicscanoppadreitem($record, $recordop, $idcon);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['paditecodigo'], "label" => $rw_item['paditenombre'] , "value" => strip_tags($rw_item['paditenombre']), "densidad" => $rw_item['paditedensid'], "extruido" => $rw_item['paditeextrui']);	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);