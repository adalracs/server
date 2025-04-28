<?php 
//by ralvear ramiro-ok@hotmail.com
	//ini_set('display_errors',1);
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
	//validaciones de campos personalizados
	$idcon = fncconn();
	//consecutivo para campo personalizado
	$nuidtemp = fncnumact(140,$idcon);	
	do
	{
		$nuresult = loadrecordcpfichdetope($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegcpfichdetope[cpftdocodigo] = $nuidtemp - 1;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//valida si tiene tipo de producto
	if($tipitecodigo)
	{
		//se consulta los campos personalizados del producto seleccionado
		$rsCamperfichat = dinamicscancamperfichat(array('tipprocodigo'=>$tipitecodigo),$idcon);
		//se cuenta la cantidad de registros consultados
		$nrCamperfichat = fncnumreg($rsCamperfichat);
		//se hace el ciclo de escaneo
		for($i=0;$i<$nrCamperfichat;$i++)
		{
			//se llama el registro dependiendo de su indice
			$rwCamperfichat = fncfetch($rsCamperfichat,$i);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperfichat['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCamperfichat = $rwCamperfichat['cpfichnombre'];
				//valida que contenga valor el campo para almacenar a la base de datos
				if($$objCamperfichat)
				{
					//se crea el ireg de campo personalizado
					$iRegcpfichdetope[cpftdocodigo] = $iRegcpfichdetope[cpftdocodigo] + 1;
					$iRegcpfichdetope[cpfichcodigo] = $rwCamperfichat[cpfichcodigo];
					$iRegcpfichdetope[usuacodi] = $usuacodi;
					$iRegcpfichdetope[cpftdovalor] = $$objCamperfichat;
					$iRegcpfichdetope[cpftdofecha] = date('Y-m-d');
					$iRegcpfichdetope[cpftdonota] = 'Valor del campo '.$objCamperfichat;
					$iRegcpfichdetope[produccodigo] = $produccodigo;
					//se inserta el registro del campo personalizado
					$res = insrecordcpfichdetope($iRegcpfichdetope,$idcon);
					if($res == -2)
					{
						//consecutivo para campo personalizado
						$nuidtemp = fncnumact(140,$idcon);	
						do
						{
							$nuresult = loadrecordcpfichdetope($nuidtemp,$idcon);
							if($nuresult == e_empty)
								$iRegcpfichdetope[cpftdocodigo] = $nuidtemp - 1;
							$nuidtemp ++;
						}while ($nuresult != e_empty);
						unset($nuidtemp);
						//se reasigna el consecutivo
						$iRegcpfichdetope[cpftdocodigo] = $iRegcpfichdetope[cpftdocodigo] + 1;
						//se ingresa el registro
						$res = insrecordcpfichdetope($iRegcpfichdetope,$idcon);
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
				$objCamperfichat = $rwCamperfichat['cpfichnombre'];
				//se recorre el array tabla 1 para conocer su estructura
				$array_tmp = explode(':|:',$arrtabla1);
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se crea el campo personalizado para cada material dela  estructura
					$objCamperfichat2 = $rwCamperfichat['cpfichnombre'].'_'.($a+1);
					($$objCamperfichat2)? $$objCamperfichat2 = $$objCamperfichat2 : $$objCamperfichat2 = ' ';
					//se crea el campo personalizado como array dependiendo de la estructura
					$$objCamperfichat = ($$objCamperfichat)? $$objCamperfichat . ',' .$$objCamperfichat2 : $$objCamperfichat2  ;
				}
				//valida que contenga valor el campo para almacenar a la base de datos
				if($$objCamperfichat)
				{
					//se crea el ireg de campo personalizado
					$iRegcpfichdetope[cpftdocodigo] = $iRegcpfichdetope[cpftdocodigo] + 1;
					$iRegcpfichdetope[cpfichcodigo] = $rwCamperfichat[cpfichcodigo];
					$iRegcpfichdetope[usuacodi] = $usuacodi;
					$iRegcpfichdetope[cpftdovalor] = $$objCamperfichat;
					$iRegcpfichdetope[cpftdofecha] = date('Y-m-d');
					$iRegcpfichdetope[cpftdonota] = 'Valor del campo '.$objCamperfichat;
					$iRegcpfichdetope[produccodigo] = $produccodigo;
					//se inserta el registro del campo personalizado
					$res = insrecordcpfichdetope($iRegcpfichdetope,$idcon);
					if($res == -2)
					{
						//consecutivo para campo personalizado
						$nuidtemp = fncnumact(140,$idcon);	
						do
						{
							$nuresult = loadrecordcpfichdetope($nuidtemp,$idcon);
							if($nuresult == e_empty)
								$iRegcpfichdetope[cpftdocodigo] = $nuidtemp - 1;
							$nuidtemp ++;
						}while ($nuresult != e_empty);
						unset($nuidtemp);
						//se reasigna el consecutivo
						$iRegcpfichdetope[cpftdocodigo] = $iRegcpfichdetope[cpftdocodigo] + 1;
						//se ingresa el registro
						$res = insrecordcpfichdetope($iRegcpfichdetope,$idcon);
					}
				}
			}
		}
		//se actualiza el consecutivo de campo personalizado
		$nuresult1 = fncnumprox(140,$iRegcpfichdetope[cpftdocodigo] + 1,$idcon); 
	}
	fncclose($idcon);
?>