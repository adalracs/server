<?php
	include '../jquery.service/jquery.array_json.php';
	include '../../FunPerPriNiv/pktblcriterio.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	
	$idcon = fncconn();
	if($critercodigo):
	$rw_criterio = loadrecordcriterio($critercodigo,$idcon);
	endif;
	fncclose($idcon);
	
	echo array_to_json($rw_criterio);