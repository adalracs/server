<?php 
//by ralvear ramiro-ok@hotmail.com
	//levanta bandera de captura y muestra de errores
	//ini_set('display_errors',1);
	//establece conexion a la base de datos
	$idcon = fncconn();
	//consulta el consecutivo de insercion
	$nuidtemp = fncnumact(135,$idcon);	
	do
	{
		//valida existencia de consecutivo
		$nuresult = loadrecordcpdispdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegCpdispdetope[cpdidocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//valida tipo de producto
	if($tipitecodigo)
	{
		//consulta los campos pertenecientes a cada tipo de producto
		$rsCamperdispen = dinamicscancamperdispen(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//cuenta los registro consultados
		$nrCamperdispen = fncnumreg($rsCamperdispen);
		//elimina valores de campo dispensing al producto
		$response = delrecordcpdispdetope($produccodigo,$idcon);
		//ciclo para recorrer consulta
		for($a=0;$a<$nrCamperdispen;$a++){
			//extrae consulta respecto a un indice
			$rwCamperdispen = fncfetch($rsCamperdispen,$a);
			//crear objeto de acuerdo a su nombre
			$objCamperdispen = $rwCamperdispen['cpdispnombre'];
			//valida si contiene valor
			if($$objCamperdispen)
			{
				//prepara array
				$iRegCpdispdetope[cpdidocodigo] = $iRegCpdispdetope[cpdidocodigo] + 1;
				$iRegCpdispdetope[cpdispcodigo] = $rwCamperdispen[cpdispcodigo];
				$iRegCpdispdetope[usuacodi] = $usuacodi;
				$iRegCpdispdetope[cpdidovalor] = $$objCamperdispen;
				$iRegCpdispdetope[cpdidofecha] = date('Y-m-d');
				$iRegCpdispdetope[cpdidonota] = 'Valor del campo '.$objCamperdispen;
				$iRegCpdispdetope[produccodigo] = $produccodigo;
				//inserta el array en su respectiva tabla
				$res = insrecordcpdispdetope($iRegCpdispdetope,$idcon);
				if($res == -2)
				{
					//consulta el consecutivo de insercion
					$nuidtemp = fncnumact(135,$idcon);	
					do
					{
						//valida existencia de consecutivo
						$nuresult = loadrecordcpdispdetope($nuidtemp,$idcon);
						if($nuresult == e_empty)
							$iRegCpdispdetope[cpdidocodigo] = $nuidtemp - 1;
						$nuidtemp ++;
					}while ($nuresult != e_empty);
					unset($nuidtemp);
					//se re asigna el codigo 
					$iRegCpdispdetope[cpdidocodigo] = $iRegCpdispdetope[cpdidocodigo] + 1;
					//se ingresa el registro
					$res = insrecordcpdispdetope($iRegCpdispdetope,$idcon);
				}
			}
		}
	}
	//termina la conexion a la base de datos
	fncclose($idcon);
	
?>