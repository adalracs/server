<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Autor           : cbedoya
Fecha           : 25-November-2007
*/

include("../src/FunGen/cargainput.php");

$idcon = fncconn();
if (!$sbreg) 
	$sbreg = loadrecordvistaotservicioest($ordtracodigo,$idcon); //Carga la orden de trabajo servicio
$sbregclienteot = loadrecordclienteot($sbreg[clientsolici],$idcon); //Carga datos del cliente ot




$sbregtarea = cargatareanombre1($sbreg[tareacodigo],$idcon); //Carga el nombre del tarea

$sbregservicio = cargaservicionombre($sbreg[servicicodigo],$idcon); //Carga el nombre del servicio
$sbregpriorida = cargapriorinombre($sbreg[prioricodigo],$idcon); //Carga el nombre de la priorida
$sbregdepto = cargadeptonombre($sbregclienteot[deptocodigo],$idcon);  //Carga el nombre del departamento
$sbregciudad = cargaciudadnombre($sbregclienteot[ciudadcodigo],$idcon); //Carga el nombre del ciudad



//Carga el nombre de las fechas de ot
$annogen = strtok($sbreg[ordtrafecgen],"-");
$mesgen = strtok("-");
$diagen = strtok("-");
$horagen = strtok($sbreg[ordtrahorgen],":");
$minutogen = strtok(":");


// Convierte a formato de 12 horas
$horcarg = $horagen;

if ($horcarg == 00){
	$horcarg = 12;
	$inPm = true;
}elseif ($horcarg > 12){
	$horcarg -= 12;
	if ($horinic < 10){
		$horcarg = "0".$horcarg;
	}
	$inPm = true;
}
?>