<?php
	include_once '../../FunPerPriNiv/pktblusuario.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';

	$iRegusuario[usuapass] = md5($pass);
	$iRegusuario[usuacodi] = $usuacodigo;

	$idcon = fncconn();
	$nuresult = uprecordusuariopass($iRegusuario,$idcon);
	fncclose($idcon);

	if($nuresult < 0)
		echo '1';