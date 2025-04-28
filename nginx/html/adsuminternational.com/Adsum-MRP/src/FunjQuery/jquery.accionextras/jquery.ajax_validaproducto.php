<?php 
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerPriNiv/pktblproducto.php';
		
	$idcon = fncconn();
	$respuesta[0]['accion'] = '0';
	$respuesta[0]['bandera'] = '0';
	if($produccoduno)
	{
		$ircrecord['produccoduno'] = $produccoduno;
		$ircrecordop['produccoduno'] = '=';
		$ircrecord['producdelrec'] = 1;
		$ircrecordop['producdelrec'] = '=';
		$rsProducto = dinamicscanopproducto($ircRecord,$ircrecordop,$idcon);
		$nrProducto = fncnumreg($rsProducto);
		$respuesta[0]['accion'] = '1';
		$respuesta[0]['bandera'] = $nrProducto;
	}
	
	echo array_to_json($respuesta[0]);
?>