<?php
	$termino = strtolower($_GET["term"]);
	if (!$termino) return;
	
//	ini_set ( 'display_errors', 1 );
//	ini_set('allow_url_include',1);
//	ini_set('allow_url_fopen',1);
	
	include '../../jquery.service/jquery.array_json.php';
	include '../../../FunPerPriNiv/pktblitem.php';
	include '../../../FunPerPriNiv/pktblpedidotemp.php';
	include '../../../FunPerSecNiv/fncnumreg.php';
	include '../../../FunPerSecNiv/fncfetch.php';
	include '../../../FunPerSecNiv/fncconn.php';
	include '../../../FunPerSecNiv/fncclose.php';
	include '../../../FunPerSecNiv/fncsqlrun.php';

	
	$test = fopen('http://190.26.218.174/test.php',r);
	var_dump($test);
	$test2 = stream_get_contents($test);
	var_dump($test2);
	
	
	/*
	$idcon = fncconn();
	
	/*
	$sql = "SELECT * FROM pedidotemp where pedtempedido::text like'%$termino%'";
	$rsNumeroPV = fncsqlrun($sql,$idcon);
	
	
	$record['pedtempedido'] = $termino;
	$recordop['pedtempedido'] = 'like';
	$idcon = fncconn();
	$rsNumeroPV = dinamicscanoppedidotemp($record, $recordop, $idcon);
	
	if($rsNumeroPV > 0) 
		$numReg = fncnumreg($rsNumeroPV);
	
	$result = array();	

	if($numReg)
	{
		for ($i = 0; $i < $numReg; $i++)
		{
			$arr = fncfetch($rsNumeroPV, $i);
			
			$registro = array();
			$registro =  array("id" => $arr['pedtempedido'], "label" => $arr['pedtempedido'], "value" => strip_tags($arr['pedtempedido']),
			"pedvenfecent" => $arr['pedtemfecent'],"produccouno" => $arr['pedtemitem'], "producnombre" => $arr['pedtemnompro'],
		    "pedvendiapac" => $arr['pedtemdiapac'],"clientcodigo" => $arr['pedtemnit'],  "clientnombre" => $arr['pedtemrazsoc'],
		    "pedvenobserv" => $arr['pedtemobserv'],"ordcomcodigo" => $arr['pedtemordcom'], "pedvenfecrec" => $arr['pedtemfecped'],
			"cant" => $arr['pedtemcantid'], "unimedi" => $arr['pedtemunimed'], 
			"pedtemtipped" => $arr['pedtemtipped'],
			
			"pedtemmotmue" => $arr['pedtemmotmue'], "pedtemcedven" => $arr['pedtemcedven'],
			"pedtemciudad" => $arr['pedtemciudad'], 
			"pedtemdirdes" => $arr['pedtemdirdes'], "pedtemtelefo" => $arr['pedtemtelefo'], "pedtemcontac" => $arr['pedtemcontac']);
			array_push($result,$registro);

			if (count($result) > 15)
				break;
		}
	}

	echo array_to_json($result);
	
	*/
	