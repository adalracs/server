<?php 
$idconeq = fncconn();

if($equipocodigo):
	$rsCpeqpndetope = dinamicscancpeqpndetope(array('relapncodigo' => $relapncodigo),$idconeq);
	$nrCpeqpndetope = fncnumreg($rsCpeqpndetope);
	for( $a = 0; $a < $nrCpeqpndetope; $a++):
		$rwCpeqpndetope = fncfetch($rsCpeqpndetope,$a);
		$rwCamperequipopn = loadrecordcamperequipopn($rwCpeqpndetope['cpeqpncodigo'],$idconeq);
		$objCamperquipopn = $rwCamperequipopn['cpeqpnnombre'];
		$$objCamperquipopn = $rwCpeqpndetope['cpepdovalor'];
	endfor;
endif;
fncconn($idconeq);
?>