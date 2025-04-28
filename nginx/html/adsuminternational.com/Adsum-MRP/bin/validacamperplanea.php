<?php 	
//by ralvear ramiro-ok@hotmail.com
	//validacion de seleccion primaria para carga de campos a validar
	if($tipitecodigo && $tipevecodigo){

		$idcon = fncconn();
		//se consulta los campos personalisados de planeacion segun tipo producto
		$rsCamperplanea = dinamicscancamperplanea(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//se cuanta el numero de registros
		$nrCamperplanea = fncnumreg($rsCamperplanea);
		for($i=0;$i<$nrCamperplanea;$i++){

			//se consulta el registro dependiendo del ciclo
			$rwCamperplanea = fncfetch($rsCamperplanea,$i);
			//se crea el campo personalizado
			$objCamperplanea = $rwCamperplanea['cpplannombre'];
			//se valida que sea campo primario o padre por si existe alguna dependencia
			if($rwCamperplanea['cpplancodpad'] == 0){

				//se valida que sea requerido y esta vacio
				if($rwCamperplanea['cpplanrequer'] == 't' && !$$objCamperplanea){

					//se llena la variable campnomb con los campos faltantes
					$campnomb[$objCamperplanea] = 1;
					//se activan las banderas de intento de grabado
					$flagnuevovistaplaneacion = 1;
				}
			}
		}
		
	}else{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['tipprocodigo'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaplaneacion = 1;
	}
	
	//validaciones adicionales
	
	if($tipo_impresion != 'sin_impresion'){

		if(!$continuo){

			//se llena la variable campnomb con los campos faltantes
			$campnomb['continuo'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaplaneacion = 1;
		}
		
		if(!$rodillo){

			//se llena la variable campnomb con los campos faltantes
			$campnomb['rodillo'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaplaneacion = 1;
		}
		
		if(!$nropistas){

			//se llena la variable campnomb con los campos faltantes
			$campnomb['nropistas'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaplaneacion = 1;
		}
		
		if($continuo == 'no'){
			
			if(!$nrorepet){
				
				//se llena la variable campnomb con los campos faltantes
				$campnomb['nrorepet'] = 1;
				//se activan las banderas de intento de grabado
				$flagnuevovistaplaneacion = 1;
			}
		}
		
	}
	
	fncclose($idcon);
	
?>