<?php
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Autor           : lfolaya
Fecha           : 24012005
*/ 
	$idcon = fncconn();
	
	//Carga el nombre del tipode mantenimiento
	if($sbregot[tipmancodigo])
	{
		$sbregottipomant = loadrecordtipomant($sbregot[tipmancodigo],$idcon);
	   	$tipmannombre = $sbregottipomant[tipmannombre];
	}
   	
   	//Carga el nombre del equipo
	if($sbregot[equipocodigo])
	{
	   	$sbregotequipo = loadrecordequipo($sbregot[equipocodigo],$idcon);
	   	$equiponombre = $sbregotequipo[equiponombre];
	}
	
 	if($sbregot[componcodigo])
	{
	   	$sbregotcomponen = loadrecordcomponen($sbregot[componcodigo],$idcon);
	   	$componnombre = $sbregotcomponen[componnombre];
	}	
   	
   	//Carga el nombre del sistema
	if($sbregot[sistemcodigo])
	{
	   	$sbregotsistema = loadrecordsistema($sbregot[sistemcodigo],$idcon);
	   	$sistemnombre = $sbregotsistema[sistemnombre];
	}
   	//Carga el nombre de la planta
	if($sbregot[plantacodigo])
	{
	   	$sbregotplanta = loadrecordplanta($sbregot[plantacodigo],$idcon);
	   	$plantanombre = $sbregotplanta[plantanombre];
	}   	
   	//Hallamos el codigo de tareot
   	$sbregottareot1 = loadrecordtareot2($sbregot[ordtracodigo],$idcon);
   	$sbregottareot = loadrecordtareot($sbregottareot1[tareotcodigo],$idcon);
	
   	//Carga el nombre de la prioridad
	if($sbregottareot[prioricodigo])
	{
		
	   	$sbregotpriorida = loadrecordpriorida($sbregottareot[prioricodigo],$idcon);
	   	$priorinombre = $sbregotpriorida[priorinombre];
	}
//--------------------------------------------------------------------------------------
   	//Armamos el arreglo para buscar en usuariotareot por el codigo de tareot
   	$sbregotusuariotareot[usutarcodigo] = "";
   	$sbregotusuariotareot[usuacodi] = "";
   	$sbregotusuariotareot[tareotcodigo] = $sbregottareot1[tareotcodigo];
   	$sbregotusuariotareot[usutarlider] = "";
   	$idusutareot = dinamicscanusuariotareot($sbregotusuariotareot,$idcon);
   	
   	  	
   	$t = 0;

if($idusutareot){
	$nuCantrow = fncnumreg($idusutareot );
	//recorremos el arreglo para determinar los usuarios de la ot
	
	for($i = 0;$i < $nuCantrow; $i++){
		$sbregusua = fncfetch($idusutareot,$i);
		
	
		if($sbregusua[usutarlider] == "t"){
			$lider = $sbregusua[usuacodi];
			$sbregusuario = loadrecordusuario($sbregusua[usuacodi],$idcon);
			
			$usuacodigo = $sbregusua[usuacodi];
			
			$sbregusuanom = $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape];
			
		}else{
			$sbregusuaselec[] = $sbregusua[usuacodi];
			
			$sbregustarcoditmp = ($t == 0) ? $sbregusua[usutarcodigo] : $sbregustarcoditmp.",".$sbregusua[usutarcodigo];
			$t++;
		}
		if(!$arreglo_tecnic)
			$arreglo_tecnic = $sbregusua[usuacodi];
		else
			$arreglo_tecnic = $arreglo_tecnic.",".$sbregusua[usuacodi];
		
	}
}
   	
//--------------------------------------------------------------------------------------   	
   	//Armamos el arreglo para buscar en tareotherramie con el codigo de tareot
