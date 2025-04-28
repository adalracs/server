<?php 
//by ralvear ramiro-ok@hotmail.com
	$idcon = fncconn();
	if($equipocodigo){
		$rwEquipo = loadrecordequipo($equipocodigo,$idcon);
		$equiponombre = $rwEquipo["equiponombre"];
	}
	//asignaciones para forma de empaque en caso de ser lamina
	if($bolsa_plastica_suspendido == 'si' || $bolsa_plastica_caja == 'si' || $bolsa_plastica_carton_extremos == 'si' || $bolsa_plastica_cubierto_extremos == 'si')
		$bolsa_plastica = 'si';
	//Validacion del campo bolsa_plastica (bolsa plastica )
	if(!$bolsa_plastica)
	{
		if($bolsa_plastica_suspendido == 'no' || $bolsa_plastica_caja == 'no' || $bolsa_plastica_carton_extremos == 'no' || $bolsa_plastica_cubierto_extremos == 'no')
			$bolsa_plastica = 'no'; 
	}
	// Validacion del campo pro_core (protector de core)
	if($pro_core_caja == 'si' || $pro_core_bolsa_plastica == 'si' || $pro_core_carton_extremos == 'si' || $pro_core_cubierto_extremos == 'si')
		$pro_core = 'si';
	//Validacion del campo pro_core (protector de core)
	if(!$pro_core)
	{	
		if($pro_core_caja == 'no' || $pro_core_bolsa_plastica == 'no' || $pro_core_carton_extremos == 'no' || $pro_core_cubierto_extremos == 'no')
			$pro_core = 'no';
	}
	// Validacion del campo pro_core_diam (diametros protector de core)
	if($pro_core_diam_caja == '76.2' || $pro_core_diam_bolsa_plastica == '76.2' || $pro_core_diam_carton_extremos == '76.2' || $pro_core_diam_cubierto_extremos == '76.2')
		$pro_core_diam = '76.2';
	//Validacion del campo pro_core_diam (diametros protector de core)
	if(!$pro_core_diam)
	{	
		if($pro_core_diam_caja == '152.4' || $pro_core_diam_bolsa_plastica == '152.4' || $pro_core_diam_carton_extremos == '152.4' || $pro_core_diam_cubierto_extremos == '152.4')
			$pro_core_diam = '152.4';
	}
	// Validacion del campo peso_max (peso_maximo por forma de empaque)
	if($peso_max_bolsa_plastica != '' )   
		$peso_max = $peso_max_bolsa_plastica;
	//Validacion del campo peso_max (peso_maximo por forma de empaque)
	if(!$peso_max)
	{	
		if($peso_max_caja != '' )
			$peso_max = $peso_max_caja;
	}	
	// Validacion del campo no_rollos (numero de rollos)
	if($no_rollos_carton_extremos != '' )   
		$no_rollos = $no_rollos_carton_extremos;
	//Validacion del campo no_rollos (numero de rollos)
	if(!$no_rollos)
	{	
		if($no_rollos_cubierto_extremos != '' )
			$no_rollos = $no_rollos_cubierto_extremos;
	}
	//asignaciones para forma de empaque codigo de empaque
	//{suspendido} codigo del empaque
	if($cod_empa_suspendido)
		$cod_empa = $cod_empa_suspendido;
	//{suspendido}nombre del empaque
	if($empa_item_suspendido)
		$empa_item = $empa_item_suspendido;
	//{carton extremos} codigo del empaque
	if($cod_empa_carton_extremos)
		$cod_empa = $cod_empa_carton_extremos;
	//{carton extremos} nombre del empaque
	if($empa_item_carton_extremos)
		$empa_item = $empa_item_carton_extremos;
	//asignacion del array de los tabs del formulacion
	if($arrTabs) $arr = explode(',', $arrTabs);
	//validacion de seleccion primaria para carga de campos a validar
	if($tipitecodigo && $tipevecodigo)
	{
		//funcion invalida dinamicscan para esta operacion necesario crear SQL
		//se crea un sql nativo para facilidad de validacion.
		$sql = "SELECT * FROM camperfichat WHERE tipprocodigo='$tipitecodigo'";
		//ciclo utilizado  dependiendo de los tabs activos omitir o tomar en cuanta la validacion 
		//encuanto a los campos pertenecientes.
		for ($i = 0;$i< count($arr);$i++)
		{
			//si existe en el array los omite y adiciona condicion de omision
			if($arr[$i] > 0)
				$sql .= " AND procescodigo != $arr[$i]";
			//validacion adicional si encuetra tab de extrusion para validacion
			if($arr[$i] == 3)
				$enc = 1;
		}
		//se ejecuta el sql creado
		$rsCamperfichat = fncsqlrun($sql,$idcon);	
		unset($enc);
		//se cuanta el numero de registros
		$nrCamperfichat = fncnumreg($rsCamperfichat);
		for($i=0;$i<$nrCamperfichat;$i++)
		{
			//se consulta el registro dependiendo del ciclo
			$rwCamperfichat = fncfetch($rsCamperfichat,$i);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperfichat['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCamperfichat = $rwCamperfichat['cpfichnombre'];
				//se valida que sea campo primario o padre por si existe alguna dependencia
				if($rwCamperfichat['cpfichcodpad'] == 0)
				{
					//se valida que sea requerido y esta vacio
					if($rwCamperfichat['cpfichrequer'] == 't' && !$$objCamperfichat && $$objCamperfichat != '0')
					{
						//se llena la variable campnomb con los campos faltantes
						$campnomb[$objCamperfichat] = 1;
						//se activan las banderas de intento de grabado
						$flagnuevovistaitemfichatecnica = 1;
					}
				}
				//se octiene el codigo , nombre , y validacion del campo para validar sus (hijos)
				$padre = $rwCamperfichat['cpfichcodpad'];
				$rw_padre = loadrecordcamperfichat($padre,$idcon);
				$obj_codpadre = $rwCamperfichat['cpfichcodigo'];
				$obj_campadre = $rwCamperfichat['cpfichnombre'];
				$obj_formpadre = $rw_padre['cpfichforcam'];
				if($$obj_campadre != $obj_formpadre)
				{
					//validacion para los campos dependientes de un valor de otro
					$rs_Camperfichat = dinamicscancamperfichat(array("cpfichcodpad"=>$obj_codpadre),$idcon);
					//respectivo conteo de registros
					$nr_Camperfichat = fncnumreg($rs_Camperfichat);
					//ciclo para el numero de registros
					for($j=0;$j<$nr_Camperfichat;$j++)
					{
						//se consulta el registro dependiendo del ciclo
						$rw_Camperfichat = fncfetch($rs_Camperfichat,$j);
						//se crea el campo personalizado
						$obj_Camperfichat = $rw_Camperfichat['cpfichnombre'];
						//se valida en campo padre de acuerdo al valor que necesita elhijo para ser validado
						if($$objCamperfichat != $rw_Camperfichat['cpfichforcam'] && !$$obj_Camperfichat && $$obj_Camperfichat != '0') 
						{
							//se llena la variable campnomb con los campos faltantes
							$campnomb[$obj_Camperfichat] = 1;
							//se activan las banderas de intento de grabado
							$flagnuevovistaitemfichatecnica = 1;
						}
					}
				}
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//se necesito el array tabla 1 que contiene la estructura de el pedido 
					//para asi mismoa hacer la validacion a continuacion lo explosionamos con el comodi ':|:'
				$array_tmp = explode(':|:',$arrtabla1);
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se explociona por segunda vez con el comodi ':-:'
					$rwArray_tmp = explode(':-:', $array_tmp[$a]);
					//si el material es extruido quiere de ir que tiene campos en extrusion proceso 3
					//y deben de validarse
					if($rwArray_tmp[4] == 't')
					{
						//se crea el campo personalizado
						$objCamperfichat = $rwCamperfichat['cpfichnombre'].'_'.($a+1);
						////se valida que sea campo primario o padre por si existe alguna dependencia
						if($rwCamperfichat['cpfichcodpad'] == 0)
						{
							//se valida que sea requerido y esta vacio
							if($rwCamperfichat['cpfichrequer'] == 't' && !$$objCamperfichat && $$objCamperfichat != '0')
							{
								//se llena la variable campnomb con los campos faltantes
								$campnomb[$objCamperfichat] = 1;
								//se activan las banderas de intento de grabado
								$flagnuevovistaitemfichatecnica = 1;
							}
						}
					}
				}
			}
		}
	}
	else
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['tipprocodigo'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validaciones personalizas.
	$array_tmp = explode(':|:',$arrtabla1);
	for($a = 0; $a < count($array_tmp); $a++)
	{
		$rwArray_tmp = explode(':-:', $array_tmp[$a]);
		$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
		$objColor = 'color_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
		$objCalibreA1 = 'calibre_a1_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
		$objCalibreA2 = 'calibre_a2_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
		if(!$$objColor && $rwItem['paditepigmen'] == 't')
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['tabla1_color'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaitemfichatecnica = 1;
		}
		
		if(!$$objCalibreA1)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['tabla1_calib_a1'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaitemfichatecnica = 1;
		}
		
		if(!$$objCalibreA2)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['tabla1_calib_a2'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistaitemfichatecnica = 1;
		}
	}

	if($tipo_impresion == 'interna' || $tipo_impresion == 'externa'){

		if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);

		for( $a = 0; $a < count($arrObject); $a++)
		{
			$rowArrObject = explode(':-:', $arrObject[$a]);
			$obj_anilox = 'anilox_'.$rowArrObject[1];
			$obj_grupo = 'grupo_'.$rowArrObject[1];

			if(validaint4($$obj_anilox) > 0 || !$$obj_anilox)
			{
				$campnomb[$obj_anilox] = 1;
				$flagnuevovistaitemfichatecnica = 1;
			}

			if(validaint4($$obj_grupo) > 0 || !$$obj_grupo)
			{
				$campnomb[$obj_grupo] = 1;
				$flagnuevovistaitemfichatecnica = 1;
			}

		}
		unset($arrObject);
	}

	//validaciones adicionales de forma de empaque {suspendido}
	//validacion de niveles por estiba unico para suspendido
	if($form_empa == 'suspendido' && !$niv_estiba)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['niv_estiba'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de niveles por estiba unico para suspendido
	if($form_empa == 'suspendido' && !$peso_estiba)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['peso_estiba'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de bolsa plasticel plasticel todas menosforma de empaque bolsa plastica
	if($form_empa != 'bolsa_plastica' && !$bolsa_plastica && $tipitecodigo == 6)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['bolsa_plastica'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	/*//validacion de item para empaque {codigo}
	if(($form_empa == 'suspendido' || $form_empa == 'carton_extremos')&& !$cod_empa)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['cod_empa'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}*/
	//validacion de item para empaque {nombre - descripcion}
	if(($form_empa == 'suspendido' || $form_empa == 'carton_extremos') && !$empa_item)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['empa_item'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de item para empaque {peso_max}
	if(($form_empa == 'caja' || $form_empa == 'bolsa_plastica')&& !$peso_max)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['peso_max'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de item para empaque {cod_caja}
	if($form_empa == 'caja' && !$cod_caja)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['cod_caja'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de item para empaque {caja_item}
	if($form_empa == 'caja' && !$caja_item)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['caja_item'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de item para empaque {peso_max}
	if(($form_empa == 'carton_extremos' || $form_empa == 'cubierto_extremos')&& !$no_rollos)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['no_rollos'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistaitemfichatecnica = 1;
	}
	//validacion de material a laminar
	if($tipitecodigo != 5)
	{
		if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa') && ($tipo_estruc != 'monocapa'))
		{
			for($h=0;$h<$valid_produc_imp;$h++){
				$obj_produclam = "product_lam_".($h +1);
				if(!$$obj_produclam)
				{
					//se llena la variable campnomb con los campos faltantes
					$campnomb[$obj_produclam] = 1;
					//se activan las banderas de intento de grabado
					$flagnuevovistaitemfichatecnica = 1;
				}
			}
		}
	}

	fncclose($idcon);
	
?>