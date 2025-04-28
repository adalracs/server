<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblitemdesa.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	include '../../../FunPerSecNiv/fncsqlrun.php';
	
	$record['itedescodigo'] = $termino;
	$recordop['itedescodigo'] = 'like';
	$record['itedesnombre'] = $termino;
	$recordop['itedesnombre'] = 'like';
	$record['keylinea'] = '1720';//linea de las cajas
	$recordop['keylinea'] = '=';
	
	$idcon = fncconn();
	//consulta personalizada
	$sql = "SELECT * FROM itemdesa WHERE (keylinea = '10101' OR keylinea = '20101' OR keylinea = '30101') 
				AND (upper(itedescodigo::text) LIKE upper('%".$termino."%') OR upper(itedesnombre) LIKE upper('%".$termino."%'))";
//	echo $sql;die;
	$rs_item = fncsqlrun($sql,$idcon);
//	$rs_item = dinamicscanopitemdesa($record, $recordop, $idcon, 1);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
		if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$registro = array();
			
			$registro = array("id" => $rw_item['itedescodigo'], "label" => $rw_item['itedescodigo'].' - '.$rw_item['itedesnombre'] , "value" => strip_tags($rw_item['itedescodigo']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);