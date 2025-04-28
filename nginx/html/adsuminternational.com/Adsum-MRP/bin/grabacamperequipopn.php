<?php 
$idconeq = fncconn();

if($equipocodigo):

	$nuidtemp = fncnumact(249,$idconeq);	
	do
	{
		$nuresult = loadrecordcpeqpndetope($nuidtemp,$idconeq);
		if($nuresult == e_empty)
			$iRegcpeqpndetope[cpepdocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	$rsCamperequipopn = dinamicscancamperequipopn(array('equipocodigo' => $equipocodigo),$idconeq);
	$nrCamperequipopn = fncnumreg($rsCamperequipopn);
	for( $a = 0; $a < $nrCamperequipopn; $a++):
		$rwCamperequipopn = fncfetch($rsCamperequipopn,$a);
		$objCamperquipopn = $rwCamperequipopn['cpeqpnnombre'];
		if($$objCamperquipopn):
			$iRegcpeqpndetope[cpepdocodigo] = $iRegcpeqpndetope[cpepdocodigo] + 1;
			$iRegcpeqpndetope[cpeqpncodigo] = $rwCamperequipopn[cpeqpncodigo];
			$iRegcpeqpndetope[usuacodi] = $usuacodi;
			$iRegcpeqpndetope[cpepdovalor] = $$objCamperquipopn;
			$iRegcpeqpndetope[cpepdofecha] = date('Y-m-d');
			$iRegcpeqpndetope[cpepdonota] = 'Valor del campo '.$objCamperquipopn;
			$iRegcpeqpndetope[relapncodigo] = $iRegreportelampn[relapncodigo];
			$res = insrecordcpeqpndetope($iRegcpeqpndetope,$idconeq);
			if($res == -2):
				unset($nuidtemp);
				$nuidtemp = fncnumact(249,$idconeq);	
				do	
				{
					$nuresult = loadrecordcpeqpndetope($nuidtemp,$idconeq);
					if($nuresult == e_empty)
						$iRegcpeqpndetope[cpepdocodigo] = $nuidtemp - 1;
					$nuidtemp ++;
				}while ($nuresult != e_empty);
	
				$iRegcpeqpndetope[cpepdocodigo] = $iRegcpeqpndetope[cpepdocodigo] + 1;
				$res = insrecordcpeqpndetope($iRegcpeqpndetope,$idconeq);
			endif;
		endif;
	endfor;
endif;
fncconn($idconeq);

?>