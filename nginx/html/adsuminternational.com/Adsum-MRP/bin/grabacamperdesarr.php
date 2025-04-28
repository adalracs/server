<?php 
//by ralvear ramiro-ok@hotmail.com
	//ini_set('display_errors',1);
	$idcon = fncconn();
	//consecutivo para campo personalizado
	$nuidtemp = fncnumact(126,$idcon);	
	do
	{
		$nuresult = loadrecordcpdesadetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegcpdesadetope[cpdsdocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//valida si tiene tipo de producto
	if($tipitecodigo)
	{
		//se consulta los campos personalizados del producto seleccionado
		$rsCamperdesarr = dinamicscancamperdesarr(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//se cuenta la cantidad de registros consultados
		$nrCamperdesarr = fncnumreg($rsCamperdesarr);
		//se borrar los registros anteriores
		$resul = delrecordcpdesadetope($produccodigo,$idcon);
		//se hace el ciclo de escaneo
		for($i=0;$i<$nrCamperdesarr;$i++)
		{
			//se llama el registro dependiendo de su indice
			$rwCamperdesarr = fncfetch($rsCamperdesarr,$i);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperdesarr['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCamperdesarr = $rwCamperdesarr['cpdesanombre'];
				//valida que contenga valor el campo para almacenar a la base de datos
				if($$objCamperdesarr)
				{
					//se crea el ireg de campo personalizado
					$iRegcpdesadetope[cpdsdocodigo] = $iRegcpdesadetope[cpdsdocodigo] + 1;
					$iRegcpdesadetope[cpdesacodigo] = $rwCamperdesarr[cpdesacodigo];
					$iRegcpdesadetope[usuacodi] = $usuacodi;
					$iRegcpdesadetope[cpdsdovalor] = $$objCamperdesarr;
					$iRegcpdesadetope[cpdsdofecha] = date('Y-m-d');
					$iRegcpdesadetope[cpdsdonota] = 'Valor del campo '.$objCamperdesarr;
					$iRegcpdesadetope[produccodigo] = $produccodigo;
					//se inserta el registro del campo personalizado
					$res = insrecordcpdesadetope($iRegcpdesadetope,$idcon);
					if($res == -2)
					{
						//consecutivo para campo personalizado
						$nuidtemp = fncnumact(126,$idcon);	
						do
						{
							$nuresult = loadrecordcpdesadetope($nuidtemp,$idcon);
							if($nuresult == e_empty)
								$iRegcpdesadetope[cpdsdocodigo] = $nuidtemp - 1;
							$nuidtemp ++;
						}while ($nuresult != e_empty);
						unset($nuidtemp);
						//re asignacion del codigo
						$iRegcpdesadetope[cpdsdocodigo] = $iRegcpdesadetope[cpdsdocodigo] + 1;
						//se ingresa el registro
						$res = insrecordcpdesadetope($iRegcpdesadetope,$idcon);
					}
				}
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else		
			{
				//validacion especial para cargar los campos de los materiales extruidos 
				//es por eso que se usa el explode y se continua ingresando creando las variables y asignado su valor
				//se crea el campo personalizado
				$objCamperdesarr = $rwCamperdesarr['cpdesanombre'];
				//se recorre el array tabla 2 para conocer su estructura
				$array_tmp = explode(':|:',$arrtabla2);
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se crea el campo personalizado para cada material dela  estructura
					$objCamperdesarr2 = $rwCamperdesarr['cpdesanombre'].'_'.($a+1);
					($$objCamperdesarr2)? $$objCamperdesarr2 = $$objCamperdesarr2 : $$objCamperdesarr2 = ' ';
					//se crea el campo personalizado como array dependiendo de la estructura
					$$objCamperdesarr = ($$objCamperdesarr)? $$objCamperdesarr . ',' .$$objCamperdesarr2 : $$objCamperdesarr2  ;
				}
				//valida que contenga valor el campo para almacenar a la base de datos
				if($$objCamperdesarr)
				{
					//se crea el ireg de campo personalizado
					$iRegcpdesadetope[cpdsdocodigo] = $iRegcpdesadetope[cpdsdocodigo] + 1;
					$iRegcpdesadetope[cpdesacodigo] = $rwCamperdesarr[cpdesacodigo];
					$iRegcpdesadetope[usuacodi] = $usuacodi;
					$iRegcpdesadetope[cpdsdovalor] = $$objCamperdesarr;
					$iRegcpdesadetope[cpdsdofecha] = date('Y-m-d');
					$iRegcpdesadetope[cpdsdonota] = 'Valor del campo '.$objCamperdesarr;
					$iRegcpdesadetope[produccodigo] = $produccodigo;
					//se inserta el registro del campo personalizado
					$res = insrecordcpdesadetope($iRegcpdesadetope,$idcon);
					if($res == -2)
					{
						//consecutivo para campo personalizado
						$nuidtemp = fncnumact(126,$idcon);	
						do
						{
							$nuresult = loadrecordcpdesadetope($nuidtemp,$idcon);
							if($nuresult == e_empty)
								$iRegcpdesadetope[cpdsdocodigo] = $nuidtemp - 1;
							$nuidtemp ++;
						}while ($nuresult != e_empty);
						unset($nuidtemp);
						//re asignacion del codigo
						$iRegcpdesadetope[cpdsdocodigo] = $iRegcpdesadetope[cpdsdocodigo] + 1;
						//se ingresa el registro
						$res = insrecordcpdesadetope($iRegcpdesadetope,$idcon);
					}
				}
			}
		}
		//se actualiza el consecutivo de campo personalizado
		$nuresult1 = fncnumprox(126,$iRegcpdesadetope[cpdsdocodigo] + 1,$idcon); 
	}
	fncclose($idcon);
?>