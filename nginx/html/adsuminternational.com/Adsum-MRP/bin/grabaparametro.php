<?php
//	ini_set("display_errors", 1);

	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	
	$idcon = fncconn();
	
	$nuidtemp = fncnumact(305, $idcon);
	do{

		$nuresult = loadrecordparametro($nuidtemp, $idcon);

		if($nuresult == e_empty){
			break;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	
	$rsParametro = dinamicscanopparametro(array('paramegrupo' => $paramegrupo, 'negocicodigo' => 'NULL'),
										array('paramegrupo' => '=', 'negocicodigo' => 'is_null'), $idcon);
	$nrParametro = fncnumreg($rsParametro);	 	
	
	for($a = 0; $a < $nrParametro; $a++){

		$rwParametro = fncfetch($rsParametro, $a);
		$objCampo = $rwParametro['paramecampo'];

		if($negocicodigo1){

			$rsParameneg = dinamicscanparametro(array('paramecampo' => $objCampo, 'negocicodigo' => $negocicodigo1), $idcon);
			$rwParameneg = fncfetch($rsParameneg, 0);
			
			if($rsParameneg > 0){

				$rwParameneg1['paramecodigo'] = $rwParameneg['paramecodigo'];
				$rwParameneg1['negocicodigo'] = $rwParameneg['negocicodigo'];
				$rwParameneg1['paramegrupo'] = $rwParameneg['paramegrupo'];
				$rwParameneg1['paramecampo'] = $rwParameneg['paramecampo'];
				$rwParameneg1['paramevalor'] = str_replace("\n", "<br>", $$objCampo);
				uprecordparametro($rwParameneg1, $idcon);
			}
			else{

				if($$objCampo){

					$rwParametro1['paramecodigo'] = $nuidtemp;
					$rwParametro1['negocicodigo'] = $negocicodigo1;
					$rwParametro1['paramevalor'] = $$objCampo;
					$rwParametro1['paramegrupo'] = $rwParametro['paramegrupo'];
					$rwParametro1['paramecampo'] = $rwParametro['paramecampo'];

					insrecordparametro($rwParametro1, $idcon);
					$nuidtemp++;
				}
			}
		}else{

			$rwParametro1['paramecodigo'] = $rwParametro['paramecodigo'];
			$rwParametro1['negocicodigo'] = $rwParametro['negocicodigo'];
			$rwParametro1['paramegrupo'] = $rwParametro['paramegrupo'];
			$rwParametro1['paramecampo'] = $rwParametro['paramecampo'];
			$rwParametro1['paramevalor'] = $$objCampo;
			
			uprecordparametro($rwParametro1, $idcon);
		}

	}
	
	$nuresult1 = fncnumprox(305, $nuidtemp, $idcon);
	
	echo '<script language="Javascript">'."\n";
	echo '<!--//'."\n";
	echo 'alert("Grabado Exitoso");'."\n";
	echo '//-->'."\n";
	echo '</script>';