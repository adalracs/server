<?php

	if($arrtabla1)
	{
		$array_tmp = explode(':|:',$arrtabla1);
		for($a = 0; $a < count($array_tmp); $a++)
		{
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);				
			$total_calibre += $rwArray_tmp[3];
			$total_gramaje += ($rwArray_tmp[3] * $rwArray_tmp[2]);
		}
	}
	unset($estructura_n); ($arrtabla2)? $estructura_n = count(explode(':|:',$arrtabla2)) : $estructura_n = 1;
		
	if($unimedi == 'MIL')
	{
		if($tipitecodigo == 1)			
			$cantplanea_kgs = $cant_planea * ((round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100) / 2);
		if($tipitecodigo== 2 || $tipitecodigo== 3 || $tipitecodigo== 4 || $tipitecodigo== 6)
			$cantplanea_kgs = $cant_planea * (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100);
		if($tipitecodigo == 5)
			$cantplanea_kgs = $cant_planea * (((((($bmayor / 1000) + ($bmenor / 1000)) / 2) * ((($largo / 1000 ) * 2) + ($pestania / 1000 ) * 2)) *  ($total_gramaje / $estructura_n)));
	}
		
	if($unimedi == 'UND')
	{
		if($tipitecodigo == 1)			
			$cantplanea_kgs = ($cant_planea / 1000) * ((round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100) / 2);
		if($tipitecodigo== 2 || $tipitecodigo== 3 || $tipitecodigo== 4)
			$cantplanea_kgs = ($cant_planea / 1000) * (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100);
		if($tipitecodigo == 5)
			$cantplanea_kgs = ($cant_planea / 1000) * (((((($bmayor / 1000) + ($bmenor / 1000)) / 2) * ((($largo / 1000 ) * 2) + ($pestania / 1000 ) * 2)) *  $total_gramaje));
		if($tipitecodigo == 6)
			$cantplanea_kgs = ( ( ( ($ancho / 1000) * ($largo / 1000) ) * $total_gramaje ) * $cant_planea) / 1000;	
	}
		
	if($unimedi == 'KGS')
		$cantplanea_kgs = $cant_planea;
		
	$rsRutaitempv = dinamicscanplanearutaitempv(array( 'produccodigo' => $produccodigo),$idcon);
	$nrRutaitempv = fncnumreg($rsRutaitempv);
	for( $a = 0; $a < $nrRutaitempv; $a++)
	{
		$rwRutaitempv = fncfetch($rsRutaitempv,$a);
		$rutaitempv = ($rutaitempv)? $rutaitempv.' <b>/</b>'.cargaprocedimientonombre($rwRutaitempv['procedcodigo'],$idcon) : cargaprocedimientonombre($rwRutaitempv['procedcodigo'],$idcon) ;
	}
		
	//se adiciono la correcion de el calculo de el peso millar de  los capuchones
	unset($estructura_n); ($arrtabla2)? $estructura_n = count(explode(':|:',$arrtabla2)) : $estructura_n = 1;
	if($tipitecodigo == 1)//peso millar => {bolsa flow pack}
	{			
		$pmillar = ((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje)) / 2;
	}else if($tipitecodigo== 2 || $tipitecodigo== 3 || $tipitecodigo== 4 || $tipitecodigo== 6)//peso millar => {bolsa lateral, bolsa pouch lateral, bolsa pouch doy pack, lamina}
	{
		$pmillar = ((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje));
	}else if($tipitecodigo == 5)//peso millar =>{capuchon}
	{
		$pmillar = (((((($bmayor / 1000) + ($bmenor / 1000)) / 2) * ((($largo / 1000 ) * 2) + ($pestania / 1000 ) * 2)) *  ($totalgramaje / $estructura_n)));
	}
	if(!$fuelle)
		$fuelle = '0';
	//array para pestañas de procesos y su codificacion interna en el sistema
	$arrProceso = 
		array( 
			'tabs_solicitud' => array('ext' => array(),'lmn' => array(), 'flx' => array(), 'cor' => array(), 'sld' => array(), 'tql' => array(), 'pch' => array(), 'dbl' => array(), 'mcr' => array(), 'crt' => array(), 'vlv' => array()),
			'codificacion' => array('ext' => 1,'lmn' => 2, 'flx' => 3, 'cor' => 4, 'sld' => 5, 'tql' => 6, 'pch' => 7, 'dbl' => 8, 'mcr' => 9, 'crt' => 10, 'vlv' => 12)
		);	
	//se utiliza el flit para busqueda por key de array
	$array_key = array_flip($arrProceso['codificacion']);
	//se consulta lo ruta adicionada en planeacion del pedido
	$rsPlanearutaitempv = dinamicscanplanearutaitempv(array( 'produccodigo' =>$produccodigo),$idcon);
	//se cuenta el numero de registros
	$nrPlanearutaitempv = fncnumreg($rsPlanearutaitempv);
	//se recorre la consulta
	unset($arrCorteS);
	for($a = 0;$a < $nrPlanearutaitempv;$a++)
	{
		//se trae uno dependieno del su indice
		$rwPlanearutaitempv = fncfetch($rsPlanearutaitempv,$a);
		//validacion para asignar que tabs tiene la solicitud	
		if(array_key_exists($rwPlanearutaitempv['tipsolcodigo'], $array_key))
		{
			$arrProceso['tabs_solicitud'] [$array_key[$rwPlanearutaitempv['tipsolcodigo']]] [] = $rwPlanearutaitempv['procedcodigo'];
		}
		
		unset($arrRutaCorteS,$rwItemdesa);
		if($rwPlanearutaitempv['plarutcorter'])
		{
			$arrRutaCorteS = explode(',',$rwPlanearutaitempv['plarutcorter']);
			$rwItemdesa = loadrecordvistaitemplaneacion($arrRutaCorteS[4],$idcon);
			$arrCorteS[]= 
				array(
					'itedescodigo' => $arrRutaCorteS[4],
					'itedesnombre' => $rwItemdesa['itedesnombre'],				
					'itedesancho' => $rwItemdesa['itedesancho'],
					'itedescalib' => $rwItemdesa['itedescalib'],
					'anchocortes' => $arrRutaCorteS[0],
					'desperdiciomm' => $arrRutaCorteS[2],
					'desperdiciokg' => $arrRutaCorteS[3],
					'desperdiciodt' => $arrRutaCorteS[1],
					'ordprocantkg' => $arrRutaCorteS[5],
					'ordprocantmt' => 10000 //esperando formulacion de metros
			);
		}
	}
	//array para informacion de los materiales y  sus cantidades.
	$arrMateriales;$nrop_laminacion = 0;$nrop_extrusion = 0;$ordprocantid =  0;
	//escaneo a la tabla planea padreitem	
	$rsPlaneapadreitem = dinamicscanplaneapadreitem(array("produccodigo" => $produccodigo),$idcon);
	//consulta numero de materiales planeados
	$nrPlaneapadreitem = fncnumreg($rsPlaneapadreitem);
	//recorre consulta
	for($a = 0;$a < $nrPlaneapadreitem;$a++)
	{
		//trae registo de padre item dependiendo de su indice
		$rwPlaneapadreitem = fncfetch($rsPlaneapadreitem,$a);
		//se consulta el registro de padreitem
		$rwPadreitem = loadrecordpadreitem($rwPlaneapadreitem['paditecodigo'],$idcon);
		//se consulta el registro de formulacion
		$rwFormulacion = loadrecordformulacion($rwPlaneapadreitem['formulcodigo'],$idcon);
		//registra el numero de op necesarios para extrusion
		if($rwPadreitem['paditeextrui'] == 't')
			$nrop_extrusion++;
		//registra el numero de op necesarios para laminacion
		if($rwPadreitem['paditecodigo'] == '23')
		{
			$laminado = '';
			//casos para laminados
			switch ($nrop_laminacion) { 
				case 0: $laminado = '1ER LAMINADO';break;
				case 1: $laminado = '2DO LAMINADO';break;
	    		case 2: $laminado = '3ER LAMINADO';break;
	    		case 3: $laminado = '4TO LAMINADO';break;
	    		case 4: $laminado = '5TO LAMINADO';break;
	    		case 5: $laminado = '6TO LAMINADO';break;
			}
			$nrop_laminacion++;			
		}
		//array de materiales
		$arrMateriales[$a]= 
			array(
				'paditecodigo' => $rwPadreitem['paditecodigo'],
				'paditenombre' => $rwPadreitem['paditenombre'],
				'paditeextrui' => $rwPadreitem['paditeextrui'],
				'plapadanchoi' => $rwPlaneapadreitem['plapadanchoi'],
				'plapadcantkg' => $rwPlaneapadreitem['plapadcantkg'],
				'plapadcantmt' => $rwPlaneapadreitem['plapadcantmt'],
				'plapadcalib' => $rwPlaneapadreitem['plapadcalib'],
				'formulcodigo' => $rwPlaneapadreitem['formulcodigo'],
				'formulnumero' => $rwFormulacion['formulnumero'],
				'plapadcaliba1' => $rwPlaneapadreitem['plapadcaliba1'],
				'plapaddesem' => strtoupper($rwPlaneapadreitem['plapaddesem']),
				'plapadtipo' => strtoupper($rwPlaneapadreitem['plapadtipo']),
				'plapadrefile' => $rwPlaneapadreitem['plapadrefile'],
				'laminado' => $laminado,
				'procedcodigo' => $rwPadreitem['procedcodigo'],
				'paditedensid' => $rwPadreitem['paditedensid'],
			);
		//se acumula las cantidades
		$ordprocantid = $ordprocantid + $rwPlaneapadreitem['plapadcantkg'];
	}

	$rsPlaneaitemdesa = dinamicscanopplaneaitemdesa(array('produccodigo' => $produccodigo, "plaitetipo" => "2"), array("produccodigo" => "=", "plaitetipo" => "="), $idcon);//materiales de importacion
	//consultamos el numero de registros que devuleve la consulta
	if($rsPlaneaitemdesa > 0){
		$nrPlaneaitemdesa = fncnumreg($rsPlaneaitemdesa);
	}
	
?>