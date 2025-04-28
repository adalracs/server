<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Autor           : lfolaya
Fecha           : 24012005

Historial de modificaciones
---------------------------

--FECHA--    	--MOTIVO--												--AUTOR--
14-08-2007		Se modifico para generar el detalle de las				cbedoya 
				programaciones
			
*/

include ( '../src/FunGen/cargainput.php');


$idcon = fncconn();
//Carga la lista de las ot's programadas
$sbregProgram = loadrecordgrupprogramacion($sbreg[progranumgru],$idcon);//ok




for($i = 0;$i < count($sbregProgram); $i++){
	if ($sbregProgram[$i]['equipocodigo'] != null){
		$nombreEq = cargaequiponombre($sbregProgram[$i]['equipocodigo'],$idcon);
	}else{
		$nombreEq = "";
	}
	if ($sbregProgram[$i]['componcodigo'] != null){
		$nombreCom = cargacomponnombre($sbregProgram[$i]['componcodigo'],$idcon);
	}else{
		$nombreCom = "";
	}
	$sbListaprogram[$i] = array(
				"ordtracodigo"=>$sbregProgram[$i]['ordtracodigo'],
				"equiponombre"=>$nombreEq,
				"componnombre"=>$nombreCom,
				"sistemnombre"=>$sbregProgram[$i]['sistemnombre'],
				"tiptranombre"=>$sbregProgram[$i]['tiptranombre'],
				"tareanombre"=>$sbregProgram[$i]['tareanombre'],
				"otestanombre"=>$sbregProgram[$i]['otestanombre'],
				"progratiedur"=>$sbregProgram[$i]['progratiedur']
				);
}

//Carga el nombre del sistema
if(!empty($sbreg['sistemcodigo']))//ok
{
	$sbregsistema = loadrecordsistema($sbreg[sistemcodigo],$idcon);
	$sbregsistnom = $sbregsistema[sistemnombre];
}



//Carga el nombre del componente
if(!empty($sbreg['componcodigo']))//ok
{
	$sbregcomponen = loadrecordcomponen($sbreg[componcodigo],$idcon);
	$sbregcompnomb = $sbregcomponen[componnombre];
}












//Carga el nombre de la planta
if(!empty($sbreg['plantacodigo']))//ok
{
	$sbregplanta = loadrecordplanta($sbreg[plantacodigo],$idcon);
	$sbregplannom = $sbregplanta[plantanombre];
}


//Carga el nombre del tipode mantenimiento
$sbregtipomant = loadrecordtipomant($sbreg[tipmancodigo],$idcon);//ok
$sbregtipmanom = $sbregtipomant[tipmannombre];//ok

//Hallamos el codigo de tareot
$sbregtareot1 = loadrecordtareotprogram($sbreg[progracodigo],$idcon);
$sbregtareot = loadrecordtareot($sbregtareot1[tareotcodigo],$idcon);

$sbregot=loadrecordot($sbregtareot1[ordtracodigo],$idcon);

//Hallamos el codigo de usuariotareot
$sbregustareottmp = loadrecordusuariotareot1($sbregtareot1[tareotcodigo], $idcon);
$codusuariotareot = $sbregustareottmp[usutarcodigo];

//--------------------------------------------------------------------------------------
//Armamos el arreglo para buscar en usuariotareot por el codigo de tareot
$sbregusuariotareot[usutarcodigo] = "";
$sbregusuariotareot[usuacodi] = "";
$sbregusuariotareot[tareotcodigo] = $sbregtareot1[tareotcodigo];
$sbregusuariotareot[usutarlider] = "";
$idusutareot = dinamicscanusuariotareot($sbregusuariotareot,$idcon);
$t = 0;

if($idusutareot)
{
	$nuCantrow = fncnumreg($idusutareot );
	//recorremos el arreglo para determinar los usuarios de la ot
	for($i = 0;$i < $nuCantrow; $i++)
	{
		$sbregusua = fncfetch($idusutareot,$i);
		if($sbregusua[usutarlider] == "t")
		{
			$sbregusuario = loadrecordusuario($sbregusua[usuacodi],$idcon);
			$usuacodigo = $sbregusua[usuacodi];
			$sbregusuanom = $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape];
		}
		else
		{
			$sbregusuaselec[] = $sbregusua[usuacodi];
			$sbregustarcoditmp = ($t == 0) ? $sbregusua[usutarcodigo] : $sbregustarcoditmp.",".$sbregusua[usutarcodigo];
			$t++;
		}
	}
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

//Carga el nombre de la prioridad
$sbregpriorida = loadrecordpriorida($sbregtareot1[prioricodigo],$idcon);
$sbregpriornom = $sbregpriorida[priorinombre];

$sbregtarnota = $sbregtareot[tareotnota];
fncclose($idcon);
//--------------------------------------------------------------------------------------
//Carga el nombre de las fechas de ot
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

// Convierte a formato de 12 horas
$horinic = $hora;
$horaend = $hora1;

if ($horinic == 00)
{
	$horinic = 12;
	$inPm = true;
}
elseif ($horinic > 12)
{
	$horinic -= 12;
	if ($horinic < 10)
	{
		$horinic = "0".$horinic;
	}
	$inPm = true;
}

if ($horaend == 00)
{
	$horaend = 12;
	$endPm = true;
}
elseif ($horaend > 12)
{
	$horaend -= 12;
	if ($horaend < 10)
	{
		$horaend = "0".$horaend;
	}
	$endPm = true;
}
?>