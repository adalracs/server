<?php 
	
	include '../src/FunjQuery/jquery.service/jquery.array_json.php';
	include '../src/FunPerPriNiv/pktblusuario.php';
	include '../src/FunPerSecNiv/fncnumreg.php';
	include '../src/FunPerSecNiv/fncfetch.php';
	include '../src/FunPerSecNiv/fncconn.php';
	include '../src/FunPerSecNiv/fncclose.php';
	
	if($idcontratista):
		$idcon = fncconn();
		$rsUsuario = loadrecordusuario($idcontratista,$idcon);
		echo ($rsUsuario == -3)? array_to_json(array('respuesta' => $rsUsuario)) :  array_to_json(array('respuesta' => '0'));
		fncclose($idcon);
	endif;

?>