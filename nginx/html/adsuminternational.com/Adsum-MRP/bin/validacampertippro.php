<?php 
//by ralvear ramiro-ok@hotmail.com

	//validacion para productos nuevos modificacion y muestras
	if($tipevecodigo != 3){
		if($tipevecodigo == 4)
		{
			$cartera = 'NA';
			$exportacion = 'NA';
			$version_arte = 'NA';
		}
		//nota : en la parte de forma de empaque se utilizar para minimizar el codigo
		//y numero de campos en la base da datos se re utilizaron por lo cual ahi que 
		//hacer a continuaion el parelelo para validacion.
		//dependiendo de su forma de empaque se asigna
		// Validacion del campo bolsa_plastica (bolsa_plastica )
		if($bolsa_plastica_suspendido == 'si' || $bolsa_plastica_caja == 'si' || $bolsa_plastica_carton_extremos == 'si' || $bolsa_plastica_cubierto_extremos == 'si')
			$bolsa_plastica = 'si';
		//Validacion del campo bolsa_plastica (bolsa plastica )
		if(!$bolsa_plastica)
		{
			if($bolsa_plastica_suspendido == 'no' || $bolsa_plastica_caja == 'no' || $bolsa_plastica_carton_extremos == 'no' || $bolsa_plastica_cubierto_extremos = 'no')
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
		//asignacion del array de los tabs del formulacrio
		if($arrTabs) $arr = explode(',', $arrTabs);
		//validacion de seleccion primaria para carga de campos a validar
		if($tipitecodigo && $tipevecodigo)
		{
			$idcon = fncconn();
			//funcion invalida dinamicscan para esta operacion necesario crear SQL
			//se crea un sql nativo para facilidad de validacion.
			$sql = "SELECT * FROM campertippro WHERE tipprocodigo=$tipitecodigo";
			//ciclo utilizado  dependiendo de los tabs activos omitar o tomar en cuanta la validacion 
			//encuanto a los campos pertenecientes.
			for ($i = 0;$i< count($arr);$i++)
			{
				//si existe en el array los omite y adiciona condicion de omision
				if($arr[$i] > 0)
					$sql .= " AND procescodigo != $arr[$i]";
			}
			//se ejecuta el sql creado
			$rsCampertippro = fncsqlrun($sql,$idcon);
			//se cuanta el numero de registros
			$nrCampertippro = fncnumreg($rsCampertippro);
			for($i=0;$i<$nrCampertippro;$i++)
			{
				//se consulta el registro dependiendo del ciclo
				$rwCampertippro = fncfetch($rsCampertippro,$i);
				//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
				if($rwCampertippro['procescodigo'] != '3')
				{
					//se crea el campo personalizado
					$objCampertippro = $rwCampertippro['cptprnombre'];
					//se valida que sea campo primario o padre por si existe alguna dependencia
					if($rwCampertippro['cptprocodpad'] == 0)
					{
						//se valida que sea requerido y esta vacio
						if($rwCampertippro['cptprorequer'] == 't' && $$objCampertippro == '' && $$objCampertippro != '0')
						{
							//se llena la variable campnomb con los campos faltantes
							$campnomb[$objCampertippro] = 1;
							//se activan las banderas de intento de grabado
							$flagnuevoproducto = 1;
							$flageditarproducto = 1;
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
							$objCampertippro = $rwCampertippro['cptprnombre'].'_'.($a+1);
							////se valida que sea campo primario o padre por si existe alguna dependencia
							if($rwCampertippro['cptprocodpad'] == 0)
							{
								//se valida que sea requerido y esta vacio
								if($rwCampertippro['cptprorequer'] == 't' && $$objCampertippro == '')
								{
									//se llena la variable campnomb con los campos faltantes
									$campnomb[$objCampertippro] = 1;
									//se activan las banderas de intento de grabado
									$flagnuevoproducto = 1;
									$flageditarproducto = 1;
								}
							}
						}
					}
				}
				//se borra variable usada en el proceso por preacucion a errores
				unset($objCampertippro);
			}
			fncclose($idcon);
			
			if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa') && (!$producto_avaliable || $producto_avaliable == ''))
			{
				//se llena la variable campnomb con los campos faltantes
				$campnomb['producto_avaliable'] = 1;
				$flagnuevoproducto = 1;
				$flageditarproducto = 1;
			}
			
			if(($tipo_impresion == 'interna' || $tipo_impresion == 'externa') && ( (!$pantone || $pantone == '') && (!$muestra || $muestra == '') && (!$est_color || $est_color == '') && (!$pcolor || $pcolor == '')) )
			{
				//se llena la variable campnomb con los campos faltantes
				$campnomb['colors_avaliable'] = 1;
				$flagnuevoproducto = 1;
				$flageditarproducto = 1;
			}
		}
		else
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['tipprocodigo'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
	}
	else
	{
		//validacion manual para repeticiones
		//nota : estos son los campos obligatorias para la repeticion
		
		//dias pactados
		if(!$pedvendiapac)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['pedvendiapac'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//numero orden de compr
		if(!$ordcomnumero)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['ordcomnumero'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//fecha elboracion del pedido
		if(!$pedvenfecelb)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['pedvenfecelb'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//precio 
		if(!$precio)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['precio'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//moneda
		if(!$moneda)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['moneda'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//exportacion
		if(!$exportacion)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['exportacion'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}
		//cobro de fotopolimetros
		if(!$cobro_fotopo)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['cobro_fotopo'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto = 1;
		}	
		//cartera
		if(!$cartera)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['cartera'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto=1;
		}
		//version_arte
		if(!$version_arte)
		{
			//se llena la variable campnomb con los campos faltantes
			$campnomb['version_arte'] = 1;
			//se activan las banderas de intento de grabado
			$flagnuevoproducto = 1;
			$flageditarproducto=1;
		}
	}

	$idcon = fncconn();

	if($pedvennumero > 0 && $acciongraba > 0){

		$vproducto = 0;

		$rsPedidoVenta = dinamicscanoppedidoventa(array("pedvennumero" => $pedvennumero), array("pedvennumero" => "="), $idcon);
		$nrPedidoVenta = fncnumreg($rsPedidoVenta);

		for($a = 0; $a < $nrPedidoVenta; $a++){

			$rwPedidoVenta = fncfetch($rsPedidoVenta, $a);
			$rwProducPedido = loadrecordproducpedido($rwPedidoVenta["pedvencodigo"],$idcon);
			$rwProducto = loadrecordproducto($rwProducPedido["produccodigo"],$idcon);

			if($rwProducto["producdelrec"] == "1"){
				$vproducto++;
				break;
			}

		}

		if($vproducto > 0){
			echo '<script language= "javascript">';
			echo '<!--//'."\n";
			echo 'alert("Ocurrio un error inesperado : Pedido de venta ya se encuentra registrado.")';
			echo '//-->'."\n";
			echo '</script>';
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';

		}

	}

	fncclose($idcon);
	
?>