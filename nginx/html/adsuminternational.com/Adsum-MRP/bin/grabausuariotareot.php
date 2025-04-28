<?php
include_once('grabausuariotareot2.php');

$usidcon = fncconn();
delrecordusuariotareot2($codigotareot, $usidcon);

$iRegusuariotareot[usutarcodigo] = $usutarcodigo;
$iRegusuariotareot[usuacodi] = $lider;
$iRegusuariotareot[tareotcodigo] = $codigotareot;
$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
$iRegusuariotareot[usutarlider] = 't';

grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);

if($arreglo_tecnic)
{
	$valposic = explode(",",$arreglo_tecnic);
	
	$numposic = count($valposic);
	for($i = 0; $i < $numposic; $i++){
		
		if($valposic[$i] != $lider){
			$iRegusuariotareot[usutarcodigo] = $emptarcodigo;
			$iRegusuariotareot[usuacodi] = $valposic[$i];
			$iRegusuariotareot[tareotcodigo] = $codigotareot;
			$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
			$iRegusuariotareot[usutarlider] = 'f';
			grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
		}
	}
}