<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Autor           : cbedoya
Fecha           : 25-November-2007
*/

	include("../src/FunGen/cargainput.php");
	
	include_once('../src/FunPerPriNiv/pktbltareot.php');
	
	
	$idcon = fncconn();
	$sbregclienteot = loadrecordclienteot($sbreg[clientsolici],$idcon); //Carga datos del cliente ot
	
	//$sbregvistaotservicioest = loadrecordvistaotservicioest($sbreg[ordtracodigo],$idcon);
	$sbregtarea = cargatareanombre1($sbreg[tareacodigo],$idcon); //Carga el nombre del tarea
	$sbregservicio = cargaservicionombre($sbreg[servicicodigo],$idcon); //Carga el nombre del servicio
	$sbregpriorida = cargapriorinombre($sbreg[prioricodigo],$idcon); //Carga el nombre de la priorida
	$sbregdepto = cargadeptonombre($sbregclienteot[deptocodigo],$idcon);  //Carga el nombre del departamento
	$sbregciudad = cargaciudadnombre($sbregclienteot[ciudadcodigo],$idcon); //Carga el nombre del ciudad
	$sbregimplantador = cargausua1nomb($sbreg[usuacodi],$idcon); //Carga el nombre del usuario
	$sbregestado = cargaotestanombre($sbreg[otestacodigo],$idcon); //Carga el nombre del estado
		
	$iregtareot[ordtracodigo] = $sbreg[ordtracodigo];
	$iregtareotop[tareotsecuen] = "=";
	$iregtareotop[ordtracodigo] = "=";
	$iregtareot[tareotsecuen] = 0;
	
	$nuResult = dinamicscanoptareot($iregtareot, $iregtareotop, $idcon);
	$sbregtareot = pg_fetch_row ($nuResult,cero);

	/*$annoorini = strtok($sbregtareot[9],"-");
	$mesorini = strtok("-");
	$diaorini = strtok("-");*/
	$horaorini = strtok($sbregtareot[8],":");
	$minutoorini = strtok(":");
	
	$horaorini1= converhor($horaorini);
	$annoorfin = strtok($sbregtareot[11],"-");
	$mesorfin = strtok("-");
	$diaorfin = strtok("-");
	$horaorfin = strtok($sbregtareot[10],":");
	$minutoorfin = strtok(":");
	
	$horaorfin1= converhor($horaorfin);






	//Carga el nombre de las fechas de ot
	$annogen = strtok($sbreg[ordtrafecgen],"-");
	$mesgen = strtok("-");
	$diagen = strtok("-");
	$horagen = strtok($sbreg[ordtrahorgen],":");
	$minutogen = strtok(":");

	$anno = strtok($sbregclienteot[clientfecsol],"-");
	$mes = strtok("-");
	$dia = strtok("-");
	$hora = strtok($sbregclienteot[clienthorsol],":");
	$minuto = strtok(":");

	$anno1 = strtok($sbregclienteot[clientfecco],"-");
	$mes1 = strtok("-");
	$dia1 = strtok("-");
	$hora1 = strtok($sbregclienteot[clienthorco],":");
	$minuto1 = strtok(":");

	$annoini = strtok($sbregtareot[11],"-");
	$mesini = strtok("-");
	$diaini = strtok("-");
	$horaini = strtok($sbregtareot[10],":");
	$minutoini = strtok(":");
	// Convierte a formato de 12 horas
	$horgen = converhor($horagen);
	$horsol = converhor($hora);
	$horco = converhor($hora1);
	$horaordini = converhor($horaini);

	function converhor($hora){
		if ($hora == 00){
			$hora = 12;
		}elseif ($hora > 12){
			$hora -= 12;
		
			if ($hora < 10)
				$hora = "0".$hora;		
		}
		return $hora;
	}
?>