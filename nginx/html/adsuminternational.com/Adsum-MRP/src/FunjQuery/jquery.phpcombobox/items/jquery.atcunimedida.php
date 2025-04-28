<?php
	ini_set('display_errors', 1);
	$termino = strtoupper($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblunimedida.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['unidadnombre'] = $termino;
	$recordop['unidadnombre'] = 'like';
	/*$record['usuapriape'] = $termino;
	$recordop['usuapriape'] = 'like';
	$record['usuasegape'] = $termino;
	$recordop['usuasegape'] = 'like';*/
	
	
	$idcon = fncconn();
	$rs_unimedida = dinamicscanopunimedida($record, $recordop, $idcon);
	$nr_unimedida = fncnumreg($rs_unimedida);
	$result = array();	

	if($nr_unimedida)
	{
		for ($i = 0; $i < $nr_unimedida; $i++)
		{
			$rw_unimedida = fncfetch($rs_unimedida, $i);
			$registro = array();
			$registro = array("id" => $rw_unimedida['unidadcodigo'], "label" => $rw_unimedida['unidadnombre'], "value" => strip_tags($rw_unimedida['unidadnombre']));
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);