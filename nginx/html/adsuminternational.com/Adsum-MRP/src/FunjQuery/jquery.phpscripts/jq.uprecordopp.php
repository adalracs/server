<?php
	include_once '../../FunPerPriNiv/pktbloppvelocidadpn.php';
	include_once '../../FunPerPriNiv/pktbloppajustepn.php';
	include_once '../../FunPerSecNiv/fncconn.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncfetch.php';

	$idcon = fncconn();
	
	if($ordoppcodigo && $arrvelocidadpn && $arrajustepn)
	{
		delrecordoppvelocidadpn($ordoppcodigo,$idcon);
		if($arrvelocidadpn) $arrObjsvelocidadpn = explode(',',$arrvelocidadpn);
		for($a = 0; $a < count($arrObjsvelocidadpn); $a++)
		{
			insrecordoppvelocidadpn(array('ordoppcodigo' => $ordoppcodigo, 'velocicodigo' => $arrObjsvelocidadpn[$a]),$idcon);
		}
		
		delrecordoppajustepn($ordoppcodigo,$idcon);
		if($arrajustepn) $arrObjsajustepn = explode(',',$arrajustepn);
		for($a = 0; $a < count($arrObjsajustepn); $a++)
		{
			insrecordoppajustepn(array('ordoppcodigo' => $ordoppcodigo, 'ajustecodigo' => $arrObjsajustepn[$a]),$idcon);
		}
		
		echo 'Proceso Exitoso.';
	}
	else
	{
		echo 'Ocurrio Algun Error Inesperado.';
	}
	
	fncclose($idcon);