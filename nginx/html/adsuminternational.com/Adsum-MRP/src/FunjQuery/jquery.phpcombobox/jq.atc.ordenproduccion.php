<?php
ini_set('display_errors',1);
	$termino = strtolower($_GET["term"]);
	
	if (!$termino) return;

	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblvistagestionopp.php';
	include '../../FunPerPriNiv/pktblopp.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$record['ordoppcodigo'] = $termino;
	$recordop['ordoppcodigo'] = 'like';
	$record['opestacodigo'] = 2;
	$recordop['opestacodigo'] = '=';
	
	$idcon = fncconn();
	$rs_item = dinamicscanopvistagestionopp($record, $recordop, $idcon);
	$nr_item = fncnumreg($rs_item);
	
	$result = array();	
	
	if($nr_item)
	{
		for ($i = 0; $i < $nr_item; $i++)
		{
			$rw_item = fncfetch($rs_item, $i);
			$rw_opp = loadrecordopp($rw_item['ordoppcodigo'],$idcon);
			$registro = array();
			
			$registro = array("id" => $rw_item['ordoppcodigo'], "label" => 'OPP: '.$rw_item['ordoppcodigo'].' ['.$rw_item['equiponombre'].'] KGs: '.number_format($rw_opp['ordoppcantkg'], 2, ',', '.').' MTs: '.number_format($rw_opp['ordoppcantmt'], 2, ',', '.') , "value" => strip_tags($rw_item['ordoppcodigo']));	
			
			array_push($result, $registro);

			if (count($result) > 15)
				break;
		}
	}
	
	echo array_to_json($result);