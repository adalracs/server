<?php
	include_once '../../FunPerPriNiv/pktblusuario.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	
	$iRegusuario[usuanomb] = $usuanomb;
	$iRegusuarioop[usuanomb] = '=';

	$idcon = fncconn();
	$nuresult = dinamicscanopusuario($iRegusuario,$iRegusuarioop,$idcon);
	fncclose($idcon);
	
	if($nuresult < 0)
		echo '<font color="green"><b>Login disponible</b></font>';
	else 
		echo '<font color="red"><b>Login no disponible</b></font>';