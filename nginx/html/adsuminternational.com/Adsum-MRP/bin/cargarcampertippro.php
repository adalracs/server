<?php 
//by ralvear ramiro-ok@hotmail.com
	//variable globales de guia
	//producto es el producto del item sea nuevo repeticion modificacion muestra viene de donde se incluya.
	//nota puede ser utilizado para suplir las veces de repeticion.
	//product_ es el producto es una copia del codigo del producto utilizada para el caso de repeticion.
	//calificar_ es una bandera utilizada para si necesita el array para la calificacion en el carga.
	$producto_ = $producto;
	//validamos que estemos pasando el codigo del producto
	if($producto)
	{
		//validamos si es una repetecion 
		if($tipevecodigo == 3)
		{
			//carga el registro de producpedido para asi traer el producto al cual fue hecha la repeticion.
			$rwProductopedido = loadrecordproducpedidoPER('produccodigo',$producto,$idcon);			
			//se la asigna el codigo a la variable producto.
			$producto = $rwProductopedido['propedproduc'];
			if(!$producto)
			{
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
		//consulta dinamica ala tabla detalle de operacion de cptpdetope
		//y asi traer los campos personalizados de los productos
		//nota : existe una validacion unica por el proceso 3 debido a un cambio de requerimiento inesperado
		$rsCptpdetope = dinamicscancptpdetope(array('produccodigo' =>$producto),$idcon);
		//consultamos el numero de registros que devuleve la consulta
		if($rsCptpdetope > 0) $nrCptpdetope = fncnumreg($rsCptpdetope);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
		for($i = 0;$i<$nrCptpdetope;$i++)
		{
			//consultamos el registro de campo personalizado
			$rwCptpdetope = fncfetch($rsCptpdetope,$i);
			//cargamos el campo personalizado correspondiente a el registro
			$rwCampertippro = loadrecordcampertippro($rwCptpdetope['cptprocodigo'],$idcon);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCampertippro['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCampo = $rwCampertippro['cptprnombre'];
				//se le asigna el valor correspondiente en la base de datos.
				$$objCampo = $rwCptpdetope['cptprovalor'];
				//almacenamos en un array por efectos adicionales de consulta y historia.
				//este campo no es indispensable
				$arrCampertippro[$objCampo] = $$objCampo ;
				//proceso adicional si es accion de calificacion 
				if($calificar_)
				{
					//se almacena el id o llave primaria de cada codigo para asignarle en cada checkbox para la calificacion
					$idCampo = $rwCampertippro['cptprocodigo'];
					//se llena un array con el id del campo llamandolo con el nombre
					$arrCampertipproCOD[$objCampo] = $idCampo;
				}
				//adicional para las calificaciones de cada producto
				if($objCampo == "ratings" && $calificar_)
				{
					//se expliciona el array de calificaciones de campos erronios
					$array_tmp = explode (',',$$objCampo);
					//se recorre el array separado por comodi ,
					for($k = 0; $k < count($array_tmp); $k++)
					{
						//se crea un array con los codigo de las compas calificados como erroneos
						$arrCampertipproCAL[$array_tmp[$k]] = $array_tmp[$k];
						//se valida de que procedencia es la calificacion FIC fichas tecnicas VEN ventas ESP en espera de revision
						if($array_tmp[$k] != 'FIC' && $array_tmp[$k] != 'VEN' && $array_tmp[$k] != 'ESP')
							$arrRatings = ($arrRatings)? $arrRatings.','.$array_tmp[$k] : $array_tmp[$k] ;
					}
				}
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//validacion especial para cargar los campos de los materiales extruidos 
				//se crean un array en cada campo personalizado separado por comas
				//es por eso que se usa el explode y se continua ingresando creando las variables y asignado su valor
				$array_tmp = explode(',',$rwCptpdetope['cptprovalor']);
				//ciclo de las variables
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se le asigna un nombre con una cadena denomida por el nombre +  en numero de resgitro.
					$objCampo = $rwCampertippro['cptprnombre'].'_'.($a+1);
					//se le asigna el valor correspondiente en la base de datos.
					$$objCampo = $array_tmp[$a];
					//proceso adicional si es accion de calificacion 
					if($calificar_)
					{
						//se almacena el id o llave primaria de cada codigo para asignarle en cada checkbox para la calificacion
						//nota se le adiciona un indice de numero de campo para identificacion del cmapo
						$idCampo = $rwCampertippro['cptprocodigo'].'_'.($a+1);
						//se llena un array con el id del campo llamandolo con el nombre
						$arrCampertipproCOD[$objCampo] = $idCampo;
					}
				}
			}
		}
		//consulta dinamica a la table prodduc - padre item 
		//para asi traer la estructura y asignar en la tabla 1 del pedido
		$rsItemproduc = dinamicscanproducpadreitem(array("produccodigo" =>$producto), $idcon);
		//consultamos el numero de registros que devuleve la consulta
		$nrItemproduc = fncnumreg($rsItemproduc);
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a el array de tabla1
		unset($arrtabla1,$totalcalibre,$totalgramaje);
		for($a = 0; $a < $nrItemproduc; $a++)
		{
			$rwItemproduc = fncfetch($rsItemproduc, $a);
			$rwItem = loadrecordpadreitem($rwItemproduc['paditecodigo'],$idcon);
			//item extruido
			if($rwItem['paditeextrui'] == 't')
				$flagextrusion = 1;
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
			//valor de los obejtos adicioneles
			$$objColor = $rwItemproduc['propadcolor'];
		}
		//validamos si es una repetecion 
		if($tipevecodigo == 3)
		{
			if($producto_)
			{
				//se hace el escaneo para traer los campos unicos de la repeticion y re asignarlos
				$rsCptpdetope = dinamicscancptpdetope(array('produccodigo' =>$producto_),$idcon);
				//consultamos el numero de registros que devuleve la consulta
				if($rsCptpdetope > 0) $nrCptpdetope = fncnumreg($rsCptpdetope);			
				//	escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
				for($i = 0;$i<$nrCptpdetope;$i++)
				{
					//consultamos el registro de campo personalizado
					$rwCptpdetope = fncfetch($rsCptpdetope,$i);
					//cargamos el campo personalizado correspondiente a el registro
					$rwCampertippro = loadrecordcampertippro($rwCptpdetope['cptprocodigo'],$idcon);
					//se crea el campo personalizado
					$objCampo = $rwCampertippro['cptprnombre'];
					//	se le asigna el valor correspondiente en la base de datos.
					$$objCampo = $rwCptpdetope['cptprovalor'];
					//almacenamos en un array por efectos adicionales de consulta y historia.
					//este campo no es indispensable
					$arrCampertippro[$objCampo] = $$objCampo ;
					//proceso adicional si es accion de calificacion 
					if($calificar_)
					{
						//se almacena el id o llave primaria de cada codigo para asignarle en cada checkbox para la calificacion
						$idCampo = $rwCampertippro['cptprocodigo'];
						//se llena un array con el id del campo llamandolo con el nombre
						$arrCampertipproCOD[$objCampo] = $idCampo;
					}		
					//adicional para las calificaciones de cada producto
					if($objCampo == "ratings" && $calificar_)
					{
						//se expliciona el array de calificaciones de campos erronios
						$array_tmp = explode (',',$$objCampo);
						//se recorre el array separado por comodi ,
						for($k = 0; $k < count($array_tmp); $k++)
						{
							//se crea un array con los codigo de las compas calificados como erroneos
							$arrCampertipproCAL[$array_tmp[$k]] = $array_tmp[$k];
							//se valida de que procedencia es la calificacion FIC fichas tecnicas VEN ventas ESP en espera de revision
							if($array_tmp[$k] != 'FIC' && $array_tmp[$k] != 'VEN' && $array_tmp[$k] != 'ESP')
								$arrRatings = ($arrRatings)? $arrRatings.','.$array_tmp[$k] : $array_tmp[$k] ;
						}
					}
				}
			}
		}
	}
	//adicionales
	//tipo de pedido
	if($tipevecodigo == 1) $tipopedido = 'NUEVO';
	if($tipevecodigo == 2) $tipopedido = 'MODIFICACION';
	if($tipevecodigo == 3) $tipopedido = 'REPETICION';
	if($tipevecodigo == 4) $tipopedido = 'MUESTRA';
	//tipo de producto
	if($tipitecodigo == 1) $tipoproducto = 'BOLSA FLOW PACK';
	if($tipitecodigo == 2) $tipoproducto = 'BOLSA LATERAL';
	if($tipitecodigo == 3) $tipoproducto = 'BOLSA POUCH DOY PACK';
	if($tipitecodigo == 4) $tipoproducto = 'BOLSA POUCH LATERAL';
	if($tipitecodigo == 5) $tipoproducto = 'CAPUCHON';
	if($tipitecodigo == 6) $tipoproducto = 'LAMINA';
	//listado de colores
	$list_colors = ($list_colors)? $list_colors : '---' ;
	//productos aprobados por:
	$producpor = ($producto_avaliable)? $producto_avaliable : '---' ;
	//colores aprobados por:
	if($pantone) $colorespor = ($colorespor)? $colorespor.',PANTONE' : 'PANTONE';
	if($muestra) $colorespor = ($colorespor)? $colorespor.',MUESTRA' : 'MUESTRA';
	if($est_color) $colorespor = ($colorespor)? $colorespor.',ESTANDAR COLOR' : 'ESTANDAR COLOR';
	if($pcolor) $colorespor = ($colorespor)? $colorespor.',PRUEBA COLOR' : 'PRUEBA COLOR';
	$colorespor = ($colorespor)? $colorespor : '---' ;
	//tintas resistentas a
	if($tnt_calor) $tintasa = ($tintasa)? $tintasa.',CALOR' : 'CALOR' ;
	if($tnt_luz) $tintasa = ($tintasa)? $tintasa.',LUZ' : 'LUZ' ;
	if($tnt_acidos) $tintasa = ($tintasa)? $tintasa.',ACIDOS' : 'ACIDOS' ;
	if($tnt_alcalis) $tintasa = ($tintasa)? $tintasa.',ALCALIS' : 'ALCALIS' ;
	if($tnt_agua) $tintasa = ($tintasa)? $tintasa.',AGUA' : 'AGUA' ;
	if($tnt_grasas) $tintasa = ($tintasa)? $tintasa.',GRASAS' : 'GRASAS' ;
	if($tnt_brillo) $tintasa = ($tintasa)? $tintasa.',BRILLO' : 'BRILLO' ;
	if($tnt_rayado) $tintasa = ($tintasa)? $tintasa.',RAYADO' : 'RAYADO' ;
	$tintasa = ($tintasa)? $tintasa : '---' ;
	//campos para tabs
	if($tipo_estruc == 'monocapa') $lmn = '0';
	if(!$flagextrusion) $ext = '0';	
?>