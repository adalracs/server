<?php 
//by ralvear ramiro-ok@hotmail.com
	//asignacion del array de los tabs del formulacion
	if($arrTabs) $arr = explode(',', $arrTabs);
	//validacion de seleccion primaria para carga de campos a validar
	if($tipitecodigo && $tipevecodigo)
	{
		$idcon = fncconn();
		//funcion invalida dinamicscan para esta operacion necesario crear SQL
		//se crea un sql nativo para facilidad de validacion.
		$sql = "SELECT * FROM camperdesarr WHERE tipprocodigo='$tipitecodigo'";
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
		$rsCamperdesarr = fncsqlrun($sql,$idcon);	
		unset($enc);
		//se cuanta el numero de registros
		$nrCamperdesarr = fncnumreg($rsCamperdesarr);
		for($i=0;$i<$nrCamperdesarr;$i++)
		{
			//se consulta el registro dependiendo del ciclo
			$rwCamperdesarr = fncfetch($rsCamperdesarr,$i);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperdesarr['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCamperdesarr = $rwCamperdesarr['cpdesanombre'];
				//se valida que sea campo primario o padre por si existe alguna dependencia
				if($rwCamperdesarr['cpdesacodpad'] == 0)
				{
					////se valida que sea requerido y esta vacio
					if($rwCamperdesarr['cpdesarequer'] == 't' && $$objCamperdesarr == '')
					{
						//se llena la variable campnomb con los campos faltantes
						$campnomb[$objCamperdesarr] = 1;
						//se activan las banderas de intento de grabado
						$flagnuevovistadesarrollo = 1;
					}
				}
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//se necesito el array tabla 2 que contiene la estructura de el pedido 
					//para asi mismoa hacer la validacion a continuacion lo explosionamos con el comodi ':|:'
				$array_tmp = explode(':|:',$arrtabla2);
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se explociona por segunda vez con el comodi ':-:'
					$rwArray_tmp = explode(':-:', $array_tmp[$a]);
					//si el material es extruido quiere de ir que tiene campos en extrusion proceso 3
					//y deben de validarse
					if($rwArray_tmp[4] == 't')
					{
						//se crea el campo personalizado
						$objCamperdesarr = $rwCamperdesarr['cpdesanombre'].'_'.($a+1);
						////se valida que sea campo primario o padre por si existe alguna dependencia
						if($rwCamperdesarr['cpdesacodpad'] == 0)
						{
							//se valida que sea requerido y esta vacio
							if($rwCamperdesarr['cpdesarequer'] == 't' && $$objCamperdesarr == '')
							{
								//se llena la variable campnomb con los campos faltantes
								$campnomb[$objCamperdesarr] = 1;
								//se activan las banderas de intento de grabado
								$flagnuevovistadesarrollo = 1;
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
		$flagnuevovistadesarrollo = 1;
	}
	//validaciones personalizas.
	
	//validacion para tintas especiales
	if($tipo_impresion != 'sin_impresion')
	{
		if(!$tntesp_laminacion && !$tntesp_superficie && !$tntesp_uretelasto && !$tntesp_nitropolia && !$tntesp_vinilica && !$tntesp_nitrocelu && !$tntesp_nitroure && !$tntesp_poliamo):
			$flagnuevovistadesarrollo = 1;
			$campnomb['tinta_espe'] = 1;
		endif;
	}
	//validacion para aplicacion de tinta
	if($tipo_impresion != 'sin_impresion')
	{
		$encadhesivo = 0;
		//se explociona el array tabla 2 que contiene la estructura y los adhesivos y tintas
		if($arrtabla2) $arrtabla = explode(':|:', $arrtabla2);
		//ciclo para recorrer el array
		for($i=0;$i<count($arrtabla);$i++)
		{
			//explosion por el comodin :-:
			$arr = explode(':-:', $arrtabla[$i]);
			//si contiene tinta padre item 25 tintas campo definido por configuracion  de desarrollo
			if($arr[1] == 25)
			{
				//bandera para que valide tinta
				$enctinta = 1;
			}
			//si contiene adhesivos padre item 23 campo definido por configuracion de desarrollo
			if($arr[1] == 23)
			{
				//bandera para que valide adhesivos
				$encadhesivo += 1;
			}
		}
		//si no encuentrra tinta la exige
		if(!$enctinta)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['apli_tinta_mt2'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevovistadesarrollo = 1;
		}
	}
	unset($enc);
	//validacion para aplicacion de adhesivo
	if($tipo_impresion != 'sin_impresion')
	{

		$arrtipo_estruc = array("bilaminado" => 1, "trilaminado" => 2, "tetralaminado" => 3, "multilaminado" => 4);

		//se explociona el array de tabs
		if($arrTabs) $arr = explode(',', $arrTabs); else unset($arr);
		//ciclo para recorrer array
		for($i=0;$i<count($arr);$i++)
		{
			//valida si el tab de laminacion esta activo
			if($arr[$i] == 4)
			{
				//activa bandera de tab
				$enc = 1;
			}
		}

		//si esta activo el tab y no tiene adhesivo lo exige
		if(!$enc && $tipitecodigo != 5){

			if( $arrtipo_estruc[$tipo_estruc] != $encadhesivo){

				//se activan las banderas de intento de grabado
				$flagnuevovistadesarrollo = 1;
				//se llena la variable campnomb con los campos faltantes
				$campnomb['apli_adhe_mt2'] = 1;

			}
			
		}

	}
	//validacion para formulacion
	if($arrtabla2)
	{
		//se explociona el array tabla 2 que contiene la estructura y los adhesivos y tintas
		$array_tmp = explode(':|:',$arrtabla2);
		//ciclo para recorrer el array
		for($a = 0; $a < count($array_tmp); $a++)
		{
			//explosion por el comodin :-:
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			//carga registro de padre item correpondiente
			$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
			//si el material padre item es extriudo para exigir su respectiva formulacion
			if($rwArray_tmp[4] == 't')
			{
				//crea objeto de formulacion
				$objformul_cod = 'formulcodigo_'.($a + 1); // formulacion codigo
				//si no contiene formula la exige
				if(!$$objformul_cod)
				{
					//se llena la variable campnomb con los campos faltantes
					$campnomb[$objformul_cod] = 1;
					//se activan las banderas de intento de grabado
					$flagnuevovistadesarrollo = 1;
				}
			}
		}
	}
	//validacion de tipo de impresion 
	if(!$tipo_impresion)
	{
		fncmsgerror(errortipo_impresion);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistadesarrollo.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
	//validacion de material a imprimir
	if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa') && (!$product_imp))
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['product_imp'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistadesarrollo = 1;
		
	}
	//validacion de material a laminar
	if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa') && ($tipo_estruc != 'monocapa'))
	{
		for($h=0;$h<$valid_produc_imp;$h++){
			$obj_produclam = "product_lam_".($h +1);
			if(!$$obj_produclam)
			{
				//se llena la variable campnomb con los campos faltantes
				$campnomb[$obj_produclam] = 1;
				//se activan las banderas de intento de grabado
				$flagnuevovistadesarrollo = 1;
			}
		}
	}
	fncclose($idcon);
	
?>