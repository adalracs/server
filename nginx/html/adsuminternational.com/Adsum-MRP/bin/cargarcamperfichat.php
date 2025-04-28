<?php 
//by ralvear ramiro-ok@hotmail.com
	//variable globales de guia
	//producto es el producto del item sea nuevo repeticion modificacion muestra viene de donde se incluya.
	//validamos que estemos pasando el codigo del producto	
	if($producto){
		//consulta dinamica ala tabla detalle de operacion de cpfichdetope
		//y asi traer los campos personalizados de los productos
		$rsCpfichdetope = dinamicscancpfichdetope(array('produccodigo' =>$producto),$idcon);
		//consultamos el numero de registros que devuleve la consulta
		if($rsCpfichdetope > 0) $nrCpfichdetope = fncnumreg($rsCpfichdetope);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
		for($i = 0;$i<$nrCpfichdetope;$i++)
		{
			$rwCpfichdetope = fncfetch($rsCpfichdetope,$i);
			(!$usuacodirespon)? $usuacodirespon = $rwCpfichdetope['usuacodi'] : '' ;
			$rwCamperfichat = loadrecordcamperfichat($rwCpfichdetope['cpfichcodigo'],$idcon);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperfichat['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCampo = $rwCamperfichat['cpfichnombre'];
				//se le asigna el valor correspondiente en la base de datos.
				$$objCampo = $rwCpfichdetope['cpftdovalor'];
				//almacenamos en un array por efectos adicionales de consulta y historia.
				//este campo no es indispensable
				$arrCamperfichat[$objCampo] = $$objCampo;
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//validacion especial para cargar los campos de los materiales extruidos 
				//se crean un array en cada campo personalizado separado por comas
				//es por eso que se usa el explode y se continua ingresando creando las variables y asignado su valor
				$objCampo = $rwCamperfichat['cpfichnombre'];
				$$objCampo = $rwCpfichdetope['cpftdovalor'];
				$array_tmp = explode(',',$rwCpfichdetope['cpftdovalor']);
				//ciclo de las variables
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se le asigna un nombre con una cadena denomida por el nombre +  en numero de resgitro.
					$objCampo = $rwCamperfichat['cpfichnombre'].'_'.($a+1);					
					//se le asigna el valor correspondiente en la base de datos.
					$$objCampo = $array_tmp[$a];
					//si tiene valor el objeto se procede a cargar el numero de la formulacion de extrusion en tabla formulacion
					if($$objCampo > 0 && $objCampo == 'formulcodigo_'.($a+1))
					{
						//se consulta el registro
						$rwFomulacion = loadrecordformulacion($$objCampo,$idcon);
						//variable adicional de la formulacion de los materiales extruidos
						$objCampo = 'formulnumero_'.($a+1);
						//se le asigna el valor
						$$objCampo = $rwFomulacion['formulnumero'];
					}
				}
			}
		}
		
		//consulta dinamica a la table prodduc - padre item 
		//para asi traer la estructura y asignar en la tabla 1 del pedido
		$rsItemproduc = dinamicscanproducpadreitem_ft(array("produccodigo" =>$producto), $idcon);
		//consultamos el numero de registros que devuleve la consulta
		$nrItemproduc = fncnumreg($rsItemproduc);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a el array de tabla1
		if( $nrItemproduc > 0){
			unset($arrtabla1,$totalgramaje,$totalcalibre);
			for($a = 0; $a < $nrItemproduc; $a++)
			{
				$rwItemproduc = fncfetch($rsItemproduc, $a);
				$rwItem = loadrecordpadreitem($rwItemproduc['paditecodigo'],$idcon);
				//creamos el registro encadenado separado por el comidin ':-:' 
				$newRow = ($a +1).':-:'.$rwItemproduc['paditecodigo'].':-:'.$rwItem['paditedensid'].':-:'.$rwItemproduc['propadcalib'].':-:'.$rwItem['paditeextrui'];
				//en caso de tener desempeño se le adiciona a la tinta
				if($rwItemproduc['propaddesem'])
					$newRow = $newRow.','.$rwItemproduc['propaddesem'];
				//al igual que el tipo de adhesivo
				if($rwItemproduc['propadtipo'])
					$newRow = $newRow.','.$rwItemproduc['propadtipo'];
				//si se encadena registro por registro por otro separador adicional con el comodin ':|:'
				($arrtabla1) ? $arrtabla1 .= ':|:'.$newRow : $arrtabla1 = $newRow;
				//se calculan los totales del gramaje y calibre
				$totalgramaje += ($rwItemproduc['propadcalib'] * $rwItem['paditedensid']);
				$totalcalibre += $rwItemproduc['propadcalib'];
				//objetos adicionales en el visor de estructura tabla1
				$objColor = 'color_'.($a +1).'_'.$rwItemproduc['paditecodigo'];
				$objCalibreA1 = 'calibre_a1_'.($a +1).'_'.$rwItemproduc['paditecodigo'];
				$objCalibreA2 = 'calibre_a2_'.($a +1).'_'.$rwItemproduc['paditecodigo'];
				//valor de los obejtos adicioneles
				$$objColor = $rwItemproduc['propadcolor'];
				$$objCalibreA1 = $rwItemproduc['propadcalib1'];
				$$objCalibreA2 = $rwItemproduc['propadcalib2'];
			}
		}
		//consulta dinamica a la tabla producformula
		//para asi traer para los colores de el dispensing
		$rsProducformula = dinamicscanproducformula_ft(array("produccodigo" =>$producto), $idcon);
		//consultamos el numero de registros que devuleve la consulta
		$nrProducformula = fncnumreg($rsProducformula);
		//se borra para evitar duplucidad en la informacion
		if($nrProducformula > 0){
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
	}
	
	//adicionales
	//productos aprobados por:
	$producpor = ($producto_avaliable)? $producto_avaliable : '---' ;
	//colores aprobados por:
	if($pantone) $colorespor = ($colorespor)? $colorespor.',PANTONE' : 'PANTONE';
	if($muestra) $colorespor = ($colorespor)? $colorespor.',MUESTRA' : 'MUESTRA';
	if($est_color) $colorespor = ($colorespor)? $colorespor.',ESTANDAR COLOR' : 'ESTANDAR COLOR';
	if($pcolor) $colorespor = ($colorespor)? $colorespor.',PRUEBA COLOR' : 'PRUEBA COLOR';
	$colorespor = ($colorespor)? $colorespor : '---' ;
	//tintas resistentas a
	unset($tintasa);
	if($tnt_calor) $tintasa = ($tintasa)? $tintasa.',CALOR' : 'CALOR' ;
	if($tnt_luz) $tintasa = ($tintasa)? $tintasa.',LUZ' : 'LUZ' ;
	if($tnt_acidos) $tintasa = ($tintasa)? $tintasa.',ACIDOS' : 'ACIDOS' ;
	if($tnt_alcalis) $tintasa = ($tintasa)? $tintasa.',ALCALIS' : 'ALCALIS' ;
	if($tnt_agua) $tintasa = ($tintasa)? $tintasa.',AGUA' : 'AGUA' ;
	if($tnt_grasas) $tintasa = ($tintasa)? $tintasa.',GRASAS' : 'GRASAS' ;
	if($tnt_brillo) $tintasa = ($tintasa)? $tintasa.',BRILLO' : 'BRILLO' ;
	if($tnt_rayado) $tintasa = ($tintasa)? $tintasa.',RAYADO' : 'RAYADO' ;
	$tintasa = ($tintasa)? $tintasa : '---' ;
	//tintas especiales para
	unset($tinta_espe);
	if($tntesp_laminacion) $tinta_espe = ($tinta_espe)? $tinta_espe.',LAMINACION' : 'LAMINACION' ;
	if($tntesp_superficie) $tinta_espe = ($tinta_espe)? $tinta_espe.',SUPERFICIE' : 'SUPERFICIE' ;
	if($tntesp_uretelasto) $tinta_espe = ($tinta_espe)? $tinta_espe.',URETANO ELASTOMERICO' : 'URETANO ELASTOMERICO' ;
	if($tntesp_nitropolia) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITROPOLIAMIDA' : 'NITROPOLIAMIDA' ;
	if($tntesp_vinilica) $tinta_espe = ($tinta_espe)? $tinta_espe.',VINILICA' : 'VINILICA' ;
	if($tntesp_nitrocelu) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITROCELULOSA' : 'NITROCELULOSA' ;
	if($tntesp_nitroure) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITRO-URETANO' : 'NITRO-URETANO' ;
	if($tntesp_poliamo) $tinta_espe = ($tinta_espe)? $tinta_espe.',POLIAMODA' : 'POLIAMODA' ;
	$tinta_espe = ($tinta_espe)? $tinta_espe : '---' ;
	//otros materiales 
	unset($other);
	if($other_pmetali) $other = ($other)? $other.',PRIMER METALIZADO' : 'PRIMER METALIZADO' ;
	if($other_lacacaliz) $other = ($other)? $other.',LACA ANTI-ALCALIZ' : 'LACA ANTI-ALCALIZ' ;
	if($other_bamiz1) $other = ($other)? $other.',BAMIZ PIGMENTOS ME1' : 'BAMIZ PIGMENTOS ME1' ;
	if($other_lacatermo) $other = ($other)? $other.',LACA TERMOSELLABLE' : 'LACA TERMOSELLABLE' ;
	if($other_hotmelt) $other = ($other)? $other.',HOT-MELT' : 'HOT-MELT' ;
	if($other_parafina) $other = ($other)? $other.',PARAFINAS' : 'PARAFINAS' ;
	if($other_lacaantiperoxido) $other = ($other)? $other.',LACA ANTI-PEROXIDO' : 'LACA ANTI-PEROXIDO' ;
	$other = ($other)? $other : '---' ;
?>