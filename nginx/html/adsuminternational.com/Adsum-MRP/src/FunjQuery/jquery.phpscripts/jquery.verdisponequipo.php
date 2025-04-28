<?php
	include_once '../../FunPerSecNiv/fncsqlrun.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	$sbSql = "SELECT estado.estadonombre, estado.estadotipo FROM equipo LEFT JOIN estado ON estado.estadocodigo = equipo.estadocodigo WHERE equipocodigo = '{$equipocodigo}'";
	$rsEquipo = fncsqlrun($sbSql, $idcon);
	$rwEquipo = fncfetch($rsEquipo, 0);
	
	if($rwEquipo['estadotipo'] === '0')
		echo $rwEquipo['estadonombre'];