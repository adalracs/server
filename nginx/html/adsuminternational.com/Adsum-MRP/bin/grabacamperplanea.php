<?php 
//by ralvear ramiro-ok@hotmail.com
	//levanta bandera de captura y muestra de errores
	//ini_set('display_errors',1);
	//establece conexion a la base de datos
	$idcon = fncconn();
	//consulta el consecutivo de insercion
	$nuidtemp = fncnumact(136,$idcon);	
	do
	{
		//valida existencia de consecutivo
		$nuresult = loadrecordcpplandetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegCpplandetope[cppldocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//valida tipo de producto
	if($tipitecodigo)
	{
		//consulta los campos pertenecientes a cada tipo de producto
		$rsCamperplanea = dinamicscancamperplanea(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//cuenta los registro consultados
		$nrCamperplanea = fncnumreg($rsCamperplanea);
		//elimina valores de campo dispensing al producto
		$response = delrecordcpplandetope($produccodigo,$idcon);
		//ciclo para recorrer consulta
		for( $a=0; $a< $nrCamperplanea; $a++){
			//extrae consulta respecto a un indice
			$rwCamperplanea = fncfetch($rsCamperplanea,$a);
			//crear objeto de acuerdo a su nombre
			$objCamperplanea = $rwCamperplanea['cpplannombre'];
			//valida si contiene valor
			if($$objCamperplanea)
			{
				//prepara array
				$iRegCpplandetope[cppldocodigo] = $iRegCpplandetope[cppldocodigo] + 1;
				$iRegCpplandetope[cpplancodigo] = $rwCamperplanea[cpplancodigo];
				$iRegCpplandetope[usuacodi] = $usuacodi;
				$iRegCpplandetope[cppldovalor] = $$objCamperplanea;
				$iRegCpplandetope[cppldofecha] = date('Y-m-d');
				$iRegCpplandetope[cppldonota] = 'Valor del campo '.$objCamperplanea;
				$iRegCpplandetope[produccodigo] = $produccodigo;
				//inserta el array en su respectiva tabla
				$res = insrecordcpplandetope($iRegCpplandetope,$idcon);
				if($res == -2)
				{
					//consulta el consecutivo de insercion
					$nuidtemp = fncnumact(136,$idcon);	
					do
					{
						//valida existencia de consecutivo
						$nuresult = loadrecordcpplandetope($nuidtemp,$idcon);
						if($nuresult == e_empty)
							$iRegCpplandetope[cppldocodigo] = $nuidtemp - 1;
						$nuidtemp ++;
					}while ($nuresult != e_empty);
					unset($nuidtemp);
					//se reasigna el nuevo consecutivo
					$iRegCpplandetope[cppldocodigo] = $iRegCpplandetope[cppldocodigo] + 1;
					//se ingresa el registro
					$res = insrecordcpplandetope($iRegCpplandetope,$idcon);
				}
			}
		}
		fncnumprox(136,$iRegCpplandetope['cppldocodigo'] + 1,$idcon);
	}
	//termina la conexion a la base de datos
	fncclose($idcon);
	
?>