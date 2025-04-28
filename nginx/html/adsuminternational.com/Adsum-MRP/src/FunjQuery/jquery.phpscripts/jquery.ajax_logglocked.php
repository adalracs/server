<?php
	include_once '../../FunPerPriNiv/pktblusuario.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';

	$iRegusuario[usuapass] = md5($pass);
	$iRegusuario[usuanomb] = $logg;
	$iRegusuarioop[usuapass] = '=';
	$iRegusuarioop[usuanomb] = '=';
	
	$idcon = fncconn();
	$nuresult = dinamicscanopusuario($iRegusuario,$iRegusuarioop,$idcon);
	$rs_usuario = fncfetch($nuresult, 0);
	
	if($rs_usuario['usuaacti'])
		echo '1';