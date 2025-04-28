<?php 
//by ralvear ramiro-ok@hotmail.com
	//ini_set('display_errors',1);
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
	//valida si tiene tipo de producto
	if($tipitecodigo)
	{
		//se consulta los campos personalizados del producto seleccionado
		$rsCampertippro = dinamicscancampertippro(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//se cuenta la cantidad de registros consultados
		$nrCampertippro = fncnumreg($rsCampertippro);
		//se hace el ciclo de escaneo
		for($i=0;$i<$nrCampertippro;$i++)
		{
			//se llama el registro dependiendo de su indice
			$rwCampertippro = fncfetch($rsCampertippro,$i);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCampertippro['procescodigo'] != '3')
			{
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
					//validacion de consecutivo de campos personalizado de tipo producto
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
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//validacion especial para cargar los campos de los materiales extruidos 
				//es por eso que se usa el explode y se continua ingresando creando las variables y asignado su valor
				//se crea el campo personalizado
				$objCampertippro = $rwCampertippro['cptprnombre'];
				//se recorre el array tabla 1 para conocer su estructura
				$array_tmp = explode(':|:',$arrtabla1);
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se crea el campo personalizado para cada material dela  estructura
					$objCampertippro2 = $rwCampertippro['cptprnombre'].'_'.($a+1);
					($$objCampertippro2)? $$objCampertippro2 = $$objCampertippro2 : $$objCampertippro2 = ' ';
					//se crea el campo personalizado como array dependiendo de la estructura
					$$objCampertippro = ($$objCampertippro)? $$objCampertippro . ',' .$$objCampertippro2 : $$objCampertippro2  ;
				}
				//valida que contenga valor el campo para almacenar a la base de datos
				if($$objCampertippro || $$objCampertippro == "0")
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
		}
		//se actualiza el consecutivo de campo personalizado
		$nuresult1 = fncnumprox(112,$iRegcptpdetope[cptodocodigo] + 1,$idcon); 
	}
	fncclose($idcon);
?>