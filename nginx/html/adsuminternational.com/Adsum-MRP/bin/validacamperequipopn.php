<?php 
$idconeq = fncconn();

if($equipocodigo):
	$rsCamperequipopn = dinamicscancamperequipopn(array('equipocodigo' => $equipocodigo),$idconeq);
	$nrCamperequipopn = fncnumreg($rsCamperequipopn);
	for( $a = 0; $a < $nrCamperequipopn; $a++):
		$rwCamperequipopn = fncfetch($rsCamperequipopn,$a);
		$objCamperquipopn = $rwCamperequipopn['cpeqpnnombre'];
		if($rwCamperequipopn['cpeqpnrequer'] == 't' && !$$objCamperquipopn):
			$campnomb[$objCamperquipopn] = 1;
			$flagnuevoreportelampn = 1;
			$flagerror=1;
		endif;		
	endfor;
endif;
fncconn($idconeq);
?>