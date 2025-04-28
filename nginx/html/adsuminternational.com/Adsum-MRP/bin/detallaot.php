<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Autor           : lfolaya
Fecha           : 24012005

Historial de modificaciones
---------------------------

--FECHA--    	--MOTIVO--												--AUTOR--

18-ene-2006		Relaciones entre PLANTA-SISTEMA-EQUIPO-COMPONENTE		mstroh
				causan problemas al detallar OT.
*/
$idcon = fncconn();
//Carga el nombre del tipode mantenimiento
$sbregtipomant = loadrecordtipomant($sbreg[tipmancodigo],$idcon);
$sbregtipmanom = $sbregtipomant[tipmannombre];

//Carga el nombre del tipo de falla
$sbregtipofall = loadrecordtipofall($sbreg[tipfalcodigo],$idcon);
$sbregtipfalnombre = $sbregtipofall[tipfalnombre];

//Carga el nombre del equipo
if(!empty($sbreg['equipocodigo']))
{
	$sbregequipo = loadrecordequipo($sbreg[equipocodigo],$idcon);
	$sbregequinom = $sbregequipo[equiponombre];
}

//Carga el nombre del sistema
if(!empty($sbreg['sistemcodigo']))
{
	$sbregsistema = loadrecordsistema($sbreg[sistemcodigo],$idcon);
	$sbregsistnom = $sbregsistema[sistemnombre];
}

//Carga el nombre de la planta
if(!empty($sbreg['plantacodigo']))
{
	$sbregplanta = loadrecordplanta($sbreg[plantacodigo],$idcon);
	$sbregplannom = $sbregplanta[plantanombre];
}

//Carga el nombre del componente
if(!empty($sbreg['componcodigo'])){
	$sbregcomponen = loadrecordcomponen($sbreg[componcodigo],$idcon);
	$sbregcompnomb = $sbregcomponen[componnombre];
}

//Carga los datos de la solicitud de servicio
if(!empty($sbreg['solsercodigo']))
{
	$sbregsolser = loadrecordsoliserv($sbreg[solsercodigo],$idcon);
	
	$sbregsolserco = $sbregsolser[solsercodigo];
	$sbregsolsermo = $sbregsolser[solsermotivo];
}
else if ($sbreg['solsercodigo'] == null) 
{
	$sbregmensaje = "La Orden de Trabajo no se genero a partir de la Solicitud de Servicio";
}

//Hallamos el codigo de tareot
$sbregtareot1 = loadrecordtareot2($sbreg[ordtracodigo],$idcon);
$sbregtareot = loadrecordtareot($sbregtareot1[tareotcodigo],$idcon);

$progracodigo = $sbregtareot['progracodigo'];
//Carga el nombre del estado de la OT

	$sbregotestado = loadrecordotestado($sbregtareot[otestacodigo],$idcon);
	$sbregotestadonom = $sbregotestado[otestanombre];

//Hallamos el codigo de usuariotareot
$sbregustareottmp = loadrecordusuariotareot1($sbregtareot1[tareotcodigo], $idcon);
$codusuariotareot = $sbregustareottmp[usutarcodigo];

//--------------------------------------------------------------------------------------
//Armamos el arreglo para buscar en usuariotareot por el codigo de tareot
$sbregtareot =loadrecordmaxtareot2($sbreg[ordtracodigo],$idcon);

$sbregusuariotareot[usutarcodigo] = "";
$sbregusuariotareot[usuacodi] = "";
$sbregusuariotareot[tareotcodigo] = $sbregtareot[tareotcodigo];
$sbregusuariotareot[usutarlider] = "";
$idusutareot = dinamicscanusuariotareot($sbregusuariotareot,$idcon);

$t = 0;

