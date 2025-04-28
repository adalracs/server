<?php
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktbltipoembobinado.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	include '../../../FunPerSecNiv/fncsqlrun.php';
	
	$record['tipembnombre'] = $termino;
	
	$idcon = fncconn();
	//consulta personalizada
	$rs_embobinado = dinamicscantipoembobinado($record, $idcon);
	$nr_embobinado = fncnumreg($rs_embobinado);
	
	$result = array();	
	
	if($nr_embobinado)
	{
		for ($i = 0; $i < $nr_embobinado; $i++)
		{
			$rw_embobinado = fncfetch($rs_embobinado, $i);
			$registro = array();
			
			$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	   		for($i = 0; $i < count($arr_ext); $i++)
	   		{
			   	if(file_exists('../../../../img/pics_embobinados/embobinado_'.$rw_embobinado['tipembcodigo'].$arr_ext[$i]))
		   		{
			   		$rutafoto = 'embobinado_'.$rw_embobinado['tipembcodigo'].$arr_ext[$i];
		   			break;
		   		}
	   		}
			
			$registro = array("id" => $rw_embobinado['tipembcodigo'], "label" => $rw_embobinado['tipembcodigo'].' - '.$rw_embobinado['tipembnombre'] , "value" => strip_tags($rw_embobinado['tipembnombre']), "desc" => $rw_embobinado['tipembdescri'], "icon" => $rutafoto );	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);