<?php
	$termino = $_GET["term"];
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblitemdesa.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['itedescodigo'] = $termino;
	$recordop['itedescodigo'] = 'like';
	$record['itedesnombre'] = $termino;
	$recordop['itedesnombre'] = 'like';
	
	$idcon = fncconn();
	$rs_item = dinamicscanopitemdesa($record, $recordop, $idcon, 1);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	

	if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$arr = fncfetch($rs_item, $i);
			array_push($result, array("datos" => array("id"=>$arr['itedescodigo'],"slip"=>$arr['itedesslip'],"antibl"=>$arr['itedesantibl']), "label" => rtrim($arr['itedesnombre']), "value" => rtrim($arr['itedesnombre'])));

			if (count($result) > 11)
				break;
		}
	}

	echo array_to_json($result);