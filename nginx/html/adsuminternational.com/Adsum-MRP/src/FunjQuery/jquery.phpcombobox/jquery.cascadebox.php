<?php
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';

	$arrComplem = array(
					"sistema" => array("table" => "sistema", "query" => "plantacodigo", "id" => "sistemcodigo", "label" => "sistemnombre", "other_q" => ""),
					"equipo" => array("table" => "equipo", "query" => "sistemcodigo", "id" => "equipocodigo", "label" => "equiponombre", "other_q" => ""),
					"componen_" => array("table" => "tipocomponen", "query" => "equipocodigo", "id" => "tipcomcodigo", "label" => "tipcomnombre", "join" => "componen LEFT JOIN tipocomponen ON tipocomponen.tipcomcodigo = componen.tipcomcodigo", "other_q" => "AND tipocomponen.tipcomcodigo IS NOT NULL"),
					"componen" => array("table" => "componen", "query" => "tipcomcodigo", "id" => "tipcomcodigo", "label" => "componnombre", "join" => "", "other_q" => "AND equipocodigo = '".$equipo."' "),
					"saloncapaci" => array("table" => "componen", "query" => "tipcomcodigo", "id" => "componcodigo", "label" => "componnombre", "join" => "", "other_q" => ""),
		);
	
	$id = $_REQUEST['id'];
	$tabla = $_REQUEST['tabla'];
	$complem = $arrComplem[$tabla];
	
	if(!$id) return;
	
	if(!$complem['join'])
		$strSql = "SELECT {$complem['table']}.{$complem['id']}, {$complem['table']}.{$complem['label']} FROM {$complem['table']} WHERE {$complem['table']}.{$complem['query']} = '{$id}' {$complem['other_q']} ORDER BY {$complem['table']}.{$complem['label']}";
	else  
		$strSql = "SELECT DISTINCT {$complem['table']}.{$complem['id']}, {$complem['table']}.{$complem['label']} FROM {$complem['join']} WHERE {$complem['query']} = '{$id}' {$complem['other_q']} ORDER BY {$complem['table']}.{$complem['label']}";
	
	$idcon = fncconn();
	$rsResult = fncsqlrun($strSql, $idcon);
	$nrResult = fncnumreg($rsResult);
	
	$result = array();	

	if($nrResult)
	{
		for ($i = 0; $i < $nrResult; $i++)
		{
			$arr = fncfetch($rsResult, $i);
			array_push($result, array("id" => $arr[0], "label" => $arr[0].' - '.$arr[1]));
			//array_push($result, array("id" => $arr[0], "label" => str_replace("\n", "", $arr[1])));
		}
	}

	echo array_to_json($result);