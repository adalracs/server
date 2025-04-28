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
	
	if($form_empa == 'suspendido')
		$keylinea = 1070;//codigo de linea en sistema uno para los conectores que se usan en la forma de empaque suspendido
	if($form_empa == 'carton_extremos')
		$keylinea = 1720;//codigo de linea en sistema uno para los conectores que se usan en la forma de empaque suspendido
	
	$idcon = fncconn();
	//consulta personalizada
	$sql = "SELECT * FROM itemdesa WHERE keylinea LIKE '%".$keylinea."%' 
				AND (upper(itedescodigo::text) LIKE upper('%".$termino."%') OR upper(itedesnombre) LIKE upper('%".$termino."%'))";
	$rs_item = fncsqlrun($sql,$idcon);
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