//   	$sbregottareotherramie[tarherrcodigo] = "";
//   	$sbregottareotherramie[tareotcodigo] = $sbregottareot1[tareotcodigo];
//   	$sbregottareotherramie[transhercodigo] = "";
//   	$idtareotherram = dinamicscantareotherramie($sbregottareotherramie,$idcon);
//   	if($idtareotherram > 0)
//   	{
//   		$nuCantrow1 = fncnumreg($idtareotherram);
//   		//recorremos el arreglo para determinar las transacciones de herramientas de la ot
//	   	for($j = 0;$j < $nuCantrow1; $j++)
//	   	{
//	   		$sbregottarherr = fncfetch($idtareotherram,$j);
//	   		$sbregottransher = loadrecordtransacherramie($sbregottarherr[transhercodigo],$idcon);
//	   		$herrseleccodi[] = $sbregottransher[herramcodigo];
//	   		$herrseleccant[] = $sbregottransher[transhercanti];
//	   	}
//   	}
//   	
//--------------------------------------------------------------------------------------
   	//Armamos el arreglo para buscar en itemtareot con el codigo de tareot
   	$sbregotitemtareot[itemtarecodigo] = "";
   	$sbregotitemtareot[tareotcodigo] = $sbregottareot1[tareotcodigo];
   	$sbregotitemtareot[transitecodigo] = "";
   	$iditemtareot = dinamicscanitemtareot($sbregotitemtareot,$idcon);
   	if($iditemtareot > 0)
   	{
   		$nuCantrow2 = fncnumreg($iditemtareot);
   		//recorremos el arreglo para determinar las transacciones de herramientas de la ot
	   	for($k = 0;$k < $nuCantrow2; $k++)
	   	{
	   		$sbregotitemtar = fncfetch($iditemtareot,$k);
	   		$sbregottransite = loadrecordtransacitem($sbregotitemtar[transitecodigo],$idcon);
	   		$itemseleccodi[] = $sbregottransite[itemcodigo];
	   		$itemseleccant[] = $sbregottransite[transitecantid];
	   	}
   	}
//--------------------------------------------------------------------------------------
   	//Carga el nombre del tipo de trabajo
   	$sbregottipotrab = loadrecordtipotrab($sbregottareot1[tiptracodigo],$idcon);
   	$tiptranombre = $sbregottipotrab[tiptranombre];
   	
   	//Carga el nombre de la tarea
   	$sbregottarea = loadrecordtarea($sbregottareot1[tareacodigo],$idcon);
   	$tareanombre = $sbregottarea[tareanombre];
   	
   	$tareotnota = $sbregottareot[tareotnota];
   	//fncclose($idcon);
//--------------------------------------------------------------------------------------   	
   	//Carga el nombre de las fechas de ot
	$ordtrafecgen = $sbregot[ordtrafecgen];
	if($sbregot['ordtrahorgen'])
	{
		$horagen = strtok($sbregot['ordtrahorgen'],":");
		$minutogen = strtok(":");
		if($horagen>12)
		{
			$horagen = $horagen-12;
			if($horagen<10)
				$horagen = "0".$horagen;
		}
		$ordtrahorgen=$horagen.":".$minutogen;
	}
	$ordtrafecini = $sbregot[ordtrafecini];
	$ordtrafecfin = $sbregot[ordtrafecfin];
	if($sbregot['ordtrahorini'])
	{
		$horaini = strtok($sbregot['ordtrahorini'],":");
		$minutoini = strtok(":");
		if($horaini>12)
		{
			$horaini = $horaini-12;
			if($horaini<10)
				$horaini = "0".$horaini;
		}
		$ordtrahorini=$horaini.":".$minutoini;
	}
	if($sbregot['ordtrahorfin'])
	{
		$horafin = strtok($sbregot['ordtrahorfin'],":");
		$minutofin = strtok(":");
		if($horafin>12)
		{
			$horafin = $horafin-12;
			if($horafin<10)
				$horafin = "0".$horafin;
		}
		$ordtrahorfin=$horafin.":".$minutofin;
	}	
   	$annogen = strtok($sbregot[ordtrafecgen],"-");
	$mesgen = strtok("-");
	$diagen = strtok("-");
	$horagen = strtok($sbregot[ordtrahorgen],":");
	$minutogen = strtok(":");
   	$anno = strtok($sbregot[ordtrafecini],"-");
	$mes = strtok("-");
	$dia = strtok("-");
	$hora = strtok($sbregot[ordtrahorini],":");
	$minuto = strtok(":");
	$anno1 = strtok($sbregot[ordtrafecfin],"-");
	$mes1 = strtok("-");
	$dia1 = strtok("-");
	$hora1 = strtok($sbregot[ordtrahorfin],":");
	$minuto1 = strtok(":");
	
	fncclose($idcon);

?>