if($idusutareot){
	$nuCantrow = fncnumreg($idusutareot );
	//recorremos el arreglo para determinar los usuarios de la ot
	
	for($i = 0;$i < $nuCantrow; $i++){
		$sbregusua = fncfetch($idusutareot,$i);
		
		
		if($sbregusua['cuadricodigo']):
			$typesource = 'cuadrilla';
			$lsttecnicoot = $sbregusua['cuadricodigo'];
		else:
			$typesource = 'user';
		endif;
			
			
		if($sbregusua[usutarlider] == "t"){
			$lider = $sbregusua[usuacodi];
			$sbregusuario = loadrecordusuario($sbregusua[usuacodi],$idcon);
			
			$usuacodigo1 = $sbregusua[usuacodi];
			
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
	$lsttecnicoot = $arreglo_tecnic;
	$usualider = $lider;
}
//--------------------------------------------------------------------------------------
//Armamos el arreglo para buscar en tareotherramie con el codigo de tareot
$sbregtareotherramie[tarherrcodigo] = "";
$sbregtareotherramie[tareotcodigo] = $sbregtareot1[tareotcodigo];
$sbregtareotherramie[transhercodigo] = "";
$idtareotherram = dinamicscantareotherramie($sbregtareotherramie,$idcon);
if($idtareotherram > 0)
{
	$nuCantrow1 = fncnumreg($idtareotherram);
	//recorremos el arreglo para determinar las transacciones de herramientas de la ot
	for($j = 0;$j < $nuCantrow1; $j++)
	{
		$sbregtarherr = fncfetch($idtareotherram,$j);
		$sbregtransher = loadrecordtransacherramie($sbregtarherr[transhercodigo],$idcon);
		$herrseleccodi[] = $sbregtransher[herramcodigo];
		$herrseleccant[] = $sbregtransher[transhercanti];
	}
}

//--------------------------------------------------------------------------------------
//Armamos el arreglo para buscar en itemtareot con el codigo de tareot
$sbregitemtareot[itemtarecodigo] = "";
$sbregitemtareot[tareotcodigo] = $sbregtareot1[tareotcodigo];
$sbregitemtareot[transitecodigo] = "";
$iditemtareot = dinamicscanitemtareot($sbregitemtareot,$idcon);
if($iditemtareot > 0)
{
	$nuCantrow2 = fncnumreg($iditemtareot);
	//recorremos el arreglo para determinar las transacciones de herramientas de la ot
	for($k = 0;$k < $nuCantrow2; $k++)
	{
		$sbregitemtar = fncfetch($iditemtareot,$k);
		$sbregtransite = loadrecordtransacitem($sbregitemtar[transitecodigo],$idcon);
		$itemseleccodi[] = $sbregtransite[itemcodigo];
		$itemseleccant[] = $sbregtransite[transitecantid];
	}
}
//--------------------------------------------------------------------------------------
//Carga el nombre del tipo de trabajo
$sbregtipotrab = loadrecordtipotrab($sbregtareot1[tiptracodigo],$idcon);
$sbregtipotnom = $sbregtipotrab[tiptranombre];

//Carga el nombre de la tarea
$sbregtarea = loadrecordtarea($sbregtareot1[tareacodigo],$idcon);
$sbregtareanom = $sbregtarea[tareanombre];

//Carga el nombre de la prioridad
$sbregpriorida = loadrecordpriorida($sbregtareot1[prioricodigo],$idcon);
$sbregpriornom = $sbregpriorida[priorinombre];

$sbregtarnota = $sbregtareot1[tareotnota];

// Usuario que genero la Orden de Trabajo

$usuariogen = loadrecordusuario($sbregtareot[usuacodi],$idcon);


fncclose($idcon);
//--------------------------------------------------------------------------------------
//Carga el nombre de las fechas de ot
$annogen = strtok($sbreg[ordtrafecgen],"-");
$mesgen = strtok("-");
$diagen = strtok("-");
$horagen = strtok($sbreg[ordtrahorgen],":");
$minutogen = strtok(":");
$anno = strtok($sbreg[ordtrafecini],"-");
$mes = strtok("-");
$dia = strtok("-");
$hora = strtok($sbreg[ordtrahorini],":");
$minini = strtok(":");
$anno1 = strtok($sbreg[ordtrafecfin],"-");
$mes1 = strtok("-");
$dia1 = strtok("-");
$hora1 = strtok($sbreg[ordtrahorfin],":");
$minfin = strtok(":");

// Convierte a formato de 12 horas
$horini = $hora;
$horfin = $hora1;

if ($horini == 00){
	$horini = 12;
	$inPm = true;
}elseif ($horini > 12){
	$horini -= 12;
	if ($horini < 10){
		$horini = "0".$horini;
	}
	$inPm = true;
}

if ($horfin == 00){
	$horfin = 12;
	$endPm = true;
}elseif ($horfin > 12){
	$horfin -= 12;
	if ($horfin < 10){
		$horfin = "0".$horfin;
	}
	$endPm = true;
}
?>