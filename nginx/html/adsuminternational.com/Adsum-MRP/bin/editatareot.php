<?php

include_once('grabausuariotareot2.php');

function editatareot($iRegtareot, $lider, $arreglo_tecnic,  $cuadricodigo)
{ 
    $nuconn = fncconn(); 
    $result = uprecordtareot($iRegtareot,$nuconn); 
    
    if($result < 0 )
        $flageditartareot = 1;
	else 
	{
		$iregResult = delrecordusuariotareot2($iRegtareot['tareotcodigo'],$nuconn);
		
	    $iRegusuariotareot[usutarcodigo] = $usutarcodigo;
		$iRegusuariotareot[usuacodi] = $lider;
		$iRegusuariotareot[tareotcodigo] = $iRegtareot['tareotcodigo'];
		$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
		$iRegusuariotareot[usutarlider] = 't';
		
		grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
		
		if($arreglo_tecnic)
		{
			$valposic = explode(",",$arreglo_tecnic);
			
			$numposic = count($valposic);
			for($i = 0; $i < $numposic; $i++)
			{
				if($valposic[$i] != $lider)
				{
					$iRegusuariotareot[usutarcodigo] = $emptarcodigo;
					$iRegusuariotareot[usuacodi] = $valposic[$i];
					$iRegusuariotareot[tareotcodigo] = $iRegtareot['tareotcodigo'];
					$iRegusuariotareot[cuadricodigo] = $cuadricodigo;
					$iRegusuariotareot[usutarlider] = 'f';
					grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnomb);
				}
			}
		}
	}
    fncclose($nuconn); 
}
 
$iRegtareot[ordtracodigo] = $codigoot; 
$iRegtareot[tareacodigo]  = $tarcodigo; 
$iRegtareot[tiptracodigo] = $tiptcodigo; 
$iRegtareot[operaccodigo] = $operaccodigo; 
$iRegtareot[tareottiedur] = $tareottiedur; 
$iRegtareot[tareotnota]   = $notatareot; 
$iRegtareot[progracodigo] = $progracodigo; 
$iRegtareot[usuacodi] 	  = $usuacodi;
$iRegtareot[otestacodigo] 	  = $otestacodigo;
$iRegtareot[prioricodigo] 	  = $otestacodigo;
$iRegtareot[tareotsecuen] = 0; 


$iRegtareot[tareothorini] = $ordtrahorini; //
$iRegtareot[tareotfecini] = $ordtrafecini; //
$iRegtareot[tareothorfin] = $ordtrahorfin; //
$iRegtareot[tareotfecfin] = $ordtrafecfin; //

$idcon = fncconn();
$rsTareot = dinamicscantareot(array('ordtracodigo' => $ordtracodigo), $idcon);
$nrTareot = fncnumreg($rsTareot);

for($a = 0; $a < $nrTareot; $a++)
{
	$rwTareot = fncfetch($rsTareot, $a);
	$iRegtareot[tareotcodigo] = $rwTareot['tareotcodigo']; 
	editatareot($iRegtareot, $lider, $arreglo_tecnic,  $cuadricodigo); 
}