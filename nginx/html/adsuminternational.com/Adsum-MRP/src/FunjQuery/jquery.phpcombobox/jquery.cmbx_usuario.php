<?php
	ini_set('display_errors', 0);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblvistacuadrillausuario.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	if($type == 'usuacodigo'):
		$record['usuacodi'] = $termino;
		$recordop['usuacodi'] = 'like';
	else:
		$record['usuanombre'] = $termino;
		$recordop['usuanombre'] = 'like';
		$record['usuapriape'] = $termino;
		$recordop['usuapriape'] = 'like';
		$record['usuasegape'] = $termino;
		$recordop['usuasegape'] = 'like';
	endif;
	
	if($filter):
		$record['negocicodigo'] = $filter;
		$recordop['negocicodigo'] = '=';
	endif;
		
	
	$idcon = fncconn();
	$rs_usuario = dinamicscanoporvistacuadrillausuario($record, $recordop, $idcon);

	$nr_usuario = fncnumreg($rs_usuario);
	
	$result = array();	

	if($nr_usuario)
	{
		for ($i = 0; $i < $nr_usuario; $i++)
		{
			$rw_usuario = fncfetch($rs_usuario, $i);
			$registro = array();
			
			if($type == 'usuacodigo')
				$registro = array("id" => $rw_usuario['usuanombre'].' '.$rw_usuario['usuapriape'].' '.$rw_usuario['usuasegape'], "label" => $rw_usuario['usuacodi'], "value" => strip_tags($rw_usuario['usuacodi']));
			else
				$registro = array("id" => $rw_usuario['usuacodi'], "label" => $rw_usuario['usuanombre'].' '.$rw_usuario['usuapriape'].' '.$rw_usuario['usuasegape'], "value" => strip_tags($rw_usuario['usuanombre'].' '.$rw_usuario['usuapriape'].' '.$rw_usuario['usuasegape']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);