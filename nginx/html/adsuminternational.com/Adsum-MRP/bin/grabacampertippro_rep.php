<?php 
//by ralvear ramiro-ok@hotmail.com
	//ini_set('display_errors',1);
	$idcon = fncconn();
	//consecutivo para campo personalizado
	$nuidtemp = fncnumact(112,$idcon);	
	do
	{
		$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegcptpdetope[cptodocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	if($tipitecodigo)
	{
		//funcion especial creada para cargar los campos a guardar en caso de ser repeticion
		$rsCampertippro = dinamicscanprszadocampertippro(array('cptprnombre'=>'precio, codigosap, moneda, exportacion, cartera, cobro_fotopo,version_arte,uploadocumen,uploadocumensize', 'tipprocodigo'=>$tipitecodigo), array('cptprnombre'=>'likeor','tipprocodigo'=>'='),$idcon);
		//se cuenta la cantidad de registros consultados
		$nrCampertippro = fncnumreg($rsCampertippro);
		//se hace el ciclo de escaneo
		for($i=0;$i<$nrCampertippro;$i++)
		{
			//se llama el registro dependiendo de su indice
			$rwCampertippro = fncfetch($rsCampertippro,$i);
			//se crea el campo personalizado
			$objCampertippro = $rwCampertippro['cptprnombre'];
			//valida que contenga valor el campo para almacenar a la base de datos
			if($$objCampertippro)
			{
				//se crea el ireg de campo personalizado
				$iRegcptpdetope[cptodocodigo] = $iRegcptpdetope[cptodocodigo] + 1;
				$iRegcptpdetope[cptprocodigo] = $rwCampertippro[cptprocodigo];
				$iRegcptpdetope[usuacodi] = $usuacodi;
				$iRegcptpdetope[cptprovalor] = $$objCampertippro;
				$iRegcptpdetope[cptprofecha] = date('Y-m-d');
				$iRegcptpdetope[cptpronota] = 'Valor del campo '.$objCampertippro;
				$iRegcptpdetope[produccodigo] = $iRegproducto[produccodigo];
				//se inserta el registro del campo personalizado
				$res = insrecordcptpdetope($iRegcptpdetope,$idcon);
				if($res == -2)
				{
					//consecutivo para campo personalizado
					$nuidtemp = fncnumact(112,$idcon);	
					do
					{
						$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
						if($nuresult == e_empty)
							$iRegcptpdetope[cptodocodigo] = $nuidtemp - 1;
						$nuidtemp ++;
					}while ($nuresult != e_empty);
					unset($nuidtemp);
					//re asignacion del codigo
					$iRegcptpdetope[cptodocodigo] = $iRegcptpdetope[cptodocodigo] + 1;
					//se ingresa el campo personalizado
					$res = insrecordcptpdetope($iRegcptpdetope,$idcon);
				}
			}
		}
		//se actualiza el consecutivo de campo personalizado
		$nuresult1 = fncnumprox(112,$iRegcptpdetope[cptodocodigo] + 1,$idcon);  
	}
	fncclose($idcon);
?>