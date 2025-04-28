<?php
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Descripcion: Despliega las datos especificos
* 			   relacionados a un euqipo especifico
*
* Fecha: 09122006
* Autor: mstroh
*
* Historial de modificaciones
* ---------------------------
* Autor     | Fecha		| Motivo
**/

	include("../src/FunPerSecNiv/fncconn.php");
	include("../src/FunPerSecNiv/fncclose.php");
	include("../src/FunPerSecNiv/fncfetch.php");
	include("../src/FunPerSecNiv/fncnumreg.php");
	include("../src/FunGen/cargainput.php");

	$idcon = fncconn();

	// Datos de planta
	$plantanombre = cargaplantanombre($plantacodigo, $idcon);

	$iRegdatapost['plantacodigo'] = $plantacodigo;
	$iRegdatapost['sistemcodigo'] = $sistemcodigo;
	$iRegdatapost['equipocodigo'] = $equipocodigo;
	$iRegdatapost['componcodigo'] = $componcodigo;

	$iRegdatapostop['plantacodigo'] = "=";
	$iRegdatapostop['sistemcodigo'] = "=";
	$iRegdatapostop['equipocodigo'] = "=";
	$iRegdatapostop['componcodigo'] = "=";

	// Datos de sistema
	$arrsistema = dinamicscanopsistema($iRegdatapost, $iRegdatapostop, $idcon);
		
	// Datos de equipo
	$arrequipo = dinamicscanopequipo($iRegdatapost, $iRegdatapostop, $idcon);
		
	// Datos de Componente
	if($componcodigo || $equipocodigo)
		$arrcomponen = dinamicscanopcomponen($iRegdatapost, $iRegdatapostop, $idcon);
	
/*
// Datos de centro de costo
$arrcentcost = loadrecordcentcost($arrequipo['cencoscodigo'], $idcon);
// Datos de centro de estado
$arrestado = loadrecordestado($arrequipo['estadocodigo'], $idcon);
// Datos de tipo de equipo
$arrtipoequipo = loadrecordtipoequipo($arrequipo['tipequcodigo'], $idcon);
// Datos de la OT
//$arrot = loadrecordot ($arrequipo['otcodigo'], $idcon);
// Datos de las tareas
//$arrtareot = loadrecordtareot ($arrot['tareotcodigo'], $idcon);*/
fncclose($idcon);
?>