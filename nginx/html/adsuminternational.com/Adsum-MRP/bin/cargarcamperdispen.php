<?php 
//by ralvear ramiro-ok@hotmail.com
	//variable globales de guia
	//producto es el producto del item sea nuevo repeticion modificacion muestra viene de donde se incluya.
	//validamos que estemos pasando el codigo del producto
	if($producto)
	{
		//consulta dinamica ala tabla detalle de operacion de cpdispdetope
		//y asi traer los campos personalizados de los productos
		$rsCpdispdetope = dinamicscancpdispdetope(array('produccodigo' =>$producto),$idcon);
		//consultamos el numero de registros que devuleve la consulta
		if($rsCpdispdetope > 0) $nrCpdispdetope = fncnumreg($rsCpdispdetope);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
		for($a = 0;$a<$nrCpdispdetope;$a++)
		{
			$rwCpdispdetope = fncfetch($rsCpdispdetope,$a);
			$rwCamperdispen = loadrecordcamperdispen($rwCpdispdetope['cpdispcodigo'],$idcon);
			//se crea el campo personalizado
			$objCampo = $rwCamperdispen['cpdispnombre'];
			//se le asigna el valor correspondiente en la base de datos.
			$$objCampo = $rwCpdispdetope['cpdidovalor'];
			//almacenamos en un array por efectos adicionales de consulta y historia.
			//este campo no es indispensable
			$arrCamperdispen[$objCampo] = $$objCampo;
		}
		//consulta dinamica a la tabla producformula
		//para asi traer para los colores de el dispensing
		$rsProducformula = dinamicscanproducformula(array("produccodigo" =>$producto), $idcon);
		//consultamos el numero de registros que devuleve la consulta
		$nrProducformula = fncnumreg($rsProducformula);
		//se borra para evitar duplucidad en la informacion
		unset($arrdispensing);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a array de dispensing $arrdispensing
		for($a = 0; $a < $nrProducformula; $a++)
		{
			$rwProducformula = fncfetch($rsProducformula, $a);
			$rwItem = loadrecordformula($rwProducformula['formulcodigo'],$idcon);
			//creamos el registro encadenado separado por el comidin ':-:' 
			$newRow = $rwProducformula['proforindice'].':-:'.$rwProducformula['formulcodigo'];
			//si se encadena registro por registro por otro separador adicional con el comodin ':|:'
			($arrdispensing) ? $arrdispensing .= ':|:'.$newRow : $arrdispensing = $newRow;
			//objeto adicional
			$obj_anilox = 'anilox_'.$rwProducformula['formulcodigo'];
			$obj_grupo = 'grupo_'.$rwProducformula['formulcodigo'];
			//se le  asigna el valor de acuerdo a la base da datos
			$$obj_grupo = $rwProducformula['proforgrupo'];
			$$obj_anilox = $rwProducformula['proforanilox'];
		}
	}
	//adicionales
	if($equipocodigo)
	{
		$rwEquipo = loadrecordequipo($equipocodigo,$idcon);
		$equiponombre = $rwEquipo['equiponombre'];
	}
?>