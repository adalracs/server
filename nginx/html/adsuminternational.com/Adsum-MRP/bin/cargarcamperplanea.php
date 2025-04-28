<?php 
//by ralvear ramiro-ok@hotmail.com
	//validamos que estemos pasando el codigo del producto
	if($producto){
		//validamos si es una repetecion 
		if($tipevecodigo == 3){
			//carga el registro de producpedido para asi traer el producto al cual fue hecha la repeticion.
			$rwProductopedido = loadrecordproducpedidoPER('produccodigo',$producto,$idcon);			
			//se la asigna el codigo a la variable producto.
			$producto = $rwProductopedido['propedproduc'];

			if(!$producto){
				//se envia mensaje de error inesperado y se redirecciona a el maestro.
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("ocurrio un error inesperado.")';
				echo '//-->'."\n";
				echo '</script>';
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}

		}
		//consulta dinamica ala tabla detalle de operacion de cpplandetope
		//y asi traer los campos personalizados de los productos
		$rsCpplandetope = dinamicscancpplandetope(array('produccodigo' =>$producto),$idcon);
		//consultamos el numero de registros que devuleve la consulta
		if($rsCpplandetope > 0) $nrCpplandetope = fncnumreg($rsCpplandetope);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
		for($a = 0;$a<$nrCpplandetope;$a++){

			//se consulta el registro dependiendo del indice dado por el ciclo
			$rwCpplandetope = fncfetch($rsCpplandetope,$a);
			//se consulta el campo personalizado
			$rwCamperplanea = loadrecordcamperplanea($rwCpplandetope['cpplancodigo'],$idcon);
			//se crea el campo personalizado
			$objCampo = $rwCamperplanea['cpplannombre'];
			//se le asigna el valor correspondiente en la base de datos.
			$$objCampo = $rwCpplandetope['cppldovalor'];
			//almacenamos en un array por efectos adicionales de consulta
			if($$objCampo){
				$arrCamperplanea[$objCampo] = $$objCampo;
			}

		}

		//consulta dinamica a la tabla planeaitemdesa
		//para asi los materiales planeados 
		$rsPlaneaitemdesa = dinamicscanplaneaitemdesa(array('produccodigo' =>$producto),$idcon);//materiales de importacion
		//consultamos el numero de registros que devuleve la consulta
		if($rsPlaneaitemdesa > 0) $nrPlaneaitemdesa = fncnumreg($rsPlaneaitemdesa);
		//se borra para evitar duplucidad en la informacion
		unset($arrmatplan);
		if($rsPlaneaitemdesa > 0){
			//escaniamos de acuerdo a la cantidad de registro y asignamos los valores a array de planeacion $arrmatplan
			for($a = 0;$a<$nrPlaneaitemdesa;$a++){

				$rwPlaneaitemdesa = fncfetch($rsPlaneaitemdesa,$a);
				//si se encadena registro por registro por otro separador adicional con el comodin ':|:'
				$arrmatplan = ($arrmatplan)? $arrmatplan.':|:'.$rwPlaneaitemdesa['itedescodigo'].':-:'.$rwPlaneaitemdesa['procedcodigo'] : $rwPlaneaitemdesa['itedescodigo'].':-:'.$rwPlaneaitemdesa['procedcodigo'] ;
				//objetos adicionales
				$obj_consumo = 'consumo_'.$rwPlaneaitemdesa['itedescodigo'].':-:'.$rwPlaneaitemdesa['procedcodigo'];
				//$$obj_consumo = $rwPlaneaitemdesa['plaitecantid'];
			}

		}

	}

?>