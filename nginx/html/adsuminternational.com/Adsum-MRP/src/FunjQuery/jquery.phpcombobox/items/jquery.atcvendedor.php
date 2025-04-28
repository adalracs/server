<?php
	ini_set('display_errors', 1);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblusuario.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	
	$record['usuanombre'] = $termino;
	$recordop['usuanombre'] = 'like';
	$record['usuapriape'] = $termino;
	$recordop['usuapriape'] = 'like';
	$record['usuasegape'] = $termino;
	$recordop['usuasegape'] = 'like';
		
	
	$idcon = fncconn();
	$rs_usuario = dinamicscanoporusaurio($record, $recordop, $idcon);
	$nr_usuario = fncnumreg($rs_usuario);
	
	$result = array();	

	if($nr_usuario)
	{
		for ($i = 0; $i < $nr_usuario; $i++)
		{
			$rw_usuario = fncfetch($rs_usuario, $i);
			$registro = array();
			
			$registro = array("id" => $rw_usuario['usuacodi'], "label" => $rw_usuario['usuanombre'].' '.$rw_usuario['usuapriape'].' '.$rw_usuario['usuasegape'], "value" => strip_tags($rw_usuario['usuanombre'].' '.$rw_usuario['usuapriape'].' '.$rw_usuario['usuasegape']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);